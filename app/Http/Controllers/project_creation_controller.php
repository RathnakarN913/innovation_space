<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class project_creation_controller extends Controller
{

    public function project_creation(Request $request)
    {

        $store = DB::table('create_client')->get();

        $main_data = DB::table('create_project')
            ->leftjoin('create_client', 'create_project.select_client', '=', 'create_client.id')
            ->select('create_client.company_name', 'create_project.*')
            ->get();

        return view('project_creation', compact('store', 'main_data'));
    }

    public function project_insert(Request $request)
    {
        $this->validate(
            $request, [
                'select_client' => 'required',
                'project_name' => 'required',
                'project_code' => 'required',
                'description' => 'required',
            ]);

        DB::table('create_project')->insert([
            'select_client' => $request->select_client,
            'project_name' => $request->project_name,
            'project_code' => $request->project_code,
            'description' => $request->description,

        ]);
        return back()->with('success', 'inserted successfully');
    }

    public function project_edit(Request $request)
    {
    $datas=    DB::table('create_client')->get();
     $id =$request->id;
    //  dd($id);
        $data = DB::table('create_project')
        ->join('create_client', 'create_project.select_client', '=', 'create_client.id')
        ->select('create_client.company_name', 'create_project.*')
        ->where('create_project.id', $id)
        ->first();
// dd($data);
        return view('project_edit', compact('data','datas'));
    }

    public function project_update(Request $request)
    {
          $datays = DB::table('create_project')->where('id', $request->userid)->update([ 
            'project_name' => $request->project_name,
            'project_code' => $request->project_code,
        ]);

        return back();
       }

    public function project_delete(Request $request)
    {
         DB::table('create_project')->where('id', $request->id)->delete();
        return back();
    }

}
