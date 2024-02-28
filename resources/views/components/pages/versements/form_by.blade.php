@extends('layouts.app')


@section('title', 'Ajouter un versement')

@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('versement.index') }}">Versements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un versement</li>
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
                        <h4 class="card-title mt-0">Ajouter un versement</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('versement.store') }}">
                            @csrf
                            <input type="hidden" name="payment_scolarite_id" value="{{ $scolarite->id }}">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="amount" class="bmd-label-floating">Montant</label>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            value="{{ old('amount') }}">
                                        @error('amount')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label for="date" class="bmd-label-floating">Date de versement</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ old('date') }}">
                                        @error('date')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    {{-- mode_payement --}}
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating" for="mode_payement">Mode de versement</label>
                                        <select class="form-control"  name="mode_payement" id="mode_payement">
                                            <option value="espece" {{ old('mode_payement') == 'espece' ? 'selected' : '' }}>
                                                Espece</option>

                                            <option value="cheque"  {{ old('mode_payement') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                                            <option value="virement"  {{ old('mode_payement') == 'virement' ? 'selected' : '' }}>Virement</option>
                                        </select>
                                        @error('mode_payement')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#mode_payement').select2();
    </script>

@endpush
