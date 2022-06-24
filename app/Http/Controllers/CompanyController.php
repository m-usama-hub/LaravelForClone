<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Auth;
use DB;
use AppHelper;
use Config;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $per_page   =   \Request::get('per_page') ?: 12;
            $query      =   Company::query();

            if(Auth::user()->isSuperAdminLoggedIn() || Auth::user()->isAdminLoggedIn())
            {
                if (!empty($request->name)) {
                    $name = $request->name;
                    $query->whereHas('User', function($q) use ($name){
                        $q->where('name','like','%'.$name.'%');
                    });
                }

                if (!empty($request->email)) {
                    $email = $request->email;
                    $query->whereHas('User', function($q){
                        $q->where('email','like','%'.$email.'%');
                    });
                }

                if (!empty($request->status)) {
                    $query->where('status', $request->status);
                }

            }

            

            $companies = $query->orderBy('id','DESC')->paginate($per_page);

            $pages = $companies->appends(\Request::except('page'))->render();

            $users = User::whereHas('roles', function($q){
                $q->where('name', '=', 'Organization');
            })->doesntHave('OrganizationDetail')->get();
            
            $data = [
                'companies' => $companies,
                'per_page' => $per_page,
                'pages' => $pages,
                'users' => $users,
                'title' => 'Organizations list',
            ];
            return view('Backend.pages.companies',$data);
        } catch (Exception $e) {
            abort(404);
        }
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
        $ErrorMsg = "";
        $response = [];
        DB::beginTransaction();
        try
        {
            if(Auth::user()->isAdminLoggedIn() || Auth::user()->isSuperAdminLoggedIn()){

                $data = $request->all();

                unset($data['_method']);
                unset($data['_token']);

                if($request->has('profile_pic')){

                    $UploadFile =  AppHelper::SaveFileAndGetPath($request->profile_pic,Config::get('constants.attachment_paths.OrganizationProfile'));

                    if($UploadFile['status']){

                        $data['profile_pic'] = $UploadFile['path'];

                    }
                    else{

                        $ErrorMsg = $UploadFile['msg'];

                    }

                }

                if($ErrorMsg == ''){
                    
                    Company::create($data);

                    $response['status'] = true;
                    $response['message'] = 'Company Added successfully';
                    
                }

            }

        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = $e->getMessage();
        }

        if ($ErrorMsg == "") {
            DB::commit();
            return response()->json($response, 200);
        } else {
            $response['message'] = $ErrorMsg;
            $response['status'] = false;
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['message'] = '';
        $data['status'] = false;

        try{

            $data['data'] = Company::findOrFail($id);
            $data['status'] = true;


        }catch(\Throwable $e){

            $data['message'] = $e->getMessage();

        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['message'] = '';
        $data['status'] = false;

        try{

            $data['data'] = Company::findOrFail($id);
            $data['status'] = true;


        }catch(\Throwable $e){

            $data['message'] = $e->getMessage();

        }

        return $data;
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
        $ErrorMsg = "";
        $response = [];
        DB::beginTransaction();
        try
        {
            if(Auth::user()->isAdminLoggedIn() || Auth::user()->isSuperAdminLoggedIn()){

                $data = $request->all();

                unset($data['_method']);
                unset($data['_token']);

                if($request->has('profile_pic')){

                    $UploadFile =  AppHelper::SaveFileAndGetPath($request->profile_pic,Config::get('constants.attachment_paths.OrganizationProfile'));

                    if($UploadFile['status']){

                        $data['profile_pic'] = $UploadFile['path'];

                    }
                    else{

                        $ErrorMsg = $UploadFile['msg'];

                    }

                }

                if($ErrorMsg == ''){
                    
                    Company::where('id',$id)->update($data);

                    $response['status'] = true;
                    $response['message'] = 'Company updated successfully';
                    
                }

            }

        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = $e->getMessage();
        }

        if ($ErrorMsg == "") {
            DB::commit();
            return response()->json($response, 200);
        } else {
            $response['message'] = $ErrorMsg;
            $response['status'] = false;
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id',$id)->delete();

        return redirect()->back()->with('message','Deleted Successfully');
    }
}
