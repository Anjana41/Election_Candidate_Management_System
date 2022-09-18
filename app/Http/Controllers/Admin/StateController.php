<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;




use App\Models\state;
use App\Models\User;
use App\Models\city;


class StateController extends Controller
{
    public function addstate()
    {
        return view('admin.addstate');
    }


    public function storestate(Request $request)
    {

        $request->validate([
            'newstate' => 'required',
            'slug' => 'required',

        ]);
        $state = new state();
        $state->name = $request->input('newstate');
        $state->slug = $request->input('slug');

        $state->save();
        return redirect('/allstates')->with('status', "State Added Successfully!!");
    }


    public function allstates(Request $request)
    {
        // $users = User::latest()->get();
        $states = state::all()->sortByDesc('id');
        return view('admin.allstates', compact('states'));
    }

    public function editstate(Request $request,$id)
    {
        $states = state::find($request->id);
        return view('admin.editstate', compact('states'));
    }

    public function updatestate(Request $request)
    {
      
        $states = state::find($request->id);
        $states->name = $request->newstate;
        $states->slug = $request->slug;

        $states->update();
        return redirect('/allstates')->with('status', 'State Updated Successfully!!');
    }


    public function statestatus(Request $request, $id)
    {
        $states = state::where('id', $request->id)->get();
        foreach ($states as $statelist) {
            if ($statelist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $states = state::find($id);
            $states->status = $status;
            $states->update();
        }
        return redirect('/allstates')->with('status', "Status Change Successfully!!");


        // $values=array('status'=>$status);
        // session()->flash('msg','Member status has been updated successfully.');
    }
}
