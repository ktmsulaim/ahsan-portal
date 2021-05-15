<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

class LetterpadPrintController extends Controller
{
    public function print(Request $request, Sponsor $sponsor)
    {
        $donor = $request->get('name_in_lang');
        $amount = $request->get('amount_in_lang');
        
        $pdf = LaravelMpdf::loadView('letterpad.print', [
            'donor' => $donor,
            'amount' => $amount
        ], [], [
            'default_font_size'    => '10',
	        'default_font'         => 'baloo_chettan',
            'margin_left'          => 15,
            'margin_right'         => 15,
            'margin_top'           => 110,
        ]);


        $mpdf = $pdf->getMpdf();
        $mpdf->charset_in='windows-1252';
        // $mpdf->SetSourceFile(public_path('assets/letterpad/muvasath_letterpad.pdf'));
        // $tplId = $mpdf->ImportPage(1);
        // $mpdf->UseTemplate($tplId);
        // $mpdf->text_input_as_HTML = true;

        // $mpdf->writeText(10, 10, $donor);

        

        return $pdf->stream('document.pdf');
    }
}
