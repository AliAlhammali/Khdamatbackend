<?php

namespace App\KhadamatTeck\ServiceProvider\Dashboard\Services;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Merchant\Orders\Models\Order;
use App\KhadamatTeck\ServiceProvider\Dashboard\Repositories\DashboardRepository;
use App\KhadamatTeck\ServiceProvider\Dashboard\Requests\ViewDashboardRequest;
use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
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

    public function figures(ViewDashboardRequest $request)
    {
        $order = Order::query();
        $users = ServiceProviderUser::where(['status' => 'active'])->count();
        if (SPAuth()?->user()?->role == 'Staff') {
            $order->where(['service_provider_user_id' => SPAuth()->user()->id]);
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
            Order::join('service_provider_users', 'service_provider_users.id', '=', 'orders.service_provider_user_id')
                ->select('service_provider_users.name', DB::raw('COUNT(orders.id) as order_count'))
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->groupBy('service_provider_users.id')
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
            Order::join('service_provider_users', 'service_provider_users.id', '=', 'orders.service_provider_user_id')
                ->select('service_provider_users.name', DB::raw('COUNT(orders.id) as order_count'))->where(['orders.status' => 'completed'])
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->groupBy('service_provider_users.id')
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
