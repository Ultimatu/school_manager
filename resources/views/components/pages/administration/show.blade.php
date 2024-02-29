@extends('layouts.app')

@section('title', 'Details de l\'administration')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('administration.index') }}">Administration</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $administration->first_name }}
                        {{ $administration->last_name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        @include('components.shared.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0"> Details de l'administration </h4>
                        <p class="card-category"> {{ $administration->first_name }} {{ $administration->last_name }} </p>
                        {{-- img --}}
                        @if (auth()->user()->isAdmin())
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('administration.edit', $administration->id) }}"
                                        class="btn btn-success float-right">Modifier</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-profile">
                                    <div class="card-avatar">
                                        <a href="javascript:;">
                                            <img class="img"
                                                src="{{ asset($administration->avatar ?? 'users/avatar.png') }}" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-category text-gray">{{ $administration->role }}</h6>
                                        <h4 class="card-title text-primary">{{ $administration->first_name }}
                                            {{ $administration->last_name }}</h4>
                                        <p class="card-description">
                                            <strong>Email:</strong> {{ $administration->email }} <br>
                                            <strong>Téléphone:</strong> {{ $administration->phone }} <br>
                                            <strong>Adresse:</strong> {{ $administration->address }} <br>
                                            <strong>Responsabilité:</strong> {{ $administration->responsabilite }} <br>
                                        </p>
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
