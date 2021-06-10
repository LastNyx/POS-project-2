<div>
    <div class="row">
        <div class = "col-md-4">
            <div class ="card sticky-top">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Form Produk</h2>
                    @if($updateMode == False)
                        <livewire:product-create></livewire:product-create>
                    @else
                        <livewire:product-edit></livewire:product-edit>
                    @endif
                </div>
            </div>
        </div>

<!-- Modal Delete -->
<div wire:ignore.self class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <H2 class="text" style="text-align:center">Yakin Menghapus?</H2>
        </form>
        </div>
        <div class="modal-footer">
            <button wire:click="destroy({{ $product_id }})" class='btn btn-danger'>Hapus</button>
        </div>
      </div>
    </div>
  </div>


        <div class ="col-md-8" >
            <div class ="card">
                <div class="card-body ">
                    <h2 class="font-weight-bold mb-3">List Produk</h2>
                    <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                        <span class="input-group-text" id="addon-wrapping"> Cari</span>
                        <input wire:model="search" type="search" class="form-control" placeholder="Nama Barang/Kode Barang">
                    </div>
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Modal</th>
                                <th scope="col" style="text-align: center;" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <td style="white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis; max-width: 2ch;">{{$product->codeitem}}</td>
                                <td data-toggle="tooltip" title="{{$product->name}}" style="white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis; max-width: 15ch;">{{$product->name}}</td>
                                <td>{{$product->unitlevel}}</td>
                                <td>{{'Rp. '.number_format($product->price,0,",",".")}}</td>
                                <td>{{'Rp. '.number_format($product->capital_price,0,",",".")}}</td>
                                <td style="text-align:right">
                                    <button wire:click="getProducts({{ $product->id }})" class='btn btn-info btn-sm'>Edit</button>
                                </td>
                                <td style="text-align:left">
                                    <button wire:click="deleteItems({{$product->id}})" class='btn btn-danger btn-sm'>Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8" >{{$products->links()}}</div></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
