@extends('layouts.app')

@section('title', 'Liste des cours')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cours</li>
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
                        <h4 class="card-title mt-0">Liste de vos cours</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Classe
                                    </th>
                                    <th>
                                        Coéfficient
                                    </th>
                                    <th>
                                        Semestre
                                    </th>
                                    <th>
                                        Date de début
                                    </th>
                                    <th>
                                        Date de fin
                                    </th>
                                    <th>
                                        Heures nécéssaires
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($classeCours as $classeCours)
                                        <tr>
                                            <td>
                                                {{ $classeCours->cours->id }}
                                            </td>
                                            <td>
                                                {{ $classeCours->cours->name }}
                                            </td>
                                            <td>
                                                {{ $classeCours->cours->description }}
                                            </td>
                                            <td>
                                                {{ $classeCours->classe->name }} - {{ $classeCours->classe->filiere->name }}
                                            </td>
                                            <td>
                                                {{ $classeCours->credit }}
                                            </td>
                                            <td>
                                                {{ $classeCours->semester }}
                                            </td>
                                            <td>
                                                {{ $classeCours->start_date }}
                                            </td>
                                            <td>
                                                {{ $classeCours->end_date }}
                                            </td>
                                            <td>
                                                <span class="bade bg-success fs-4 text-white">{{ $classeCours->total_hours }}Heures</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('classe.addNote', $classeCours->id) }}"
                                                    class="btn btn-warning mb-3">
                                                    <i class="ri-add-line"></i>
                                                    Ajouter une note</a>
                                                <a href="{{ route('classe.show', $classeCours->classe_id) }}"
                                                        class="btn btn-warning mb-3">
                                                        <i class="ri-eye-line"></i>
                                                        Voir la classe</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Vous n'avez été programmé à aucun cours</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush
