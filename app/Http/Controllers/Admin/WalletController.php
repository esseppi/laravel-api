<?php

namespace App\Http\Controllers\Admin;

use App\Coin;
use App\User;
use App\Trade;
use App\Wallet;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $wallets = Wallet::all();
        $coins = Coin::all();
        $trades = Trade::all();
        return view('admin.wallets.index', [
            'wallets'         => $wallets,
            'coins'           => $coins,
            'trades'         => $trades,
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // GENERATE A NEW EMPTY WALLET
    public function create(Wallet $wallet, Request $request)
    {

        $newWallet = [
            'user_id' => Auth::user()->id,
            'slug' => Wallet::generateSlug(Auth::user()->id),
        ];
        $wallet = Wallet::create($newWallet);
        return redirect()->route('admin.wallets.show', $wallet->slug);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // GENERATORE SLUGGER
    public function slugger(Request $request)
    {
        return response()->json([
            'slug' => Wallet::generateSlug($request->all()['generatorString'])
        ]);
    }
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {

        $walletBalance = DB::table('coin_balances')
            ->join('coins', 'coins.id', '=', 'coin_balances.coin_id')
            ->where('coin_balances.wallet_id', $wallet->id)
            ->select('coins.name', 'coin_balances.amount')
            ->get();
        // dd($walletBalance);




        return view('admin.wallets.show', [
            'wallet'              => $wallet,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
