<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class CoinBalance extends Model
{
    protected $primaryKey = 'slug';
    protected $fillable = [
        "coin_id",
        "wallet_id",
        "amount",
    ];
    static public function generateSlug($generatorString)
    {
        $baseSlug = Str::of($generatorString)->slug('-')->__toString();
        $slug = $baseSlug;
        $_i = 1;
        while (self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
