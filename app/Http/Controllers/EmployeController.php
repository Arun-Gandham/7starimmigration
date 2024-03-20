<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DateTime;

class EmployeController extends Controller
{
    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('templates.pages.emp_view',compact('user'));
    }

    public function list()
    {
        return view('templates.pages.emp_list');
    }

    public function add()
    {
        return view('templates.pages.forms.emp_form');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'User deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not exist!!!');
        }
        return view('templates.pages.forms.emp_form', compact('user'));
    }

    public function editSubmit(Request $req)
    {
        $ifExists = User::where('id', '!=', $req->id)->where('phone', $req->phone)->first();

        if ($ifExists) {
            return redirect()->back()->with('error', 'Phone number already exist!!!');
        }

        $user = User::findOrFail($req->id);
        $user->email = $req->email;
        $user->name = $req->username;
        $user->role = $req->role;
        $user->phone = $req->phone;

        if ($req->password) {
            $user->password = $req->password;
        }

        if ($user->save()) {
            return redirect()->route('emp.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('emp.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $ifExist = User::where('phone', $req->phone)->first();

        if ($ifExist) {
            return redirect()->back()->with('error', 'Phone number already exist!!!');
        }

        $users = User::create(
            ['name' => $req->username, 'email' => $req->email, 'phone' => $req->phone, 'role' => $req->role, 'password' => $req->password]
        );

        if ($users) {
            return redirect()->route('emp.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('emp.list')->with('error', 'Something went wrong');
        }
    }

    public function datatblesList(Request $request)
    {
        $data = User::select(['id', 'name', 'phone', 'role'])->where('id', '!=', 1)->where('role', 'Emp')->orderBy('id', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (User $user) {
                return '<div class="d-flex">
                    <a href="' . route('emp.delete', $user->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('emp.edit', $user->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->addColumn('name_link', function (User $user) {
                return '<a href="'.route("emp.view", $user->id).'">'.$user->name.'</a>';
            })
            ->addColumn('client_count', function (User $user) {
                return $user->getClientCount();
            })
            ->rawColumns(['actions','name_link'])
            ->make(true);
    }

    public function clientListByEmployee($id)
    {
        $data = Client::where('user_id',$id)->orderBy('id', 'desc')->get(); // Replace with your model and desired columns
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
            ->addColumn('date', function (Client $client) {
                $dateString = $client->created_at;
                $date = new DateTime($dateString);
                return $date->format('jS F Y');
            })
            ->rawColumns(['actions', 'country'])
            ->make(true);
    }
}
