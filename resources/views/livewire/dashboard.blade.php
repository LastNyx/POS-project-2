<div>
    @php
        $totalpenjualan = 0;
        $totalpenjualanmodal = 0;
    @endphp

    @if($transaction_id == 0)
    <div class="row" id="noprint">
        <div class ="col">
            <div class ="card" >
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h2 class="font-weight-bold mb-3">LAPORAN PENJUALAN</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlSelect1">Transaksi Bulan :</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <Select wire:model ="month" style="width: 50%;" id="bulan" name="bulan" class="form-control">
                                @for ($m=01; $m<=12; ++$m)
                                        <option value="{{$m}}">{{$month_label = date('F', mktime(0, 0, 0, $m, 1))}}</option>
                                @endfor
                                </Select>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4" style="padding: 0;margin: 0 ;">
                                        <span class="input-group-text pull-right" id="addon-wrapping">Cari Transaksi</span>
                                    </div>
                                    <div class="col-8" style="padding-left: 0;margin: 0 ;">
                                        <input wire:model="searchTransaction" type="search" class="form-control" placeholder="No. Transaksi">
                                        <div class="dropdown">
                                            @if(!empty($searchTransaction))
                                                <div class="dropdown-menu show" style="width:100%">
                                                    <?php $count = 0; ?>
                                                        @foreach ($transactionsearch as $transaction)
                                                            <?php if($count == 4) break; ?>
                                                                <a wire:click="opendetail({{$transaction->id}})" class="dropdown-item">{{str_pad($transaction->id, 5, "0", STR_PAD_LEFT)}}</a>
                                                            <?php $count++; ?>
                                                        @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No transaksi</th>
                                            <th scope="col">Tanggal Transaksi</th>
                                            <th scope="col" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $index => $transaction)
                                            <tr>
                                                <td>{{str_pad($transaction->id, 5, "0", STR_PAD_LEFT)}}</td>
                                                <td>{{date_format($transaction->created_at, "D, d F Y")}}</td>
                                                <td style="text-align:center">
                                                    <button wire:click="opendetail({{$transaction->id}})" class='btn btn-success btn-sm'>Detail</button>
                                                </td>
                                                @php
                                                    $totalpenjualan += $transaction->total;
                                                @endphp
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">{{$transactions->links()}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;" id="dashboard">
                            <div class="col text-center">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseSummary">Rangkuman Penjualan Bulanan</button>
                            </div>
                        </div>

                        <div class ="row" style="margin-top: 15px;">
                            <div class="col">
                                <div class="collapse" id="collapseSummary">
                                    <div class ="card">
                                        <div class="card-body">
                                            <div class="container-fluid" id="Sellings">
                                                <div class="row">
                                                    <div class="col">
                                                        <h2>Rangkuman Penjualan Bulanan</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr style="text-align: center;">
                                                                <th scope="col">Nama Barang</th>
                                                                <th scope="col">Harga Modal</th>
                                                                <th scope="col">Harga Jual</th>
                                                                <th scope="col">Banyak Terjual</th>
                                                                <th scope="col">Satuan</th>
                                                                <th scope="col">Harga Jual Total</th>
                                                                <th scope="col">Keuntungan</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $groups = array();
                                                                @endphp
                                                                @foreach ($transactionAll as $index => $transaction)
                                                                    @foreach ($transaction->details as $details)
                                                                        @php
                                                                            $products = App\Models\product::find($details->product_id);
                                                                            $key = $details->product_id;
                                                                            if (!array_key_exists($key, $groups)) {
                                                                                $groups[$key] = array(
                                                                                    'id' => $details->transaction_id,
                                                                                    'name' => $details->Product->name,
                                                                                    'qty' => $details->qty,
                                                                                    'actual_price' => $products->price,
                                                                                    'price' => $details->price,
                                                                                    'price_total' => $details->price*$details->qty,
                                                                                    'capital_price' => $details->Product->capital_price,
                                                                                    'capital_price_total' => $details->Product->capital_price*$details->qty,
                                                                                    'satuan' => $details->Product->unitlevel
                                                                                );
                                                                            } else {
                                                                                $groups[$key]['qty'] = $groups[$key]['qty'] + $details->qty;
                                                                                $groups[$key]['price_total'] = $groups[$key]['price_total'] + ($details->price*$details->qty);
                                                                                $groups[$key]['capital_price_total'] = $groups[$key]['capital_price_total'] + ($details->Product->capital_price*$details->qty);
                                                                            }
                                                                        @endphp
                                                                    @endforeach
                                                                @endforeach

                                                                @php
                                                                    function cmp($a, $b) {
                                                                        return $a['qty'] < $b['qty'];
                                                                    }


                                                                @endphp

                                                                @foreach ($groups as $key => $value)
                                                                    <tr>
                                                                        <td data-toggle="tooltip" title="{{$groups[$key]['name']}}" style="white-space: nowrap;
                                                                            overflow: hidden;
                                                                            text-overflow: ellipsis; max-width: 20ch;">{{$groups[$key]['name']}}</td>
                                                                        <td>{{'Rp. '.number_format($groups[$key]['capital_price'],0,",",".")}}</td>
                                                                        <td>{{'Rp. '.number_format($groups[$key]['actual_price'],0,",",".")}}</td>
                                                                        <td>{{$groups[$key]['qty']}}</td>
                                                                        <td>{{$groups[$key]['satuan']}}</td>
                                                                        <td style="text-align: center;">{{'Rp. '.number_format($groups[$key]['price_total'],0,",",".")}}</td>
                                                                        <td style="text-align: center;">{{'Rp. '.number_format($groups[$key]['price_total']-$groups[$key]['capital_price_total'],0,",",".")}}</td>
                                                                    </tr>
                                                                    @php
                                                                        $totalpenjualanmodal += $groups[$key]['capital_price_total'];
                                                                    @endphp
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="5"><b>TOTAL PENJUALAN BULAN INI</b></td>
                                                                    <td style="text-align: center;">{{'Rp. '.number_format($totaltransactions,0,",",".")}}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"><b>TOTAL KEUNTUNGAN BULAN INI</b></td>
                                                                    <td style="text-align: center;">{{'Rp. '.number_format($totaltransactions-$totalpenjualanmodal,0,",",".")}}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($transaction_id !=0)
            <livewire:transaction-detail></livewire:transaction-detail>
        @endif
    </div>

</div>



