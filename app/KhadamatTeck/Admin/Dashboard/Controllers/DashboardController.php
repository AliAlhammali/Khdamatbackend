<?php
namespace App\KhadamatTeck\Admin\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Admin\Dashboard\Requests\CreateDashboardRequest;
use App\KhadamatTeck\Admin\Dashboard\Requests\DeleteDashboardRequest;
use App\KhadamatTeck\Admin\Dashboard\Requests\ListDashboardRequest;
use App\KhadamatTeck\Admin\Dashboard\Requests\UpdateDashboardRequest;
use App\KhadamatTeck\Admin\Dashboard\Requests\ViewDashboardRequest;
use App\KhadamatTeck\Admin\Dashboard\Services\DashboardService;

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

    public function figures(ViewDashboardRequest $request)
    {
        return $this->dashboardService->figures($request);
    }
    public function top_merchants_by_orders(ViewDashboardRequest $request)
    {
        return $this->dashboardService->top_merchants_by_orders($request);
    }
    public function top_sp_completed_by_orders(ViewDashboardRequest $request)
    {
        return $this->dashboardService->top_sp_completed_by_orders($request);
    }
    public function top_services(ViewDashboardRequest $request)
    {
        return $this->dashboardService->top_services($request);
    }
    public function top_categories(ViewDashboardRequest $request)
    {
        return $this->dashboardService->top_categories($request);
    }
}
