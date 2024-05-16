<?php

namespace App\KhadamatTeck\Merchant\Dashboard\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Merchant\Dashboard\Mappers\DashboardDTOMapper;
use App\KhadamatTeck\Merchant\Dashboard\Repositories\DashboardRepository;
use App\KhadamatTeck\Merchant\Dashboard\Requests\CreateDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\DeleteDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\ListDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\UpdateDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\ViewDashboardRequest;
use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;
use App\KhadamatTeck\Merchant\Orders\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class DashboardService extends Service
{
    /**
     * @var DashboardRepository $dashboardRepository
     * AE
     */
    private DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        parent::__construct($dashboardRepository);
        $this->dashboardRepository = $dashboardRepository;
    }

    public function paginateDashboard(ListDashboardRequest $request): Response
    {
        $response = $this->response();
        if ($request->has('listing')) {
            $data = $this->dashboardRepository->minimalListWithFilter();
            $response->setData($data);
        } else {
            $data = $this->dashboardRepository->paginateDashboard(
                $request->query(),
                $request->query('perPage')
            );
            $data = DashboardDTOMapper::fromPaginator($data);
            $response->setData($data['items'])->setMeta($data['meta']);
        }
        return $response->setStatusCode(HttpStatus::HTTP_OK);
    }


    public function createDashboard(CreateDashboardRequest $request): Response
    {
        $data = $this->dashboardRepository->createDashboard($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateDashboard(UpdateDashboardRequest $request, $id): Response
    {
        $model = $this->dashboardRepository->findDashboard($id);
        $data = $this->dashboardRepository->updateDashboard(
            $model,
            $request->all()
        );

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function deleteDashboard(DeleteDashboardRequest $request, $id): Response
    {
        $model = $this->dashboardRepository->findDashboard($id);
        return $this->response()
            ->setData($this->dashboardRepository->deleteDashboard($model))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function findDashboard(ViewDashboardRequest $request, $id): Response
    {
        $model = $this->dashboardRepository->findDashboard($id);
        $data = DashboardDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function figures(ViewDashboardRequest $request)
    {
        $order = Order::query();
        $users = MerchantUser::where(['status' => 'active'])->count();
        if (MerchantAuth()?->user()?->role == 'Staff') {
            $order->where(['merchant_user_id' => MerchantAuth()?->user()?->id]);
            $users = 0;
        }

        return $this->response()
            ->setData([
                'count_of_active_staff' => $users,
                'count_of_new_orders' => $order->where(['status' => 'new'])->count(),
                'count_of_in_progress_orders' => $order->where(['status' => 'in_progress'])->count(),
                'count_of_completed_orders' => $order->where(['status' => 'completed'])->count(),
            ])
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function top_staff_by_orders(ViewDashboardRequest $request): JsonResponse|Response
    {
        $top_merchants = QueryBuilder::for(
            Order::join('merchant_users', 'merchant_users.id', '=', 'orders.merchant_user_id')
                ->select('merchant_users.name', DB::raw('COUNT(orders.id) as order_count'))
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->groupBy('merchant_users.id')
            ->orderByDesc('order_count')
            ->limit(6)
            ->get();
        return $this->response()
            ->setData($top_merchants)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function top_staff_completed_orders(ViewDashboardRequest $request)
    {
        $top_merchants = QueryBuilder::for(
            Order::join('merchant_users', 'merchant_users.id', '=', 'orders.merchant_user_id')
                ->select('merchant_users.name', DB::raw('COUNT(orders.id) as order_count'))
                ->where(['orders.status' => 'completed'])
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->groupBy('merchant_users.id')
            ->orderByDesc('order_count')
            ->limit(6)
            ->get();
        return $this->response()
            ->setData($top_merchants)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function calender_orders(ViewDashboardRequest $request)
    {
        $calender_orders = QueryBuilder::for(
            Order::select(DB::raw("id as title"))->addSelect('started_at as start')->addSelect('id')
                ->whereNotIn('orders.status',[ 'completed', 'cancelled' ])
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->get();

        return $this->response()
            ->setData($calender_orders)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
