<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Calendar;
use App\Models\Order;
use App\Models\OrderItems;
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
    public function getOrdersJson(string $branch): JsonResponse
    {
        $arrayOrders = [];
        $orders = DB::connection('mysqlbagetnaya')->table('calendar')->where('department', $branch)->get();

        foreach ($orders as $order) {
            if (Order::where('id', $order->order_id)->exists() == true) {
                $orderNew = Order::where('id', $order->order_id)->first();

                $arrayOrders[] = [
                    "id" => $order->id,
                    "title" => empty($orderNew->date_issuance) == true ? 'Заказ №' . $order->numberord . ' (прием)' : 'Заказ №' . $order->numberord . ' (выдача)',
                    "start" => empty($orderNew->date_issuance) == true ? $order->datein : $orderNew->date_issuance,
                    "end" => empty($orderNew->date_issuance) == true ? $order->datein : $orderNew->date_issuance,
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

    /**
     * Получение инфы при клике на заказ в календаре
     * 
     * @return JsonResponse
     */
    public function getOrderJson(int $id): JsonResponse
    {
        $orderOld = DB::connection('mysqlbagetnaya')->table('calendar')->where('id', $id)->first();

        if (Order::where('id', $orderOld->order_id)->exists() == true) {
            $orderNew = Order::where('id', $orderOld->order_id)->first();
            $orderItems = OrderItems::where('orders_id', $orderNew->id)->get();
        }else{
            $orderNew = new Order();
            $orderNew->order_number = $orderOld->numberord;
            $orderNew->client_name = $orderOld->client_name;
            $orderNew->client_phone = $orderOld->phone;
            $orderNew->date_reception = $orderOld->datein;
            $orderNew->total_amount = $orderOld->payment;
            $orderNew->comment = $orderOld->comment;
            $orderNew->save();

            DB::connection('mysqlbagetnaya')->table('calendar')->where('id', $id)->update([
                "order_id" => $orderNew->id,
            ]);

            $orderItems = [];
        }

        return response()->json([
            'orderOld' => $orderOld,
            'orderNew' => $orderNew,
            'orderItems' => $orderItems,
            'buttonEdit' => '<a href="' . route('orders.edit', ['id' => $id]) . '" type="button" class="btn btn-outline-success" title="Просмотр (редактирование)"><i class="bi bi-pencil-square"></i></a>',
            'buttonPrint' => '<a href="' . route('orders.pdf.print', ['id' => $id]) . '" type="button" class="btn btn-outline-info" title="Отправить на печать"><i class="bi bi-printer-fill"></i></a>',
            'buttonDownload' => '<a href="' . route('orders.pdf.download', ['id' => $id]) . '" type="button" class="btn btn-outline-danger" title="Скачать pdf"><i class="bi bi-file-earmark-pdf"></i></a>',
        ]);
    }
}