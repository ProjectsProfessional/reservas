<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class dailyReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'Corte diario de Ofrendas';
        $rows = DB::table('dbov_reporte_diario')->get();
        return view('reports.daily.index',compact('rows','title'));
    }

    public function generatePDF($option)
    {
        $title = 'Corte diario de Ofrendas';
        $rows = DB::table('dbov_reporte_diario')->get();
        $pdf = PDF::loadView('reports.daily.printable', compact('rows','title'));

        return ($option == 'see') ? $pdf->stream('Corte Diario.pdf'): $pdf->download('Corte Diario.pdf');
    }
}
