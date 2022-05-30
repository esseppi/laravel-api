<?php

namespace App\Http\Controllers\Admin;

use App\Coin;
use App\User;

use App\Trade;
use App\CoinBalance;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Support\Facades\Auth;


class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $trades = Trade::all();
        $trades = Trade::whereRaw('1 = 1');
        $trades = $trades->with('wallet')->get();
        dd($trades);


        if ($request->baseCoin) {
            $trades->where('baseCoin_id', $request->baseCoin);
        }
        if ($request->foreignCoin) {
            $trades->where('foreignCoin_id', $request->foreignCoin);
        }
        if ($request->date) {
            $trades->where('date', $request->date);
        }

        if ($request->users) {
            $trades->where('wallet_id', $request->users);
        }

        $trades = $trades->paginate(20);


        $coins = Coin::all();
        $users = User::all();

        return view('admin.trades.index', [
            'coins'         => $coins,
            'trades'        => $trades,
            'users'         => $users,
            'request'       => $request
        ]);
    }


    public function myTrades(Request $request)
    {
        $trades = Trade::whereRaw('1 = 1');
        $trades = $trades->where('wallet_id', Auth::user()->id);

        if ($request->baseCoin) {
            $trades->where('baseCoin_id', $request->baseCoin);
        }
        if ($request->foreignCoin) {
            $trades->where('foreignCoin_id', $request->foreignCoin);
        }
        if ($request->date) {
            $trades->where('date', $request->date);
        }

        $trades = $trades->paginate(20);


        $coins = Coin::all();
        $users = User::all();

        return view('admin.trades.myTrades', [
            'coins'         => $coins,
            'trades'        => $trades,
            'users'         => $users,
            'request'       => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Coin $coin)
    {
        $coins = Coin::all();
        return view('admin.trades.create', compact('coins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request, Wallet $wallets)
    {
        // CHECKING IF THERE IS ENOUGH MONEY TO SWAP
        $id = Auth::user()->id;
        $sellCoin = $request->get('baseCoin_id');
        $sellAmount = $request->get('baseAmount');
        $buyCoin = $request->get('foreignCoin_id');
        $buyAmount = $request->get('foreignAmount');

        $searchSellCoin = $sellCoin . '-' . $id;
        $searchBuyCoin = $buyCoin . '-' . $id;
        $soldCoin = CoinBalance::find($searchSellCoin);

        $netOnWallet = $soldCoin->amount - $sellAmount;
        $newSellBalance = [
            'coin_id'    => $sellCoin,
            'amount'     => $netOnWallet,
        ];
        // REMOVE SOLD COIN FROM THE BALANCE
        $soldCoin->update($newSellBalance);

        // IF BALANCE 0 ABORT CONDITION
        if ($netOnWallet < 0) {
            abort(403);
        } else {
            $this->validationRules = [
                'baseCoin_id'          => 'required|different:foreignCoin_id|min:1|max:200',
                'foreignCoin_id'       => 'required|min:1|max:200',
                'slug'                 => 'required|unique:trades|max:250',
                'basePrice'            => 'numeric|max:200000000',
                'foreignPrice'         => 'numeric|max:200000000',
                'date'                 => 'date',
                'tradeDir'             => 'required|boolean',
            ];
            // validazione
            $request->validate($this->validationRules);

            // ADD TRADE TO THE HISTORY

            $newTrade = $request->all() + [
                'wallet_id' => $id,
            ];
            $trade = Trade::create($newTrade);


            // ADD BOUGHT COIN TO THE BALANCE
            $boughtCoin = CoinBalance::find($searchBuyCoin);
            $netOnWallet = $boughtCoin->amount + $buyAmount;

            $newBuyBalance = [
                'coin_id'    => $buyCoin,
                'amount'     => $netOnWallet,
            ];

            $boughtCoin->update($newBuyBalance);

            return redirect()->route('admin.trades.show', $trade->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        return view('admin.trades.show', compact('trade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Faker $faker, Trade $trade)
    {

        return view('admin.trades.edit', compact('trade'));
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
        if (Auth::user()->id !== $trade->user_id) abort(403);
        $formData = $request->all();
        $trade->update($formData);
        return redirect()->route('admin.trades.show', $trade->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        $trade->delete();
        return redirect()->route('admin.trades.index');
    }


    public function search(Request $request)
    {
        $search_text = $request->query('query');
        $trades = Trade::where('name', 'LIKE', '%' . $search_text . '%')->get();
        return view('admin.trades.search', compact('trades'));
    }

    // GENERATORE SLUGGER
    public function slugger(Request $request)
    {
        return response()->json([
            'slug' => Trade::generateSlug($request->all()['generatorString'])
        ]);
    }
}
