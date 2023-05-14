<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{

    public function showCreateForm()
    {
        return view('orders.formCreate', [
            //
        ]);
    }

    public function showEditForm(int $orderId)
    {
        $order = DB::connection('mysqlbagetnaya')->table('calendar')->where('id', $orderId)->first();

        return view('orders.formEdit', [
            'order' => $order
        ]);
    }

    public function showCreateFormPost(Request $request)
    {
        dd($request);
    }

    public function showOrdersBaget()
    {
        $orders = DB::connection('mysqlbagetnaya')->table('calendar')->get();
        
        return view('orders.showOrdersBaget', [
          'orders' => $orders
        ]);
    }

    public function getOrdersJson()
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
