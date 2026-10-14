<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Vinograd\Order\Order;
use App\UseCases\Dashboard\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ArchiveDashboardController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        View::share ('dashboard_archive_active', ' active');
    }

        public function index (Request $request, DashboardService $service)
    {
        $dateRange = $service->getDateRange($request);

        return view('admin.vinograd.analytica.archive', [
            'array' => $service->getCompletedOrdersItemsArray($dateRange, true, true),
            'totalCost' => $service->getTotalCostCompletedOrders($dateRange, true, true),
            'titleDate' => $service->getTitleDate($dateRange),
            'orderCount' => Order::query()->whereNotInStatus()->timeRange($dateRange, true)->count(),
            'orderAVG' => Order::query()->whereNotInStatus()->timeRange($dateRange, true)->avg('cost')
        ]);
    }
}
