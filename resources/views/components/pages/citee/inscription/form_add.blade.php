@extends('layouts.app')

@section('title', $inscription->id ? 'Modifier une inscription' : 'Ajouter une inscription')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('citeInscriptions.index') }}">Inscriptions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <div class="row">
            {{-- Tableau des statistiques --}}
            <div class="col-md-12 mb-4">
                <div class="card">
                    @include('components.shared.alert')
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Statistiques</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    {{-- etudiant  --}}
                                    <td><strong>Etudiant</strong></td>
                                    <td><strong class="fs-3">{{ $inscription->etudiant->student_mat }} {{ $inscription->etudiant->first_name. ' '. $inscription->etudiant->last_name }}</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Montant total de l'inscription</strong></td>
                                    <td><span class="badge bg-secondary fs-2"><i class="ri-money-dollar-circle-line"></i>  {{ $inscription->total_amount }} FCFA</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Montant déjà versé</strong></td>
                                    <td><span class="badge bg-secondary fs-2"><i class="ri-money-dollar-circle-line"></i> {{ $versements }} FCFA</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Montant restant</strong></td>
                                    <td><span class="badge bg-secondary fs-2"><i class="ri-money-dollar-circle-line"></i> {{ $inscription->total_amount - $versements }} FCFA</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Formulaire pour saisir un nouveau versement --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h4 class="card-title">{{__('Ajouter une facture') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('citeInscriptions.storeVersement', ['inscription'=>$inscription->id]) }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group mb-1">
                                        <label for="versement">Nouveau versement</label>
                                        <input type="number" name="versement" id="versement" value="{{ old('versement', '') }}" class="form-control" max="{{ $inscription->total_amount - $versements }}" min="1000">
                                        @error('versement')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    {{-- date_versement --}}
                                    <div class="form-group mb-1">
                                        <label for="date_versement">Date du versement</label>
                                        <input type="date" name="date_versement" id="date_versement" value="{{ old('date_versement', date('Y-m-d')) }}" class="form-control">
                                        @error('date_versement')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{  __('Ajouter le versement')  }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Vos scripts ici
    </script>
@endpush
