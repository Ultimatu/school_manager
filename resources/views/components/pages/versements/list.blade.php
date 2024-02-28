@extends('layouts.app')


@section('title', 'Liste des versements')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Versements</li>
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
                        <h4 class="card-title mt-0">Liste des versements</h4>
                        <p class="card-category">Liste des versements enregistrés</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('versement.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter un versement</a>
                            </div>
                        </div>
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
                                        Date de versement
                                    </th>
                                    <th>
                                        Etudiant
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($versements as $versement)
                                        <tr>
                                            <td>
                                                {{ $versement->id }}
                                            </td>
                                            <td>
                                                {{ $versement->amount }} FCFA
                                            </td>
                                            <td>
                                                {{ $versement->created_at->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                {{ $versement->etudiant()->first_name }} {{ $versement->etudiant()->last_name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('versement.edit', $versement->id) }}" class="btn btn-warning">
                                                    <i class="ri-pencil-line"></i>
                                                    Modifier
                                                </a>
                                                <form action="{{ route('versement.destroy', $versement->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="ri-delete-bin-line"></i>
                                                        Supprimer
                                                    </button>
                                                </form>
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


