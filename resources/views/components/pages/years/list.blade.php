@extends('layouts.app')


@section('title', 'Liste des années')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Années</li>
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
                        <h4 class="card-title text-center">Liste des années</h4>
                        <p class="card-category">Liste des années enregistrées</p>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('years.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une année</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th scope="col">
                                        ID
                                    </th>
                                    <th scope="col">
                                        Année scolaire
                                    </th>
                                    <th>
                                        Date de début
                                    </th>
                                    <th>
                                        Statut

                                    </th>
                                    <th>
                                        Date de fin
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($anneeScolaires as $year)
                                        <tr>
                                            <td>
                                                {{ $year->id }}
                                            </td>
                                            <td>
                                                {{ $year->annee_scolaire }}
                                            </td>
                                            <td>
                                                {{ $year->debut }}
                                            </td>
                                            <td>
                                                {{ $year->fin }}
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-id="{{ $year->id }}" role="switch"
                                                        class="js-switch form-check-input"
                                                        {{ $year->status === 'en cours' ? 'checked' : '' }}
                                                        style="color: #26c6da;">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('years.edit', $year->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                <a href="{{ route('years.show', $year->id) }}" class="btn btn-info btn-sm">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <form action="{{ route('years.destroy', $year->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
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
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
           Swal.fire({
               title: 'Êtes-vous sûr de vouloir supprimer cette année scolaire?',
               text: "Cette action est irréversible!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#d33',
               cancelButtonColor: '#3085d6',
               confirmButtonText: 'Oui, supprimer!',
               cancelButtonText: 'Annuler'
           }).then((result) => {
               if (result.isConfirmed) {
                   document.getElementById(`delete-form-${id}`).submit();
               }
           })
        }

        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 'en cours' : 'terminée';
                let yearId = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'api/changeAnnee-state'+yearId,
                    data: {'status': status, 'year_id': yearId},
                    success: function(data){
                        console.log(data.message);
                    }
                });
            });
        });

    </script>

@endpush
