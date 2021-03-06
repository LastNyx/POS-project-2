<div>
    <div class="row" id="noprint">
        <div class ="col-md-8" >
            <div class ="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Transaksi</h2>
                    <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center">Action</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($details as $index => $detail)
                            @if($detail->transaction_id == 0)
                                <tr>
                                    <td style="text-align:center">
                                        <button wire:click="deleteDetail({{$detail->id}})" class='btn btn-danger btn-sm'>Hapus</button>
                                    </td>
                                    <td data-toggle="tooltip" title="{{$detail->product_id}}" style="white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis; max-width: 2ch;">{{$detail->Product->codeitem}}</td>
                                    <td data-toggle="tooltip" title="{{$detail->Product->name}}" style="white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis; max-width: 20ch;">{{$detail->Product->name}}</td>
                                    <td wire:click="editqty({{$detail->id}})" style="cursor: pointer;">{{$detail->qty}}</td>
                                    <td>{{$detail->Product->unitlevel}}</td>
                                    <td wire:click="editprice({{$detail->id}})" style="cursor: pointer;">{{'Rp. '.number_format($detail->price,0,",",".")}}</td>
                                    <td style="display:none;">{{$detail->Product->id}}</td>
                                    <td>{{'Rp. '.number_format($detail->price * $detail->qty,0,",",".")}}</td>
                                    @php
                                        $total += $detail->price * $detail->qty;
                                    @endphp
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr >
                            <td colspan="6" style="text-align:right"><b>TOTAL</b></td>
                            <td>
                                {{'Rp. '.number_format($total,0,",",".")}}
                            </td>
                            </tr>
                            @if(!empty($pay))
                            <tr>
                                <td colspan="6" style="text-align:right"><b>BAYAR</b>
                                <td>{{'Rp. '.number_format($pay,0,",",".")}}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right"><b>KEMBALI</b>
                                <td>{{'Rp. '.number_format($pay-$total,0,",",".")}}</td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="6" style="text-align:right"><b>BAYAR</b>
                                <td>{{'Rp. '.number_format(0,0,",",".")}}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right"><b>KEMBALI</b>
                                <td>{{'Rp. '.number_format(0-$total,0,",",".")}}</td>
                            </tr>
                            @endif

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

<!-- Modal QTY -->
<div wire:ignore.self class="modal fade" id="ModalQty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Qty</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form wire:keydown.enter="confirmEditQty({{$detail_id}})" onsubmit="return false">
            <input wire:model="detail_id" type="hidden" class="form-control">
            <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                <span class="input-group-text"  id="addon-wrapping">QTY</span>
                <input wire:model="qty"  type="number" class="form-control" id="setfocus">
                <input wire:model="unitlevel" type="text" class="form-control" readonly style="margin-left: 5px; font-weight: bold">
                @error('name') <small class="text-danger">{{$message}}</small>@enderror
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" wire:click="confirmEditQty({{$detail_id}})">Simpan</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal Harga -->
<div wire:ignore.self class="modal fade" id="ModalPrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Harga</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form wire:keydown.enter="confirmEditPrice({{$detail_id}})" onsubmit="return false">
            <input wire:model="detail_id" type="hidden" class="form-control">
            <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                <span class="input-group-text" id="addon-wrapping">Harga</span>
                <input wire:model="price" type="number" class="form-control" id="setfocus2">
            </div>
            <div><small class="text-danger">{{$TransactionError2}}</small></div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" wire:click.prevent="confirmEditPrice({{$detail_id}})">Simpan</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Error -->
