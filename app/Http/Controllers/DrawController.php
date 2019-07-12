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

    /**
     * Only XMLHttpRequest, POST method. Draw action
     *
     * @param  Request $request
     * @return array(JSON)
     */
    public function draw(Request $request)
    {
        /* instance PrizeGenerator */
        $generator = new Classes\PrizeGenerator([
            Classes\Bonus::class,
            Classes\Money::class,
            Classes\Item::class
        ]);

        /* get random available prize */
        do {
            $prize = $generator->randomize();
        } while ($prize->isAvailable());
        /* create draw item */
        $draw = Models\Draw::factory(Auth::user(), $prize);

        return [
            'draw' => $draw
        ];
    }
}
