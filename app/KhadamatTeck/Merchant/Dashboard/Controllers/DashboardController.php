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
