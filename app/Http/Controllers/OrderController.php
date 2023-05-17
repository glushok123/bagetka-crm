<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderItems;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Список всех заказов
     * 
     * @return View
     */
    public function showOrdersBaget(): View
    {
        $orders = DB::connection('mysqlbagetnaya')->table('calendar')->get();

        return view('orders.showOrdersBaget', [
          'orders' => $orders
        ]);
    }

    /**
     * Форма создания заказа
     * 
     * @param Request $request
     * 
     * @return View
     */
    public function showCreateForm(Request $request): View
    {
        return view('orders.formCreate');
    }

    /**
     * Форма редактирования заказа
     * 
     * @param int $orderId
     * 
     * @return View
     */
    public function showEditForm(int $orderId): View
    {
        $orderOld = DB::connection('mysqlbagetnaya')->table('calendar')->where('id', $orderId)->first();

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

            DB::connection('mysqlbagetnaya')->table('calendar')->where('id', $orderId)->update([
                "order_id" => $orderNew->id,
            ]);

            $orderItems = [];

            Session::flash('message', 'Заказ в CRM не найден. Данные были перенесены со старой базы.');
        }

        return view('orders.formEdit', [
            'orderOld' => $orderOld,
            'orderNew' => $orderNew,
            'orderItems' => $orderItems,
        ]);
    }

    /**
     * Запрос на изменение заказа
     * 
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function editOrder(Request $request): RedirectResponse
    {
        $order = Order::where('id', $request->new_order_id)->first();
        $order->order_number = empty($request->order_number) == true ? rand(1, 300) : $request->order_number;
        $order->client_name = $request->client_name;
        $order->employee_name = $request->employee_name;
        $order->out_of_work = empty($request->out_of_work) == true ? 0 : 1;
        $order->client_phone = $request->client_phone;
        $order->payment_method = $request->payment_method;
        $order->date_reception = $request->date_reception;
        $order->date_issuance = $request->date_issuance;
        $order->prepayment = $request->prepayment;
        $order->total_amount = $request->total_amount;
        $order->delivery = $request->delivery;
        $order->comment = $request->comment;
        $order->save();

        OrderItems::where('orders_id', $order->id)->delete();

        $count = 0;
        foreach ($request->article_baget as $item) {
            $orderItem = new OrderItems();
            $orderItem->orders_id = $order->id;
            $orderItem->article_baget = $request->article_baget[$count];
            $orderItem->chop = $request->chop[$count];
            $orderItem->window_size = $request->window_size[$count];
            $orderItem->article_kanta = $request->article_kanta[$count];
            $orderItem->article_pasp = $request->article_pasp[$count];
            $orderItem->field_width = $request->field_width[$count];
            $orderItem->quantity = $request->quantity[$count];
            $orderItem->amount = $request->amount[$count];
            $orderItem->backdrop = $request->backdrop[$count];
            $orderItem->glass = $request->glass[$count];
            $orderItem->save();
            $count =  $count + 1;
        }

        DB::connection('mysqlbagetnaya')->table('calendar')->where('order_id', $order->id)->update([
            "datein" => $order->date_reception,
            "numberord" => $order->order_number,
            "client_name" => $order->client_name,
            "phone" => $order->client_phone,
            "comment" => $order->comment,
            "payment" => $order->total_amount,
        ]);

        Session::flash('message', 'Заказ № ' . $order->order_number . ' (' . $order->id .') успешно изменен!');

        return Redirect::to(route('orders.show'));
    }

    /**
     * Запрос на создание заказа
     * 
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function createOrder(Request $request): RedirectResponse
    {
        $order = new Order();
        $order->order_number = empty($request->order_number) == true ? rand(1, 300) : $request->order_number;
        $order->client_name = $request->client_name;
        $order->employee_name = $request->employee_name;
        $order->out_of_work = empty($request->out_of_work) == true ? 0 : 1;
        $order->client_phone = $request->client_phone;
        $order->payment_method = $request->payment_method;
        $order->date_reception = $request->date_reception;
        $order->date_issuance = $request->date_issuance;
        $order->prepayment = $request->prepayment;
        $order->total_amount = $request->total_amount;
        $order->delivery = $request->delivery;
        $order->comment = $request->comment;
        $order->save();

        $count = 0;
        foreach ($request->article_baget as $item) {
            $orderItem = new OrderItems();
            $orderItem->orders_id = $order->id;
            $orderItem->article_baget = $request->article_baget[$count];
            $orderItem->chop = $request->chop[$count];
            $orderItem->window_size = $request->window_size[$count];
            $orderItem->article_kanta = $request->article_kanta[$count];
            $orderItem->article_pasp = $request->article_pasp[$count];
            $orderItem->field_width = $request->field_width[$count];
            $orderItem->quantity = $request->quantity[$count];
            $orderItem->amount = $request->amount[$count];
            $orderItem->backdrop = $request->backdrop[$count];
            $orderItem->glass = $request->glass[$count];
            $orderItem->save();
            $count =  $count + 1;
        }

        DB::connection('mysqlbagetnaya')->table('calendar')->insert([
            "department" => 'arb',
            "datein" => $order->date_reception,
            "numberord" => $order->order_number,
            "client_name" => $order->client_name,
            "phone" => $order->client_phone,
            "comment" => $order->comment,
            "payment" => $order->total_amount,
            "important" => 0,
            "file_front" => '',
            "file_back" => '',
            "order_id" => $order->id,
        ]);

        Session::flash('message', 'Заказ № ' . $order->order_number . ' (' . $order->id .')добавлен!');

        return Redirect::to(route('orders.show'));
    }

    /**
     * Список всех заказов в Json
     * 
     * @return JsonResponse
     */
    public function getOrdersJson(): JsonResponse
    {
        $arrayOrders = [];
        $orders = DB::connection('mysqlbagetnaya')->table('calendar')->get();
        
        foreach ($orders as $order) {
            $iconDownload1 = '';
            $iconDownload2 = '';

            if (empty($order->file_front) == false) {
                $iconDownload1 = '<i class="bi bi-arrow-right-square-fill"></i>';
            }
            
            if (empty($order->file_back) == false) {
                $iconDownload2 = '<i class="bi bi-arrow-right-square-fill"></i>';
            }

            $arrayOrders[] = [
                '',
                $order->numberord,
                $order->datein,
                $order->department == 'arb' ? "Арбат" : "Кузня",
                $order->client_name,
                $order->phone,
                $order->comment,
                $order->payment,
                '
                <a href="http://orders.bagetnaya-masterskaya.com/calendar/' . $order->file_front . '" target="_blank" title="Просмотр">
                    ' . $iconDownload1 . '
                </a>
                ',
                '
                <a href="http://orders.bagetnaya-masterskaya.com/calendar/' . $order->file_back . '" target="_blank" title="Просмотр">
                    ' . $iconDownload2 . '
                </a>
                ',
                '
                <a href="' . route('orders.edit', ['id' => $order->id]) . '" type="button" class="btn btn-outline-success" title="Просмотр (редактирование)"><i class="bi bi-pencil-square"></i></a>
                <a href="' . route('orders.pdf.print', ['id' => $order->id]) . '" type="button" class="btn btn-outline-info" title="Отправить на печать"><i class="bi bi-printer-fill"></i></a>
                <a href="' . route('orders.pdf.download', ['id' => $order->id]) . '" type="button" class="btn btn-outline-danger" title="Скачать pdf"><i class="bi bi-file-earmark-pdf"></i></a>
                '
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => $arrayOrders,
        ]);
    }
}