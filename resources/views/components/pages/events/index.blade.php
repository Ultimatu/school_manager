@extends('layouts.app-calendar')

@section('title', 'Calendrier des événements')



@section('content')
    <div class="calendar-sidebar">
        @include('components.shared.alert')
        <div id="calSidebar" class="sidebar-body">
            @if (auth()->user()->isCreator())
                <div class="d-grid mb-3">
                    <a href="{{ route('evenements.create') }}" class="btn btn-primary">Ajouter un programe</a>
                </div>
            @endif
            <div id="datepicker1" class="task-calendar mb-5"></div>

            <h5 class="section-title section-title-sm mb-4">Calendrier d'événements</h5>
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
                    <p><strong>Titre:</strong> <span id="eventTitle"></span></p>
                    <p><strong>Date de début:</strong> <span id="eventStartDate"></span></p>
                    <p><strong>Date de fin:</strong> <span id="eventEndDate"></span></p>
                    <p><strong>Description:</strong> <span id="eventDescription"></span>
                    </p>
                </div><!-- modal-body -->
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    @if (auth()->user()->isCreator())
                        <a href="" class="btn btn-outline-primary" id="btnEditEvent">
                            <i class="ri-edit-line"></i> Modifier </a>
                        <form action="" method="post" id="formDeleteEvent">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger" id="btnDeleteEvent"
                                onclick="deleteEvent(this)">Supprimer</button>
                    @endif
                </div><!-- modal-footer -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@push('scripts')
    <script>
        "use strict";
        new PerfectScrollbar("#calSidebar", {
            suppressScrollX: true,
        });

        var events = @json($events);
        console.log(events);
        // Initialiser un tableau pour stocker les événements au format attendu par FullCalendar
        var calendaREvents = [];

        events.forEach(function(event) {
            calendaREvents.push({
                title: event.titre,
                start: event.date_heure_debut,
                end: event.date_time_fin,
                description: event.description,
                id: event.id,
                backgroundColor: randomColor(event.type)
            });
        });


        $("#datepicker1").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
        });

        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            locale: "fr",
            headerToolbar: {
                left: "custom1 prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            eventSources: [calendaREvents],
            selectable: false,
            eventClick: function(info) {
                $("#modalEventView #eventTitle").text(info.event.title);
                $("#modalEventView #eventStartDate").text(info.event.start);
                $("#modalEventView #eventEndDate").text(info.event.end);
                $("#modalEventView #eventDescription").text(info.event.extendedProps.description);
                $("#modalLabelEventView").text(info.event.title);
                $("#btnDeleteEvent")?.attr("data-id", info.event.id);
                $("#btnEditEvent")?.attr("href", "/evenements/" + info.event.id + "/edit");
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

        function deleteEvent(event) {
            var id = $(event).attr("data-id");
            $("#formDeleteEvent").attr("action", "/evenements/" + id);
            $("#formDeleteEvent").submit();
        }

        function randomColor($type) {
            if ($type === "meeting") {
                return "#007bff"; // blue
            } else if ($type === "soutenance") { //vert
                return "#28a745"; // green
            } else if ($type === "conference") {
                return "#ffc107"; // yellow
            } else { //viollet
                return "#6f42c1"; // purple
            }
        }
    </script>
@endpush
