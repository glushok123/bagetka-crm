@extends('layouts.app')

@section('content')

    <div class='container' >
        <div id='calendar'></div>
    </div>

@endsection

@section('after_scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'ru',
                initialView: 'dayGridMonth',
                eventSources: [
                  {  
                    url: '/calendar/get/json', // use the `url` property
                    //color: 'yellow',    // an option!
                    //textColor: 'black'  // an option!
                }
                ],
            });
            calendar.render();
        });

    </script>
@endsection

@section('description', 'Тестовое задание')
@section('keywords', 'Тестовое задание')
@section('title', 'Тестовое задание')