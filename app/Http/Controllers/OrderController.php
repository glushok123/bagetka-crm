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

    public function showCreateFormPost(Request $request)
    {
        dd($request);
    }

    public function showOrdersBaget()
    {
        dd(DB::connection('mysqlbagetnaya')->table('calendar')->first());
    }
}
