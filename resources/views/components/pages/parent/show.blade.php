@extends('layouts.app')


@section('title', 'Details du parent')

@section('content')

    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('parents.index') }}">Parents</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $parents->first_name}} {{ $parents->last_name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end bread --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">Details du parent</h4>
                        <p class="card-category">Details du parent</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-profile">
                                    <div class="card-body">
                                        <h6 class="card-category text-gray">{{ $parents->type }}</h6>
                                        <h4 class="card-title text-center">{{ $parents->first_name}} {{ $parents->last_name }}</h4>
                                        <p class="card-description">
                                            <strong>Nombre d'enfants:</strong> {{ $parents->etudiants()->count() }}<br>
                                            <strong>Email:</strong> {{ $parents->email }}<br>
                                            <strong>Téléphone:</strong> {{ $parents->phone }}<br>
                                            <strong>Adresse:</strong> {{ $parents->address }}<br>
                                            <strong>Profession:</strong> {{ $parents->profession }}<br>

                                            @if($parents->etudiants()->count() > 1)
                                                <strong>Enfants:</strong>
                                                <ul>
                                                    @foreach($parents->etudiants() as $child)
                                                        <li> <a href="{{ route('etudiant.show', $child->id) }}" class="text-primary" style="text-decoration: none;" target="_blank">
                                                            {{ $child->student_mat }} &nbsp; - {{ $child->first_name }} &nbsp; {{ $child->last_name }}  </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <strong>Enfant:</strong>
                                                <a href="{{ route('etudiant.show', $parents->etudiants()->first()->id) }}" class="text-primary" style="text-decoration: none;" target="_blank">
                                                    {{ $parents->etudiants()->first()->student_mat }} &nbsp; - {{ $parents->etudiants()->first()->first_name }} &nbsp; {{ $parents->etudiants()->first()->last_name }}
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('parents.edit', $parents->id) }}" class="btn btn-primary float-right">
                                                    <i class="ri-pencil-line"></i>
                                                    Modifier le parent
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="{{ route('parents.destroy', $parents->id) }}" method="post" class="float-left" id="deleteForm">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                                        <i class="ri-delete-bin-line"></i>
                                                        Supprimer le parent
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimez-le!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            })
        }
    </script>
@endpush


