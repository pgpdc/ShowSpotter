<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
    header("location: index.php");
}

function data_calendar()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'indiana';

    $link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    $result = mysqli_query($link, "SELECT `imdbid`, `date`, `timestart`, `timeend`, `room_id` FROM `showtimes`");

    while ($rs = mysqli_fetch_assoc($result)) {
        $imdbid = $rs['imdbid'];
        $date = $rs['date'];
        $timestart = $rs['timestart'];
        $timeend = $rs['timeend'];
        $room_id = $rs['room_id'];
        $title = getMovieTitle($imdbid);
        $color = getColor($room_id);
        echo "{title: '$title', imdbid: '$imdbid', start: '$date' + 'T' + '$timestart', end: '$date' + 'T' + '$timeend', resourceId: '$room_id', color: '$color'},";
    }
}
function getMovieTitle($imdbid)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://moviesdatabase.p.rapidapi.com/titles/episode/$imdbid",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: moviesdatabase.p.rapidapi.com",
            "X-RapidAPI-Key: 8452b825abmshd1549bfe74262fcp138103jsnd5f10dbe3289"
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $data = json_decode($response, true);
        return $data['results']['titleText']['text'];
    } else {
        return $imdbid; // Return the IMDb ID as a fallback
    }
}

function getColor($roomId)
{
    switch ($roomId) {
        case 'ROOM_A':
            return '#ff0000';
        case 'ROOM_B':
            return '#00ff00';
        case 'ROOM_C':
            return '#0000ff'; 
        default:
            return '#000000';
    }
}

?>


<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title customButton',
                    right: 'timeGridWeek,timeGridDay'
                },
                customButtons: {
        customButton: {
            text: 'Admin Home',
            click: function() {
                window.location.href = 'admin.php';
            }
        }
    },
                slotMinTime: '09:00:00',
                slotMaxTime: '24:00:00',
                events: [<?php data_calendar(); ?>],
                eventColor: function(event) {
                    switch (event.resourceId) {
                        case 'ROOM_A':
                            return '#ff0000';
                        case 'ROOM_B':
                            return '#00ff00';
                        case 'ROOM_C':
                            return '#0000ff';
                        default:
                            return '#000000';
                    }
                },
                eventTimeFormat: { 
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: true
                },
                eventContent: function(arg) {
                    var title = document.createElement('div');

                    var convertTo12Hr = function(time) {
                        var hours = parseInt(time.slice(0, 2));
                        var minutes = time.slice(3, 5);
                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12; 
                        return hours + ':' + minutes + ' ' + ampm;
                    }

                    var startTime = convertTo12Hr(arg.event.start.toISOString().slice(11, 16));
                    var endTime = arg.event.end ? convertTo12Hr(arg.event.end.toISOString().slice(11, 16)) : '';

                    title.innerHTML = arg.event.title + ' (' + arg.event.extendedProps.resourceId + ') ' + startTime + (endTime ? '-' + endTime : '');
                    var arrayOfDomNodes = [title];
                    return {
                        domNodes: arrayOfDomNodes
                    };
                },

                eventClick: function(info) {
                    if (confirm('Are you sure you want to remove this movie from the database?')) {
                        $.ajax({
                            url: 'remove_movie.php',
                            type: 'POST',
                            data: {
                                imdbid: info.event.extendedProps.imdbid,
                                roomId: info.event.extendedProps.resourceId,
                                startTime: info.event.start.toISOString().slice(11, 16),
                                endTime: info.event.end ? info.event.end.toISOString().slice(11, 16) : ''
                            },
                            success: function() {
                                info.event.remove();
                            }
                        });
                    }
                }


            });

            calendar.render();
        });
    </script>

</head>

<body>
    <div id='calendar'></div>
</body>

</html>