<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Models\district;
use App\Http\Controllers\Controller;
use App\Models\state;
use App\Models\tehsil;
use App\Models\samiti;
use App\Models\panchayat;



use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PanchayatController extends Controller
{
    public function addpan()
    {
        $pan = panchayat::all();
        $sam = samiti::all();
        $teh = tehsil::all();
        $state = state::all();
        $dist = district::all();
        return view('panchayat.addpan', compact('sam', 'state', 'dist','teh','pan'));
    }
    public function getsam(Request $request)
    {
        $tehId = $request->post('tehId');
      echo $sam = samiti::where('teh_id', $tehId)->get();
    
        
        return ($sam);

    }

    public function storepan(Request $request)
    {

        $request->validate([
            'pan'=>'required',
            'samiti'=>'required',
            'teh' => 'required',
            'state' => 'required',
            'dist' => 'required',
            'slug' => 'required',

        ]);
        $pan = new panchayat();
        $pan->panchayat_name = $request->input('pan');
        $pan->samiti_id = $request->input('samiti');
        $pan->teh_id = $request->input('teh');
        $pan->dist_id = $request->input('dist');
        $pan->state_id = $request->input('state');
        $pan->slug = $request->input('slug');
        $pan->save();
        return redirect('/allpanchayat')->with('status', "panchayat Added Successfully!!");
    }




    public function allpan(Request $request)
    {
        $pan = panchayat::all()->sortByDesc('id');
        foreach( $pan as $panlist){
            $stateid = $panlist->state_id;
            $dist_id = $panlist->dist_id;
            $teh_id = $panlist->teh_id;
            $sam_id = $panlist->samiti_id;
            $samdata = samiti::where('id',$sam_id)->first();
            $distdata = district::where('id',$dist_id)->first();
            $statedata = state::where('id', $stateid)->first();
            $tehdata = tehsil::where('id',$teh_id)->first();
        }
        return view('panchayat.allpan', compact('pan','distdata','statedata','tehdata','samdata'));
    }

    public function editpan(Request $request, $id)
    {
        $pan = panchayat::find($request->id);
        $sam  = samiti::where('teh_id',$pan->teh_id)->get();
        $teh  = tehsil::where('dist_id',$pan->dist_id)->get();
        $dist  = district::where('state_id',$pan->state_id)->get();
        $state = state::all();
        return view('panchayat.editpan', compact('dist', 'state','teh','sam','pan'));
    }

    public function updatepan(Request $request)
    {
        $pan = panchayat::find($request->id);
        $pan ->panchayat_name = $request->pan;
        $pan ->samiti_id = $request->samiti;
        $pan ->teh_id = $request->teh;
        $pan ->dist_id = $request->dist;
        $pan->state_id = $request->state;
        $pan ->slug = $request->slug;
        $pan ->update();
        return redirect('/allpanchayat')->with('status', 'panchayat Updated Successfully!!');
    }


    public function panstatus(Request $request, $id)
    {
        $pan = panchayat::where('id', $request->id)->get();
        foreach ( $pan as  $panlist) {
            if ( $panlist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $pan = panchayat::find($id);
            $pan->status = $status;
            $pan->update();
        }
        return redirect('/allpanchayat')->with('status', "Status Change Successfully!!");


        // $values=array('status'=>$status);
        // session()->flash('msg','Member status has been updated successfully.');
    }
}
