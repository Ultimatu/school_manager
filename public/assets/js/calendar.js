// "use strict";
// new PerfectScrollbar("#calSidebar", {
//     suppressScrollX: true,
// });

// var events = JSON.parse("{{ $emplois->toJson() }}");
// // Initialiser un tableau pour stocker les événements au format attendu par FullCalendar
// var calendaREvents = [];

// // Parcourir les données récupérées et les formater pour FullCalendar
// events.forEach(function (event) {
//     // Créer un objet pour chaque événement au format attendu par FullCalendar
//     var calendarEvent = {
//         title: event.classeCours.name,
//         description:
//             "Cours: " +
//             event.classeCours.name +
//             ", " +
//             "Professeur: " +
//             event.professeur.first_name +
//             event.professeur.last_name +
//             ", " +
//             "Salle: " +
//             event.salle.name,
//         start: event.start_date_time,
//         end: event.end_date_time,
//         allDay: false,
//         backgroundColor: "#00c5dc",
//     };

//     // Ajouter l'événement formaté au tableau des événements
//     calendaREvents.push(calendaEvent);
// });

// $("#datepicker1").datepicker({
//     showOtherMonths: true,
//     selectOtherMonths: true,
// });

// var calendarEl = document.getElementById("calendar");
// var calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: "dayGridMonth",
//     locale: "fr",
//     headerToolbar: {
//         left: "custom1 prev,next today",
//         center: "title",
//         right: "dayGridMonth,timeGridWeek,timeGridDay",
//     },
//     eventSources: [calendaREvents],
//     selectable: true,
//     select: function (info) {
//         var startDate = moment(info.start).format("LL");
//         $("#startDate").val(startDate);

//         var endDate = moment(info.startStr).add(1, "days");
//         $("#endDate").val(endDate.format("LL"));

//         $("#modalCreateEvent").modal("show");
//     },
//     eventClick: function (info) {
//         console.log(info.event.start);

//         // Set title
//         $("#modalLabelEventView").text(info.event.title);

//         $("#modalEventView").modal("show");
//     },
//     customButtons: {
//         custom1: {
//             icon: "chevron-left",
//             click: function () {
//                 $(".main-calendar").toggleClass("show");
//             },
//         },
//     },
// });

// calendar.render();

// $("#btnCreateEvent").on("click", function (e) {
//     e.preventDefault();

//     var startDate = moment().format("LL");
//     $("#startDate").val(startDate);

//     var endDate = moment().add(1, "days");
//     $("#endDate").val(endDate.format("LL"));

//     $("#modalCreateEvent").modal("show");
// });

// $("#salle_id").select2({
//     placeholder: "Choisisssez la salle",
// });
// $("#classe_cours_id").select2({
//     placeholder: "Choisissez le cours",
// });
// $("#professeur_id").select2({
//     placeholder: "Choisissez le prof",
// });
