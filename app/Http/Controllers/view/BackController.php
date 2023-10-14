<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Carousel;
use App\Models\Contact;
use App\Models\Facilitie;
use App\Models\Feature;
use App\Models\LeaveMessage;
use App\Models\Room;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackController extends Controller
{
    public function adminPage(Request $request)
    {
        $page = $request->page;
        $user = Auth::guard('admin')->user();

        /* Settings page */
        $site_settings = Settings::where(['id' => 1])->get()->first();
        $contact_settings = Contact::where(['id' => 1])->get()->first();

        /* Carousel page */
        $carousel = Carousel::orderBy('priority', 'ASC')->get();

        /* Message page */
        $messages = LeaveMessage::orderBy('send_date', 'DESC')->get();

        /* Feature&Fac page */
        $features = Feature::orderBy('priority', 'ASC')->get();
        $facilities = Facilitie::orderBy('priority', 'ASC')->get();

        /* Rooms page */
        $rooms = Room::orderBy('created_at', 'ASC')->get();
        $features_room = Feature::where(['display' => 1])->orderBy('priority', 'ASC')->get();
        $facilities_room = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->get();

        /* Bank page */
        $banks = Bank::orderBy('priority', 'ASC')->get();

        /* Admins page */
        $admins = Admin::all();

        /* Managebook page */
        $bookings = Booking::join('booking_statuses AS bs', 'bs.id', 'bookings.status_id')
                    ->join('rooms', 'rooms.id', 'bookings.room_id')
                    ->select('bookings.*', 'rooms.name AS room_name', 'bs.name AS status_name', 'bs.bg_color AS bg_color')
                    ->whereIn('bookings.status_id', [1, 2, 3])
                    ->orderBy('bookings.created_at', 'DESC')
                    ->get();
        $statuses = BookingStatus::orderBy('id', 'ASC')->get();


        foreach ($messages as $message) {
            $msg = $message->message;
            $submsg = substr($msg, 0, 40);
            $message->submsg = $submsg;
        }

        if ($user) {
            switch ($page) {
                case 'settings':
                    return view('backoffice.settings', [
                        'site' => $site_settings,
                        'contact' => $contact_settings,
                    ]);

                    break;

                case 'rooms':
                    return view('backoffice.rooms', [
                        'features' => $features_room,
                        'facilities' => $facilities_room,
                        'rooms' => $rooms,
                    ]);

                    break;

                case 'admins':
                    return view('backoffice.admins', ['banks' => $banks, 'admins' => $admins]);
                    break;

                case 'messages':
                    return view('backoffice.messages', ['messages' => $messages]);
                    break;

                case 'features_fac':
                    return view('backoffice.features-fac', [
                        'features' => $features,
                        'facilities' => $facilities,
                    ]);
                    break;

                case 'carousel':
                    return view('backoffice.carousel', [
                        'slide_img' => $carousel,
                    ]);
                    break;

                case 'bank':
                    return view('backoffice.bank', [
                        'banks' => $banks,
                    ]);
                    break;

                case 'managebook':
                    return view('backoffice.managebook', [
                        'bookings' => $bookings,
                        'statuses' => $statuses,
                    ]);
                    break;

                default:
                    return view('backoffice.dashboard');
                    break;
            }
        }
    }



    public function loginPage(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin');
        }

        return view('backoffice.login');
    }

    // public function dashboardPage(Request $request)
    // {
    //     return view('backoffice.dashboard');
    // }

    // public function managerooms(Request $request)
    // {
    //     return view('backoffice.managerooms');
    // }
}
