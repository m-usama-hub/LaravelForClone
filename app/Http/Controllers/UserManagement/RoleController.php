<?php


namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   //dd(Auth::user()->getAllPermissions());
        try {
            $per_page   =   \Request::get('per_page') ?: 12;
            $query      =   Role::query();

            if (!empty($request->name)) {
                $query->where('name','like','%'.$request->name.'%');
            }

            $roles     =   $query->orderBy('id','DESC')->paginate($per_page);

            $pages      =   $roles->appends(\Request::except('page'))->render();

            $data   =   [
                'roles'             =>  $roles,
                'per_page'          =>  $per_page,
                'pages'             =>  $pages,
                'umActive'          =>  1,
                'roleActive'        =>  1,
                'title'             =>  'Role List',
            ];

            return view('Backend.user_management.role.index',$data);

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
        try {

            // $permissions = Permission::get();
            // return view('admin.roles.create',compact('permissions'));
            $permissions = Permission::get();

            $data = [
                'permissions'       =>  $permissions,
                'umActive'          =>  1,
                'roleActive'        =>  1,
                'title'             =>  'Create Role',
            ];
            return view('Backend.user_management.role.create',$data);
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
        try {
            $this->validate($request, [
                'name'          =>  'required|unique:roles,name',
                'permission'    =>  'required',
            ]);

            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            return redirect()->back()->with('message','Role created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
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
        try {
            $role = Role::find($id);
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")->where("role_has_permissions.role_id",$id)
                ->get();

            $rolePermission = [];
            if (isset($rolePermissions) && count($rolePermissions) > 0 ) {
                foreach ($rolePermissions as $key => $role_per) {
                    $rolePermission[] = $role_per->name;
                }
            }
            $data = [
                'role'              =>  $role,
                'rolePermission'    =>  $rolePermission,
                'settingsActive'    =>  1,
                'manageRoleActive'  =>  1,
            ];
            return view('admin.roles.show',$data);
        } catch (Exception $e) {
            abort(404);
        }
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
            $role = Role::find($id);
            $permissions = Permission::get();

            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
                // return $rolePermissions;
            $data   =   [
                'role'              =>  $role,
                'permissions'       =>  $permissions,
                'rolePermissions'   =>  $rolePermissions,
                'umActive'          =>  1,
                'roleActive'        =>  1,
                'title'             =>  'Edit Role',
            ];

            return view('Backend.user_management.role.edit',$data);
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
                'name' => 'required',
                'permission' => 'required',
            ]);

            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();

            $role->syncPermissions($request->input('permission'));

            return redirect()->route('role.index')
                            ->with('message','Role updated successfully');
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
            $role = Role::findOrFail($id);
            $role->revokePermissionTo($role->permissions);

            //DB::table("roles")->where('id',$id)->delete();
            $role->delete();
            return redirect()->route('Backend.role.index')
                            ->with('message','Role deleted successfully');
        } catch (Exception $e) {
            abort(404);
        }
    }
}
