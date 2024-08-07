<?php

namespace App\KhadamatTeck\Admin\Dashboard\Services;

use App\KhadamatTeck\Admin\Dashboard\Mappers\DashboardTopCatsAndServicesDTOMapper;
use App\KhadamatTeck\Admin\Dashboard\Repositories\DashboardRepository;
use App\KhadamatTeck\Admin\Dashboard\Requests\ViewDashboardRequest;
use App\KhadamatTeck\Admin\Orders\Models\Order;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use App\KhadamatTeck\ServiceProvider\ServiceProviders\Models\ServiceProvider;
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


    public function figures(ViewDashboardRequest $request): JsonResponse|Response
    {
        return $this->response()
            ->setData([
                'count_of_active_merchants' => Merchant::where(['status' => 'active'])->count(),
                'count_of_active_sp' => ServiceProvider::where(['status' => 'active'])->count(),
                'count_of_new_orders' => Order::where(['status' => 'new'])->count(),
                'count_of_in_progress_orders' => Order::where(['status' => 'in_progress'])->count(),
                'count_of_completed_orders' => Order::where(['status' => 'completed'])->count(),
            ])
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function top_merchants_by_orders(ViewDashboardRequest $request): JsonResponse|Response
    {
        $top_merchants = QueryBuilder::for(
            Order::join('merchants', 'merchants.id', '=', 'orders.merchant_id')
                ->select('merchants.title', DB::raw('COUNT(orders.id) as order_count'))
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->groupBy('merchants.id')
            ->orderByDesc('order_count')
            ->limit(6)
            ->get();
        return $this->response()
            ->setData($top_merchants)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function top_sp_completed_by_orders(ViewDashboardRequest $request): JsonResponse|Response
    {
        $top_service_providers = QueryBuilder::for(
            Order::join('service_providers', 'service_providers.id', '=', 'orders.service_provider_id')
                ->select('service_providers.title', DB::raw('COUNT(orders.id) as order_count'))
                ->where('orders.status', 'completed')
        )
            ->allowedFilters(Order::getAllowedFilters())
            ->groupBy('service_providers.id')
            ->orderByDesc('order_count')
            ->limit(6)
            ->get();
        return $this->response()
            ->setData($top_service_providers)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function top_services(ViewDashboardRequest $request): JsonResponse|Response
    {
        $topProducts = Order::selectRaw(
            'COUNT(*) as order_count'
        )
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('services', 'order_items.item_id', '=', 'services.id')
            ->selectRaw(
                "services.title as name",
            )
            ->selectRaw(
                'services.id as services_id',
            )
            ->groupBy('services_id', 'name');
        $orders = QueryBuilder::for(
            $topProducts
        )->allowedFilters(Order::getAllowedFilters())
            ->orderByDesc('order_count')
            ->limit(6)
            ->get();
        return $this->response()
            ->setData(DashboardTopCatsAndServicesDTOMapper::fromCollection($orders))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function top_categories(ViewDashboardRequest $request): JsonResponse|Response
    {
        $q = Order::selectRaw(
            'COUNT(*) as order_count'
        )->selectRaw(
            'categories.title as name',
        )->selectRaw(
            'categories.id as category_id',
        )
            ->join(
                'categories',
                'categories.id',
                '=',
                'orders.main_category_id'
            )->groupBy(['category_id', 'name']);

        $orders = QueryBuilder::for(
            $q
        )->allowedFilters(Order::getAllowedFilters())->orderByDesc('order_count')->get();
        return $this->response()
            ->setData(DashboardTopCatsAndServicesDTOMapper::fromCollection($orders))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }
}
