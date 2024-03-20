<?php

namespace App\Http\Controllers;

use PDF;

class InvoiceController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'PDF Example',
            'description' => 'This is an example PDF generated from Laravel.',
        ];

        $pdf = PDF::loadView('templates.pages.Invoice.invoice', $data);
        return $pdf->download('pdf_filename.pdf');
    }
}
