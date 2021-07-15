<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product as productModel;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $item_id,$codeitem,$name,$unitlevel,$price,$capital_price,$stock,$product_id;
    public $updateMode = false;
    public $stockMode = false;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'productStored' => 'handleStored',
        'productUpdate' => 'handleUpdate'
    ];

    public function render()
    {
        $products = productModel::orderBy('created_at','DESC')->get();
        return view('livewire.product', [
            'products' =>$products,
            'products' =>productModel::where('name', 'like', '%'.$this->search.'%')
            ->orwhere('codeitem', 'like', '%'.$this->search.'%')->paginate(7),
        ]);
    }

    public function getProducts($id){
        $this->updateMode = True;
        $products = productModel::find($id);
        $this->emit('getProducts', $products);
    }

    public function handleStored($products){
        session()->flash('info', 'Produk berhasil ditambahkan');
    }

    public function handleUpdate(){
        $this->updateMode = false;
        session()->flash('message', 'Users Updated Successfully.');
    }

    public function deleteItems($id){
        $product = productModel::find($id);
        $this->product_id = $product['codeitem'];
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function destroy($id)
    {
        $products = ProductModel::find($id);
        $products->delete();


        $this->dispatchBrowserEvent('closeModalDelete');
    }




}