<div wire:ignore.self class="modal fade" id="ModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <H2 class="text-danger" style="text-align:center">{{$TransactionError}}</H2>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


        <div class = "col-md-4">
            <div class ="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Input</h2>
                    <form onkeydown="return event.key != 'Enter';">
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping">Cari</span>
                            <input wire:model="search" wire:keydown.enter="showProduct('{{$search}}')" type="search" class="form-control" placeholder="Nama Barang/Kode Barang" aria-label="Username" aria-describedby="addon-wrapping" id="setfocusitem">
                        </div>
                            @if(!empty($search))
                                <div class="input-group flex-nowrap" style="margin-top: 15px;">
                                    <table class="table table-hover">
                                        <?php $count = 0; ?>
                                            @foreach ($products as $product)
                                            <?php /*if($count == 8) break;*/ ?>
                                                    <tbody>
                                                        <tr wire:click="showProduct('{{ $product->codeitem }}')" style="cursor: pointer;">
                                                            <td data-toggle="tooltip" title="{{$product->codeitem}}" style="white-space: nowrap;
                                                                overflow: hidden;
                                                                text-overflow: ellipsis; max-width: 8ch;">{{$product->codeitem}}</td>
                                                            <td data-toggle="tooltip" title="{{$product->name}}" style="white-space: nowrap;
                                                                overflow: hidden;
                                                                text-overflow: ellipsis; max-width: 25ch;">{{$product->name}}</td>
                                                            <td>{{$product->unitlevel}}</td>
                                                        </tr>
                                                    </tbody>
                                                <?php $count++; ?>
                                            @endforeach
                                    </table>
                                </div>
                            @endif
                            <div class="input-group" style="margin-top: 15px;">
                                <span class="input-group-text" id="addon-wrapping">Bayar</span>
                                <input wire:model="pay" type="number" class="form-control">
                            </div>
                            <div>@error('pay') <small class="text-danger">{{$message}}</small>@enderror</div>
                        <div class="input-group flex-nowrap;" style="margin-top: 15px;">
                            <button wire:click.prevent="saveTransaction(@php
                                                                        echo $total;
                                                                        @endphp)" class="btn btn-success btn-block">Selesai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@php
    $timenow = Carbon\Carbon::now();
@endphp

        <div class ="row" style="margin-top: 15px;">
            <div class="col-1">
                <div class="card" style="width: 390px; background: white; padding: 0px; margin: 0 auto; text-align: center; visibility: hidden;" id="print" >
                    <div class="card-body">
                        <h2 style="padding: 0px;margin: 0; font-size:29px;
                        font-family: Arial, Helvetica, sans-serif;">SUMBER JAYA</h2>
                        <p>Jalan Raya Sungai Kakap, Parit Gadoh<br>No.Telp 085386028128 / 089697897689</p>
                        <div class="d-flex justify-content-between">
                            <p>-------------------------------------------------------------</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>{{$timenow}}</p>
                            <p>Transaksi : {{str_pad($LastSavedID, 5, "0", STR_PAD_LEFT)}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>-------------------------------------------------------------</p>
                        </div>
                        @foreach ($details as $index => $detail)
                            @if($detail->transaction_id == $LastSavedID)
                            <div class="d-flex justify-content-between">
                                <p>{{$detail->Product->name}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>{{number_format($detail->qty,2,)}} {{ $detail->Product->unitlevel}}&nbsp;&nbsp;x {{'Rp. '.number_format($detail->price,0,",",".")}}</p>
                                <p>&nbsp;&nbsp;{{'Rp. '.number_format($detail->price * $detail->qty,0,",",".")}}</p>
                                @php
                                    $total += $detail->price * $detail->qty;
                                @endphp
                            </div>
                            @endif
                        @endforeach

                        <div class="d-flex justify-content-between">
                            <p>-------------------------------------------------------------</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p>Total : {{'Rp. '.number_format($total,0,",",".")}}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p>Tunai : {{'Rp. '.number_format($LastPayment,0,",",".")}}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p>Kembali : {{'Rp. '.number_format($LastPayment-$total,0,",",".")}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>-------------------------------------------------------------</p>
                        </div>
                        <div>
                            <p>Terima Kasih Sudah Berbelanja <br> di Toko Kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
