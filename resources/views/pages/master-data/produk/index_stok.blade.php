@extends('layouts.master')
@section('title', 'Stok')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-header">
                    <div class="iq-header-title d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Stok Produk</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="basic-datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($stoks as $stok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stok->Produk->nama_produk }}</td>
                                        <td>{{ $stok->stok }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
