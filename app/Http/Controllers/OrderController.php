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
}
