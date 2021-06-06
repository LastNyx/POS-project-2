<div>
    <div class="row">
        <div class = "col-md-5">
            <div class ="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Edit Stok</h2>
                    @if($updateMode == False)
                    <form>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">kode Barang</span>
                            <input wire:model="codeitem" type="text" class="form-control" readonly>
                            @error('codeitem') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Nama Barang</span>
                            <input wire:model="name" type="text" class="form-control"readonly>
                            @error('name') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Satuan</span>
                            <input wire:model="unitlevel" type="text" class="form-control" readonly>
                            @error('unitlevel') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Stok</span>
                            <input wire:model="stock" type="text" class="form-control" readonly>
                            @error('stock') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </form>

                    @else
                        <livewire:stock-edit></livewire:stock-edit>
                    @endif
                </div>
            </div>
        </div>

        <div class ="col-md-7" >
            <div class ="card">
                <div class="card-body " >
                    <h2 class="font-weight-bold mb-3">List Produk</h2>
                    <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                        <span class="input-group-text" id="addon-wrapping"> Cari</span>
                        <input wire:model="search" type="search" class="form-control" placeholder="Nama Barang" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Stok</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <td>{{$product->codeitem}}</td>
                                <td data-toggle="tooltip" title="{{$product->name}}" style="white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis; max-width: 12ch;">{{$product->name}}</td>
                                <td>{{$product->unitlevel}}</td>
                                <td>{{$product->stock}}</td>
                                <td style="text-align:center">
                                    <button wire:click="getProducts({{ $product->id }})" class='btn btn-info btn-sm'>Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" style="text-align: center;">{{$products->links()}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
