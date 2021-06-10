<div>
    @if($transaction_id == 0)
    <div class="row">
        <div class ="col">
            <div class ="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h2 class="font-weight-bold mb-3">DASHBOARD</h2>
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
                                            <th scope="col">No.transaksi</th>
                                            <th scope="col">Tanggal Transaksi</th>
                                            <th scope="col" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalpenjualan = 0
                                        @endphp
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
                                        <tr>
                                        <td><b>TOTAL PENJUALAN BULAN INI</b></td>
                                        <td colspan="2">{{'Rp. '.number_format($totaltransactions,0,",",".")}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
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

    <div class ="row" style="margin-top: 15px;">
        <div class="col">
            <div class ="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactionAll as $index => $transaction)
                                            @foreach ($transaction->details as $details)
                                                <tr>
                                                    <td>{{$details->transaction_id}}</td>
                                                    <td>{{$details->Product->name}}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



