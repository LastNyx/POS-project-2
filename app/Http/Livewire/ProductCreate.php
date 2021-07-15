<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product as productModel;

class ProductCreate extends Component
{
    public $item_id,$codeitem,$name,$unitlevel,$price,$capital_price,$stock;
    public $updateMode = false;
    public $errormessage;

    public function render()
    {
        return view('livewire.product-create');
    }


    private function resetInputFields(){
        $this->codeitem = '';
        $this->name = '';
        $this->unitlevel ='';
        $this->price = '';
        $this->capital_price = '';
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

        if ($this->capital_price <= $this->price){
            try{
                $Products = ProductModel::Create([
                    'codeitem' => $this->codeitem,
                    'name' => $this->name,
                    'unitlevel' => $this->unitlevel,
                    'price' => $this->price,
                    'capital_price' => $this->capital_price,
                ]);
                $this->emit('productStored', $Products);

                $this->resetInputFields();
                $this->errormessage = '';
            } catch (\Illuminate\Database\QueryException $e){
                $this->errormessage = 'Kode Barang sudah ada! Cek kembali Kode barang.';
            };
        }else{
            $this->errormessage = 'Harga Modal Lebih tinggi dari harga jual';
        }

    }

}
