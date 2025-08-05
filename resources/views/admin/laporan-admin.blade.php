@extends('admin.layout-admin')

@section('title', 'Laporan')

@section('content')


    <div class="card-wrapper">
        <div class="card card-laporan" onclick="window.location.href='{{ route('admin.laporan-gudang-admin.index') }}'">
            <div class="card-title">Laporan Gudang</div>
        </div>
        <div class="card card-data-produk" onclick="window.location.href='{{ route('admin.laporan-kasir-admin.index') }}'">
            <div class="card-title">Laporan Kasir</div>
        </div>
    </div>

@endsection
