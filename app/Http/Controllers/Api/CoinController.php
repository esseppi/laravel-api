<?php

namespace App\Http\Controllers\Api;

use App\Coin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CoinController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalCoins()
    {
        $totalCoins = Coin::paginate(25);

        return response()->json([
            'status'    => 'success',
            'coins'  => $totalCoins,
        ]);
    }
}
