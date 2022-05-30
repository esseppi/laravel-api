@extends('layouts.app1')

@section('content')
    <main class="my-3">
        <div class="container">
            {{-- @dd($wallets) --}}
            <div class="row row-cols-5">
                <div class="card-body">
                    SLUG-WALLET:{{ $wallet->slug }} <br> Owner {{ $wallet->user->name }}
                    <ul>
                        @foreach ($trades as $trade)
                            <li>
                                <ol>
                                    <li>
                                        {{ $trade->baseCoin->name }}
                                        {{ $trade->baseAmount }}
                                    </li>
                                    <li>
                                        {{ $trade->foreignCoin->name }}
                                        {{ $trade->foreignAmount }}
                                    </li>
                                </ol>
                            </li>
                        @endforeach
                        <ul>
                            @foreach ($userBasedCoinList as $item)
                                <li>
                                    <ol>
                                        <li>
                                            @foreach ($coins as $coin)
                                                @if ($item->baseCoin_id == $coin->id)
                                                    {{ $coin->name }}
                                                @endif
                                            @endforeach
                                        </li>
                                        <li>
                                            Totale Coin Vendute:
                                            {{ $item->user_baseAmount }}
                                        </li>
                                    </ol>
                                </li>
                            @endforeach
                            @foreach ($userForeignCoinList as $item)
                                <li>
                                    <ol>
                                        <li>
                                            @foreach ($coins as $coin)
                                                @if ($item->foreignCoin_id == $coin->id)
                                                    {{ $coin->name }}
                                                @endif
                                            @endforeach
                                        </li>
                                        <li>
                                            Totale Coin Acquistate:
                                            {{ $item->user_foreignAmount }}
                                        </li>
                                    </ol>
                                </li>
                            @endforeach
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
