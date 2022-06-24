<?php
namespace App\Http\Controllers\UserManagement;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_type;
use App\Models\Restaurant;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use Hash;
use Config;


class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list');
        $this->middleware('permission:change-password', ['only' => ['showChangePasswordForm','changePassword']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /******************************************
        assign role to a user begin
        *******************************************/
        // $user = User::findOrFail(1);
        // $role = Role::findById(1);
        // $user->assignRole($role->id);
        // dd($user);
        /******************************************
        assign role to a user end
        *******************************************/

        /**************************************
        Check user roles names
        ***************************************/
        // $user = User::findOrFail(1);
        // $roles = $user->getRoleNames(); // Returns a collection
        // dd($roles);
        /**************************************
        Check user roles names
        ***************************************/

        /******************************************
        give all permission to a single role begin
        *******************************************/
        // $role = Role::findById(1);
        // $permissions = Permission::all();
        // $role->syncPermissions($permissions);
        /******************************************
        give all permission to a single role end
        *******************************************/

        /******************************************
        give single permission to a  role begin
        *******************************************/
        // Assign permission to role
        // $role           =   Role::findById(1);
        // $permission     =   Permission::findById(1);
        // $role->givePermissionTo($permission);
        // dd($permission);

        // role to a  permission
        // $role           =   Role::findById(1);
        // $permission     =   Permission::findById(2);
        // $permission->assignRole($role);
        // dd($permission);
        /******************************************
        give single permission to a  role end
        *******************************************/

        /**************************************
        Check user all permissions begin
        ***************************************/
        // $user = User::findOrFail(1);
        // $permissions = $user->getAllPermissions();
        // dd($permissions);
        /**************************************
        Check user all permissions end
        ***************************************/

        /**************************************
        Assign permission to user begin
        ***************************************/
        // $user = User::findOrFail(1);
        // $user->givePermissionTo('role-list');
        // dd($user);
        /**************************************
        Assign permission to user end
        ***************************************/

        /**************************************
        Check user all permissions begin
        ***************************************/
        // $user = User::findOrFail(1);
        // $permissions = $user->getPermissionsViaRoles();
        // dd($permissions);
        /**************************************
        Check user all permissions end
        ***************************************/


        /**************************************
        Revoke role permission begin
        ***************************************/
        // $role = Role::findOrFail(1);
        // $permission = Permission::all();
        // $role->revokePermissionTo($permission);
        // dd($permission);
        /**************************************
        Revoke role permission end
        ***************************************/


        // //$role->hasPermissionTo(1);
        // //print_r($permissions);
        // $data = User::orderBy('id','DESC')->paginate(5);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        try {
            $per_page   =   \Request::get('per_page') ?: 12;
            $query      =   User::query();

            if(Auth::user()->isSuperAdminLoggedIn() || Auth::user()->isAdminLoggedIn())
            {

            }

            $NotInUserType = [Config::get("constants.UserTypeIds.SuperAdmin")];
            $query->whereNotIn("user_type_id" , $NotInUserType);
            $query->with("UserType");
            if (!empty($request->name)) {
                $query->where('name','like','%'.$request->name.'%');
            }
            if (!empty($request->user_type_id)) {
                $query->where('user_type_id',$request->user_type_id);
            }

            $users     =   $query->orderBy('id','DESC')->paginate($per_page);

            $user_types = User_type::whereNotIn('id', $NotInUserType)->get();
            $user_types = User_type::get();

            $pages      =   $users->appends(\Request::except('page'))->render();
            // dd($users);
            $data = [
                'users'             =>  $users,
                'user_types'             =>  $user_types,
                'umActive'          =>  1,
                'userActive'        =>  1,
                'per_page'          =>  $per_page,
                'pages'             =>  $pages,
                'title'             =>  'User List',
            ];
            return view('Backend.user_management.user.index',$data);
        } catch (Exception $e) {
            abort(404);
        }

    }

    public function showChangePasswordForm()
    {
        try {
            $data = [
                'settingsActive'        =>  1,
                'changepasswordActive'  =>  1,
            ];
            return view('admin.passwords.change',$data);
        } catch (Exception $e) {
            abort(404);
        }

    }

    public function changePassword(Request $request)
    {
        try {
            $data = $request->validate([
                'oldPassword'   => 'required',
                'password'      => 'required|confirmed',
            ]);

            auth()->user()->update(['password' => bcrypt($data['password'])]);

            return redirect(route('password.change'))->with('message', 'Your password is changed successfully');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            // $roles = Role::pluck('name','name')->all();
            // return view('users.create',compact('roles'));
            $roles = Role::all();
            // $user_types = User_type::whereNotIn();
            // return $user_types;
            $data = [
                'roles'             =>  $roles,
                // 'user_types'        =>  $roles,
                'umActive'          =>  1,
                'userActive'        =>  1,
                'title'             =>  'Create New User',
            ];
            return view('Backend.user_management.user.create',$data);
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        try {
            $this->validate($request, [
                'name'              =>  'required',
                'email'             =>  'required|email|unique:users,email',
                'password'          =>  'required|same:confirm-password',
                'user_type_id'      =>  'required',
                'roles'             =>  'required',
                'status'            =>  'required',
            ]);

            $input = $request->all();

            $input['password'] = Hash::make($input['password']);
            // $input['user_type_id'] = Config::get('constants.UserTypeIds.Admin');

            // dd($input);

            $user = User::create($input);


            $user->assignRole($request->input('roles'));

            return redirect()->route('user.index')
                            ->with('message','User created successfully');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $user = User::find($id);
        // return view('users.show',compact('user'));
        $data = [
            'user'              =>  $user,
            'manageUserActive'  =>  1,
            'settingsActive'    =>  1,
        ];
        return view('Backend.user_management.user.index',$data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            // $user = User::find($id);
            // $roles = Role::pluck('name','name')->all();
            // $userRole = $user->roles->pluck('name','name')->all();
            // return view('users.edit',compact('user','roles','userRole'));
            //$user       =   User::find($id);
            $roles      =   Role::all();
            $userRole = $user->roles->pluck('name','name')->all();
            // //dd($userRole);
            // foreach ($roles as $key => $value) {
            //     //echo $value->name."<br>";
            //     echo isset($userRole[$value->name])?$userRole[$value->name]:'';
            // }
            // die();
            $data = [
                'user'              =>  $user,
                'roles'             =>  $roles,
                'userRole'          =>  $userRole,
                'umActive'          =>  1,
                'userActive'        =>  1,
                'title'             =>  'Edit User',
            ];
            return view('Backend.user_management.user.edit',$data);
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
        // return $request->all();

        try {
            $this->validate($request, [
                'name'          =>  'required',
                'email'         =>  'required|email|unique:users,email,'.$id,
                // 'password'      =>  'same:confirm-password',
                'roles'         =>  'required',
                // 'isApproved'        =>  'required',
            ]);

            $input = $request->all();
            if(!empty($input['password']) && $request->password != null){
                $input['password'] = Hash::make($input['password']);
            }else{
                unset($input['password']);
                //$input = array_except($input,array('password'));
            }

            $user = User::find($id);
            $user->update($input);
            // $SellerIfExist = Seller::where("userId" , $id)->first();
            // if ($SellerIfExist)
            // {
            //     $UpdateSellerStatus = Seller::where("userId" , $id)->update(["isApproved" => $request->isApproved]);
            // }
            DB::table('model_has_roles')->where('model_id',$id)->delete();

            // dd($request->input('roles'));

            foreach ($request->input('roles') as $key => $role) {
                $user->assignRole($role);
            }


            return redirect()->route('user.index')->with('message','User updated successfully');
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
        try {
            User::find($id)->delete();
            return redirect()->route('user.index')
                            ->with('message','User deleted successfully');
        } catch (Exception $e) {
            abort(404);
        }
    }
}
