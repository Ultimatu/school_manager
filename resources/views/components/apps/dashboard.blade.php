@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Management</li>
            </ol>
            <h4 class="main-title mb-0">Welcome to Dashboard</h4>
        </div>

        <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
            <button type="button" class="btn btn-white btn-icon"><i class="ri-share-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-white btn-icon"><i class="ri-printer-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-primary d-flex align-items-center gap-2"><i
                    class="ri-bar-chart-2-line fs-18 lh-1"></i>Generate<span class="d-none d-sm-inline">
                    Report</span></button>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-5">
            <div class="row g-3">
                <div class="col-6 col-md-3 col-xl-6">
                    <div class="card card-one card-product">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <div class="card-icon"><i class="ri-shopping-bag-fill"></i></div>
                                <h6 class="fw-normal ff-numerals text-success mb-0">+28.5%</h6>
                            </div>
                            <h2 class="card-value ls--1"><span>$</span>14,803.80</h2>
                            <label class="card-label fw-medium text-dark">Total Sales</label>
                            <span class="d-flex gap-1 fs-xs">
                                <span class="d-flex align-items-center text-success">
                                    <span class="ff-numerals">2.3%</span><i class="ri-arrow-up-line"></i>
                                </span>
                                <span class="text-secondary">than last week</span>
                            </span>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-md-3 col-xl-6">
                    <div class="card card-one card-product">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <div class="card-icon"><i class="ri-wallet-3-fill"></i></div>
                                <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6>
                            </div>
                            <h2 class="card-value ls--1"><span>$</span>8,100.63</h2>
                            <label class="card-label fw-medium text-dark">Total Expenses</label>
                            <span class="d-flex gap-1 fs-xs">
                                <span class="d-flex align-items-center text-danger">
                                    <span class="ff-numerals">0.5%</span><i class="ri-arrow-down-line"></i>
                                </span>
                                <span class="text-secondary">than last week</span>
                            </span>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-md-3 col-xl-6">
                    <div class="card card-one card-product">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <div class="card-icon"><i class="ri-shopping-basket-fill"></i></div>
                                <h6 class="fw-normal ff-numerals text-danger mb-0">-8.4%</h6>
                            </div>
                            <h2 class="card-value ls--1">23,480</h2>
                            <label class="card-label fw-medium text-dark">Total Products</label>
                            <span class="d-flex gap-1 fs-xs">
                                <span class="d-flex align-items-center text-danger">
                                    <span class="ff-numerals">0.2%</span><i class="ri-arrow-down-line"></i>
                                </span>
                                <span class="text-secondary">than last week</span>
                            </span>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-md-3 col-xl-6">
                    <div class="card card-one card-product">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <div class="card-icon"><i class="ri-shopping-basket-fill"></i></div>
                                <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6>
                            </div>
                            <h2 class="card-value ls--1">18,060</h2>
                            <label class="card-label fw-medium text-dark">Products Sold</label>
                            <span class="d-flex gap-1 fs-xs">
                                <span class="d-flex align-items-center text-success">
                                    <span class="ff-numerals">5.8%</span><i class="ri-arrow-up-line"></i>
                                </span>
                                <span class="text-secondary">than last week</span>
                            </span>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- col -->
        <div class="col-xl-7">
            <div class="card card-one card-product-inventory">
                <div class="card-header">
                    <h6 class="card-title">Product Inventory</h6>
                    <nav class="nav nav-icon nav-icon-sm ms-auto">
                        <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                        <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
                    </nav>
                </div><!-- card-header -->
                <div class="card-body p-3">
                    <ul class="legend mb-3 position-absolute">
                        <li>Remaining Quantity</li>
                        <li>Sold Quantity</li>
                    </ul>
                    <div id="apexChart1" class="apex-chart-twelve mt-4 pt-3"></div>
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->
    </div> --}}
@endsection

@push('scripts')
    <script src="{{ asset('lib/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/db.product.js') }}"></script>
@endpush
