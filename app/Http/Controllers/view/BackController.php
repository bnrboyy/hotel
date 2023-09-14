<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackController extends Controller
{
    public function adminPage(Request $request)
    {
        $page = $request->page;
        $user = Auth::guard('admin')->user();

        if ($user) {
            return view('backoffice.dashboard');
        }

        return view('backoffice.login');
    }

    public function dashboardPage(Request $request)
    {
        return view('backoffice.dashboard');
    }

    public function managerooms(Request $request)
    {
        return view('backoffice.managerooms');
    }
}
