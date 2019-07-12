<?php

namespace App\Http\Controllers;

class DrawController extends Controller
{
    /**
     * Show the application draw.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('draw');
    }
}
