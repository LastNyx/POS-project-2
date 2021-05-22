<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product as productModel;
use Livewire\WithPagination;

class Stock extends Component
{
    use WithPagination;

    public $item_id,$codeitem,$name,$unitlevel,$price,$capital_price,$stock;
    public $updateMode = false;
    public $stockMode = false;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'productUpdate' => 'handleUpdate'
    ];

    public function render()
    {
        $products = productModel::orderBy('created_at','DESC')->get();
        return view('livewire.stock', [
            'products' =>$products,
            'products' =>productModel::where('name', 'like', '%'.$this->search.'%')
            ->orwhere('codeitem', 'like', '%'.$this->search.'%')->paginate(5),
        ]);
    }

    public function getProducts($id){
        $this->updateMode = True;
        $products = productModel::find($id);
        $this->emit('getProducts', $products);
    }

    public function handleUpdate(){
        $this->updateMode = false;
        session()->flash('message', 'Users Updated Successfully.');
    }

    public function destroy($id)
    {
        $products = ProductModel::find($id);
        $products->delete();


        session()->flash('message', $products->name . ' Dihapus');
    }




}
