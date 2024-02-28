@extends('layouts.app')

@section('title', 'Liste des scolarités')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Scolarités</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Liste des scolarités</h4>
                        <p class="card-category">Liste des scolarités enregistrées</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Montant
                                    </th>
                                    <th>
                                       Etudiant
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($scolarites as $scolarite)
                                        <tr>
                                            <td>{{ $scolarite->id }}</td>
                                            <td>{{ $scolarite->amount }}</td>
                                            <td>
                                                <a href="{{ route('etudiant.show', $scolarite->etudiant->id) }}" class="text-primary" title="Voir les détails de l'étudiant">
                                                    {{ $scolarite->etudiant->student_mat }} -
                                                {{ $scolarite->etudiant->first_name }} - {{ $scolarite->etudiant->last_name }} - {{ $scolarite->etudiant->classe->name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($scolarite->is_paid)
                                                    <span class="badge bg-success">{{ __('Payé') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Non payé') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('scolarite.show', $scolarite->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('scolarite.edit', $scolarite->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="ri-pencil-line"></i>
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
    </div>
@endsection




