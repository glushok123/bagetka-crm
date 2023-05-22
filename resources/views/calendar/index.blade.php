@extends('layouts.app')

@section('content')

    <div class='container' >
        <div id='calendar'></div>
    </div>

@endsection

<style>
    .fc-event-title {
        padding: 0 1px;
        float: left;
        clear: none;
        margin-right: 10px;
    }
    .fc-daygrid-event{
        white-space: normal !important;
    }
</style>

@section('after_scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ru',
                initialView: 'dayGridMonth',
                eventSources: [
                    {  
                        url: '/calendar/get/json/arb', // use the `url` property
                        //color: 'yellow',    // an option!
                        //textColor: 'black'  // an option!
                    },
                    {  
                        url: '/calendar/get/json/kuzn', // use the `url` property
                        color: 'green',    // an option!
                        textColor: 'white'  // an option!
                    },
                ],
                eventClick: function(info) {
                    let window1 = window.open("/orders/edit/" + info.event.id, "_blank");
                    window1.focus();
                    //console.log(info.event.id)
                    //window.location = "http://crm.bagetnaya-masterskaya.com/orders/edit/" + info.event.id;
                    //window.location = "http://localhost:8083/orders/edit/" + info.event.id;
                },
            });
            calendar.render();
        });

    </script>
@endsection

@section('description', 'Тестовое задание')
@section('keywords', 'Тестовое задание')
@section('title', 'Тестовое задание')