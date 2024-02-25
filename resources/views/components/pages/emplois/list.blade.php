@extends('layouts.app-calendar')

@section('title', 'Tableau de bord')



@section('content')
    <div class="calendar-sidebar">
        <div id="calSidebar" class="sidebar-body">
            <div class="d-grid mb-3">
                <a id="btnCreateEvent" href="" class="btn btn-primary">Ajouter un programe</a>
            </div>
            <div id="datepicker1" class="task-calendar mb-5"></div>

            <h5 class="section-title section-title-sm mb-4">Upcoming Events</h5>

            <ul class="event-group mb-5">
                <li class="event-item">
                    <div class="event-body">
                        <h6><a href="">Project Concept Meeting</a></h6>
                        <p>08:30AM - 11:30AM</p>
                        <div class="mutual-badge">
                            <ul>
                                <li><a href="" class="avatar"><img src="../assets/img/img15.jpg" alt=""></a>
                                </li>
                                <li><a href="" class="avatar"><img src="../assets/img/img14.jpg" alt=""></a>
                                </li>
                            </ul>
                            <label>Lea and 4 others are going</label>
                        </div><!-- mutual-badge -->
                    </div><!-- event-body -->
                </li>
                <li class="event-item">
                    <div class="event-body">
                        <h6><a href="">Company Standup Meeting</a></h6>
                        <p>04:30PM - 05:00PM</p>
                        <div class="mutual-badge">
                            <ul>
                                <li><a href="" class="avatar"><img src="../assets/img/img10.jpg" alt=""></a>
                                </li>
                                <li><a href="" class="avatar"><img src="../assets/img/img8.jpg" alt=""></a>
                                </li>
                                <li><a href="" class="avatar"><img src="../assets/img/img6.jpg" alt=""></a>
                                </li>
                            </ul>
                            <label>Socrates and 8 others are going</label>
                        </div><!-- mutual-badge -->
                    </div><!-- event-body -->
                </li>
                <li class="event-item">
                    <div class="event-body">
                        <h6><a href="">Product Presentation</a></h6>
                        <p>Tomorrow, 09:30AM - 10:30AM</p>
                        <div class="mutual-badge">
                            <ul>
                                <li><a href="" class="avatar"><img src="../assets/img/img15.jpg" alt=""></a>
                                </li>
                                <li><a href="" class="avatar"><img src="../assets/img/img14.jpg" alt=""></a>
                                </li>
                                <li><a href="" class="avatar"><img src="../assets/img/img12.jpg" alt=""></a>
                                </li>
                            </ul>
                            <label>Marie and 5 others are going</label>
                        </div><!-- mutual-badge -->
                    </div><!-- event-body -->
                </li>
            </ul>

            <h5 class="section-title section-title-sm mb-4">Calendrier Scolaire</h5>
            <nav class="nav nav-calendar mb-4">
                <a href="" class="nav-link calendar"><span></span> Calendar Events</a>
                <a href="" class="nav-link birthday"><span></span> Birthday Events</a>
                <a href="" class="nav-link holiday"><span></span> Holiday Calendar</a>
                <a href="" class="nav-link discover"><span></span> Discovered Events</a>
                <a href="" class="nav-link meetup"><span></span> Meetup Events</a>
                <a href="" class="nav-link other"><span></span> Other Events</a>
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
                        <label class="form-label">Titre:</label>
                        <input type="text" class="form-control" placeholder="Enter title of event">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="etype" id="etype1" value="1"
                                checked>
                            <label class="form-check-label" for="etype1">Cours</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="etype" id="etype2"
                                value="2">
                            <label class="form-check-label" for="etype2">Tp</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="etype" id="etype3"
                                value="2">
                            <label class="form-check-label" for="etype3">Conférence</label>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-7 col-md-8">
                            <label class="form-label">Date de début:</label>
                            <input id="startDate" type="text" class="form-control" placeholder="Choose date">
                        </div><!-- col -->
                        <div class="col">
                            <label class="form-label">Heure de début:</label>
                            <select class="form-select">
                                <option value="">Choose time</option>
                                <option value="12:00AM">12:00AM</option>
                                <option value="12:15AM">12:15AM</option>
                                <option value="12:30AM">12:30AM</option>
                                <option value="12:45AM">12:45AM</option>
                            </select>
                        </div><!-- col -->
                    </div><!-- row -->
                    <div class="row g-3 mb-3">
                        <div class="col-7 col-md-8">
                            <label class="form-label">Date de fin:</label>
                            <input id="endDate" type="text" class="form-control" placeholder="Choose date">
                        </div><!-- col -->
                        <div class="col">
                            <label class="form-label">Heure de fin:</label>
                            <select class="form-select">
                                <option value="">Choose time</option>
                                <option value="12:00AM">12:00AM</option>
                                <option value="12:15AM">12:15AM</option>
                                <option value="12:30AM">12:30AM</option>
                                <option value="12:45AM">12:45AM</option>
                            </select>
                        </div><!-- col -->
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
@endpush
