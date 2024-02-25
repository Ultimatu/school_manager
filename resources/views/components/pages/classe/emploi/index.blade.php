@extends('layouts.app-calendar')

@section('title', 'Emploi du temps de la classe {{ $classe->name }}')

@section('content')
    <div class="calendar-sidebar">
        <div id="calSidebar" class="sidebar-body">
            <div class="d-grid mb-3">
                <a id="btnCreateEvent" href="" class="btn btn-primary">Ajouter un programe</a>
            </div>
            <div id="datepicker1" class="task-calendar mb-5"></div>
            <h5 class="section-title section-title-sm mb-4">Calendrier Scolaire</h5>
            <nav class="nav nav-calendar mb-4">
                <a href="" class="nav-link calendar"><span></span> Conférence</a>
                <a href="" class="nav-link birthday"><span></span> Cours</a>
                <a href="" class="nav-link holiday"><span></span> TP</a>
                <a href="" class="nav-link discover"><span></span> TD </a>
                <a href="" class="nav-link meetup"><span></span> Examens</a>
                <a href="" class="nav-link other"><span></span> Autres événements</a>
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
                    <div class="mb-3">
                        <label class="form-label">Salle:</label>
                        <select class="form-select" name="salle_id" id="salle_id">
                            <option value="">Choisissez la salle</option>
                            @foreach ($salles as $salle)
                                <option value="{{ $salle->id }}">{{ $salle->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cours:</label>
                        <select class="form-select"name="classe_cours_id" id="classe_cours_id">
                            <option value="">Choisissez le cours</option>
                            @foreach ($classeCours as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Professeur:</label>
                        <select class="form-select" name="professeur_id" name="professeur_id">
                            <option value="">Choisissez le prof</option>
                            @foreach ($professeurs as $professeur)
                                <option value="{{ $professeur->id }}">{{ $professeur->last_name }}
                                    {{ $professeur->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="mb-3">
                            <label class="form-label">Date de début:</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de fin:</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                    </div><!-- row -->
                    <div>
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Write some description (optional)"></textarea>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Ajouter</button>
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
                    <div class="date-item">
                        <i class="ri-calendar-line"></i>
                        <div>Date: <span>September 30, 2023</span></div>
                    </div><!-- date-item -->
                    <div class="date-item">
                        <i class="ri-time-line"></i>
                        <div>Time: <span>11:30AM - 12:30PM</span></div>
                    </div><!-- date-item -->
                    <div class="date-item">
                        <i class="ri-map-pin-line"></i>
                        <div>Location: <span>No location</span></div>
                    </div><!-- date-item -->
                    <hr class="opacity-0">
                    <label class="mb-2">Description:</label>
                    <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis.
                    </p>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                </div><!-- modal-footer -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#salle_id').select2({
                placeholder: 'Choisisssez la salle'
            });
            $("#classe_cours_id").select2({
                placeholder: "Choisissez le cours"
            });
            $("#professeur_id").select2({
                placeholder: "Choisissez le prof"
            });
            new PerfectScrollbar('#calSidebar', {
                suppressScrollX: true
            });

            var events = JSON.parse('{{ $emplois->toJson() }}');
            // Initialiser un tableau pour stocker les événements au format attendu par FullCalendar
            var calendarEvents = [];

            // Parcourir les données récupérées et les formater pour FullCalendar
            events.forEach(function(event) {
                // Créer un objet pour chaque événement au format attendu par FullCalendar
                var calendarEvent = {
                    title: event.classeCours.name,
                    description: "Cours: " + event.classeCours.name + ", " +
                        "Professeur: " + event.professeur.first_name + event.professeur.last_name +
                        ", " +
                        "Salle: " + event.salle.name,
                    ,
                    start: event.start_date_time,
                    end: event.end_date_time,
                    allDay: false,
                    backgroundColor: '#00c5dc',
                };

                // Ajouter l'événement formaté au tableau des événements
                calendarEvents.push(calendarEvent);
            });


            $('#datepicker1').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true
            });

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                headerToolbar: {
                    left: 'custom1 prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventSources: [calendarEvents],
                selectable: true,
                select: function(info) {
                    var startDate = moment(info.start).format('LL');
                    $('#startDate').val(startDate);

                    var endDate = moment(info.startStr).add(1, 'days');
                    $('#endDate').val(endDate.format('LL'));

                    $('#modalCreateEvent').modal('show');
                },
                eventClick: function(info) {
                    console.log(info.event.start);

                    // Set title
                    $('#modalLabelEventView').text(info.event.title);

                    $('#modalEventView').modal('show');
                },
                customButtons: {
                    custom1: {
                        icon: 'chevron-left',
                        click: function() {
                            $('.main-calendar').toggleClass('show');
                        }
                    }
                }
            });

            calendar.render();

            $('#btnCreateEvent').on('click', function(e) {
                e.preventDefault();

                var startDate = moment().format('LL');
                $('#startDate').val(startDate);

                var endDate = moment().add(1, 'days');
                $('#endDate').val(endDate.format('LL'));

                $('#modalCreateEvent').modal('show');
            });
        })
    </script>
@endpush
