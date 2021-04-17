<div>
    <div class="row">
        <div class = "col-md-5">
            <div class ="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Buat Produk</h2>
                    <form wire:submit.prevent="store">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">kode Barang</span>
                            <input wire:model="codeitem" type="text" class="form-control">
                            @error('codeitem') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Nama Barang</span>
                            <input wire:model="name" type="text" class="form-control">
                            @error('name') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Satuan</span>
                            <input wire:model="unitlevel" type="text" class="form-control">
                            @error('unitlevel') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Harga</span>
                            <input wire:model="price" type="number" class="form-control">
                            @error('price') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <span class="input-group-text" id="addon-wrapping">Modal</span>
                            <input wire:model="capital_price" type="number" class="form-control">
                            @error('capital_price') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h3>{{$codeitem}}</h3>
                    <h3>{{$name}}</h3>
                    <h3>{{$unitlevel}}</h3>
                    <h3>{{$price}}</h3>
                    <h3>{{$capital_price}}</h3>
                </div>
            </div>
        </div>

        <div class ="col-md-7" >
            <div class ="card">
                <div class="card-body " style="background-color:dodgerblue">
                    <h2 class="font-weight-bold mb-3">List Produk</h2>
                    <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                        <span class="input-group-text" id="addon-wrapping"> Cari</span>
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Username" aria-describedby="addon-wrapping">
                        <div class="input-group-append " style="background-color:white">
                            <button class="btn btn-outline-secondary fa fa-search" type="button"></button>
                        </div>
                    </div>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Modal</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <td>{{$product->codeitem}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->unitlevel}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->capital_price}}</td>
                                <td style="text-align:center">
                                    <a href='#' class='btn btn-info btn-sm'>Edit</a>
                                    <a class='btn btn-danger btn-sm' onclick='if(confirm(\"Yakin Hapus ?\")) location.href=\"#";'>Hapus</a>
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
