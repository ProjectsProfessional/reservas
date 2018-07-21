<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class byDateReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'Informe General de Ofrendas';
        return view('reports.byDate.index',compact('title'));
    }

    public function generatePDF()
    {

        $data = Request()->all();

        $title = 'Informe de Ofrendas';
        $title2 =  'Del: '. $data['date-in'] .' al: '.$data['date-end'];
        
        $rows = DB::select('CALL DBOSP_Ofrendas_Por_Fecha (?,?)',[
            $data['date-in'],
            $data['date-end'],
        ]);

        $pdf = PDF::loadView('reports.byDate.printable', compact('rows','title','title2'));
        return $pdf->stream('Reporte '.$data['date-in'] .' - '. $data['date-end'] .'.pdf');

        //return ($option == 'see') ? $pdf->stream('Corte Diario.pdf'): $pdf->download('Corte Diario.pdf');
    }
}
