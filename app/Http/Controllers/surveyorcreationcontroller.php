<?php

namespace App\Http\Controllers;
use App\Models\surveyor;
use App\Models\state;
use App\Models\country;
use App\Models\mappingserveyor;
use App\Models\users;
use App\Models\User;
use App\Models\banks;
use App\Models\ifsc;
use App\Models\gender;

use Illuminate\Http\Request;
use DB;
use Session;
use Image;
class surveyorcreationcontroller extends Controller
{
  
public function surveyor()
{        $bank=banks::all();
          $ifsc=ifsc::all();
          $gender=gender::all();
         $state=state::all();
         $country=country::all();
         $data=DB::table('surveyor')
               ->join('countries', 'surveyor.country', '=', 'countries.id')
               ->join('states', 'surveyor.state', '=', 'states.id')
               ->join('banknames', 'surveyor.bankname_id', '=', 'banknames.id')
               ->join('ifsc', 'surveyor.ifsc_id', '=', 'ifsc.id')
               ->join('gender', 'surveyor.gender_id', '=', 'gender.id')
               ->select('countries.country_name', 'states.state_name','banknames.bankname','ifsc.ifsc','gender.gender','surveyor.*')
               ->get(); 
//dd($data);
 return view('surveyor',compact('state','country','data','bank','ifsc','gender'));

}

public function insert_serveyor(Request $request){
   //  dd($request->all());
    $this->validate($request,[
     
            'name'=>'required',
            'mobilenumber'=>'required|unique:surveyor',
            'emailid'=>'required|unique:surveyor',
            'state'=>'required',
            'country'=>'required',
            'pincode'=>'required',
            'age'=>'required',
            'gender_id'=>'required',
            'file'=>'required',
            'bankname_id'=>'required',
            'ifsc_id'=>'required',
            'accountnumber'=>'required',
            'remarks'=>'required',

          ]);
      
          $name=$request->name;
          $mobilenumber=$request->mobilenumber;
          $emailid=$request->emailid;
          $state=$request->state;
          $country=$request->country;
          $pincode=$request->pincode;
          $age=$request->age;
          $gender=$request->gender_id;

         
         
         $file=$request->file('file');
         //dd($file);
         $filename=$file->getClientOriginalName();
         $file->move(base_path('/public/images'),$filename);

         $bankname=$request->bankname_id;
         $ifsc=$request->ifsc_id;
         $accountnumber=$request->accountnumber;

          $remarks=$request->remarks;
               
               surveyor::create([
                     'name'=>$name,
                     'mobilenumber'=>$mobilenumber,
                     'emailid'=>$emailid,
                     'state'=>$state,
                     'country'=>$country,
                     'pincode'=>$pincode,
                     'age'=>$age,
                     'gender_id'=>$gender,
                     'file'=>$filename,
                     'bankname_id'=>$bankname,
                     'ifsc_id'=> $ifsc,
                     'accountnumber'=>$accountnumber,
                     'remarks'=>$remarks,
                    
                     ]);
       return back()->with('success', 'data inserted successfully');
       }

     public function changestate(Request $request){
            $country=$request->countryid;
            $state= DB::table('states')->where('country_id','=',$country)->get();
         //dd($state);
            $html="<option value=''>--Select state --</option>";

         foreach($state as $sta){
             $html .="<option value=".$sta->id.">".$sta->state_name."</option>";
          
         }

         return response()->json($html);
      
      }
      
      public function surveyoredit(Request $request){
                     $id=$request->id;
                     $data=surveyor::where('id',$id)->first();
                     $state=state::all();
                     $country=country::all();
                     $bank=banks::all();
                     $ifsc=ifsc::all();
                   $gender=gender::all();
// dd($data);
         return view('surveyoredit',compact('data','country','state','bank','ifsc','gender'));
         
         
         }
         
         public function surveyordelete(Request $request){
                 surveyor::where('id',$request->id)->delete();

     return back()->with('success','record deleted successfully');
         
         }
         

