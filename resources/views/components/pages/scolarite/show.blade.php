@extends('layouts.app')


@section('title', 'Scolarité')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('scolarite.index') }}">Scolarité</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Scolarité</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- content --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">Details de la scolarité</h4>
                    </div>
                    <div class="card-body">

                        <p>
                            <strong>Montant:</strong> {{ $scolarite->amount }}
                        </p>
                        <p>
                            <strong>Etudiant:</strong> <a href="{{ route('etudiant.show', $scolarite->etudiant->id) }}" class="text-primary" title="Voir les détails de l'étudiant">
                                {{ $scolarite->etudiant->student_mat }} -
                                {{ $scolarite->etudiant->first_name }} - {{ $scolarite->etudiant->last_name }} - {{ $scolarite->etudiant->classe->name }}
                            </a>
                        </p>
                        <p>
                            <strong>Statut:</strong> {{ $scolarite->is_paid ? 'Payée' : 'Non payée' }}
                        </p>
                         <hr>
                         <h1>Details des versements</h1>
                         <div class="datatable bg-info">
                            <table class="table table-hover table-responsive" id="myTable">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Montant
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($scolarite->details as $versement)
                                        <tr>
                                            <td>{{ $versement->id }}</td>
                                            <td>{{ $versement->amount }}</td>
                                            <td>{{ $versement->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('versement.show', $versement->id) }}" class="btn btn-primary btn-sm" title="Voir les détails du versement">
                                                    <i class="ri-eye-line"></i>
                                                </a>
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

@section('scripts')
    <script>
        $(document).ready(() => {
            $('#myTable').DataTable();
        });
    </script>
@endsection
