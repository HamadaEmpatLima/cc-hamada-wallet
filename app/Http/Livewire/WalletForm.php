<?php

namespace App\Http\Livewire;

use App\Jobs\WalletApiRequestJob;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WalletForm extends Component
{
    public $state;
    public $showSuccessModal = false;
    public $balance;

    private $walletRepository;

    protected $rules = [
        'state.type'   => 'required',
        'state.amount' => 'required',
    ];

    public function __construct()
    {
        $this->walletRepository = new WalletRepository;
    }

    public function getData()
    {
        session(['authorization_value' => Auth::user()->name]);
        $this->balance = $this->walletRepository->balance();
    }

    public function mount()
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.wallet-form', [
            'balance' => $this->balance
        ]);
    }

    public function submit()
    {
        $this->validate();
        $this->state['user_id']   = Auth::user()->id;
        $this->state['order_id']  = $this->generateOrderId();
        $this->state['timestamp'] = now()->toDateTimeString();

        if ($this->state['amount'] > $this->balance) {
            $validator = Validator::make($this->state, []);
            $validator->errors()->add('state.amount', 'Your balance is insufficient.');
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        dispatch(new WalletApiRequestJob($this->state, Auth::user()->name));
        $this->showSuccessModal = true;
    }

    public function generateOrderId()
    {
        $currentDate      = now();
        $year             = $currentDate->format('y');
        $month            = $currentDate->format('m');
        $paddedUserId     = str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT);
        $transactionCount = Wallet::whereDate('created_at', $currentDate)->count();
        $transactionCount++;
        $paddedTransactionCount = str_pad($transactionCount, 4, '0', STR_PAD_LEFT);

        $orderId = "{$year}{$month}{$paddedUserId}{$paddedTransactionCount}";

        return $orderId;
    }
}
