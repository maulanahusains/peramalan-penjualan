<form action="{{ route('kelola.produk.update', $produk->id) }}" method="post" id="form-update-produk"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Data!"
            value="{{ $produk->nama_produk }}">
        @error('nama_produk')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan Data!"
            value="{{ $produk->deskripsi }}">
        @error('deskripsi')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Photo</label>
        <input type="file" name="photo" class="form-control" placeholder="Masukkan Data!">
        @error('photo')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Stok</label>
        <input type="text" name="stok" class="form-control number" placeholder="Masukkan Data!"
            value="{{ $produk->stok }}">
        @error('stok')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Harga</label>
        <input type="text" name="harga" class="form-control currency" placeholder="Masukkan Data!"
            value="{{ number_format($produk->harga, 0, '.') }}">
        @error('harga')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</form>

<script>
    $('.currency').on('input', function() {
        var value = $(this).val();

        value = value.replace(/[^0-9]/g, '');

        var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $(this).val(formattedValue);
    });
</script>
