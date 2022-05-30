<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(WalletSeeder::class);
        $this->call(CoinSeeder::class);
        $this->call(TradeSeeder::class);
        $this->call(CoinBalanceSeeder::class);
    }
}
