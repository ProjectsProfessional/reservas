<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class byPartnerReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'Informe General de Ofrendas por Socio';
        $partnerCodes = DB::table('SOCIO')->pluck('CODIGO','ID_SOCIO');
        return view('reports.byPartner.index',compact('title','partnerCodes'));
    }

    public function generatePDF()
    {

        $data = Request()->all();

        $titles = [
            'title1' => 'Informe General De Ofrendas por Socio',
            'title2' => 'Del: '. $data['date-in'] .' al: '.$data['date-end'],
            'title3' => 'Socio: '. $data['partner'],
        ];

        $rows = DB::select('CALL DBOSP_Ofrendas_Por_Socio (?,?,?)',[
            $data['partner'],
            $data['date-in'],
            $data['date-end'],
        ]);

        $pdf = PDF::loadView('reports.byPartner.printable', compact('rows','titles'));
        return $pdf->stream('Reporte '.$data['date-in'] .' - '. $data['date-end'] .' por '.$data['partner'] .'.pdf');
    }
}
