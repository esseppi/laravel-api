<?php

namespace App\Http\Controllers\Api;

use App\Coin;
use App\Trade;
use App\Wallet;
use App\CoinBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CoinBalanceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coinBalance($wallet_id)
    {
        $walletId = $wallet_id;
        $balanceOnWallet = CoinBalance::where('wallet_id', $walletId)->first();

        $balance = CoinBalance::whereRaw('1=1')->get();
        return response()->json([
            'status'    => 'success',
            'balance'  => $balanceOnWallet,
        ]);
    }
    public function walletBalance($wallet_id)
    {

        $balanceOnWallet = CoinBalance::where('wallet_id', $wallet_id)->get();

        return response()->json([
            'status'    => 'success',
            'balance'  => $balanceOnWallet,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        $coins = Coin::all();
        $count = count($coins);
        return response()->json([
            'status'    => 'success',
            'balance'  => $count,
        ]);

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        //
    }
}
