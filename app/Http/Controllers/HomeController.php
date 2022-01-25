<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function index()
    {
        //return view('home');
        $count = auth()->User()->tasks()->where('completion_date', '=', date('Y-m-d'))
            ->count();
        $message = 'You have ' . $count . ' task Today';
        return view('admin.home', ['message' => $message]);
    }
}
