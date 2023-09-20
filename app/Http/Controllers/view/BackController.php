<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Contact;
use App\Models\LeaveMessage;
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
                    return view('backoffice.rooms');
                    break;

                case 'users':
                    return view('backoffice.users');
                    break;

                case 'messages':
                    return view('backoffice.messages', ['messages' => $messages]);
                    break;

                case 'carousel':
                    return view('backoffice.carousel', [
                        'slide_img' => $carousel,
                    ]);
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
