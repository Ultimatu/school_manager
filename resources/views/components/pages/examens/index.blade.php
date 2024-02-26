@extends('layouts.app')

@section('title', 'Tableau de bord')



@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Examens</li>
                </ol>
            </nav>
        </div>
    </div>

@endsection

@push('scripts')
@endpush
