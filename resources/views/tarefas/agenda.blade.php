@extends('layout')


@section('titulo')
    Agenda
@endsection

@section('conteudo')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: '100%',
                expandRows: true,
                slotMinTime: '06:00',
                slotMaxTime: '20:00',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                initialDate: '2020-09-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
                slotDuration: '00:30:00',
                businessHours: [
                    {
                        daysOfWeek: [1], 
                        startTime: '08:00', 
                        endTime: '08:30' 
                    },
                    {
                        daysOfWeek: [1], 
                        startTime: '08:30', 
                        endTime: '09:00'
                    }
                ],
                events: [{
                        title: 'All Day Event',
                        start: '2020-09-01',
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2020-09-09T16:00:00'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2020-09-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2020-09-11',
                        end: '2020-09-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-09-12T10:30:00',
                        end: '2020-09-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2020-09-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2020-09-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2020-09-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2020-09-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2020-09-13T07:00:00'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2022-01-17T08:00:00',
                        end: '2022-01-17T08:30:00',
                        display: 'inverse-background'
                    },
                    {
                        groupId: 999,
                        title: 'Repeating Event',
                        start: '2022-01-17T08:30:00',
                        end: '2022-01-17T09:00:00',
                        display: 'inverse-background'

                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2020-09-28'
                    }
                ]
            });

            calendar.render();
        });
    </script>
    <style>
        html,
        body {
            overflow: hidden;
            /* don't do scrollbars */
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar-container {
            position: fixed;
            top: 20%;
            left: 0;
            right: 0;
            bottom: 5%;
        }

        .fc-header-toolbar {
            /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
            padding-top: 1em;
            padding-left: 1em;
            padding-right: 1em;
        }

    </style>
</head>
    <div class="container" id='calendar-container'>
        <div id='calendar'></div>
    </div>

    @endsection
