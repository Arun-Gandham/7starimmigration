<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use App\Models\ClientTimeline;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    public function addSubmit(Request $req)
    {
        $change["type"] = "payment";
        $change["message"] = $req->amount." payment added.";
        $change["amount"] = $req->amount;
        ClientTimeline::create(
            ['client_id' => $req->client_id, 'change' => serialize($change), 'user_id' => auth()->user()->id]
        );
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
