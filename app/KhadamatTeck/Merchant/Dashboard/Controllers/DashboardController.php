<?php
namespace App\KhadamatTeck\Merchant\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Merchant\Dashboard\Requests\CreateDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\DeleteDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\ListDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\UpdateDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Requests\ViewDashboardRequest;
use App\KhadamatTeck\Merchant\Dashboard\Services\DashboardService;

class DashboardController extends Controller
{
    /**
     * @var DashboardService $dashboardService
     */
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(ListDashboardRequest $request)
    {
        return $this->dashboardService->paginateDashboard($request);
    }

    public function create(CreateDashboardRequest $request)
    {
        return $this->dashboardService->createDashboard($request);
    }


    public function show(ViewDashboardRequest $request, string $id): Response
    {
        return $this->dashboardService->findDashboard($request, $id);
    }

    public function update(UpdateDashboardRequest $request,string $id)
    {
        return $this->dashboardService->updateDashboard($request,$id);
    }

    public function delete(DeleteDashboardRequest $request,string $id)
    {
        return $this->dashboardService->deleteDashboard($request,$id);
    }
}
