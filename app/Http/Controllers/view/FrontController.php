<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Contact;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome(Request $request)
    {
        $carousel = Carousel::where(['display' => 1])->orderBy('priority', 'ASC')->get()->all();
        return view('frontoffice.home', ['slide_img' => $carousel]);
    }

    public function facilitiesPage(Request $request)
    {
        return view('frontoffice.facilities');
    }

    public function aboutPage(Request $request)
    {
        return view('frontoffice.about');
    }

    public function contactPage(Request $request)
    {
        $contact_settings = Contact::where(['id' => 1])->get()->first();

        return view('frontoffice.contactus', ['contact' => $contact_settings]);
    }

    public function roomPage(Request $request)
    {
        return view('frontoffice.rooms');
    }
}
