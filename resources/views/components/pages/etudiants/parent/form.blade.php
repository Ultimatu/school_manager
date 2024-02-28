@extends('layouts.app')

@section('content')
    {{-- bread --}}
    <x-shared.breadcrumb :items="[
        ['url' => route('etudiant.index'), 'label' => 'Liste des étudiants'],
        ['url' => route('etudiant.show', $etudiant), 'label' => $etudiant->first_name. ' '.$etudiant->last_name],
        ['url' => route('parents.index' ), 'label' => 'Parents'],
        ['label' => 'Ajouter un parent'],
    ]" />

@endsection
