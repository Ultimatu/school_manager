@extends('layouts.app')



@section('title', 'Details du trajet')


@section('content')
  {{-- bread --}}
  <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('trajets.index') }}">Trajets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details du trajet</li>
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
                        <h4 class="card-title mt-0">Details du trajet</h4>
                        <p class="card-category">Details du trajet</p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('trajets.edit', $trajet) }}" class="btn btn-outline-primary float-right">
                                    <i class="ri-edit-line"></i>
                                    Modifier le trajet</a>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('trajets.destroy', $trajet) }}" id="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger float-left" onclick="confirmDelete()">
                                        <i class="ri-delete-bin-line"></i>
                                        Supprimer le trajet</button>
                                </form>
                    </div>
                    <div class="card-body">
                        <p> <strong>Nom</strong>: {{ $trajet->name }}</p>
                        <p> <strong>Heure de départ de la ville</strong>: {{ $trajet->city_departure_time }}</p>
                        <p> <strong>Heure de départ de l'école</strong>: {{ $trajet->school_departure_time }}</p>
                        <hr class="divider">
                        Les points de passage:
                        <ul class="list-group">
                            @foreach ($trajet->waypoints as $waypoint)
                                <li>{{ $waypoint }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function confirmDelete() {
           Swal.fire({
               title: 'Êtes-vous sûr?',
               text: "Vous ne pourrez pas revenir en arrière!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Oui, supprimez-le!',
               cancelButtonText: 'Annuler'
           }).then((result) => {
               if (result.isConfirmed) {
                   document.getElementById('delete-form').submit();
               }
           })
        }
    </script>

@endpush


