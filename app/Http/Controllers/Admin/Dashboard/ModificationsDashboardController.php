<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\UseCases\Dashboard\DashboardService;
use Illuminate\Http\Request;
use View;

class ModificationsDashboardController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        View::share ('dashboard_modification_active', ' active');
    }

    public function index (Request $request, DashboardService $service)
    {
        $dateRange = $service->getDateRange($request);
        $status = $request->status;

        $modifications = $service->getDataOnModifications ($dateRange, $status);
        $total = $modifications->groupBy('name')->map(function ($item) {
            return [
                'quantity' => $item->sum('allQuantity'),
                'sum' =>$item->sum('cost')
            ];
        });

        return view('admin.vinograd.analytica.modifications_analytics', [
            'modifications' => $modifications,
            'totalCost' => $service->getTotalCostCompletedOrders($dateRange, $status),
            'titleDate' => $service->getTitleDate($dateRange),
            'total' => $total
        ]);
    }
}
