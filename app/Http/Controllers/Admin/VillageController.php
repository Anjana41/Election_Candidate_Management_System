<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Models\district;
use App\Http\Controllers\Controller;
use App\Models\state;
use App\Models\tehsil;
use App\Models\samiti;
use App\Models\panchayat;
use App\Models\village;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class VillageController extends Controller
{
    public function addvill()
    {
        $vill = village::all();
        $pan = panchayat::all();
        $sam = samiti::all();
        $teh = tehsil::all();
        $state = state::all();
        $dist = district::all();
        return view('village.addvill', compact('sam', 'state', 'dist','teh','pan','vill'));
    }
    public function getpan(Request $request)
    {
        $samId = $request->post('samId');
      $pan = panchayat::where('samiti_id', $samId)->get();
        return ($pan);

    }
    public function getvill(Request $request)
    {
        $panId = $request->post('panId');
        $vill = village::where('panch_id', $panId)->get();
        return ($vill);

    }

    public function storevill(Request $request)
    {

        $request->validate([
            'village'=>'required',
            'pan'=>'required',
            'samiti'=>'required',
            'teh' => 'required',
            'state' => 'required',
            'dist' => 'required',
            'slug' => 'required',

        ]);
        $vill = new village();
        $vill->village_name = $request->input('village');
        $vill->samiti_id = $request->input('samiti');
        $vill->panch_id = $request->input('pan');
        $vill->teh_id = $request->input('teh');
        $vill->dist_id = $request->input('dist');
        $vill->state_id = $request->input('state');
        $vill->slug = $request->input('slug');
        $vill->save();
        return redirect('/allvillage')->with('status', "village Added Successfully!!");
    }




    public function allvill(Request $request)
    {
        $vill = village::all()->sortByDesc('id');
        foreach( $vill as $villlist){
            $stateid = $villlist->state_id;
            $dist_id = $villlist->dist_id;
            $teh_id = $villlist->teh_id;
            $sam_id = $villlist->samiti_id;
            $pan_id = $villlist->panch_id;

            $samdata = samiti::where('id',$sam_id)->first();
            $distdata = district::where('id',$dist_id)->first();
            $statedata = state::where('id', $stateid)->first();
            $tehdata = tehsil::where('id',$teh_id)->first();
            $pandata = panchayat::where('id',$pan_id)->first();

        }
        return view('village.allvill', compact('vill','distdata','statedata','tehdata','samdata','pandata'));
    }

    public function editvill(Request $request, $id)
    {
        $vill = village::find($request->id);
        $pan  = panchayat::where('samiti_id',$vill->panch_id)->get();
        $sam  = samiti::where('teh_id',$vill->teh_id)->get();
        $teh  = tehsil::where('dist_id',$vill->dist_id)->get();
        $dist  = district::where('state_id',$vill->state_id)->get();
        $state = state::all();
        return view('village.editvill', compact('dist', 'state','teh','sam','pan','vill'));
    }

    public function updatevill(Request $request)
    {
        $vill = village::find($request->id);
        $vill ->village_name = $request->village;
        $vill ->panch_id = $request->pan;
        $vill ->samiti_id = $request->samiti;
        $vill ->teh_id = $request->teh;
        $vill ->dist_id = $request->dist;
        $vill->state_id = $request->state;
        $vill ->slug = $request->slug;
        $vill->update();
        return redirect('/allvillage')->with('status', 'village Updated Successfully!!');
    }


    public function villstatus(Request $request, $id)
    {
        $vill = village::where('id', $request->id)->get();
        foreach ( $vill as  $villlist) {
            if ( $villlist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $vill = village::find($id);
            $vill->status = $status;
            $vill->update();
        }
        return redirect('/allvillage')->with('status', "Status Change Successfully!!");
    }
}
