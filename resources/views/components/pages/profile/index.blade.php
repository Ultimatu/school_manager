@extends('layouts.app')


@section('title', 'Profile')


@section('content')
    {{-- bread --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- end bread --}}

    <h2 class="main-title">Profile</h2>

    <nav class="nav nav-tabs nav-line nav-tabs--vertical">
        <a href="" class="nav-link active" id="general"><i class="ri-information-line"></i> General</a>
        <a href="" class="nav-link" id="EditProfile"><i class="ri-edit-line"></i>Modifier les informations</a>
        <a href="" class="nav-link" id="security"><i class="ri-lock-line"></i> Security</a>
    </nav>

    <div class="tab-content">
        <div class="tab-pane active" id="general">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title mt-0">General</h4>
                            <p class="card-category">Informations générales</p>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
