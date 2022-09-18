<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\state;
use App\Models\district;
use App\Models\pansamiti;
use App\Models\samiti;
use App\Models\tehsil;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class SamitiController extends Controller
{
    public function addsam()
    {
        $sam = samiti::all();
        $teh = tehsil::all();
        $state = state::all();
        $dist = district::all();
        return view('samiti.addsam', compact('sam', 'state', 'dist','teh'));
    }
    public function getteh(Request $request)
    {
        $distId = $request->post('distId');
       $teh = tehsil::where('dist_id', $distId)->get();
    //    echo"<pre>";
    //    print_r($teh);
    //    die;
        
        return ($teh);

    }

    public function storesam(Request $request)
    {

        $request->validate([
            'samiti'=>'required',
            'teh' => 'required',
            'state' => 'required',
            'dist' => 'required',
            'slug' => 'required',

        ]);
        $sam = new samiti();
        $sam->samiti_name = $request->input('samiti');
        $sam->teh_id = $request->input('teh');
        $sam->dist_id = $request->input('dist');
        $sam->state_id = $request->input('state');
        $sam->slug = $request->input('slug');
        $sam->save();
        return redirect('/allsamiti')->with('status', "Samiti Added Successfully!!");
    }




    public function allsam(Request $request)
    {
        $sam = samiti::all()->sortByDesc('id');
        foreach( $sam as $samlist){
            $stateid = $samlist->state_id;
            $dist_id = $samlist->dist_id;
            $teh_id = $samlist->teh_id;
            $distdata = district::where('id',$dist_id)->first();
            $statedata = state::where('id', $stateid)->first();
            $tehdata = tehsil::where('id',$teh_id)->first();

  
        }
        return view('samiti.allsam', compact('sam','distdata','statedata','tehdata'));
    }

    public function editsam(Request $request, $id)
    {
        $sam = samiti::find($request->id);
        $teh  = tehsil::where('dist_id',$sam->dist_id)->get();
        $dist  = district::where('state_id',$sam->state_id)->get();
        $state = state::all();
        return view('samiti.editsam', compact('dist', 'state','teh','sam'));
    }

    public function updatesam(Request $request)
    {
        $sam = samiti::find($request->id);
        $sam ->samiti_name = $request->samiti;
        $sam ->teh_id = $request->teh;
        $sam ->dist_id = $request->dist;
        $sam ->state_id = $request->state;
        $sam ->slug = $request->slug;
        $sam ->update();
        return redirect('/allsamiti')->with('status', 'Samiti Updated Successfully!!');
    }


    public function samstatus(Request $request, $id)
    {
        $sam = samiti::where('id', $request->id)->get();
        foreach ( $sam as  $samlist) {
            if ( $samlist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $sam = samiti::find($id);
            $sam->status = $status;
            $sam->update();
        }
        return redirect('/allsamiti')->with('status', "Status Change Successfully!!");


        // $values=array('status'=>$status);
        // session()->flash('msg','Member status has been updated successfully.');
    }
}
