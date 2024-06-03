@extends('layouts.master')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header">
                    <div class="iq-header-title d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Kelola User</h4>
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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->level }}</td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-edit" data-id="{{ $user->id }}">
                                                <i class="ri-edit-box-line"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-outline-danger btn-delete" data-id="{{ $user->id }}">
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
                    <form action="{{ route('kelola.user.store') }}" method="post" id="form-add-user">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Data!">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Data!">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Data!">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <select name="level" class="form-control">
                                <option value="Admin">Admin</option>
                                <option value="Superadmin">Superadmin</option>
                                <option value="Owner">Owner</option>
                            </select>
                            @error('level')
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
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
                $('#form-add-user').submit();
            })

            $('.btn-edit').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('kelola.user.edit', '') }}" + '/' + id,
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
                $('#form-update-user').submit();
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
                        window.location.href = "{{ route('kelola.user.delete', '') }}" + '/' + id
                    }
                });
            })
        })
    </script>
@endsection
