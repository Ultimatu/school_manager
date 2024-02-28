@extends('layouts.app')

@section('content')
{{-- bread --}}
<x-shared.breadcrumb :items="[
        ["url"=>route('etudiant.index'), "label"=>"Liste des étudiants"],
        ['label'=>"Detail étudiant"]
    ]"
/>

@endsection
