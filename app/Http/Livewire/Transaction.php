<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\transaction as TransactionModel;
use App\Models\product as productModel;
use App\Models\Details as detailsModel;

class Transaction extends Component
{

    public $item_id,$codeitem,$name,$unitlevel,$price,$detail_id,$qty;
    public $pay;
    public $TransactionError;
    public $LastSavedID;
    public $search;
    public $updateMode = false;

    public function render()
    {
        $products = productModel::orderBy('created_at','DESC')->get();
        $details = detailsModel::orderBy('created_at','DESC')->get();
        return view('livewire.transaction', [
            'details' =>$details,
            'products' =>$products,
            'products' =>productModel::where('name', 'like', '%'.$this->search.'%')
            ->orwhere('codeitem', 'like', '%'.$this->search.'%')->get()]);

    }

    public function showProduct($id){
        $products = productModel::find($id);
        $this->item_id = $products['id'];
        $this->codeitem = $products['codeitem'];
        $this->name = $products['name'];
        $this->unitlevel =$products['unitlevel'];
        $this->price = $products['price'];

        $this->search = '';

        try{
            $details = detailsModel::Create([
                'product_id' => $this->item_id,
                'price' => $this->price,

            ]);

            $this->detail_id = $details['id'];
            $this->qty = $details['qty'];
            $this->dispatchBrowserEvent('openModal');

        } catch (\Illuminate\Database\QueryException $e){
            $this->TransactionError = 'Barang sudah ada!';
            $this->dispatchBrowserEvent('openModalError');
        };

    }

    public function editqty($id){

        $details = detailsModel::find($id);
        $this->detail_id = $details['id'];
        $this->qty = $details['qty'];
        $this->dispatchBrowserEvent('openModal');


    }

    public function confirmEditQty($id){
        $details = detailsModel::find($id);
        $details->update([
            'qty' => $this->qty
        ]);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function editprice($id){

        $details = detailsModel::find($id);
        $this->detail_id = $details['id'];
        $this->price = $details['price'];
        $this->dispatchBrowserEvent('openModalPrice');


    }

    public function confirmEditPrice($id){
        $details = detailsModel::find($id);
        $details->update([
            'price' => $this->price
        ]);
        $this->dispatchBrowserEvent('closeModalPrice');
    }

    public function saveTransaction($total){

        $this -> validate([
            'pay' => 'required',
        ]);

        $transaction = TransactionModel::create([
            'total' => $total,
            'pay'=> $this->pay,
        ]);

        $this->pay = 0;
        detailsModel::where('transaction_id', '=', 0)->update(['transaction_id'=> $transaction['id']]);

        $this->LastSavedID = $transaction['id'];
    }


    public function deleteDetail($id){
        $details = detailsModel::find($id);
        $details->delete();
    }

    public function print(){
        $this->dispatchBrowserEvent('printSellings');
    }

}
