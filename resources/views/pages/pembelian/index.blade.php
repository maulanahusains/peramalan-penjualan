@extends('layouts.master')
@section('title', 'Pembelian')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header">
                    <div class="iq-header-title d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Kelola Pembelian</h4>
                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#add-data">
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="basic-datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Tanggal Beli</th>
                                    <th>Jumlah Beli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($pembelians as $pembelian)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pembelian->Produk->nama_produk }}</td>
                                        <td>{{ $pembelian->tgl_pembelian }}</td>
                                        <td>{{ $pembelian->jumlah_pembelian }}</td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-edit" data-id="{{ $pembelian->id }}">
                                                <i class="ri-edit-box-line"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-outline-danger btn-delete"
                                                data-id="{{ $pembelian->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pembelian.store') }}" method="post" id="form-add-pembelian">
                        @csrf
                        <div class="form-group">
                            <label for="">Produk</label>
                            <select name="kd_produk" id="" class="form-control">
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                @endforeach
                            </select>
                            @error('kd_produk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="text" name="jumlah_pembelian" class="form-control number"
                                placeholder="Masukkan Data!">
                            @error('jumlah_pembelian')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga Satuan</label>
                            <input type="text" name="harga_satuan" class="form-control currency"
                                placeholder="Masukkan Data!">
                            @error('harga_satuan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control"
                                placeholder="Masukkan Data!">
                            @error('tanggal_pembelian')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Minggu</label>
                            <select name="minggu" id="minggu" class="form-control">
                                @for ($i = 1; $i < 5; $i++)
                                    <option value="{{ $i }}" {{ $i == $week_of_month ? 'selected' : '' }}>
                                        Minggu
                                        {{ $i }}</option>
                                @endfor
                                <option value="nextmo_1">Minggu 1 Bulan depan</option>
                            </select>
                            @error('minggu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="response"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-update">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        function getWeekOfMonth(date) {
            let d = new Date(date);
            let week = d.getDate() / 7 | 0;
            if (week > 3) {
                week = 3
            }
            return week + 1;
        }

        $(document).ready(function() {

            $('#tanggal_pembelian').on('change', function() {
                let tanggalPembelian = $(this).val();
                let minggu = getWeekOfMonth(tanggalPembelian);

                $('#minggu').val(minggu);
            });

            $('.btn-add').click(function(e) {
                e.preventDefault();

                $(this).prop('disabled', true);
                $('#form-add-pembelian').submit();
            })

            $('.btn-edit').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('pembelian.edit', '') }}" + '/' + id,
                    method: 'GET',
                    success: function(res) {
                        $('#response').replaceWith(res);
                        $('#edit-data').modal('show');
                    }
                })
            })

            $('.btn-update').click(function(e) {
                e.preventDefault();

                $(this).prop('disabled', true);
                $('#form-update-pembelian').submit();
            })

            $('.btn-delete').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('pembelian.delete', '') }}" + '/' +
                            id
                    }
                });
            })
        })
    </script>
@endsection
