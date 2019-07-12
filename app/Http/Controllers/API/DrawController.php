<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Classes;
use App\Enums;
use App\Models;
use Auth;

class DrawController extends BaseController
{
    /**
     * GET method. Draw lists
     *
     * @param  Request $request
     * @return array(JSON)
     */
    public function list(Request $request)
    {
        return [
            'draws' => Auth::user()->draws
        ];
    }

    /**
     * POST method. Draw action
     *
     * @param  Request $request
     * @return array (JSON)
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
        } while (!$prize->isAvailable());

        /* create draw item */
        $draw = Models\Draw::factory(Auth::user(), $prize);

        return [
            'draw' => $draw
        ];
    }

    /**
     * POST method. Exchange draw action
     *
     * @param  Request $request
     * @return array (JSON)
     */
    public function exchange(Request $request)
    {
        /* getting last draw */
        $draw = Auth::user()->draws()->where([
            'status' => Enums\DrawStatus::UNDEFINED
        ])->orderBy('id', 'DESC')->firstOrFail();


    }

    /**
     * POST method. Reject draw action
     *
     * @param  Request $request
     * @return array(JSON)
     */
    public function reject(Request $request)
    {
        /* getting last draw */
        $draw = Auth::user()->draws()->where([
            'status' => Enums\DrawStatus::UNDEFINED
        ])->orderBy('id', 'DESC')->firstOrFail();

        /* update status draw */
        $draw->update([
            'status' => Enums\DrawStatus::REJECTED
        ]);

        return [
            'draw' => $draw
        ];
    }
}
