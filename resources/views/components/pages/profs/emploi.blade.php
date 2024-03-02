@extends('layouts.app-calendar')

@section('title', 'Emploi du temps du prof {{ $professeur->first_name }}')

@section('content')
    <div class="calendar-sidebar">
        <div id="calSidebar" class="sidebar-body">
            {{-- bread --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Emploi du temps</li>
                </ol>
            </nav>
            {{-- end bread --}}
            <div id="datepicker1" class="task-calendar mb-5"></div>
            <h5 class="section-title section-title-sm mb-4">Votre emploi du temps</h5>
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
    <script>
        'use strict';
        new PerfectScrollbar('#calSidebar', {
            suppressScrollX: true
        });
        var baseUrl = "{{ url('/') }}";
        var calendarEvents = [];
        var events = @json($emplois);
        var examens = @json($examens);
    </script>
    <script src="{{ asset('assets/js/emploi.js') }}"></script>
    <script>
        events.forEach(function(event) {
            var calendarEvent = {
                id: event.id,
                title: event.classe_cours.cours.name +
                    " "  +
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


        // Fonction pour initialiser le calendrier une fois que les données sont disponibles
        function initializeCalendar() {
            var calendarEl = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "timeGridWeek",
                locale: "fr",
                slotMinTime: "08:00:00",
                slotMaxTime: "18:00:00",
                headerToolbar: {
                    left: "custom1 prev,next today",
                    center: "title",
                    right: "timeGridDay,timeGridWeek,dayGridMonth",
                },
                events: calendarEvents,
                selectable: true,
                select: function(info) {
                    var startDate = moment(info.start).format("LL");
                    $("#modalCreateEvent").modal("show");
                },
                eventClick: function(info) {
                    $("#modalLabelEventView").text(info.event.title);
                    $("#eventTitle").text(info.event.title);
                    $("#eventStartDate").text(moment(info.event.start).format("LLLL"));
                    $("#eventEndDate").text(moment(info.event.end).format("LLLL"));
                    $("#eventDescription").text(info.event.extendedProps.description);
                    $("#modalEventView").modal("show");
                },
                customButtons: {
                    custom1: {
                        icon: "chevron-left",
                        click: function() {
                            $(".main-calendar").toggleClass("show");
                        },
                    },
                },
            });

            calendar.render();
        }

        // Fonction pour attribuer des couleurs aléatoires en fonction du crédit
        function randomColor(credit) {
            if (credit === 1) {
                return "#007bff"; // blue
            } else if (credit === 2) { //vert
                return "#28a745"; // green
            } else if (credit === 3) {
                return "#ffc107"; // yellow
            } else if (credit === 4) { //cyan
                return "#17a2b8"; // cyan
            } else { //viollet
                return "#6f42c1"; // purple
            }
        }
        // Fonction pour construire la description de l'événement
        function buildDescription(event, isExamen) {
            var description = "";
            if (isExamen) {
                description += "Examen: " + event.classe_cours.cours.name + "<br>" + "Salle: " + event.salle.name + "<br>";
                description +=
                    "Début: " + moment(event.start_date_time).format("LLLL") + "<br>";
                description +=
                    "Fin: " + moment(event.end_date_time).format("LLLL") + "<br>";
            } else {
                description += "Cours: " + event.classe_cours.cours.name + "<br>";
                description += "Salle: " + event.salle.name + "<br>";
                description +=
                    "Début: " + moment(event.start_date_time).format("LLLL") + "<br>";
                description +=
                    "Fin: " + moment(event.end_date_time).format("LLLL") + "<br>";
            }
            return description;
        }
    </script>
@endpush
