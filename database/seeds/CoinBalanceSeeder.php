<?php

use App\Coin;
use App\Wallet;
use App\CoinBalance;
use Faker\Generator as Faker;

use Illuminate\Database\Seeder;

class CoinBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        $wallets = Wallet::all()->count();
        $wallet = Wallet::all();
        $coins = Coin::all();
        $coin = Coin::all()->count();

        // SELEZIONA LE COINS INIZIAL SPECIFICANDO IL NOME NELL'ARRAY initialCoins
        for ($i = 0; $i < $wallets; $i++) {
            for ($j = 0; $j < $coin; $j++) {
                $slug = $coins[$j]['id'] . '-' . $wallet[$i]['id'];
                CoinBalance::create([
                    "slug"        => CoinBalance::generateSlug($slug),
                    "coin_id"     => $coins[$j]['id'],
                    "wallet_id"   => $wallet[$i]['id'],
                    "amount"      => $faker->numberBetween(0, 10000),
                ]);
            }
        }
    }
}
