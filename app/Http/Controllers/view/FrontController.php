<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome(Request $request) {
        return view('frontoffice.home');
    }

    public function facilitiesPage(Request $request) {
        return view('frontoffice.facilities');
    }

    public function aboutPage(Request $request) {
        return view('frontoffice.about');
    }
}
