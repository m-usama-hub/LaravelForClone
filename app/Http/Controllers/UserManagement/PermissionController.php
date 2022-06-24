<?php
namespace App\Http\Controllers\UserManagement;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission as tbl_permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use Hash;
use Artisan;


class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-list', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Auth::user()->getAllPermissions();
        $permissions = tbl_permission::orderby('created_at','DESC')->get();
        // dd($permissions);
        return view('Backend.user_management.permission.create_permission',compact('permissions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return DB::select("select id,name,guard_name,created_at,DATE_FORMAT(created_at, '%d-%m-%Y %W %r') as FormatedCreated_at from permissions order by id desc");
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
        DB::beginTransaction();
        try
        {
            if (tbl_permission::where('name', $request->permission_name)->count() > 0) {
                $ErrorMsg = "This Permission is already exist.";
            }

            if ($ErrorMsg == "")
            {
                $create = tbl_permission::create([
                    "name" => $request->permission_name,
                    "guard_name" => "web",
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Permission cannot be Saved at this time. Exception Msg : " . $e->getMessage();
        }

        if ($ErrorMsg == "") {
            DB::commit();
            $DataSet = $this->create();
            return redirect()->back()->with('message','Permission created successfully');

        } else {
            DB::commit();
            return array('reply' => 0, 'msg' => $ErrorMsg);
        }
    }

    public function EditPermission(Request $request)
    {
        $ErrorMsg = "";
        DB::beginTransaction();
        try
        {
            $id = $request->input('id');
            $name = $request->input('permission_name');

            if (tbl_permission::where('name', $name)
                ->where('id', '!=', $id)
                ->count() > 0) {
                $ErrorMsg = "This Permission is already exist.";
            }

            if ($ErrorMsg == "") {
                $Update = tbl_permission::where('id', $id)
                                    ->update(['name' => $name]);

                $ClearPermissionCache = Artisan::call('permission:cache-reset');

            }

        } catch (Exception $e) {
            DB::rollback();
            $ErrorMsg = "Permission cannot be Saved at this time. Exception Msg : " . $e->getMessage();
        }

        if ($ErrorMsg == "") {
            DB::commit();
            $DataSet = $this->create();
            return array('reply' => 1, 'DataSet' => $DataSet, 'msg' => 'Permission has been Updated Successfully!');
        } else {
            DB::commit();
            return array('reply' => 0, 'msg' => $ErrorMsg);
        }
    }

    public function DeletePermission(Request $request)
    {
        // return $request->all();
        $ErrorMsg = "";
        DB::beginTransaction();
        try
        {
            if ($ErrorMsg == "")
            {
                $delete = tbl_permission::find($request->id)->delete();
            }

        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Permission cannot be Saved at this time. Exception Msg : " . $e->getMessage();
        }

        if ($ErrorMsg == "") {
            DB::commit();
            $DataSet = $this->create();
            return array('reply' => 1, 'DataSet' => $DataSet, 'msg' => 'Permission has been Saved Successfully!');
        } else {
            DB::commit();
            return array('reply' => 0, 'msg' => $ErrorMsg);
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

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $delete = tbl_permission::find($id)->delete();

        return redirect()->back()->with('message','Succcessfully deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
