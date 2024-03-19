<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function list()
    {
        return view('templates.pages.admins_list');
    }

    public function add()
    {
        return view('templates.pages.forms.admin_form');
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
        return view('templates.pages.forms.admin_form', compact('user'));
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
        $user->phone = $req->phone;
        $user->role = $req->role;

        if ($req->password) {
            $user->password = $req->password;
        }

        if ($user->save()) {
            return redirect()->route('admin.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('admin.list')->with('error', 'Something went wrong');
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
            return redirect()->route('admin.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('admin.list')->with('error', 'Something went wrong');
        }
    }

    public function datatblesList(Request $request)
    {
        $data = User::select(['id', 'name', 'phone', 'role'])->where('id', '!=', 1)->where('role', 'Admin')->orderBy('id', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (User $user) {
                return '<div class="d-flex">
                    <a href="' . route('admin.delete', $user->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('admin.edit', $user->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
