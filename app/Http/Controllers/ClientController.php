<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Country;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function list()
    {
        return view('templates.pages.clients_list');
    }

    public function adminList()
    {
        return view('templates.pages.admin_clients_list');
    }

    public function view($id)
    {
        $client = Client::findOrFail($id);
        $historys = PaymentHistory::where('client_id', $id)->get();

        return view('templates.pages.clients_view', compact('client', 'historys'));
    }

    public function add()
    {
        $countries = Country::all();
        return view('templates.pages.forms.clients_form', compact('countries'));
    }

    public function delete($id)
    {
        $client = Client::where('id', $id)->delete();
        if ($client) {
            return redirect()->back()->with('success', 'Client deleted succesfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $client = Client::where('id', $id)->first();
        if (!$client) {
            return redirect()->back()->with('error', 'Client not exist!!!');
        }
        $countries = Country::all();

        return view('templates.pages.forms.clients_form', compact('client', 'countries'));
    }

    public function editSubmit(Request $req)
    {

        $client = Client::findOrFail($req->id);
        $client->name = $req->name;
        $client->file_submitted = $req->file_submitted;
        $client->enq_status = $req->enq_status;
        $client->address = $req->address;
        $client->amount = $req->amount;
        $client->country_id = $req->country_id;

        if ($client->save()) {
            return redirect()->route(auth()->user()->role == "Admin" ? 'admin.client.list' : 'client.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route(auth()->user()->role == "Admin" ? 'admin.client.list' : 'client.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $ifExist = Client::where('phone', $req->phone)->first();

        if ($ifExist) {
            return redirect()->back()->with('error', 'Phone number already exist!!!');
        }
        $client = Client::create(
            ['user_id' => auth()->user()->id, 'name' => $req->name, 'country_id' => $req->country_id, 'amount' => $req->amount, 'phone' => $req->phone, 'file_submitted' => $req->file_submitted, 'enq_status' => $req->enq_status, 'address' => $req->address]
        );

        if ($client) {
            return redirect()->route('client.view', $client->id)->with('success', 'Succesfully created');
        } else {
            return redirect()->route('client.view', $client->id)->with('error', 'Something went wrong');
        }
    }

    public function datatblesList(Request $request)
    {
        $data = Client::where('user_id', auth()->user()->id)->orderBy('id', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Client $client) {
                return '<div class="d-flex">
                    <a href="' . route('client.view', $client->id) . '" class="mx-2"><i class="fa-solid fa-eye"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('client.delete', $client->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('client.edit', $client->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->addColumn('country', function (Client $client) {
                return $client->country->name ?? "-";
            })
            ->addColumn('payment', function (Client $client) {
                return $client->payment->sum('amount') ?? "-";
            })
            ->rawColumns(['actions', 'country', 'payment'])
            ->make(true);
    }

    public function adminDatatblesList(Request $request)
    {
        $data = Client::orderBy('id', 'desc')->get(); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Client $client) {
                return '<div class="d-flex">
                    <a href="' . route('client.view', $client->id) . '" class="mx-2"><i class="fa-solid fa-eye"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('client.delete', $client->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('client.edit', $client->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->addColumn('country', function (Client $client) {
                return $client->country->name ?? "-";
            })
            ->addColumn('emp', function (Client $client) {
                return $client->employee->name ?? "-";
            })
            ->rawColumns(['actions', 'country'])
            ->make(true);
    }
}
