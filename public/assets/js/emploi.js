
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
        select: function (info) {
            var startDate = moment(info.start).format("LL");
            $("#modalCreateEvent").modal("show");
        },
        eventClick: function (info) {
            $("#modalLabelEventView").text(info.event.title);
            $("#eventTitle").text(info.event.title);
            $("#eventStartDate").text(moment(info.event.start).format("LLLL"));
            $("#eventEndDate").text(moment(info.event.end).format("LLLL"));
            $("#eventDescription").text(info.event.extendedProps.description);
            $("#btnDeleteEvent").on("click", function () {
                Swal.fire({
                    title: "Êtes-vous sûr?",
                    text: "Vous ne pourrez pas revenir en arrière!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui, supprimez-le!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (info.event.backgroundColor == "#dc3545") {
                            $.ajax({
                                url:
                                    baseUrl +
                                    "/api/destroy-examen/" +
                                    info.event.id,
                                type: "DELETE",
                                success: function (response) {
                                    calendar.getEventById(info.event.id)
                                        .remove();
                                    $("#modalEventView").modal("hide");
                                },
                                error: function (error) {
                                    console.log("error :", error);
                                },
                            });
                        }
                        $.ajax({
                            url:
                                baseUrl +
                                "/api/destroy-emploi/" +
                                info.event.id,
                            type: "DELETE",
                            success: function (response) {
                                calendar.getEventById(info.event.id).remove();
                                $("#modalEventView").modal("hide");

                            },
                            error: function (error) {
                                console.log("error :", error);
                            },
                        });
                    }
                });
            });
            $("#modalEventView").modal("show");
        },
        customButtons: {
            custom1: {
                icon: "chevron-left",
                click: function () {
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
        description +=
            "Professeur: " +
            event.professeur.first_name +
            " " +
            event.professeur.last_name +
            "<br>";
        description += "Salle: " + event.salle.name + "<br>";
        description += "Cours: " + event.classe_cours.cours.name + "<br>";
        description +=
            "Début: " + moment(event.start_date_time).format("LLLL") + "<br>";
        description +=
            "Fin: " + moment(event.end_date_time).format("LLLL") + "<br>";
    }
    return description;
}

// Fonction pour ajouter un cours
$("#btnSaveEvent").on("click", function () {
    var salleId = $("#salle_id").val();
    var classeCoursId = $("#classe_cours_id").val();
    var startTime = $("#start_time").val();
    var endTime = $("#end_time").val();
    var date = $("#datepicker2").val();
    var type = $("#type").val();

    //convertier les heures en deux chiffres
    if (startTime.length == 4) {
        startTime = "0" + startTime;
    }
    if (endTime.length == 4) {
        endTime = "0" + endTime;
    }

    if (date == "") {
        $("#dateError").text("La date est obligatoire");
        return;
    } else {
        $("#dateError").text("");
    }

    //verifier si l'heure de début est vide
    if (startTime == "") {
        $("#errorStDate").text("L'heure de début est obligatoire");
        return;
    } else {
        $("#errorStDate").text("");
    }

    //verifier si l'heure de fin est vide
    if (endTime == "") {
        $("#errorEnDate").text("L'heure de fin est obligatoire");
        return;
    } else {
        $("#errorEnDate").text("");
    }

    //verifier si l'heure de fin est superieur à l'heure de début
    if (moment(endTime, "HH:mm").isBefore(moment(startTime, "HH:mm"))) {
        $("#errorEnDate").text(
            "L'heure de fin doit être superieur à l'heure de début"
        );
        return;
    } else {
        $("#errorEnDate").text("");
    }

    //transformer date en format YYYY-MM-DD
    var newdate = date.split("/").reverse();
    const year = newdate[0];
    const month = newdate[2];
    const day = newdate[1];
    newdate = year + "-" + month + "-" + day;
    //verifier si y'a -undefined-undefined dans la date et remplacer par ''
    newdate = newdate.replace("-undefined", "");
    newdate = newdate.replace("-undefined", "");
    console.log("newdate :", newdate);
    var startDateTime = newdate + " " + startTime;
    var endDateTime = newdate + " " + endTime;

    console.log("startDate :", startDateTime);
    console.log("endDate :", endDateTime);
    console.log("diff :", moment(endDateTime).diff(startDateTime, "hours"));

    if (moment(endDateTime).diff(startDateTime, "hours") > 8) {
        $("#errorEnDate").text(
            "La durée du programme ne doit pas dépasser 8 heures" +
                moment(endDateTime).diff(startDateTime, "hours")
        );
        return;
    } else {
        $("#errorEnDate").text("");
    }

    var eventDay = moment(date).format("dddd");
    console.log("eventDay :", eventDay);
    //if day is sunday
    if (eventDay == "Sunday") {
        $("#globalError")
            .addClass("alert alert-danger")
            .text(
                "<strong>Erreur!</strong> Vous ne pouvez pas programmer un cours ou examen le dimanche"
            );
        return;
    }
    //convertir le jour en français
    switch (eventDay) {
        case "Monday":
            eventDay = "Lundi";
            break;
        case "Tuesday":
            eventDay = "Mardi";
            break;
        case "Wednesday":
            eventDay = "Mercredi";
            break;
        case "Thursday":
            eventDay = "Jeudi";
            break;
        case "Friday":
            eventDay = "Vendredi";
            break;
        case "Saturday":
            eventDay = "Samedi";
            break;
        case "Sunday":
            eventDay = "Dimanche";
            break;
    }
    let data = {
        day: eventDay,
        classe_id: classeId,
        salle_id: salleId,
        classe_cours_id: classeCoursId,
        start_date_time: startDateTime,
        end_date_time: endDateTime,
    };

    if (type === "cours") {
        $.ajax({
            url: baseUrl + "/api/store-emploi",
            type: "POST",
            data: data,
            success: function (response) {
                window.location.reload();
            },
            error: function (error) {
                console.log("error :", error);
                console.log("error :", error.responseJSON);
                $("#globalError")
                    .addClass("alert alert-danger")
                    .text(
                        "<strong>Erreur!</strong> " + error.responseJSON.message ?? error.responseJSON.error
                    );
            },
        });
    } else {
        $.ajax({
            url: baseUrl + "/api/store-examen",
            type: "POST",
            data: data,
            success: function (response) {
                window.location.reload();
            },
            error: function (error) {
                console.log("error :", error);
                console.log("error :", error.responseJSON);
                $("#globalError")
                    .addClass("alert alert-danger")
                    .text(
                        "<strong>Erreur!</strong> " + error.responseJSON.message ?? error.responseJSON.error
                    );
            },
        });
    }
});

if ($('#datepicker1').length){
    $("#datepicker1").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        lang: "fr",
    
    });
}
