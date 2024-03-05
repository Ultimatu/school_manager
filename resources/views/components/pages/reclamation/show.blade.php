@extends('layouts.app')

@section('title', 'Détails de la réclamation')


@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reclamations.index') }}">Réclamations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
        </div>
    </div>
    {{-- end breadcrumb --}}

    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center">Détails de la réclamation</h4>
                        @if (auth()->user()->isEtudiant() &&
                                $reclamantion->status == 'pending' &&
                                auth()->user()->etudiant->id == $reclamantion->etudiant_id)
                            <div class="d-flex justify-content-center mt-1">
                                {{-- modifier --}}
                                @if ($reclamantion->is_exam)
                                    <a href="{{ route('reclamations.editEx', $reclamantion->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="ri-pencil-line"></i>
                                        Modifier
                                    </a>
                                @else
                                    <a href="{{ route('reclamations.editEv', $reclamantion->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="ri-pencil-line"></i>
                                        Modifier
                                    </a>
                                @endif
                                {{-- supprimer --}}
                                <form action="{{ route('reclamations.destroy', $reclamantion->id) }}" method="post"
                                    id="delete-form-{{ $reclamantion->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="ri-delete-bin-line"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @elseif (auth()->user()->isEtudiant() &&
                                $reclamantion->status == 'resolved' &&
                                auth()->user()->etudiant->id == $reclamantion->etudiant_id)
                            <form action="{{ route('reclamations.destroy', $reclamantion->id) }}" method="post"
                                id="delete-form-{{ $reclamantion->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i>
                                    Supprimer
                                </button>
                            </form>
                        @elseif (auth()->user()->isProfesseur() && $reclamantion->status == 'pending')
                            <div class="d-flex justify-content-center mt-1">
                                {{-- résoudre --}}
                                <a href="{{ route('reclamations.resolve', $reclamantion->id) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="ri-checkbox-circle-fill"></i>
                                    Répondre
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            <strong>Objet:</strong> {{ $reclamantion->objet }}
                        </p>
                        <p class="text-muted mb-0">
                            <strong>Message:</strong> {{ $reclamantion->message }}
                        </p>
                        <p class="text-muted mb-0">
                            <strong>Date:</strong> {{ $reclamantion->date }}
                        </p>
                        @if (auth()->user()->isProfesseur())
                            <p class="text-muted mb-0">
                                <strong>Etudiant:</strong> {{ $reclamantion->etudiant->first_name }}
                                {{ $reclamantion->etudiant->last_name }}
                            </p>
                        @endif
                        @if (auth()->user()->Etudiant())
                            <p class="text-muted mb-0">
                                @if ($reclamantion->is_exam)
                                    <strong>Professeur:</strong> {{ $reclamantion->examen->professeur->first_name }}
                                    {{ $reclamantion->examen->professeur->last_name }}
                                @else
                                    <strong>Professeur:</strong> {{ $reclamantion->evaluation->professeur->first_name }}
                                    {{ $reclamantion->evaluation->professeur->last_name }}
                                @endif
                            </p>
                        @endif
                        @if ($reclamantion->file)
                            <p class="text-muted mb-0">
                                <strong>Piéce jointe:</strong>
                                <a href="{{ asset($reclamantion->file) }}" target="_blank">Télécharger</a>
                            </p>
                        @endif
                        @if ($reclamantion->response)
                            <p class="text-muted mb-0">
                                <strong>Réponse:</strong> {{ $reclamantion->response->message }}
                                
                                @if ($reclamantion->response->piece_jointe)
                                    <p class="text-muted mb-0">
                                        <strong>Piéce jointe:</strong>
                                        <a href="{{ asset($reclamantion->file) }}" target="_blank">Télécharger</a>
                                    </p>
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
@endsection
