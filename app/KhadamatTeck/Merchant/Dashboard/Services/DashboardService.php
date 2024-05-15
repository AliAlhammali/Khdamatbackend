<?php
namespace App\KhadamatTeck\Merchant\Dashboard\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Merchant\Dashboard\Mappers\DashboardDTOMapper;
use App\KhadamatTeck\Merchant\Dashboard\Models\Dashboard;
use App\KhadamatTeck\Merchant\Dashboard\Repositories\DashboardRepository;
use App\KhadamatTeck\Merchant\Dashboard\Requests\CreateDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\DeleteDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\ListDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\UpdateDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\ViewDashboardRequest;

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
        $data  =$this->dashboardRepository->createDashboard($request->all());
        return $this->response()
            ->setData($data)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function updateDashboard(UpdateDashboardRequest $request,$id): Response
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

    public function deleteDashboard(DeleteDashboardRequest $request,$id): Response
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
}
