<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(): View
    {
        $data = [
            'pageTitle' => 'Dashboard',
            'contacts' =>   0,
            'users' => User::count() ?? 0,
            'favorites' =>   0,
            'favContacts' => []


        ];

        return view('admin.dashboard', $data);
    }

}
