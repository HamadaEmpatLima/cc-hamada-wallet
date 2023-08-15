<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $WalletRepository;

    public function __construct()
    {
        $this->WalletRepository = new WalletRepository;
    }

    public function index()
    {
        $data = $this->WalletRepository->all();

        return response()->json([
            'status'        => 1,
            'statusMessage' => 'success',
            'data'          => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'  => 'required',
            'amount'    => 'required',
            'timestamp' => 'required'
        ]);

        $input   = $request->all();
        $balance = $this->WalletRepository->balance();
        if ($input['type'] == 'out' && $balance - $input['amount'] < 0) {
            return response()->json([
                'status'        => 2,
                'statusMessage' => 'failed',
                'message'       => 'Your balance is insufficient.'
            ]);
        }
        $data = $this->WalletRepository->create($input);

        return response()->json([
            'status'        => 1,
            'statusMessage' => 'success',
            'data'          => $data
        ]);
    }
}
