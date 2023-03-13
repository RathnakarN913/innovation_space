<?php

namespace App\Http\Controllers;
use App\Models\{client_creation,country,state};
use DB;
use Illuminate\Http\Request;

class create_client_controller extends Controller
{

    public function create_client(Request $request)
    {

        $country = country::all();
        $state = state::all();
        $data = DB::table('create_client')
              ->join('countries', 'create_client.country_id', '=', 'countries.id')
              ->join('states', 'create_client.states_id', '=', 'states.id')
              ->select('states.state_name', 'countries.country_name', 'create_client.*')
              ->get();

        return view('create_client', compact('data', 'state', 'country'));
    }

    public function store_client(Request $request)
    {
        //    dd($request->all());
        $validated = $request->validate([
            'companyname' => 'required',
            'personname' => 'required',
            'email' => 'required|email|unique:create_client',
            'mobile' => 'required|numeric|unique:create_client,mobile_number',
            'pannumber' => 'required',
            'gstnumber' => 'required',
            'state' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);
           client_creation::insert([

            'company_name' => $request->companyname,
            'consult_person_name' => $request->personname,
            'email' => $request->email,
            'mobile_number' => $request->mobile,
            'pan_number' => $request->pannumber,
            'gst_number' => $request->gstnumber,
            'states_id' => $request->state,
            'country_id' => $request->country,
            'address' => $request->address,
           ]);

        return back()->with('success', 'client inserted successfully');

    }

    public function country_ajax(Request $request)
    {
        $countries = $request->countries;
        $results = DB::table('states')->where('country_id', '=', $countries)->get();

        return response()->json(['status' => 200, 'store' => $results]);
    }
    public function client__view(Request $request)
    {

        $id = $request->id;
        $country = country::all();
        $state = state::all();
        $data = DB::table('create_client')
            ->join('countries', 'create_client.country_id', '=', 'countries.id')
            ->join('states', 'create_client.states_id', '=', 'states.id')
            ->select('states.state_name', 'countries.country_name', 'create_client.*')
            ->where('create_client.id',$id)
            ->first();
// dd($data);
        return view('client_edit', compact('data', 'country', 'state'));
    }
    public function client_update(Request $request)
    {



        client_creation::where('id', $request->userid)->update([
            'company_name' => $request->companyname,
            'consult_person_name' => $request->personname,
            'mobile_number' => $request->mobile,
            'email' => $request->email,
            'pan_number' => $request->pannumber,
            'gst_number' => $request->gstnumber,
            'country_id' => $request->country,
            'states_id' => $request->state,
          
        ]);
        return back()->with('success','updated successfully');
    }
    public function client_delete(Request $request)
    {
        client_creation::where('id', $request->id)->delete();

        return back();
    }

}