         public function updatesurveyor(Request $request) {
            //dd($request->all());
            $name=$request->name;
                   $mobilenumber=$request->mobilenumber;
                   $emailid=$request->emailid;
                   $state=$request->state;
                   $country=$request->country;
                   $pincode=$request->pincode;
                   $age=$request->age;
                   $gender=$request->gender_id;
                   $file=$request->file('file');
                   //dd($file);
                   $filename=$file->getClientOriginalName();
                  $file->move(base_path('/public/images'),$filename);
                  

                
                  $bankname=$request->bankname_id;
                  $ifsc=$request->ifsc_id;
                  $accountnumber=$request->accountnumber;
                  $remarks=$request->remarks;
                      
               
          $class = surveyor::where('id',$request->userid)->update([
         
                     'name'=>$name,
                     'mobilenumber'=>$mobilenumber,
                     'emailid'=>$emailid,
                     'state'=>$state,
                     'country'=>$country,
                     'pincode'=>$pincode,
                     'age'=>$age,
                     'gender_id'=>$gender,
                     'file'=>$filename,
                     'bankname_id'=>$bankname,
                     'ifsc_id'=> $ifsc,
                     'accountnumber'=>$accountnumber,
                     'remarks'=>$remarks,
               ]);
             
              
         return back()->with('success','updated successfully');
          }

          
      public function mappingsurveyor(){
               $state=state::all();
            $country=country::all();
            $surveyor=surveyor::all();
            $users=users::all();

     $main_data=DB::table('mappingserveyor')

         ->leftjoin('create_project', 'mappingserveyor.project_id', '=', 'create_project.id')
         ->leftjoin('countries', 'mappingserveyor.country_id', '=', 'countries.id')
         ->leftjoin('states', 'mappingserveyor.state_id', '=', 'states.id')
         ->leftjoin('surveyor', 'mappingserveyor.surveyor_id', '=', 'surveyor.id')
         ->select('mappingserveyor.*', 'create_project.project_name','countries.country_name','states.state_name',
         DB::raw('group_concat(surveyor.name SEPARATOR  "<br>")  as name'))
         ->groupBy('mappingserveyor.project_id')
         ->get();
         // dd($data);

      return view('mappingsurveyor',compact('state','country','surveyor','users','main_data'));

       }

       public function mappingsurveyor_insert(Request $request){

//dd($request->all());
         $this->validate($request,[
      
            'country'=>'required',
            'state'=>'required',
            'project_id'=>'required',
            'surveyors'=>'required',
            'city'=>'required',
            'fieldoffice'=>'required',
            'workcenter'=>'required',
            'address'=>'required',
      
         ]);
      
               $country=$request->country;
               $state=$request->state;
               $project=$request->project_id;
               $surveyor=$request->surveyors;
               $city=$request->city;
               $fieldoffice=$request->fieldoffice;
               $workcenter=$request->workcenter;
               $address=$request->address;

         $survyorcount= mappingserveyor::where('project_id',$project)->count();
         if( $survyorcount>0){
            mappingserveyor::where('project_id',$project)->delete();
         }
        
         foreach($surveyor as $key=>$value){
           mappingserveyor::create([
                     'country_id'=>$country,
                     'state_id'=>$state,
                     'project_id'=>$project,
                  'surveyor_id'=>$surveyor[$key],
                  'city'=>$city,
                  'fieldoffice'=>$fieldoffice,
                  'workcenter'=>$workcenter,
                  'address'=>$address,

            ]);   
           }
         return back()->with('success', 'data inserted successfully');
      
      }


      public function mappingsurveyor_ajax(Request $request){
               $country=$request->countryid;
               $state= DB::table('states')->where('country_id','=',$country)->get();
            //   dd($state);
               $html="<option value=''>--Select state--</option>";

         foreach($state as $sta){
             $html .="<option value=".$sta->id.">".$sta->state_name."</option>";
          
         }

   }
     public function changeproject(Request $request){
            $id=$request->id;
            $data['map']= mappingserveyor::where('project_id',$id)->get();
            $data['surveyor']= surveyor::get();
         $maphtml= view('ajax.surveyors',$data)->render();
         //dd($pro);

               if($data['surveyor']->count() >0){
                  echo $maphtml;   
               }else{
                  echo "no results found";    
               }
               
               }
   


               public function getifsc(Request $request){
               
                  $bank=$request->bankid;
                  // dd($bank);
                  $ifsc= DB::table('ifsc')->where('bank_id','=',$bank)->get();
               //   dd($ifsc);
                  $html="<option value=''>--Select ifsc--</option>";
  
            foreach($ifsc as $item){
               echo  $html .="<option value=".$item->id.">".$item->ifsc."</option>";

          

            }
 }
}