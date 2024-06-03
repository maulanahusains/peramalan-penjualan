@extends('layouts.master')
@section('title', 'Produk')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header">
                    <div class="iq-header-title d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Kelola Produk</h4>
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
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>{{ $produk->deskripsi }}</td>
                                        <td>Rp. {{ number_format($produk->harga, 0, '.') }}</td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-edit" data-id="{{ $produk->id }}">
                                                <i class="ri-edit-box-line"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-outline-danger btn-delete" data-id="{{ $produk->id }}">
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
                    <form action="{{ route('kelola.produk.store') }}" method="post" id="form-add-produk"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Data!">
                            @error('nama_produk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan Data!">
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
                            <input type="text" name="stok" class="form-control number" placeholder="Masukkan Data!">
                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="harga" class="form-control currency" placeholder="Masukkan Data!">
                            @error('harga')
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Produk</h5>
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
        $(document).ready(function() {
            $('.btn-add').click(function(e) {
                e.preventDefault();

                $(this).prop('disabled', true);
                $('#form-add-produk').submit();
            })

            $('.btn-edit').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('kelola.produk.edit', '') }}" + '/' + id,
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
                $('#form-update-produk').submit();
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
                        window.location.href = "{{ route('kelola.produk.delete', '') }}" + '/' + id
                    }
                });
            })
        })
    </script>
@endsection
