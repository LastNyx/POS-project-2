<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product as productModel;

class Product extends Component
{

    public $codeitem,$name,$unitlevel,$price,$capital_price;

    public function render()
    {
        $products = productModel::orderBy('created_at','DESC')->get();
        return view('livewire.product', [
            'products' =>$products
        ]);
    }

    public function store()
    {
        $this -> validate([
            'codeitem' => 'required',
            'name' => 'required',
            'unitlevel' => 'required',
            'price' => 'required',
            'capital_price' => 'required',
        ]);

        ProductModel::create([
            'codeitem' => $this->codeitem,
            'name' => $this->name,
            'unitlevel' => $this->unitlevel,
            'price' => $this->price,
            'capital_price' => $this->capital_price
        ]);

        session()->flash('info', 'Produk berhasil ditambahkan');

        $this->codeitem = '';
        $this->name = '';
        $this->unitlevel ='';
        $this->price = '';
        $this->capital_price = '';
    }
}
