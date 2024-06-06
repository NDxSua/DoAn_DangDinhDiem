<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetailModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $topSellingIn = 1;
        if(isset($request->topSellingIn)) $topSellingIn = $request->topSellingIn;
        
        $data = [
            'header_title' => 'Dashboard',
            'totalIncomeData' => OrderDetailModel::getTotalIncomeLast6Months(),
            'topSelling' => OrderDetailModel::getProductTopSelling($topSellingIn),
        ];

        return view('admin.dashboard', $data);
    }
}
