<?php

namespace App\KhadamatTeck\Public\Merchants\Services;

use App\KhadamatTeck\Public\Merchants\Repositories\MerchantsRepository;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Merchant\Merchants\Mappers\MerchantDTOMapper;

class MerchantsService extends Service
{
    /**
     * @var MerchantsRepository $merchantsRepository
     * AE
     */
    private MerchantsRepository $merchantsRepository;

    public function __construct(MerchantsRepository $merchantsRepository)
    {
        parent::__construct($merchantsRepository);
        $this->merchantsRepository = $merchantsRepository;
    }

    public function getByCode(\App\KhadamatTeck\Public\Merchants\Requests\ViewMerchantRequest $request, string $code)
    {
        $model = $this->merchantsRepository->findMerchantByCode($code);
        $data = MerchantDTOMapper::mapFromDB($model);

        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
