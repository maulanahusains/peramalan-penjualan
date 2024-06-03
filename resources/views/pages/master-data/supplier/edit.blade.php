<form action="{{ route('kelola.supplier.update', $supplier->id) }}" method="post" id="form-update-supplier">
    @csrf
    <div class="form-group">
        <label for="">Nama Supplier</label>
        <input type="text" name="nama_supplier" class="form-control" placeholder="Masukkan Data!"
            value="{{ $supplier->nama_supplier }}">
        @error('nama_supplier')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" class="form-control" placeholder="Masukkan Data!"
            value="{{ $supplier->nama_perusahaan }}">
        @error('nama_perusahaan')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Alamat</label>
        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Data!"
            value="{{ $supplier->alamat }}">
        @error('alamat')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</form>
