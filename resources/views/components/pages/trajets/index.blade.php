@extends('layouts.app')


@section('title', 'Liste des trajets')

@section('content')
  {{-- bread --}}
  <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Trajets</li>
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
                        <h4 class="card-title mt-0">Liste des trajets</h4>
                        <p class="card-category">Liste des trajets enregistrés</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('trajets.create') }}" class="btn btn-outline-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter un trajet</a>
                            </div>
                        </div>
                    </div>
                    {{--  'name',
                    'waypoints',
                    'city_departure_time',
                    'school_departure_time', --}}
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
                                        Points de passage
                                    </th>
                                    <th>
                                        Heure de départ de la ville
                                    </th>
                                    <th>
                                        Heure de départ de l'école
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($trajets as $trajet)
                                        <tr>
                                            <td>
                                                {{ $trajet->id }}
                                            </td>
                                            <td>
                                                {{ $trajet->name }}
                                            </td>
                                            <td class="bg-info text-muted">
                                                {{ implode(', ', $trajet->waypoints) }}
                                            <td>
                                                {{ $trajet->city_departure_time }}
                                            </td>
                                            <td>
                                                {{ $trajet->school_departure_time }}
                                            </td>
                                            <td class="td-actions d-flex justify-content-between gap-3">
                                                <a href="{{ route('trajets.show', $trajet->id) }}" class="btn btn-info">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('trajets.edit', $trajet->id) }}" class="btn btn-primary">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <form action="{{ route('trajets.destroy', $trajet->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $trajet->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="deleteItem({{ $trajet->id }})">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                Aucun trajet enregistré
                                            </td>
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

<script>
    function deleteItem(id){
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="ri-check-line"></i> Oui, supprimer!',
            cancelButtonText: ' <i class="ri-close-line"></i> Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm-'+id).submit();
            }
        })
    }
</script>

@endpush


