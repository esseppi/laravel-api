<?php

namespace App\Http\Controllers\Admin;

use App\Wallet;
use App\CoinBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\CoinBalance  $coinBalance
     * @return \Illuminate\Http\Response
     */
    public function show(CoinBalance $coinBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoinBalance  $coinBalance
     * @return \Illuminate\Http\Response
     */
    public function edit(CoinBalance $coinBalance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoinBalance  $coinBalance
     * @return \Illuminate\Http\Response
     */
    public function walletBalance(Request $request, CoinBalance $coinBalance)
    {
        // $newWallet = [
        //     'coin_id' => Auth::user()->id,
        //     'amount' => Wallet::generateSlug(Auth::user()->id),
        // ];

        $coin_id = $request->get('coin_id');
        $wallet_id = $request->get('wallet_id');
        $wallet = Wallet::find($wallet_id)->first();
        $coin = CoinBalance::find($coin_id)->first();
        $coin = $coin->where('wallet_id', $wallet_id);
        $amount = $request->get('amount');
        $coin->update([
            'coin_id'    => $coin_id,
            'wallet_id'  => $wallet_id,
            'amount'     => $amount,
        ]);
        // $wallet = Wallet::create($newBalance);
        return redirect()->route('admin.wallets');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoinBalance  $coinBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoinBalance $coinBalance)
    {
        //
    }

    public function slugger(Request $request)
    {
        return response()->json([
            'slug' => CoinBalance::generateSlug($request->all()['generatorString'])
        ]);
    }
}
