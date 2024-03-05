@extends('layouts.app')

@section('title', "Ajouts des notes")

@section('content')
{{-- bread --}}
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouts des notes</li>
            </ol>
        </nav>
    </div>
</div>
{{-- end bread --}}

{{-- content --}}
{{-- afficher la liste des etudiants, avec devant le nom une case de saisi de note et observation et un bouton sauvegarder --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Ajouts des notes
            </div>
            <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Note Observation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($etudiants as $etudiant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $etudiant->student_mat }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>
                                   <form action="{{ route('notes.store') }}" method="post">
                                        @csrf
                                        <input type="number" name="note" class="form-control" value="{{ old('note', $evaluation->note) }}" required min="0" max="20">
                                        <input type="hidden" name="etudiant_id" value="{{ $student->id }}">
                                        <input type="text" name="observation" class="form-control" value="{{ old('observation', $evaluation->observation) }}">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
{{-- end content --}}
@endsection