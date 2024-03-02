@extends('layouts.app')


@section('title', 'Details de l\'inscription')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('citeInscriptions.index') }}">Inscriptions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Détails de l'inscription</h4>
                        <p class="card-category">Détails de l'inscription aux services de transport</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('citeInscriptions.edit', $citeInscription->id) }}" class="btn btn-primary float-right">
                                    <i class="ri-pencil-line"></i>
                                    Modifier l'inscription</a>
                            </div>
                            @if (!$citeInscription->is_paid)
                                <div class="col-md-6 mb-3">
                                    {{-- add versement --}}
                                    <a href="{{ route('citeInscriptions.addVersement', ['inscription'=>$citeInscription->id]) }}" class="btn btn-outline-warning float-left">
                                        <i class="ri-add-line"></i>
                                        Ajouter un versement</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td>ID</td>
                                                <td>{{ $citeInscription->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Etudiant</td>
                                                <td>{{ $citeInscription->etudiant->first_name }} {{ $citeInscription->etudiant->last_name }}</td>
                                                <td>
                                                    <a href="{{ route('etudiant.show', $citeInscription->etudiant->id) }}" class="btn btn-outline-info">
                                                        <i class="ri-eye-line"></i>
                                                        Voir l'étudiant</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Chambre & Cité</td>
                                                <td>{{ $citeInscription->chambre->name }} {{ $citeInscription->chambre->cite->name }}</td>
                                                <td>
                                                    <a href="{{ route('chambres.show', $citeInscription->chambre->id) }}" class="btn btn-outline-info">
                                                        <i class="ri-eye-line"></i>
                                                        Voir la chambre</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Statut</td>
                                                <td>
                                                    @if ($citeInscription->is_paid)
                                                        <span class="badge bg-success">Payé</span>
                                                    @else
                                                        <span class="badge bg-danger">Non payé</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Versements</td>
                                                <td>{{ $citeInscription->versements->sum('versement') }} </td>
                                            </tr>
                                            <tr>
                                                <td>Montant total</td>
                                                <td>{{ $citeInscription->total_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date de création</td>
                                                <td>{{ $citeInscription->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('citeInscriptions.index') }}" class="btn btn-outline-secondary">
                            <i class="ri-arrow-left-line"></i>
                            Retour à la liste des inscriptions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // console.log('hello');
    </script>
@endsection