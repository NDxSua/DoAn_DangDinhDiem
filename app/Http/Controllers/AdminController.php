<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'header_title' => 'Dashboard',
        ];
        return view('admin.dashboard', $data);
    }
}
