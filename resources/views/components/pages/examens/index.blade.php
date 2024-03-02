@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Examens</li>
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
                        <h4 class="card-title">Liste des examens</h4>
                        @if (auth()->user()->isCreator())
                            <p class="card-category">Liste des examens enregistrés</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('examens.create') }}" class="btn btn-primary float-right">
                                        <i class="ri-add-line"></i>
                                        Ajouter un examen</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Classe
                                    </th>
                                    <th>
                                        Cours
                                    </th>
                                    <th>
                                        Salle
                                    </th>
                                    <th>
                                        Jour de la semaine
                                    </th>
                                    <th>
                                        Date & Heure de début
                                    </th>
                                    <th>
                                        Date & Heure de fin
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($examens as $examen)
                                        <tr>
                                            <td>
                                                {{ $examen->id }}
                                            </td>
                                            <td>
                                                {{ $examen->classe->name }}
                                            </td>
                                            <td>
                                                {{ $examen->classeCours->cours->name }}
                                            </td>
                                            <td>
                                                {{ $examen->salle->name }}
                                            </td>
                                            <td>
                                                {{ $examen->day }}
                                            </td>
                                            <td>
                                                {{ $examen->start_date_time }}
                                            </td>
                                            <td>
                                                {{ $examen->end_date_time }}
                                            </td>
                                            @if (auth()->user()->isCreator())
                                                <td class="td-actions text-righ d-flex justify-content-end">
                                                    <a href="{{ route('examens.show', $examen->id) }}" class="btn btn-info">
                                                        <i class="ri-eye-line"></i> </a>
                                                    <a href="{{ route('examens.edit', $examen->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <form action="{{ route('examens.destroy', $examen->id) }}"
                                                        method="post" style="display: inline-block"
                                                        id="delete-form-{{ $examen->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $examen->id }})">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @elseif (auth()->user()->isProfesseur())
                                                <td>
                                                    <a href="{{ route('examens.show', $examen->id) }}"
                                                        class="btn btn-info">
                                                        <i class="ri-eye-line"></i> </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @if ($examens->count() === 0)
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                Aucun examen enregistré
                                            </td>
                                        </tr>
                                    @endif
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
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush
