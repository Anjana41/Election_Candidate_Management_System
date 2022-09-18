<?php

namespace App\Http\Controllers\Admin;

use App\Models\district;
use App\Http\Controllers\Controller;
use App\Models\state;
use App\Models\tehsil;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TehsilController extends Controller
{
    public function addteh()
    {
        $teh = tehsil::all();
        $state = state::all();
        $dist = district::all();
        return view('tehsil.addteh', compact('teh', 'state', 'dist'));
    }
    public function getdist(Request $request)
    {
        $stateId = $request->post('stateId');
         $dist = district::where('state_id', $stateId)->get();
        return ($dist);
    }

    public function storeteh(Request $request)
    {

        $request->validate([
            'newteh' => 'required',
            'state' => 'required',
            'newdist' => 'required',
            'slug' => 'required',

        ]);
        $teh = new tehsil();
        $teh->teh_name = $request->input('newteh');
        $teh->dist_id = $request->input('newdist');
        $teh->state_id = $request->input('state');
        $teh->slug = $request->input('slug');
        $teh->save();
        return redirect('/alltehsil')->with('status', "Tehsil Added Successfully!!");
    }




    public function allteh(Request $request)
    {
        $teh = tehsil::all()->sortByDesc('id');
        foreach($teh as $tehlist){
            $stateid = $tehlist->state_id;
            $dist_id = $tehlist->dist_id;
            $distdata = district::where('id',$dist_id)->first();
            $statedata = state::where('id', $stateid)->first();
  
        }
        return view('tehsil.allteh', compact('teh','distdata','statedata'));
    }

    public function editteh(Request $request, $id)
    {
        $teh = tehsil::find($request->id);
        $dist  = district::where('state_id',$teh->state_id)->get();
        $state = state::all();
        return view('tehsil.editteh', compact('dist', 'state','teh'));
    }

    public function updateteh(Request $request)
    {
        $teh = tehsil::find($request->id);
        $teh->teh_name = $request->newteh;
        $teh->dist_id = $request->newdist;
        $teh->state_id = $request->state;
        $teh->slug = $request->slug;
        $teh->update();
        return redirect('/alltehsil')->with('status', 'State Updated Successfully!!');
    }


    public function tehstatus(Request $request, $id)
    {
        $teh = tehsil::where('id', $request->id)->get();
        foreach ($teh as $tehlist) {
            if ($tehlist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $teh = tehsil::find($id);
            $teh->status = $status;
            $teh->update();
        }
        return redirect('/alltehsil')->with('status', "Status Change Successfully!!");


        // $values=array('status'=>$status);
        // session()->flash('msg','Member status has been updated successfully.');
    }
}
