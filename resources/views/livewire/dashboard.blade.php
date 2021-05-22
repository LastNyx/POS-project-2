<div>
    @if($transaction_id == 0)
    <div class="row">
        <div class ="col-md-12" >
            <div class ="card">
                <div class="card-body ">
                    <h2 class="font-weight-bold mb-3">DASHBOARD</h2>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Transaksi Bulan:</label>
                        <Select class="form-control" aria-label="Default select example">
                            <option value="05">May</option>
                        </Select>
                    </div>
                    <div class="input-group flex-nowrap;" style="margin-top: 10px; margin-bottom: 15px;">
                    </div>
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
                                    <td>{{$transaction->id}}</td>
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
    @elseif($transaction_id !=0)
    <livewire:transaction-detail></livewire:transaction-detail>
    @endif
</div>



