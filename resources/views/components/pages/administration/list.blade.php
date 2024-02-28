@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administration</li>
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
                        <h4 class="card-title mt-0"> Administration </h4>
                        <p class="card-category"> Liste des administrateurs </p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('administration.create') }}"
                                    class="btn btn-success float-right">Ajouter</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Prénom
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Téléphone
                                    </th>
                                    <th>
                                        Adresse
                                    </th>
                                    <th>
                                        Role
                                    </th>
                                    <th>
                                        Responsabilité
                                    </th>
                                    <th>
                                        Statut
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($administrations as $administration)
                                        <tr>
                                            <td>
                                                {{ $administration->id }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($administration->avatar??'administrations/avatar.png') }}"
                                                    alt="{{ $administration->first_name }}" class="img-fluid"
                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                            </td>
                                            <td>
                                                {{ $administration->first_name }}
                                            </td>
                                            <td>
                                                {{ $administration->last_name }}
                                            </td>
                                            <td>
                                                {{ $administration->email }}
                                            </td>
                                            <td>
                                                {{ $administration->phone }}
                                            </td>
                                            <td>
                                                {{ $administration->address }}
                                            </td>
                                            <td>
                                                {{ $administration->role }}
                                            </td>
                                            <td>
                                                {{ $administration->responsability }}
                                            </td>
                                            <td>
                                                {{-- display checkbox here to active or desactive  --}}
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-id="{{ $administration->id }}"
                                                        role="switch" class="js-switch form-check-input"
                                                        {{ $administration->status == 1 ? 'checked' : '' }}
                                                        @if (auth()->user()->id !== $administration->user_id) onclick="toggleStatus({{ $administration->id }})" @else readonly disabled @endif
                                                        style="color: #26c6da;">
                                                </div>
                                            </td>
                                            @if (auth()->user()->id !== $administration->user_id)
                                                <td>
                                                    <a href="{{ route('administration.show', $administration->id) }}"
                                                        class="btn btn-info texte-white">
                                                        <i class="ri-eye-fill fs-2"></i>
                                                    </a>
                                                    <a href="{{ route('administration.edit', $administration->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="ri-pencil-fill fs-2"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('administration.destroy', $administration->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="ri-delete-bin-6-fill fs-2"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>
                                                    <a href="{{ route('administration.show', $administration->id) }}"
                                                        class="btn btn-info texte-white">
                                                        <i class="ri-eye-fill fs-2"></i>
                                                    </a>
                                                    <a href="{{ route('administration.edit', $administration->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="ri-pencil-fill fs-2"></i>
                                                    </a>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleStatus(id) {
            //put request to api/change-state/id
            $.ajax({
                type: "PUT",
                url: `api/changeAdmin-state/${id}`,
                success: function(response) {
                    console.log(response);
                    //refresh the page
                    //location.reload();
                }
            });
        }
    </script>
@endpush
