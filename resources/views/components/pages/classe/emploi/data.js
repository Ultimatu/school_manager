// var events = [];

// function randomColor(credit) {
//     if (credit === 1) {
//         return '#007bff'; //blue
//     } else if (credit === 2) {
//         return '#28a745'; //green
//     } else if (credit === 3) {
//         return '#ffc107'; //yellow
//     } else if (credit === 4) {
//         console.log('credit :', credit);
//         return '#dc3545'; //red
//     } else {
//         return '#6c757d';
//     }
// }

// function buildDescription(event) {
//     var description = '';
//     description += 'Professeur: ' + event.professeur.first_name + ' ' + event.professeur.last_name + '<br>';
//     description += 'Salle: ' + event.salle.name + '<br>';
//     description += 'Cours: ' + event.classe_cours.cours.name + '<br>';
//     description += 'Début: ' + moment(event.start_date_time).format('LLLL') + '<br>';
//     description += 'Fin: ' + moment(event.end_date_time).format('LLLL') + '<br>';
//     return description;
// }
// // Récupérer les événements depuis la base de données
// $.ajax({
//     url: "{{ route('api.classe.get-emplois', ['id' => $classe->id]) }}",
//     type: 'GET',
//     success: function(response) {
//         console.log(response.data);
//         events = response.data;

//         var calendarEvents = [];

//         // Parcourir les données récupérées et les formater pour FullCalendar
//         events.forEach(function(event) {
//             // Créer un objet pour chaque événement au format attendu par FullCalendar
//             var calendarEvent = {
//                 id: event.id,
//                 title: event.classe_cours.cours.name + ' -Prof: ' + event.professeur
//                     .first_name + ' ' + event.professeur
//                     .last_name + ' -Salle: ' + event.salle.name,
//                 description: buildDescription(event),
//                 start: event.start_date_time,
//                 end: event.end_date_time,
//                 //green
//                 //faire les couleurs en fonction des types de cours
//                 backgroundColor: randomColor(event.classe_cours.credit),
//                 borderColor: randomColor(event.classe_cours.credit),
//                 textColor: 'white',
//             };
//             calendarEvents.push(calendarEvent);
//         });

//         // Injecter les événements dans FullCalendar
//         var calendarEl = document.getElementById('calendar');
//         var calendar = new FullCalendar.Calendar(calendarEl, {
//             initialView: 'timeGridWeek',
//             locale: 'fr',
//             slotMinTime: '08:00:00',
//             slotMaxTime: '18:00:00',
//             headerToolbar: {
//                 left: 'custom1 prev,next today',
//                 center: 'title',
//                 right: 'timeGridDay,timeGridWeek,dayGridMonth',
//             },
//             events: calendarEvents,
//             selectable: true,
//             select: function(info) {
//                 var startDate = moment(info.start).format('LL');
//                 // $('#datepicker2').val(startDate);
//                 console.log('info :', info);

//                 // var endDate = moment(info.startStr).add(1, 'days');
//                 // $('#endDate').val(endDate.format('LL'));
//                 $('#modalCreateEvent').modal('show');
//                 $('#start_time').select2();
//                 $('#end_time').select2();
//                 $('#salle_id').select2();
//                 $('#classe_cours_id').select2();
//                 $('#professeur_id').select2();

//             },
//             eventClick: function(info) {
//                 // Set title
//                 console.log('An event has been clicked!', info);
//                 //display event in modal
//                 $('#modalLabelEventView').text(info.event.title);
//                 $('#eventTitle').text(info.event.title);
//                 $('#eventStartDate').text(moment(info.event.start).format('LLLL'));
//                 $('#eventEndDate').text(moment(info.event.end).format('LLLL'));
//                 $('#eventDescription').text(info.event.extendedProps.description);
//                 $('#btnDeleteEvent').on('click', function() {
//                     Swal.fire({
//                         title: 'Êtes-vous sûr?',
//                         text: "Vous ne pourrez pas revenir en arrière!",
//                         icon: 'warning',
//                         showCancelButton: true,
//                         confirmButtonColor: '#3085d6',
//                         cancelButtonColor: '#d33',
//                         confirmButtonText: 'Oui, supprimez-le!'
//                     }).then((result) => {
//                         if (result.isConfirmed) {
//                             $.ajax({
//                                 url: "{{ route('api.classe.destroy-emploi', ['id' => '+ info.event.id + ']) }}",
//                                 type: 'DELETE',
//                                 success: function(response) {
//                                     Swal.fire(
//                                         'Supprimé!',
//                                         'Le programme a été supprimé.',
//                                         'success'
//                                     );
//                                     calendar.getEventById(info
//                                         .event.id).remove();
//                                 },
//                                 error: function(error) {
//                                     console.log('error :',
//                                         error);
//                                     Swal.fire(
//                                         'Erreur!',
//                                         'Erreur lors de la suppression.',
//                                         'error'
//                                     );
//                                 }
//                             });
//                         }
//                     });
//                 });
//                 $('#modalEventView').modal('show');
//             },
//             customButtons: {
//                 custom1: {
//                     icon: 'chevron-left',
//                     click: function() {
//                         $('.main-calendar').toggleClass('show');
//                     }
//                 }
//             },
//         });

//         calendar.render();
//     },
//     error: function(error) {
//         console.log('error :', error);
//     }
// });
