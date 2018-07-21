<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class byCurrencyReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'Informe General de Ofrendas por Socio';
        $currencies = DB::table('MONEDA')->pluck('CODIGO_MONEDA','ID_MONEDA');
        return view('reports.byCurrency.index',compact('title','currencies'));
    }

    public function generatePDF()
    {

        $data = Request()->all();

        $titles = [
            'title1' => 'Informe General De Ofrendas por Moneda',
            'title2' => 'Moneda: '. $data['currency'],
            'title3' => 'Del: '. $data['date-in'] .' al: '.$data['date-end'],
        ];

        $rows = DB::select('CALL DBOSP_Ofrendas_Por_Moneda (?,?,?)',[
            $data['currency'],
            $data['date-in'],
            $data['date-end'],
        ]);

        $pdf = PDF::loadView('reports.byCurrency.printable', compact('rows','titles'));
        return $pdf->stream('Reporte '.$data['date-in'] .' - '. $data['date-end'] .' por '.$data['currency'] .'.pdf');
    }
}
