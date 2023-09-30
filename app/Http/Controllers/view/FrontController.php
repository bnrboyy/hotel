<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Contact;
use App\Models\Facilitie;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function getHome(Request $request)
    {
        $facilities = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->limit(5)->get();
        $carousel = Carousel::where(['display' => 1])->orderBy('priority', 'ASC')->get()->all();

        $rooms = Room::where(['display' => 1])->orderBy('price', 'ASC')->limit(3)->get();

        foreach ($rooms as $room) {
            $fea_ids = explode(', ', $room->feature_ids);
            $fac_ids = explode(', ', $room->fac_ids);

            $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
            $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();
            $gallery = $room->gallery;
            // $gallery = Gallery::where('room_id', $room->id)->orderBy('default', 'DESC')->get();

            $room->features = $features;
            $room->facs = $facs;
            $room->gallery = $gallery;
        }

        return view('frontoffice.home', [
            'slide_img' => $carousel,
            'facilities' => $facilities,
            'rooms' => $rooms,
        ]);
    }

    public function facilitiesPage(Request $request)
    {
        $facilities = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->get();

        return view('frontoffice.facilities', [
            'facilities' => $facilities,

        ]);
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
        $rooms = Room::where(['display' => 1])->orderBy('price', 'ASC')->get();

        foreach ($rooms as $room) {
            $fea_ids = explode(', ', $room->feature_ids);
            $fac_ids = explode(', ', $room->fac_ids);

            $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
            $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();
            $gallery = $room->gallery;

            $room->features = $features;
            $room->facs = $facs;
            $room->gallery = $gallery;
        }

        return view('frontoffice.rooms', [
            'rooms' => $rooms,
        ]);
    }

    public function roomDetailsPage(Request $request)
    {

        $room = Room::where(['id' => $request->id])->first();

        if (!$room) {
            return redirect()->back();
        }

        $fea_ids = explode(', ', $room->feature_ids);
        $fac_ids = explode(', ', $room->fac_ids);

        $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
        $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();
        $gallery = $room->gallery;
        // $gallery = Gallery::where('room_id', $room->id)->orderBy('default', 'DESC')->get();

        $room->features = $features;
        $room->facs = $facs;
        $room->gallery = $gallery;

        return view('frontoffice.room-details', [
            'room' => $room,
        ]);
    }
}
