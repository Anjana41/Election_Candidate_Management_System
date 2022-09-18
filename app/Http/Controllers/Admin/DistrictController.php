<?php

namespace App\Http\Controllers\Admin;
use App\Models\district;
use App\Http\Controllers\Controller;
use App\Models\state;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DistrictController extends Controller
{
    //
    public function adddist()
    {
        $states = state::all();

        return view('district.adddist',compact('states'));
    }


    public function storedist(Request $request)
    {
        
        $request->validate([
            'newdist' => 'required',
            'state' => 'required',
            'slug' => 'required',

        ]);
        $dist = new district();
        $dist->dist_name = $request->input('newdist');
        $dist->state_id = $request->input('state');
        $dist->slug = $request->input('slug');
        $dist->save();
        return redirect('/alldistrict')->with('status', "State Added Successfully!!");
    }


    public function alldist(Request $request)
    {
        // $users = User::latest()->get();
        $dist = district::all()->sortByDesc('id');
        foreach($dist as $distlist){
            $stateid = $distlist->state_id;
            $statedata = state::where('id', $stateid)->first();
  
        }
        return view('district.alldist', compact('dist','stateid'));
    }

    public function editdist(Request $request,$id)
    {
       
        $dist = district::find($request->id);
        $state = state::all();
        // echo"<pre>";
        // print_r($dist);
        // die;
        // foreach ($state as $stateName) {
        //     $name = $stateName->name;
        // }

        return view('district.editdist', compact('dist','state'));
    }

    public function updatedist(Request $request)
    {
      
        $dist = district::find($request->id);
        $dist->dist_name = $request->newdist;
        $dist->state_id = $request->state;
        $dist->slug = $request->slug;
        $dist->update();
        return redirect('/alldistrict')->with('status', 'State Updated Successfully!!');
    }


    public function diststatus(Request $request, $id)
    {
        $dist = district::where('id', $request->id)->get();
        foreach ($dist as $distlist) {
            if ($distlist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $dist = district::find($id);
            $dist->status = $status;
            $dist->update();
        }
        return redirect('/alldistrict')->with('status', "Status Change Successfully!!");


        // $values=array('status'=>$status);
        // session()->flash('msg','Member status has been updated successfully.');
    }
}
