@extends('layouts.master')
@section('title', 'Supplier')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header">
                    <div class="iq-header-title d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Kelola Supplier</h4>
                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#add-data">Tambah
                            Data</button>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="basic-datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Supplier</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $supplier->nama_supplier }}</td>
                                        <td>{{ $supplier->nama_perusahaan }}</td>
                                        <td>{{ $supplier->alamat }}</td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-edit" data-id="{{ $supplier->id }}">
                                                <i class="ri-edit-box-line"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-outline-danger btn-delete" data-id="{{ $supplier->id }}">
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
                    <form action="{{ route('kelola.supplier.store') }}" method="post" id="form-add-supplier">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <input type="text" name="nama_supplier" class="form-control" placeholder="Masukkan Data!">
                            @error('nama_supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control" placeholder="Masukkan Data!">
                            @error('nama_perusahaan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Masukkan Data!">
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Supplier</h5>
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
                $('#form-add-supplier').submit();
            })

            $('.btn-edit').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('kelola.supplier.edit', '') }}" + '/' + id,
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
                $('#form-update-supplier').submit();
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
                        window.location.href = "{{ route('kelola.supplier.delete', '') }}" + '/' +
                            id
                    }
                });
            })
        })
    </script>
@endsection
