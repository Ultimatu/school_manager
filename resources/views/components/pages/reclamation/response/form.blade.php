@extends('layouts.app')


@section('title', $reclamationResponse->id ? 'Modifier une réponse' : 'Ajouter une réponse')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reclamations.index') }}">Réclamations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $reclamationResponse->id ? 'Modifier' : 'Ajouter' }}</li>
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
                        <h4 class="card-title text-center">{{ $reclamationResponse->id ? 'Modifier' : 'Ajouter' }} une
                            réponse</h4>
                    </div>
                    {{-- 'reclamantion_id','message','date','piece_jointe', --}}
                    <div class="card-body">
                        <form action="{{ route('reclamations.response.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($reclamationResponse->id)
                                @method('put')
                            @endif
                            <input type="hidden" name="reclamantion_id" value="{{ $reclamationResponse->reclamantion_id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="message" class="bmd-label-floating">Message</label>
                                        <textarea name="message" id="message"
                                            class="form-control @error('message') is-invalid @enderror"
                                            value="{{ old('message', $reclamationResponse->message) }}"></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="date" class="bmd-label-floating">Date</label>
                                        <input type="date" name="date" id="date"
                                            class="form-control @error('date') is-invalid @enderror"
                                            value="{{ old('date', $reclamationResponse->date) }}" min="{{ now() }}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group bmd-form-group">
                                        <label for="piece_jointe" class="bmd-label-floating">Pièce jointe</label>
                                        <input type="file" name="piece_jointe" id="piece_jointe"
                                            class="form-control @error('piece_jointe') is-invalid @enderror"
                                            value="{{ old('piece_jointe', $reclamationResponse->piece_jointe) }}">
                                        @error('piece_jointe')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $reclamationResponse->id ? 'Modifier' : 'Ajouter' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        {{-- end content --}}
@endsection



