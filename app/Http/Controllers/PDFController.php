<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $data = [
            'title' => 'Welcome to Nicesnippets.com',
            'date' => date('m/d/Y'),
        ]; 

        $pdf = PDF::loadView('myPDF', $data);
        $pdf->set_option('defaultFont', 'dejavu sans');
        
        return $pdf->stream();
        //return $pdf->download('nicesnippets.pdf');
    }


    public function generatePDFForDownload(int $id)
    {

        $data = [
            'title' => 'Welcome to Nicesnippets.com',
            'date' => date('m/d/Y'),
        ]; 

        $pdf = PDF::loadView('myPDF', $data);
        $pdf->set_option('defaultFont', 'dejavu sans');

        return $pdf->download('nicesnippets.pdf');
    }
}
