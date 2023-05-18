<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Calendar;
use App\Models\Order;
use DB;

class CalendarController extends Controller
{

    public function show(Calendar $calendar)
    {
        return view('calendar.index', [

        ]);
    }

    /**
     * Список заказов для календаря
     * 
     * @return JsonResponse
     */
    public function getOrdersJson(): JsonResponse
    {
        $arrayOrders = [];
        $orders = DB::connection('mysqlbagetnaya')->table('calendar')->get();

        foreach ($orders as $order) {
            if (Order::where('id', $order->order_id)->exists() == true) {
                $orderNew = Order::where('id', $order->order_id)->first();

                $arrayOrders[] = [
                    "id" => $order->id,
                    "title" => empty($orderNew->date_issuance) == true ? 'Заказ №' . $order->numberord . ' (прием)' : 'Заказ №' . $order->numberord . ' (выдача)',
                    "start" =>empty($orderNew->date_issuance) == true ? $order->datein : $orderNew->date_issuance,
                    "end" => $order->datein,
                ];
            }
            else {
                $arrayOrders[] = [
                    "id" => $order->id,
                    "title" => 'Заказ №' . $order->numberord . ' (прием)',
                    "start" => $order->datein,
                    "end" => $order->datein,
                ];
            }
        }

        return response()->json($arrayOrders);
    }
}