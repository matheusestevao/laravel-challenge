<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $today = Event::where('user_id', Auth::user()->id)
                    ->whereRaw('? BETWEEN start_datetime AND end_datetime', date('Y-m-d H:i:s'))->count();

        $next = Event::where('user_id', Auth::user()->id)
                    ->whereRaw('start_datetime BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 5 DAY)')->count();

        $all = Event::where('user_id', Auth::user()->id)->count();

        //dd(date('Y-m-d H:i:s', strtotime('+5 Days')));
        
        return view('home', [
            'today' => $today,
            'next' => $next,
            'all' => $all
        ]);
    }
}
