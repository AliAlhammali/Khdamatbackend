<?php
namespace App\KhadamatTeck\ServiceProvider\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\ServiceProvider\Dashboard\Requests\CreateDashboardRequest;
use App\KhadamatTeck\ServiceProvider\Dashboard\Requests\DeleteDashboardRequest;
use App\KhadamatTeck\ServiceProvider\Dashboard\Requests\ListDashboardRequest;
use App\KhadamatTeck\ServiceProvider\Dashboard\Requests\UpdateDashboardRequest;
use App\KhadamatTeck\ServiceProvider\Dashboard\Requests\ViewDashboardRequest;
use App\KhadamatTeck\ServiceProvider\Dashboard\Services\DashboardService;

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


    public function top_staff_by_orders(ViewDashboardRequest $request)
    {
        return $this->dashboardService->top_staff_by_orders($request);
    }


    public function top_staff_completed_orders(ViewDashboardRequest $request)
    {
        return $this->dashboardService->top_staff_completed_orders($request);
    }

    public function calender_orders(ViewDashboardRequest $request)
    {
        return $this->dashboardService->calender_orders($request);
    }
}
