<?php

namespace App\KhadamatTeck\Admin\Users\Services;

use App\KhadamatTeck\Admin\Users\Enums\UserOtpNotifyTypes;
use App\KhadamatTeck\Admin\Users\Mappers\UserDTOMapper;
use App\KhadamatTeck\Admin\Users\Models\User;
use App\KhadamatTeck\Admin\Users\Repositories\UsersRepository;
use App\KhadamatTeck\Admin\Users\Requests\Auth\ForgotRequest;
use App\KhadamatTeck\Admin\Users\Requests\Auth\LoginRequest;
use App\KhadamatTeck\Admin\Users\Requests\Auth\PhoneLoginRequest;
use App\KhadamatTeck\Admin\Users\Requests\Auth\RegisterRequest;
use App\KhadamatTeck\Admin\Users\Requests\Auth\ResetPasswordRequest;
use App\KhadamatTeck\Admin\Users\Requests\Auth\VerifyPhoneLogin;
use App\KhadamatTeck\Admin\Users\Requests\CreateUserRequest;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\Mail\SendMail;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Ichtrojan\Otp\Models\Otp as ModelOtp;
class AuthService
{
    /**
     * @var UsersRepository $usersRepository
     */
    private UsersRepository $usersRepository;

    private $allowed_actions = [ // TODO latter AE
        "order" => [
            "create" => true,
            "update" => true
        ],
        "user" => [
            "create" => true,
            "update" => true
        ]
    ];

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function registerUser(RegisterRequest $request)
    {
        $user = UserDTOMapper::mapFromRequest($request);
        $user = UserDTOMapper::fromModel(
            $this->usersRepository->create($user->toArray())
        );

        return $this->response()
            ->setData([
                'user' => $user,
                'token' => $this->usersRepository->createPersonalToken($user->getId()),
            ])
            ->setStatusCode(HttpStatus::HTTP_OK)->json();
    }

    public function createUser(CreateUserRequest $request)
    {
        return $this->response()
            ->setData($this->usersRepository->create($request->validated()))
            ->setStatusCode(HttpStatus::HTTP_OK)->json();
    }

