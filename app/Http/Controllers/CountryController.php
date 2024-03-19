<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function list()
    {
        $Countrys = Country::orderBy('name', 'DESC')->get();
        return view('templates.pages.country_list', compact('Countrys'));
    }

    public function add()
    {
        return view('templates.pages.forms.country_form');
    }

    public function delete($id)
    {
        $Country = Country::where('id', $id)->delete();
        if ($Country) {
            return redirect()->back()->with('success', 'Country deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $Country = Country::where('id', $id)->first();
        if (!$Country) {
            return redirect()->back()->with('error', 'Country not exist!!!');
        }
        return view('templates.pages.forms.country_form', compact('Country'));
    }

    public function editSubmit(Request $req)
    {
        // return $req->all();
        $Country = Country::where('id', $req->id)->first();

        if (!$Country) {
            return redirect()->back()->with('error', 'No Country Found!');
        }

        $Country->name = $req->name;

        if ($Country->save()) {
            return redirect()->route('country.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('country.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $InsertData['name'] = $req->name;
        $Country = Country::create($InsertData);

        if ($Country) {
            return redirect()->route('country.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('country.list')->with('error', 'Something went wrong');
        }
    }
}
