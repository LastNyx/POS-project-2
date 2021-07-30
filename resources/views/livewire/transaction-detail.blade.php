<div class="row">
    <div class="container-fluid" >
        <div class="row" style="margin:15px" id="noprint">
            <button wire:click='resetTransactionId()' type="button" class='btn btn-danger'>Back</button>
            <button wire:click='print()' type="button" class='btn btn-success' style="margin-left: 5px">Print out struk</button>
        </div>
        <div class="row" id="noprint">
            <div class ="col">
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
                                        <th scope="col">Qty</th>
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
                                            <td data-toggle="tooltip" title="{{$detail->Product->codeitem}}" style="white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis; max-width: 8ch;">{{$detail->Product->codeitem}}</td>
                                            <td data-toggle="tooltip" title="{{$detail->Product->name}}" style="white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis; max-width: 15ch;">{{$detail->Product->name}}</td>
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
                                        <td colspan="5" style="text-align:right"><b>KEMBALI</b>
                                        <td>{{'Rp. '.number_format($pay-$total,0,",",".")}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>
                </div>
            </div>
        </div>
            @php
            $timenow = Carbon\Carbon::now();
            @endphp

        <div class ="row" style="margin-top: 15px;">
            <div class="col-1">
                <div class="card" style="width: 390px; background: white; padding: 0px; margin: 0 auto; text-align: center; visibility: hidden; " id="print" >
                    <div class="card-body">
                        <h2 style="padding: 0px;margin: 0; font-size:29px;
                        font-family: Arial, Helvetica, sans-serif;">SUMBER JAYA</h2>
                        <p>Jalan Raya Sungai Kakap, Parit Gadoh<br>No.Telp 085386028128 / 089697897689<br>*COPY*<br></p>
                        <div class="d-flex justify-content-between">
                            <p>-------------------------------------------------------------</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>{{$timenow}}</p>
                            <p>Transaksi : {{str_pad($transaction_id, 5, "0", STR_PAD_LEFT)}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>-------------------------------------------------------------</p>
                        </div>
                        @foreach ($details as $index => $detail)
                            @if($detail->transaction_id == $transaction_id)
                            <div class="d-flex justify-content-between">
                                <p>{{$detail->Product->name}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>{{number_format($detail->qty,2,)}} {{ $detail->Product->unitlevel}}&nbsp;&nbsp;x {{'Rp. '.number_format($detail->price,0,",",".")}}</p>
                                <p>&nbsp;&nbsp;{{'Rp. '.number_format($detail->price * $detail->qty,0,",",".")}}</p>

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
                            <p>Tunai : {{'Rp. '.number_format($pay,0,",",".")}}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p>Kembali : {{'Rp. '.number_format($pay-$total,0,",",".")}}</p>
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
</div>

