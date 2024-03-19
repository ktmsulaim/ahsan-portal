<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

class LetterpadPrintController extends Controller
{
    public function print(Request $request, Sponsor $sponsor)
    {
        $donor = $request->get('name_in_lang');
        $amount = $request->get('amount_in_lang');
        $lang = $request->get('lang');
        $ref = $sponsor->refNo();
        $date = Carbon::now()->format('d-m-Y');

        if(!in_array($lang, ['ml', 'ar', 'en'])) {
            toastr()->error("Unsupported language", "Error");
            return redirect()->back();
        }

        $lang_conf = [
            'ml' => [
                'default_font_size'    => '12',
	            'default_font'         => 'rachana',
            ],
            'ar' => [
                'default_font_size'    => '14',
	            'default_font'         => 'amiri',
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'autoArabic' => true
            ],
            'en' => [
                'default_font_size'    => '12',
	            'default_font'         => 'calibri',
            ],
        ];
        
        $pdf = LaravelMpdf::loadView('letterpad.print', [
            'donor' => $donor,
            'amount' => $amount,
            'ref' => $ref,
            'date' => $date,
            'sponsor' => $sponsor,
            'lang' => $lang
        ], [], array_merge([
            'margin_left'          => 15,
            'margin_right'         => 15,
            'margin_top'           => 70,
        ], $lang_conf[$lang]));


        $mpdf = $pdf->getMpdf();
        $mpdf->charset_in='windows-1252';
        // $mpdf->SetSourceFile(public_path('assets/letterpad/muvasath_letterpad.pdf'));
        // $tplId = $mpdf->ImportPage(1);
        // $mpdf->UseTemplate($tplId);
        // $mpdf->text_input_as_HTML = true;

        // $mpdf->writeText(10, 10, $donor);

        

        return $pdf->download("Muvasath_Thanks_letter_{$lang}_{$sponsor->id}_{$date}.pdf");
        // return $pdf->stream();
    }
}
