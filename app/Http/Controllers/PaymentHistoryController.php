<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    public function addSubmit(Request $req)
    {
        $payment = PaymentHistory::create(
            ['client_id' => $req->client_id, 'amount' => $req->amount, 'note' => $req->note]
        );

        if ($payment) {
            return redirect()->back()->with('success', 'Succesfully payment added');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
