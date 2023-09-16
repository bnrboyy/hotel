<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackController extends Controller
{
    public function adminPage(Request $request)
    {
        $page = $request->page;
        $user = Auth::guard('admin')->user();

        $site_settings = Settings::where(['id' => 1])->get()->first();

        if ($user) {

            switch($page) {
                case 'settings':
                    return view('backoffice.settings', ['site' => $site_settings]);
                    break;

                case 'rooms':
                    return view('backoffice.rooms');
                    break;

                case 'users':
                    return view('backoffice.users');
                    break;

                default:
                    return view('backoffice.dashboard');
                    break;


            }
        } else {
            return view('backoffice.login');
        }

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
