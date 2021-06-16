<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Role;
use Hash;
use DB;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

            $data = User::latest()->get();
            $roles = Role::pluck('name','name')->all();
            $role_add = Role::all();
            if ($request->ajax()) {
                $data = User::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('Admin.users.list_user',compact('data','roles','role_add'));
    }

    public function get()
    {
        $role_add = Role::all();
        $d['users'] = User::orderby('id', 'DESC')->get();
        return view('Admin.users.getTableDate', $d,compact('role_add'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));

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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => ''
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->back()->with('message', 'Add User  Successfully');
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
        $user = User::find($id);
        return view('users.show',compact('user'));
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

        $userEdit =User::query()->with('roles')->find($id);

       return response()->json($userEdit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|:users,email,',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = User::find($request->id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$request->id)->delete();
        $user->assignRole($request->input('roles'));

        echo "done";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $user = User::find($id);
        if ($user){
            $user->delete();
        }
        echo "done";
        //return back()->with('message', 'user Deleted Successfully');
    }
}
