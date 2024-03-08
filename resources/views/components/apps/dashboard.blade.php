@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
            </ol>
            <h4 class="main-title mb-0">Bienvenue sur votre tableau de bord</h4>
        </div>
    </div>
    @include('components.shared.alert')
    @if (auth()->user()->isComptable())
        <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
            <button type="button" class="btn btn-white btn-icon"><i class="ri-share-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-white btn-icon"><i class="ri-printer-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-primary d-flex align-items-center gap-2"><i
                    class="ri-bar-chart-2-line fs-18 lh-1"></i>Generate<span class="d-none d-sm-inline">
                    Report</span></button>
        </div>
    @endif
    @if (auth()->user()->isEtudiant())
        <div class="row g-3">
            <div class="co-md-12">
                <div class="row g-3">
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product alert alert-info">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalScolarite }}</span> FCFA</h2>
                                <label class="card-label fw-bold text-dark">Total Scolarité</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product alert alert-success">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalScolaritePaid }}</span> FCFA</h2>
                                <label class="card-label fw-bold text-dark">Total Scolarité payée</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product alert alert-danger">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-8.4%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalScolariteUnpaid }}</span> FCFA</h2>
                                <label class="card-label fw-bold text-dark ">Total Scolarité non payée</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    @if ($car === true)
                        <div class="col-6 col-md-3 col-xl-6">
                            <div class="card card-one card-product alert alert-secondary">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                        {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                    </div>
                                    <h2 class="card-value ls--1"><span>{{ $totalCar }}</span> FCFA</h2>
                                    <label class="card-label fw-bold text-dark">Montant Inscription Car</label>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                        <div class="col-6 col-md-3 col-xl-6">
                            <div class="card card-one card-product alert alert-success">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                        {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                    </div>
                                    <h2 class="card-value ls--1"><span>{{ $totalCarPaid }}</span> FCFA</h2>
                                    <label class="card-label fw-bold text-dark">Montant Inscription Transport payé</label>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                        <div class="col-6 col-md-3 col-xl-6">
                            <div class="card card-one card-product alert alert-warning">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                        {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                    </div>
                                    <h2 class="card-value ls--1"><span>{{ $totalCar - $totalCarPaid }}</span> FCFA</h2>
                                    <label class="card-label fw-bold text-dark">Montant Inscription Transport non
                                        payé</label>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                    @endif
                    @if ($cite === true)
                        <div class="col-6 col-md-3 col-xl-6">
                            <div class="card card-one card-product alert alert-secondary">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                        {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                    </div>
                                    <h2 class="card-value ls--1"><span>{{ $totalCite }}</span> FCFA</h2>
                                    <label class="card-label fw-bold text-dark">Montant Inscription Chambre</label>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                        <div class="col-6 col-md-3 col-xl-6">
                            <div class="card card-one card-product alert alert-success">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                        {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                    </div>
                                    <h2 class="card-value ls--1"><span>{{ $totalCitePaid }}</span> FCFA</h2>
                                    <label class="card-label fw-bold text-dark">Montant Inscription Chambre payé</label>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                        <div class="col-6 col-md-3 col-xl-6">
                            <div class="card card-one card-product alert alert-warning">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                        {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                    </div>
                                    <h2 class="card-value ls--1"><span>{{ $totalCite - $totalCitePaid }}</span> FCFA</h2>
                                    <label class="card-label fw-bold text-dark">Montant Inscription Chambre non payé</label>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col -->
                    @endif
                </div><!-- row -->
            </div><!-- col -->
        </div>
    @elseif (auth()->user()->isAdmin())
        <div class="row g-3">
            <div class="co-md-12">
                <div class="row g-3">
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                </div>
                                <h2 class="card-value ls--1">{{ $totalBudget_scolaire }}&nbsp;FCFA</h2>
                                <label class="card-label fw-medium text-dark">Budget scolarité</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalBudget_scolaire_paid }}</span>&nbsp;FCFA</h2>
                                <label class="card-label fw-medium text-dark">Total Scolarité payée</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-8.4%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalBudget_scolaire_unpaid }}</span>&nbsp;FCFA
                                </h2>
                                <label class="card-label fw-medium text-dark">Total Scolarité non payée</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1">{{ $filieres->count() }}</h2>
                                <label class="card-label fw-medium text-dark">Nombres de filières</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1">{{ $classes->count() }}</h2>
                                <label class="card-label fw-medium text-dark">Nombres de classes</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-user-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1">{{ $etudiants->count() }}</h2>
                                <label class="card-label fw-medium text-dark">Nombres d'étudiants</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- col -->
        </div>
    @elseif (auth()->user()->isComptable())
        <div class="row g-3">
            <div class="co-md-12">
                <div class="row g-3">
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                </div>
                                <h2 class="card-value ls--1">{{ $totalBudget_scolaire }}&nbsp;FCFA</h2>
                                <label class="card-label fw-medium text-dark">Budget scolarité</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalBudget_scolaire_paid }}</span>&nbsp;FCFA</h2>
                                <label class="card-label fw-medium text-dark">Total Scolarité payée</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-money-dollar-circle-line"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-8.4%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $totalBudget_scolaire_unpaid }}</span>&nbsp;FCFA
                                </h2>
                                <label class="card-label fw-medium text-dark">Total Scolarité non payée</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- col -->
        </div>
    @elseif (auth()->user()->isConsellor())
        <div class="row g-3">
            <div class="co-md-12">
                <div class="row g-3">
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1">{{ $filieres->count() }}</h2>
                                <label class="card-label fw-medium text-dark">Nombres de filières</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1">{{ $classes->count() }}</h2>
                                <label class="card-label fw-medium text-dark">Nombres de classes</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-user-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-success mb-0">+20.9%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1">{{ $etudiants->count() }}</h2>
                                <label class="card-label fw-medium text-dark">Nombres d'étudiants</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- col -->
        </div>
    @elseif (auth()->user()->isProfesseur())
        <div class="row g-3">
            <div class="co-md-12">
                <div class="row g-3">
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product alert alert-info">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $nbrCours }}</span></h2>
                                <label class="card-label fw-bold text-dark">Total de cours que vous dispensez</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product alert alert-success">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-3.8%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $coursTermines }}</span></h2>
                                <label class="card-label fw-bold text-dark">Cours terminés</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-6 col-md-3 col-xl-6">
                        <div class="card card-one card-product alert alert-danger">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="card-icon"><i class="ri-archive-fill"></i></div>
                                    {{-- <h6 class="fw-normal ff-numerals text-danger mb-0">-8.4%</h6> --}}
                                </div>
                                <h2 class="card-value ls--1"><span>{{ $nbrCours - $coursTermines }}</span></h2>
                                <label class="card-label fw-bold text-dark ">Cours restant</label>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- col -->
        </div>
    @endif
@endsection

@push('scripts')
    {{-- <script src="{{ asset('lib/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/db.product.js') }}"></script> --}}
@endpush