    /**
     * @throws ValidationException
     */
    public function loginUser(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token,'user'=>UserDTOMapper::fromModel($user)];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    /**
     * @throws ValidationException
     */
    public function loginUserWithOTP(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->merge([
                    "phone" => User::where("email", $request->email)->first()->phone
                ]);
                $mRequest = new PhoneLoginRequest();
                $mRequest->merge([
                    "phone" => AdminAuth()->user()->phone,
                ]);
                return $this->phoneLoginUser($mRequest);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }


    }

    /**
     * @throws ValidationException
     */
    public function verifyLoginUserWithOTP(LoginRequest $request)
    {

        // check password
        if (!AdminAuth()->attempt($request->only(['email', 'password']))) {
            throw ValidationException::withMessages([
                'password' => [trans('auth.failed')],
            ]);
        }

        // check otp
        $request->merge([
            "phone" => User::where("email", $request->email)->first()->phone
        ]);

        $otp = new Otp;
        $otp = $otp->validate($request->phone, $request->token);

        if (!$otp->status) {
            throw ValidationException::withMessages([
                'token' => [$otp->message],
            ]);
        }

        // login
        $user = $this->usersRepository->findOneByPhone($request->phone);
        Auth::login($user);

        request()->merge(['includePermissionGroups' => true]);
        return $this->response()
            ->setData([
                'user' => UserDTOMapper::fromModel($user),
                'token' => $this->usersRepository->createPersonalToken($user->id),
            ])
            ->setStatusCode(HttpStatus::HTTP_OK)->json();
    }


    public function logout()
    {
        $user = AdminAuth()->user()->token();
        $user->revoke();
        Request::session()->invalidate();
        Request::session()->regenerateToken();
        return $this->response()
            ->setData([
                'user' => (object)[],
                'token' => '',
            ])
            ->setStatusCode(HttpStatus::HTTP_OK)->json();
    }

    public function phoneLoginUser(PhoneLoginRequest $request)
    {
        $executed = RateLimiter::attempt('send-otp:' . $request->phone, $perMinute = 1, function () use ($request) {
            if (URL::to('/') == 'http://khadamat-teck.com' /*||URL::to('/') == 'http://127.0.0.1:8000'*/) {
                ModelOtp::where('identifier', $request->phone)->delete();
                $otp = ModelOtp::create([
                    'identifier' => $request->phone,
                    'token' => 9988,
                    'validity' => 10
                ]);
            } else {
                $otp = new Otp;
                $otp = $otp->generate($request->phone,'alpha_numeric',10);
            }
            $user = $this->usersRepository->findOneByPhone($request->phone);
            if ($user?->otp_notify_type == UserOtpNotifyTypes::SMS) {
                send_sms($request->phone, "#$otp->token is your KhadamatTeck verification code");
            } elseif ($user->otp_notify_type == UserOtpNotifyTypes::EMAIL) {
                Mail::to($user->email)->send(new SendMail($otp->token, true));
            } else {
                send_sms($request->phone, "#$otp->token is your KhadamatTeck verification code");
                Mail::to($user->email)->send(new SendMail($otp->token, true));
            }
        });

        if (!$executed) {
            throw ValidationException::withMessages([
                'token' => [trans('auth.too_many_otp')],
            ]);
        }
        return $this->response()->setData([
            'message' => trans('auth.send_otp_success'),
        ])->setStatusCode(HttpStatus::HTTP_OK)->json();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $otpClass = new Otp();
        $otp = $otpClass->validate($request->email, $request->token);
        if (!$otp->status) {
            throw ValidationException::withMessages([
                'token' => [trans('passwords.token')],
            ]);
        }
        $user = $this->usersRepository->findOneByEmail($request->email);
        $user->forceFill([
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return $this->response()->setStatusCode(HttpStatus::HTTP_OK)->setData([
            'message' => trans('passwords.reset'),
        ])->json();
    }

    public function forgotPassword(ForgotRequest $request)
    {
        $executed = RateLimiter::attempt('send-otp:' . $request->email, $perMinute = 1, function () use ($request) {
            $this->sendMail($request->email);
        });

        if (!$executed) {
            throw ValidationException::withMessages([
                'token' => [trans('auth.too_many_otp')],
            ]);
        }

        return $this->response()->setData([
            'message' => trans('passwords.sent'),
        ])->setStatusCode(HttpStatus::HTTP_OK)->json();
    }

    public function sendMail($email)
    {
        $otpClass = new Otp;
        $otp = $otpClass->generate($email,'alpha_numeric',10);
        Mail::to($email)->send(new SendMail($otp->token));
    }

    public function verifyPhoneLoginUser(VerifyPhoneLogin $request)
    {
        $otp = new Otp;
        $otp = $otp->validate($request->phone, $request->token);

//        if (App::environment(['local', 'staging', 'dev']) || $request->token == env('TEST_OTP_VALUE')) {
//            $otp->status = true;
//        }

        if (!$otp->status) {
            throw ValidationException::withMessages([
                'token' => [$otp->message],
            ]);
        }

        $user = $this->usersRepository->findOneByPhone($request->phone);
        return $this->response()
            ->setData([
                'user' => $user,
                'token' => $this->usersRepository->createPersonalToken($user->id),
            ])
            ->setStatusCode(HttpStatus::HTTP_OK)->json();
    }

    public function loggedInUser()
    {
        request()->merge(['includePermissionGroups' => true]);
        return $this->response()
            ->setData([
                'user' => UserDTOMapper::fromModel(AdminAuth()->user())
            ])
            ->setStatusCode(HttpStatus::HTTP_OK)->json();
    }



    protected function response(): Response
    {
        return (new Response());
    }
}
