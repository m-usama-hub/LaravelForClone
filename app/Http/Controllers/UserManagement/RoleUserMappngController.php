<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_type;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleUserMappngController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:user-list');
    //     $this->middleware('permission:change-password', ['only' => ['showChangePasswordForm','changePassword']]);
    //     $this->middleware('permission:user-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $per_page   =   \Request::get('per_page') ?: 12;
            $query      =   User_type::query();


            $user_types     =   $query->orderBy('id','DESC')->get();

            // $pages      =   $user_types->appends(\Request::except('page'))->render();
            // dd($user_types);
            $data = [
                // 'users'             =>  $users,
                'user_types'             =>  $user_types,
                'umActive'          =>  1,
                'userActive'        =>  1,
                'per_page'          =>  $per_page,
                // 'pages'             =>  $pages,
                'title'             =>  'User Types List',
            ];
            return view('Backend.user_management.user_type.index',$data);
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
        //
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
        try {

            $user_type = User_type::where('slug',$id)->first();
            $roles = Role::all();
            
            $data = [
                'user_type'              =>  $user_type,
                'roles'  => $roles,
                'title'             =>  'Edit User Type Roles',
            ];
            return view('Backend.user_management.user_type.edit',$data);
        } catch (Exception $e) {
            abort(404);
        }
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
        
        try {
            $this->validate($request, [
                'roles'         =>  'required',
            ]);

            $user_type = User_type::where('slug',$id)->first();

            DB::table('model_has_roles')->where('model_id',$user_type->id)->delete();

            $user_type->assignRole($request->roles);

            return redirect()->route('mapping.index')->with('message','Roles updated successfully');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
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
        //
    }
}
