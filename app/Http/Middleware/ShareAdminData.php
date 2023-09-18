<?php

namespace App\Http\Middleware;

use App\Models\Contact;
use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareAdminData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        $site_settings = Settings::where(['id' => 1])->get()->first();
        $contact_settings = Contact::where(['id' => 1])->get()->first();

        View::share([
                'shareUser' => $user,
                'shareSite' => $site_settings,
                'shareContact' => $contact_settings,
            ]);

        return $next($request);
    }
}
