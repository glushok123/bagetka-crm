<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\OrderItems;
use DB;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function generatePDF()
    {
        $users = User::get();
  
        $data = [
            'title' => 'Welcome to Nicesnippets.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ]; 
            
        $pdf = PDF::loadView('myPDF', $data);
        $pdf->set_option('defaultFont', 'dejavu sans');
        
        return $pdf->stream();
        //return $pdf->download('nicesnippets.pdf');
    }


    public function generatePDFForPrint(int $id)
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

        $data = [
            'orderOld' => $orderOld,
            'orderNew' => $orderNew,
            'orderItems' => $orderItems,
        ]; 

        $pdf = PDF::loadView('myPDF', $data);
        $pdf->set_option('defaultFont', 'dejavu sans');

        return $pdf->stream();
    }


    public function generatePDFForDownload(int $id)
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

        $data = [
            'orderOld' => $orderOld,
            'orderNew' => $orderNew,
            'orderItems' => $orderItems,
        ]; 

        $pdf = PDF::loadView('myPDF', $data);
        $pdf->set_option('defaultFont', 'dejavu sans');

        return $pdf->download('nicesnippets.pdf');
    }
}
