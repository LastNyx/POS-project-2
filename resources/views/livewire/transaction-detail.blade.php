<div class="row">
    <div class="container-fluid" style="margin-top: 15px; margin-bottom:15px;">
        <button wire:click='resetTransactionId()' type="button" class='btn btn-primary btn-sm'>Back</button>
    </div>
    <div class ="col" >
        <div class ="card">
            <div class="card-body ">
                <h2 class="font-weight-bold mb-3">Detail Transaksi No.{{$transaction_id}}</h2>
                <h2 class="font-weight-bold mb-3" style="text-align:right"></h2>
                <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                               $total = 0;
                            @endphp
                            @foreach ($details as $index => $detail)
                            @if($detail->transaction_id == $transaction_id)
                                <tr>
                                    <td>{{$detail->Product->codeitem}}</td>
                                    <td data-toggle="tooltip" title="{{$detail->Product->name}}" style="white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis; max-width: 12ch;">{{$detail->Product->name}}</td>
                                    <td>{{$detail->Product->unitlevel}}</td>
                                    <td>{{$detail->qty}}</td>
                                    <td>{{'Rp. '.number_format($detail->price,0,",",".")}}</td>
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
                            <tr>
                            <td colspan="5" style="text-align:right"><b>TOTAL</b></td>
                            <td>{{'Rp. '.number_format($total,0,",",".")}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align:right"><b>BAYAR</b>
                                <td>{{'Rp. '.number_format($pay,0,",",".")}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align:right"><b>KEMBALIAN</b>
                                <td>{{'Rp. '.number_format($pay-$total,0,",",".")}}</td>
                            </tr>
                        </tfoot>
                    </table>

            </div>
        </div>
    </div>
</div>
