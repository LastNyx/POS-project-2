<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\transaction as TransactionModel;
use App\Models\Details as detailsModel;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class Dashboard extends Component
{

    use WithPagination;


    public $transaction_id = 0;
    public $month,$searchTransaction;

    protected $listeners = [
        'TransactionIdChange'
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->month = Carbon::now()->format('n');
    }

    public function render()
    {
        $transactions = TransactionModel::whereMonth('created_at', '=', $this->month)->orderBy('created_at','DESC')->paginate(5);
        $transactionAll  =TransactionModel::whereMonth('created_at', '=', $this->month)->orderBy('created_at','DESC')->get();
        $totaltransactions = TransactionModel::whereMonth('created_at', '=', $this->month)->sum('total');
        $transactionSearch = TransactionModel::where('id', 'like', '%'.$this->searchTransaction.'%')->get();

        return view('livewire.dashboard', [
            'transactions' => $transactions,
            'totaltransactions' => $totaltransactions,
            'transactionsearch' => $transactionSearch,
            'transactionAll' => $transactionAll
        ]);
    }

    public function opendetail($id){
        $this->transaction_id = $id;
        $this->searchTransaction ='';
        $this->emit('opendetail',$this->transaction_id);
    }

    public function TransactionIdChange($id){
        $this->transaction_id = $id;
    }


}
