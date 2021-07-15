<form>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">kode Barang</span>
        <input wire:model="codeitem" type="text" class="form-control">
        @error('codeitem') <small class="text-danger">{{$message}}</small>@enderror
    </div>
    <div class="input-group flex-nowrap;" style="margin-top: 15px;">
        <span class="input-group-text" id="addon-wrapping">Nama Barang</span>
        <input wire:model="name" type="text" class="form-control" maxlength="40">
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
        <button wire:click.prevent="store()" class="btn btn-primary btn-block">Submit</button>
    </div>
</form>
