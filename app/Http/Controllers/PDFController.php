<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\tbProdi;
use App\Models\tbMatkul;
use App\Models\tbSoal;
use App\Models\tbUjian;
use App\Models\User;

class PDFController extends Controller
{
    // public function generatePDF()
    // {
    //     $data = ['title' => 'Test PDF', 'content' => 'This is a test PDF document.'];
    //     $pdf = Pdf::loadView('pdf_view', $data);
    //     return $pdf->download('test.pdf');
    // }

    // public function Ujian2($ujian_id)
    // {
    //     $ujian = tbUjian::where('ujian_id', $ujian_id)->get();
    //     $soal = tbSoal::where('ujian_id', $ujian_id)->get();
    
    //     $pdf = PDF::loadView('lihatUjian2', ['dataUjian' => $ujian, 'dataSoal' => $soal]);
    //     return $pdf->stream('ujian.pdf');
    // }
    
}

