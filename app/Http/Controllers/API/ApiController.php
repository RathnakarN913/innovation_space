<?php
namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CreateProject;
use App\Models\User;
use App\Models\SurveyMst;
use App\Models\ApiSettings;
use Illuminate\Http\Request;
use Validator;

error_reporting(0);

class ApiController extends Controller
{
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
            'response_code' => $code,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'response_code' => $code,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric|min:10',
            'accesskey' => 'required',
            // 'token' => 'required',
        ]);
        $accesskey = $request->accesskey;
        $searchaccekey = ApiSettings::where('id',1)->first();
       // dd($searchaccekey->accesskey); 
        if($searchaccekey->accesskey != $accesskey)
        {
            return response()->json(["message" => 'Access Key Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }
        
        // $token = $request->token;
        // $generatetoken = User::where('remember_token', $request->token)->where('mobile_number', $request->mobile_number)->first();
        // if($generatetoken->remember_token != $token)
        // {
        //     return response()->json(["message" => 'Token Does Not Match','response_code' => '500','status' => 'false']);
        //     exit;
        // }

        if ($validator->fails()) {
        return $this->sendError('Validation Error', $validator->errors());
        } else {
        $random = rand(1000, 9999);
        $mobile_number = $request->mobile_number;
        
        $count = User::where('mobile_number', $mobile_number)->where(['role' => 0])->first();
        if ($count > 0) {
            User::where(['mobile_number' => $mobile_number])->where(['role' => 0])->update(['otp' => $random]);
            $success['token'] = $count->createToken('Innovation')->accessToken;
            $success['mobile_number'] = $mobile_number;
            $success['otp'] = $random;
            // $success['accesskey'] = $accesskey;
            return $this->sendResponse($success, 'Please use otp number for authentication');
        } else {
            $data = ['mobile_number' => $mobile_number, 'otp' => $random, 'login_status' => 1, 'role' => 0, 'remember_token' => $user->createToken('Innovation')->accessToken, 'AccessKey' => $request->accesskey];
            User::insert($data);
            $success['mobile_number'] = $mobile_number;
            $success['otp'] = $random;
            // $success['AccessKey'] = $request->accesskey;
            return $this->sendResponse($success, 'Please use otp number for authentication');
        }
        }
    }

    public function verify_otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric|min:10',
            'otp' => 'required|numeric|min:6',
            'accesskey' => 'required',
        ]);
        $accesskey = $request->accesskey;
        $searchaccekey = ApiSettings::where('id',1)->first();
       // dd($searchaccekey->accesskey); 
        if($searchaccekey->accesskey != $accesskey)
        {
            return response()->json(["message" => 'Access Key Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }

        $token = $request->token;
        $searchaccekey = User::where('mobile_number',$request->mobile_number)->where('remember_token', $request->token)->first();
    //    dd($searchaccekey); 
        if($token != $searchaccekey->remember_token)
        {
            return response()->json(["message" => 'Token Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }

        $mobile_number = $request->mobile_number;
        $credentials = User::where(['mobile_number' => $mobile_number])->where(['otp' => $request->otp])->where(['role' => 0])->first();
        // return $request->otp;
        $Authuser = User::select('id', 'email', 'name', 'primary_contact_name', 'mobile_number', 'role', 'login_status')->where(['mobile_number' => $mobile_number])->where(['otp' => $request->otp])->where(['role' => 2])->first();
        //return response()->json($credentials,200);
        $user = User::where('mobile_number', $request->get('mobile_number'))->where(['role' => 0])->first();

        if (empty($credentials)) {
            $success = $request->all();
            return $this->sendError($success, 'Credientials does not match.');
        } else {
            $otpVerify = $credentials->otp_verified;
            $isUser = $credentials->is_user;
            $login_status = $credentials->login_status;

            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors());
            } else if ($otpVerify == 1 && $login_status == 3) {
                \Auth::login($user);
                // $success['chaitu']= "this zero";
                $success['token'] = $user->createToken('Innovation')->accessToken;
                $success['user_details'] = User::select('id', 'email', 'name', 'primary_contact_name', 'mobile_number', 'role', 'login_status')->where(['mobile_number' => $mobile_number])->where(['otp' => $request->otp])->first();
                return $this->sendResponse($success, 'User login Successfully.');
            } else if (!empty($credentials)) {
                User::where(['mobile_number' => $mobile_number])->update(['otp_verified' => 1, 'login_status' => 2]);
            
                $response['token'] = $user->createToken('Innovation')->accessToken;
                $response['status_code'] = 200;
                $response['message'] = "Successfully Fetched Data.";
              
                $user_details = User::where('mobile_number', $mobile_number)->where('otp', $request->otp)->get();
                // dd($user_details); 
               
                $response['data']['id'] = ($user_details[0]->id) ? $user_details[0]->id : '';
                $response['data']['email'] = ($user_details[0]->email)?$user_details[0]->email:'';
                $response['data']['name'] = ($user_details[0]->name) ? $user_details[0]->name:'';
                $response['data']['primary_contact_name'] = ($user_details[0]->primary_contact_name) ? $user_details[0]->primary_contact_name:'';
                $response['data']['mobile_number'] = ($user_details[0]->mobile_number) ? $user_details[0]->mobile_number : '';
                $response['data']['role'] = ($user_details[0]->role) ? $user_details[0]->role:'';
                $response['data']['login_status'] = ($user_details[0]->login_status) ? $user_details[0]->login_status:'';
               
            echo json_encode($response);
            } else {
                $success['request_data'] = $request->all();
                return $this->sendResponse($success, 'Some thing went wrong.');
            }
        }
    }

    public function select_project(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|numeric',
            'accesskey' => 'required',
        ]);

        $accesskey = $request->accesskey;
        $searchaccekey = ApiSettings::where('id',1)->first();
       // dd($searchaccekey->accesskey); 
        if($searchaccekey->accesskey != $accesskey)
        {
            return response()->json(["message" => 'Access Key Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }

        $tokenfordropdown = $request->token;
        $dropdntokn = User::where('remember_token', $request->token)->first();
    //    dd($dropdntokn); 
        if($tokenfordropdown != $dropdntokn->remember_token)
        {
            return response()->json(["message" => 'Token Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Not Found');
        }

        $project_id = $request->project_id;
        $users = CreateProject::join('mappingserveyor', 'create_project.id', '=', 'mappingserveyor.project_id')
            ->where('mappingserveyor.surveyor_id', $project_id)->get();
        
        if (count($users)>0) {
         
            $response['status_code'] = 200;
            $response['message'] = "Successfully selected project";
            $response['data'] = array();
            foreach ($users as $key => $val) {
                $row['id'] = $val->id;
                $row['project_name'] = $val->project_name;
                array_push($response['data'], $row);
            }
        } else {
            $response['status_code'] = 500;
            $response['message'] = "No Data Found";

        }
        echo json_encode($response);
    }

    public function update_survey_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|numeric',
            'surveyor_id' => 'required|numeric',
            'access_key' => 'required|string',
            'photo' => 'max:5000|required|mimes:jpeg,png,doc,docs,pdf',
        ],
        [
            'photo.required' => 'You have to choose the file!',
            'photo.max' => 'File size should be less than 5MB',
            'photo.mimes' => 'Allow only PDF,images', 
        ]);
        
        $accesskey = $request->access_key;
        $searchaccekey = ApiSettings::where('id',1)->first();
       // dd($searchaccekey->accesskey); 
        if($searchaccekey->accesskey != $accesskey)
        {
            return response()->json(["message" => 'Access Key Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }
        
        $subtfrmdt = $request->token;
        $toeknforsbmt = User::where('remember_token', $request->token)->first();
    //    dd($dropdntokn); 
        if($subtfrmdt != $toeknforsbmt->remember_token)
        {
            return response()->json(["message" => 'Token Does Not Match', 'response_code' => '500', 'status' => 'false']);
            exit;
        }
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Not Found');
        }
        $base_url = url('/public/');
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $existprt_tax_file_name = $file->getClientOriginalName();
            $file->move(public_path('survey_data/photo/'), $filename);
    
            $survery_photos =  $base_url.'/survey_data/photo/'.$filename;
        }
        $insert_array = array(
            'project_id' => $request->project_id,
            'surveyor_id' => $request->project_id,
            'access_key' => $request->access_key,
            'file_path' => $survery_photos,
        );
        $insert_status =  SurveyMst::create($insert_array);

        // $response['status_code'] = 200;
        // $response['message'] = "Successfully Submitted Data";
        // $response['data'] = array();

        if (!empty($insert_status) ) {
         
            $response['status_code'] = 200;
            $response['message'] = "Successfully Submitted Data";
        } else {
            $response['status_code'] = 500;
            $response['message'] = "Invalid Data";

        }
        echo json_encode($response);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
