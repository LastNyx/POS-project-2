<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Details as detailsModel;
use App\Models\Transaction as transactionModel;

class TransactionDetail extends Component
{

    public $transaction_id,$pay;

    protected $listeners = [
        'opendetail'=>'showdetail'
    ];

    public function render()
    {
        $details = detailsModel::orderBy('created_at','DESC')->get();
        return view('livewire.transaction-detail',[
            'details' => $details,
        ]);
    }

    public function showdetail($id){
        $transaction = transactionModel::find($id);
        $this->transaction_id = $transaction['id'];
        $this->pay = $transaction['Pay'];
    }

    public function resetTransactionId(){
        $this->transaction_id = 0;
        $this->emit('TransactionIdChange',$this->transaction_id);
    }
}
