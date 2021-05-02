<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product as productModel;

class StockEdit extends Component
{

    public $item_id,$codeitem,$name,$unitlevel,$price,$capital_price,$stock;
    public $updateMode = false;
    public $stockMode = false;

    protected $listeners = [
        'getProducts' => 'showProduct'
    ];

    public function render()
    {
        return view('livewire.stock-edit');
    }

    public function showProduct($products){
        $this->item_id = $products['id'];
        $this->codeitem = $products['codeitem'];
        $this->name = $products['name'];
        $this->unitlevel =$products['unitlevel'];
        $this->stock = $products['stock'];
    }

    private function resetInputFields(){
        $this->codeitem = '';
        $this->name = '';
        $this->unitlevel ='';
        $this->stock = '';
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->emit('productUpdate');
    }

    public function update()
    {
        $this -> validate([
            'item_id' => 'required',
            'codeitem' => 'required',
            'name' => 'required',
            'unitlevel' => 'required',
            'stock'=>'required',
        ]);

        $products = ProductModel::find($this->item_id);
        $products->update([
            'codeitem' => $this->codeitem,
            'name' => $this->name,
            'unitlevel' => $this->unitlevel,
            'stock' => $this->stock,
        ]);

        $this->resetInputFields();

        $this->emit('productUpdate');


    }
}
