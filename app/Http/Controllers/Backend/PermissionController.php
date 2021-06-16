<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Permission;
use DataTables;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $permissions = Permission::latest()->get();

        if ($request->ajax()) {
            $data = Permission::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPermission">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.permission.list_permission',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Permission::updateOrCreate(['id' => $request->permission_id],
            ['name' => $request->name]);

        return response()->json(['success'=>'Permission saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Permission  $permision
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permisison = Permission::find($id);
        return response()->json($permisison);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Permission  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();

        return response()->json(['success'=>'Permission deleted successfully.']);
    }
}
