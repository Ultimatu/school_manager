@extends('layouts.app-calendar')

@section('title', 'Emploi du temps de la classe {{ $classe->name }}')

@section('content')
    <div class="calendar-sidebar">
        <div id="calSidebar" class="sidebar-body">
           @if (auth()->user()->isAdmin())
                <div class="d-grid mb-3">
                    <a id="btnCreateEvent" href="" class="btn btn-primary">Ajouter un programe</a>
                </div>
           @endif
            {{-- bread --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('classe.index') }}">Classes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $classe->name }}</li>
                </ol>
            </nav>
            {{-- end bread --}}
            <div id="datepicker1" class="task-calendar mb-5"></div>
            <h5 class="section-title section-title-sm mb-4">Emploi du temps de la classe {{ $classe->name }}
                {{ $classe->level }}</h5>
            <nav class="nav nav-calendar mb-4">
                <a href="" class="nav-link calendar"><span></span> Cours avec crédit 1</a>
                <a href="" class="nav-link birthday"><span></span> Cours avec crédit 2</a>
                <a href="" class="nav-link meetup"><span></span> Cours avec crédit 4</a>
                <a href="" class="nav-link discover"><span></span> Cours avec crédit 3</a>
                <a href="" class="nav-link other"><span></span> Cours avec crédit 5 ou plus</a>
                <a href="" class="nav-link holiday"><span></span> Examens</a>
            </nav>
        </div><!-- sidebar-body -->
    </div><!-- calendar-sidebar -->
    <div id="calendar" class="calendar-body"></div>
    <div class="modal modal-event fade" id="modalCreateEvent" tabindex="-1" aria-labelledby="modalLabelCreateEvent"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelCreateEvent">Ajouter un programme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    <div id="globalError">

                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="salle_id">Salle:</label>
                        <select class="form-select" name="salle_id" id="salle_id">
                            <option value="">Choisissez la salle</option>
                            @foreach ($salles as $salle)
                                <option value="{{ $salle->id }}">{{ $salle->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="mb-3 col-6">
                            <label class="form-label" for="classe_cours_id">Cours:</label>
                            <select class="form-select" name="classe_cours_id" id="classe_cours_id">
                                <option value="">Choisissez le cours</option>
                                @foreach ($classeCours as $course)
                                    <option value="{{ $course->id }}">{{ $course->cours->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            {{-- select for type --}}
                            <label class="form-label mb-2" for="type">Type:</label>
                            <select class="form-select" name="type" id="type">
                                <option value="cours">Cours</option>
                                <option value="examen">Examen</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">La Date:</label>
                            <input type="date" class="form-control" id="datepicker2" name="refDate"
                                placeholder="Choisissez la date" min="{{ now() }}">
                            <strong class="text-danger" id="dateError"></strong>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="mb-3 col-6">
                            <label class="form-label">Heure de début:</label>
                            <select name="start_time" id="start_time" class="form-select">
                                <option value="">Choisissez l'heure de début</option>
                                @for ($i = 8; $i <= 18; $i++)
                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                @endfor
                            </select>
                            <strong class="text-danger" id="errorStDate"></strong>
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Heure de fin:</label>
                            <select name="end_time" id="end_time" class="form-select">
                                <option value="">Choisissez l'heure de fin</option>
                                @for ($i = 8; $i <= 18; $i++)
                                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                                @endfor
                            </select>

                            <strong class="text-danger" id="errorEnDate"></strong>
                        </div>
                    </div><!-- row -->
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSaveEvent">Save</button>
                </div><!-- modal-footer -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div class="modal modal-event fade" id="modalEventView" tabindex="-1" aria-labelledby="modalLabelEventView"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelEventView">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    {{-- title --}}
                    <hr class="opacity-0">
                    <label class="mb-2"><i class="ri-information-line"></i>Titre:</label>
                    <p id="eventTitle"></p>

                    {{-- date --}}
                    <div class="date-item">
                        <i class="ri-calendar-line"></i>
                        <div>Début: <span id="eventStartDate"></span></div>
                    </div><!-- date-item -->
                    <div class="date-item">
                        <i class="ri-time-line"></i>
                        <div>Fin: <span id="eventEndDate"></span></div>
                    </div><!-- date-item -->

                    <hr class="opacity-0">
                    <label class="mb-2"><i class="ri-information-line"></i>Description:</label>
                    <p id="eventDescription">
                    </p>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    {{-- deleteButton --}}
                    @if (Auth::user()->isAdmin())
                        <button type="button" class="btn btn-danger" id="btnDeleteEvent">Supprimer</button>
                    @endif
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                </div><!-- modal-footer -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/emploi.js') }}"></script>

    <script>
        'use strict';
        new PerfectScrollbar('#calSidebar', {
            suppressScrollX: true
        });
        var classeId = {{ $classe->id }};
        var baseUrl = "{{ url('/') }}";
        var calendarEvents = [];
        var events = @json($emplois);
        var examens = @json($examens);
        events.forEach(function(event) {
            var calendarEvent = {
                id: event.id,
                title: event.classe_cours.cours.name +
                    " - Prof: " +
                    event.professeur.first_name +
                    " " +
                    event.professeur.last_name +
                    " - Salle: " +
                    event.salle.name,
                description: buildDescription(event, false),
                start: event.start_date_time,
                end: event.end_date_time,
                backgroundColor: randomColor(event.classe_cours.credit),
                borderColor: randomColor(event.classe_cours.credit),
                textColor: "white",
            };
            calendarEvents.push(calendarEvent);
        });

        examens.forEach(function(examen) {
            var calendarEvent = {
                id: examen.id,
                title: "Examen: " + examen.classe_cours.cours.name + " - Salle: " + examen.salle.name,
                description: buildDescription(examen, true),
                start: examen.start_date_time,
                end: examen.end_date_time,
                backgroundColor: "#dc3545",
                borderColor: "#dc3545",
                textColor: "white",
            };
            calendarEvents.push(calendarEvent);
        });
        initializeCalendar();
    </script>
    <script>
        $('#btnCreateEvent').on('click', function(e) {
            e.preventDefault();

            var startDate = moment().format('LL');
            $('#startDate').val(startDate);

            var endDate = moment().add(1, 'days');
            $('#endDate').val(endDate.format('LL'));

            $('#modalCreateEvent').modal('show');
        });
    </script>
@endpush
