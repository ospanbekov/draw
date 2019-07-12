<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Models;
use Auth;
use Illuminate\Http\Request;

class DrawController extends Controller
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
     * Show the application draw.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('draw.index');
    }

    /**
     * Show the user draws list.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $draws = Auth::user()->draws;

        return view('draw.list', compact('draws'));
    }
}
