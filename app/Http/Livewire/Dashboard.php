<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\transaction as TransactionModel;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{

    use WithPagination;


    public $transaction_id = 0;
    public $month;

    protected $listeners = [
        'TransactionIdChange'
    ];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $transactions = TransactionModel::whereMonth('created_at', '=', $this->month)->orderBy('created_at','DESC')->paginate(5);
        $totaltransactions = TransactionModel::whereMonth('created_at', '=', $this->month)->sum('total');

        return view('livewire.dashboard', [
            'transactions' => $transactions,
            'totaltransactions' => $totaltransactions
        ]);
    }

    public function opendetail($id){
        $this->transaction_id = $id;
        $this->emit('opendetail',$this->transaction_id);
    }

    public function TransactionIdChange($id){
        $this->transaction_id = $id;
    }
}
