<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\role;



use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function addrole()
    {
        return view('role.addrole');
    }


    public function storerole(Request $request)
    {

        $request->validate([
            'role' => 'required',
            'slug' => 'required',

        ]);
        $role = new role();
        $role->role_name = $request->input('role');
        $role->slug = $request->input('slug');

        $role->save();
        return redirect('/allrole')->with('status', "Role Added Successfully!!");
    }


    public function allrole(Request $request)
    {
        $role = role::all()->sortByDesc('id');
        return view('role.allrole', compact('role'));
    }

    public function editrole(Request $request,$id)
    {
        $role = role::find($request->id);
        return view('role.editrole', compact('role'));
    }

    public function updaterole(Request $request)
    {
      
        $role = role::find($request->id);
        $role->role_name = $request->role;
        $role->slug = $request->slug;
        $role->update();
        return redirect('/allrole')->with('status', 'role Updated Successfully!!');
    }


    public function rolestatus(Request $request, $id)
    {
        $role = role::where('id', $request->id)->get();
        foreach ($role as $rolelist) {
            if ($rolelist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $role = role::find($id);
            $role->status = $status;
            $role->update();
        }
        return redirect('/allrole')->with('status', "Status Change Successfully!!");


        // $values=array('status'=>$status);
        // session()->flash('msg','Member status has been updated successfully.');
    }
}
