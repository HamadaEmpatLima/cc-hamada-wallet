<?php

namespace App\Http\Livewire;

use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Table extends Component
{
    public $data;

    private $walletRepository;

    public function __construct()
    {
        $this->walletRepository = new WalletRepository;
    }

    public function getData()
    {
        session(['authorization_value' => Auth::user()->name]);
        $this->data = $this->walletRepository->all();
    }

    public function mount()
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.table', [
            'data' => $this->data
        ]);
    }
}
