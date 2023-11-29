<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Render screen dashboard
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pageTitle = 'Admin';
        return view('admin.dashboard', compact('pageTitle'));
    }
}
