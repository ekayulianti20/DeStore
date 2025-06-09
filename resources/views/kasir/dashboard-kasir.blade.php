@extends('kasir.layout-kasir')

@section('title', 'Dashboard')

@section('content')

    <div class="card-wrapper">
        <div class="card-container">
            <div class="card border-danger mb-3" style="max-width: 30rem; min-height: 10rem;">
                <div class="card-header border-danger d-flex align-items-center justify-content-between">
                    <div class="circle-group">
                        <span class="circle bg-danger"></span>
                        <span class="circle bg-warning"></span>
                        <span class="circle bg-success"></span>
                    </div>
                    <h5 class="mb-0">Produk Masuk</h5>
                </div>
                <div class="card-body text-secondary">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        cards
                        content.</p>
                </div>
            </div>
        </div>
        <div class="card-container">
            <div class="card border-primary mb-3" style="max-width: 30rem; min-height: 10rem;">
                <div class="card-header border-danger d-flex align-items-center justify-content-between">
                    <div class="circle-group">
                        <span class="circle bg-danger"></span>
                        <span class="circle bg-warning"></span>
                        <span class="circle bg-success"></span>
                    </div>
                    <h5 class="mb-0">Produk Keluar</h5>
                </div>
                <div class="card-body text-secondary">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        cards
                        content.</p>
                </div>
            </div>
        </div>
        <div class="card-container">
            <div class="card border-success mb-3" style="max-width: 30rem; min-height: 10rem;">
                <div class="card-header border-danger d-flex align-items-center justify-content-between">
                    <div class="circle-group">
                        <span class="circle bg-danger"></span>
                        <span class="circle bg-warning"></span>
                        <span class="circle bg-success"></span>
                    </div>
                    <h5 class="mb-0">Total Produk</h5>
                </div>
                <div class="card-body text-secondary">
                    <h5 class="card-title">Secondary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        cards
                        content.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
