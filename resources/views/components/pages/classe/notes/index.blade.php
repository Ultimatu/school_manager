@extends('layouts.app')

@section('title', 'Liste de vos notes')

@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vos notes</li>
                </ol>
            </nav>
        </div>
    </div>


    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('components.shared.alert')
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title , card-title-2">Liste de vos notes</h4>
                        <p class="card-category">Liste de vos notes enregistrées</p>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('notes.create') }}" class="btn btn-primary float-right">
                                    <i class="ri-add-line"></i>
                                    Ajouter une note
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-responsive table-striped dataTable">
                                <thead class="">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Cours
                                    </th>
                                    <th>
                                        Evaluation
                                    </th>
                                    <th>
                                        Note
                                    </th>
                                    <th>
                                        Observation
                                    </th>
                                    <th>
                                        Cofficient
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Durée
                                    </th>
                                    <th class="text-center">
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($notes as $note)
                                        <tr>
                                            <td>
                                                {{ $note->id }}
                                            </td>
                                            <td>
                                                {{ $note->evaluation->classeCours->cours->name }}
                                            </td>
                                            <td>
                                                {{ $note->evaluation->sujet }}
                                            </td>
                                            <td>
                                                {{ $note->note }}/ {{ $note->evaluation->max_note }}
                                            </td>
                                            <td>
                                                {{ $note->observation }}
                                            </td>
                                            <td>
                                                {{ $note->evaluation->coefficient }}
                                            </td>
                                            <td>
                                                {{ $note->evaluation->date }}
                                            </td>
                                            <td>
                                                {{ $note->evaluation->duree }}
                                            </td>
                                            <td class="td-actions">
                                                {{-- faire une réclammation --}}
                                                <a href="{{ route('reclamations.create', ['note' => $note->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="ri-chat-3-line"></i>
                                                    Réclamer
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                Aucune note enregistrée
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

                                                
                                               