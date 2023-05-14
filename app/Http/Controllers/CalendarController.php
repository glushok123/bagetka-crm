<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Models\Calendar;
use DB;

class CalendarController extends Controller
{

    public function show(Calendar $calendar)
    {
        return view('calendar.index', [

        ]);
    }

    public function getOrdersJson()
    {
        $arrayOrders = [];
        $orders = DB::connection('mysqlbagetnaya')->table('calendar')->get();
        
        foreach ($orders as $order) {

            $arrayOrders[] = [
                "id" => $order->id,
                "title" => 'Заказ №' . $order->numberord,
                "start" => $order->datein,
                "end" => $order->datein,
            ];
        }

        return response()->json($arrayOrders);
    }
}
