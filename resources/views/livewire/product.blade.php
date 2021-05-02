<div>
    <div class="row">
        <div class = "col-md-5">
            <div class ="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Buat Produk</h2>
                    @if($updateMode == False)
                        <livewire:product-create></livewire:product-create>
                    @else
                        <livewire:product-edit></livewire:product-edit>
                    @endif
                </div>
            </div>
        </div>

        <div class ="col-md-7" >
            <div class ="card">
                <div class="card-body " style="background-color:dodgerblue">
                    <h2 class="font-weight-bold mb-3">List Produk</h2>
                    <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                        <span class="input-group-text" id="addon-wrapping"> Cari</span>
                        <input wire:model="search" type="search" class="form-control" placeholder="Nama Barang" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Modal</th>
                                <th scope="col">Stok</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <td>{{$product->codeitem}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->unitlevel}}</td>
                                <td>{{'Rp. '.number_format($product->price,0,",",".")}}</td>
                                <td>{{'Rp. '.number_format($product->capital_price,0,",",".")}}</td>
                                <td>{{$product->stock}}</td>
                                <td style="text-align:center">
                                    <button wire:click="getProducts({{ $product->id }})" class='btn btn-info btn-sm'>Edit</a>
                                    <button wire:click="destroy({{ $product->id }})" class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
