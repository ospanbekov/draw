<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Classes;
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
            'draws' => Models\Draw::where('user_id', Auth::user()->id)->get()
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
        } while ($prize->isAvailable());
        /* create draw item */
        $draw = Models\Draw::factory(Auth::user(), $prize);

        return [
            'draw' => $draw
        ];
    }

    /**
     * @param Request $request
     * @param Models\Draw $draw
     */
    public function exchange(Request $request, Models\Draw $draw)
    {

    }
}
