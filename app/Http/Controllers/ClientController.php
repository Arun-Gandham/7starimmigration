<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function list()
    {
        return view('templates.pages.clients_list');
    }

    public function add()
    {
        return view('templates.pages.forms.clients_form');
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
        return view('templates.pages.forms.clients_form', compact('client'));
    }

    public function editSubmit(Request $req)
    {

        $user = Client::findOrFail($req->id);
        $user->name = $req->name;
        $user->file_submitted = $req->file_submitted;
        $user->enq_status = $req->enq_status;
        $user->address = $req->address;
        $user->amount = $req->amount;

        if ($req->password) {
            $user->password = $req->password;
        }

        if ($user->save()) {
            return redirect()->route('client.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('client.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $ifExist = Client::where('phone', $req->phone)->first();

        if ($ifExist) {
            return redirect()->back()->with('error', 'Phone number already exist!!!');
        }
        $users = Client::create(
            ['user_id' => auth()->user()->id, 'name' => $req->name, 'amount' => $req->amount, 'phone' => $req->phone, 'file_submitted' => $req->file_submitted, 'enq_status' => $req->enq_status, 'address' => $req->address]
        );

        if ($users) {
            return redirect()->route('client.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('client.list')->with('error', 'Something went wrong');
        }
    }

    public function datatblesList(Request $request)
    {
        $data = Client::where('user_id', auth()->user()->id)->orderBy('id', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Client $client) {
                return '<div class="d-flex">
                    <a href="' . route('client.delete', $client->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('client.edit', $client->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
