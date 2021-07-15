<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product as productModel;

class ProductEdit extends Component
{

    public $item_id,$codeitem,$name,$unitlevel,$price,$capital_price,$stock;
    public $updateMode = false;
    public $errormessage;

    protected $listeners = [
        'getProducts' => 'showProduct'
    ];

    public function render()
    {
        return view('livewire.product-edit');
    }

    public function showProduct($products){
        $this->codeitem = $products['codeitem'];
        $this->name = $products['name'];
        $this->unitlevel =$products['unitlevel'];
        $this->price = $products['price'];
        $this->capital_price = $products['capital_price'];
    }

    private function resetInputFields(){
        $this->codeitem = '';
        $this->name = '';
        $this->unitlevel ='';
        $this->price = '';
        $this->capital_price = '';
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->emit('productUpdate');
    }

    public function update()
    {
        $this -> validate([
            'codeitem' => 'required',
            'name' => 'required',
            'unitlevel' => 'required',
            'price' => 'required',
            'capital_price' => 'required',
        ]);

        $products = ProductModel::find($this->codeitem);
        if ($this->capital_price <= $this->price){
        $products->update([
            'codeitem' => $this->codeitem,
            'name' => $this->name,
            'unitlevel' => $this->unitlevel,
            'price' => $this->price,
            'capital_price' => $this->capital_price,
        ]);

        $this->resetInputFields();

        $this->emit('productUpdate');
        $this->errormessage = '';
        }else{
            $this->errormessage = 'Harga Modal Lebih tinggi dari harga jual';
        }


    }
}
