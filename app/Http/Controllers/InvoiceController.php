<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Client;
use App\Models\PaymentHistory;
use DateTime;
class InvoiceController extends Controller
{
    public function generatePDF($client_id)
    {
        $data = Client::findOrFail($client_id);
        $histories = PaymentHistory::where('client_id', $client_id)->get();
        $dateString = $data->created_at;
        $date = new DateTime($dateString);
        $data = [
            'type' => "pdf",
            'name' => $data->name,
            'phone' => $data->phone,
            'country' => $data->country->name ?? "-",
            'date' => $date->format('jS F Y'),
            'amount' => $data->amount,
            'pen_amount' => ( (int) $data->amount - (int) $data->getPaymentSum() < 0 ? 0 :  (int) $data->amount -  (int) $data->getPaymentSum()),
            'paid_amount' => $data->getPaymentSum(),
            'histories' => $histories,
            'invoice_date' => date('d/m/Y'),
            'invoice_id' => ''
        ];

        $pdf = PDF::loadView('templates.pages.Invoice.invoice', $data);
        return $pdf->download($data["name"].'_invoice.pdf');
    }

    public function generatePrint($client_id)
    {
        $data = Client::findOrFail($client_id);
        $histories = PaymentHistory::where('client_id', $client_id)->get();
        $dateString = $data->created_at;
        $date = new DateTime($dateString);
        $data = [
            'type' => "print",
            'name' => $data->name,
            'phone' => $data->phone,
            'country' => $data->country->name ?? "-",
            'date' => $date->format('jS F Y'),
            'amount' => $data->amount,
            'pen_amount' => ( (int) $data->amount -  (int) $data->getPaymentSum() < 0 ? 0 :  (int) $data->amount -  (int) $data->getPaymentSum()),
            'paid_amount' => $data->getPaymentSum(),
            'histories' => $histories,
            'invoice_date' => date('d/m/Y'),
            'invoice_id' => ''
        ];

        $pdf = PDF::loadView('templates.pages.Invoice.invoice', $data);
        return $pdf->stream($data["name"].'_invoice.pdf');
    }
}
