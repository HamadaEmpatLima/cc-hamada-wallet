<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Wallet;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class WalletRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Wallet();
    }

    public function all()
    {
        $user = User::where('name', session('authorization_value'))->first();
        if (!$user) {
            return null;
        }

        return Wallet::where('user_id', $user->id)->latest()->get();
    }

    public function balance()
    {
        $user = User::where('name', session('authorization_value'))->first();
        if (!$user) {
            return null;
        }

        return DB::table('wallets')
            ->selectRaw('SUM(CASE WHEN type = "in" THEN amount ELSE -amount END) AS balance')
            ->where('user_id', $user->id)
            ->value('balance');
    }
}
