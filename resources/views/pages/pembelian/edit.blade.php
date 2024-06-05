<form action="{{ route('penjualan.update', $penjualan->id) }}" method="post" id="form-update-penjualan">
    @csrf
    <div class="form-group">
        <label for="">Produk</label>
        <select name="kd_produk" id="" class="form-control">
            @foreach ($produks as $produk)
                <option value="{{ $produk->id }}" {{ $produk->id == $penjualan->kd_produk ? 'selected' : '' }}>
                    {{ $produk->nama_produk }}</option>
            @endforeach
        </select>
        @error('kd_produk')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Jumlah</label>
        <input type="text" name="jumlah_penjualan" class="form-control number" placeholder="Masukkan Data!"
            value="{{ $penjualan->jumlah_penjualan }}">
        @error('jumlah_penjualan')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Minggu</label>
        <select name="minggu" class="form-control">
            @for ($i = 1; $i < 5; $i++)
                <option value="{{ $i }}" {{ $i == $penjualan->minggu ? 'selected' : '' }}>Week
                    {{ $i }}</option>
            @endfor
            <option value="nextmo_1" {{ $penjualan->minggu == 'nextmo_1' ? 'selected' : '' }}>
                Week 1 Bulan depan
            </option>
        </select>
        @error('minggu')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</form>
