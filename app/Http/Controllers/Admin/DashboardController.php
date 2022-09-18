<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Requests\AddMemberRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\state;
use App\Models\city;
use App\Models\district;
use App\Models\panchayat;
use App\Models\role;
use App\Models\samiti;
use App\Models\tehsil;
use App\Models\village;

class DashboardController extends Controller
{

    public function registered()
    {
        
        $users = User::orderBy('id','desc')->paginate(10);
        // print_r($users);
        // print(json_encode($users)) ;

        // die;
        return view('admin.newregister',compact('users'));
    }


    public function registerupdate(Request $request)
    {
        $users = User::findorfail($request->id);
        $role = json_encode($request['role']);
        $users->name = $request->name;
        $users->phone = $request->phone;
        $users->Gender = $request->gender;
        $users->DOB = $request->dob;
        $users->usertype = $request->usertype;
        $users->email = $request->email;
        $users->Address = $request->address;
        $users->Role = $role;
        $users->State = $request->state;
        $users->district = $request->district;
        $users->tehsil = $request->tehsil;
        $users->samiti = $request->samiti;
        $users->panchayat = $request->panchayat;
        $users->village = $request->village;
        $users->update();

        return redirect('/role-register')->with('status', 'Data Updated Successfully!!');
    }

    public function registerdelete($id)
    {

        $users = User::findorfail($id);
        $users->delete();
        return redirect('/role-register')->with('status', 'Data Deleted Successfully!!');
    }



    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'state' => 'required',
            'district' => 'required',
            'tehsil' => 'required',
            'samiti' => 'required',
            'panchayat' => 'required',
            'village' => 'required',
            'role' => 'required',
        ]);
        // return $request->all();


        $users = new User();
        $role = json_encode($request['role']);

        $users->name = $request->input('name');
        $users->phone = $request->input('phone');
        $users->Gender = $request->input('gender');
        $users->DOB = $request->input('dob');
        $users->usertype = $request->input('usertype');
        $users->email = $request->input('email');
        $users->Address = $request->input('address');
        $users->Role = $role;
        $users->State = $request->input('state');
        $users->district = $request->input('district');
        $users->tehsil = $request->input('tehsil');
        $users->samiti = $request->input('samiti');
        $users->panchayat = $request->input('panchayat');
        $users->village = $request->input('village');
        $users->save();

        if($users){
            return redirect('/role-register')->with('status', "Member Added Successfully!!");
        }
        else{
            return redirect('/add-member')->with('error', "Try Again!!!");
        }
    }

    public function registeredit(Request $request, $id)
    {

        // $users = User::all();
        $users = User::find($id);
        $state = state::where('id', $users->State)->get();
        foreach ($state as $stateName) {
            $name = $stateName->name;
        }

        if(isset($state->name)){
            $name = $state->name;
        } else {
            $name = 'Not Available';
        }
        //    print_r($name);
        //   die;
        $dist = district::where('id', $users->district)->get();
        if(isset($dist->dist_name)){
            $distname = $dist->dist_name;
        } else {
            $distname = 'Not Available';
        }
        $teh = tehsil::where('id', $users->tehsil)->first();
        if(isset($teh->teh_name)){
            $tehname = $teh->teh_name;
        } else {
            $tehname = 'Not Available';
        }
       
        $sam = samiti::where('id', $users->samiti)->first();
        if(isset($sam->samiti_name)){
            $samname = $sam->samiti_name;
        } else {
            $samname = 'Not Available';
        }
       
        $pan = panchayat::where('id', $users->panchayat)->first();
        if(isset($pan->panchayat_name)){
            $panname = $pan->panchayat_name;
        } else {
            $panname = 'Not Available';
        }
        $vill = village::where('id', $users->village)->first();
        if(isset($vill->village_name)){
            $villname = $vill->village_name;
        } else {
            $villname = 'Not Available';
        }
        // $teh = tehsil::where('id', $users->tehsil)->get();
        // foreach ($teh as $tehName) {
        //     $tehname = $tehName->teh_name;
        // }

        // $sam = samiti::where('id', $users->samiti)->get();
        // foreach ($sam as $samName) {
        //     $samname = $samName->samiti_name;
        // }
        // $pan = panchayat::where('id', $users->panchayat)->get();
        // foreach ($pan as $panName) {
        //     $panname = $panName->panchayat_name;
        // }
        // $vill = village::where('id', $users->village)->get();
        // foreach ($vill as $villName) {
        //     $villname = $villName->village_name;

           
            
        // }
  

        $states = DB::table('states')->get();
        $users = User::find($request->id);
        $vill  = village::where('panch_id',$users->village)->get();
        $pan  = panchayat::where('samiti_id',$users->panchayat)->get();
        $sam  = samiti::where('teh_id',$users->tehsil)->get();
        $teh  = tehsil::where('dist_id',$users->district)->get();
        $dist  = district::where('state_id',$users->State)->get();
        $role = DB::table('roles')->get();
        // print_r($role);
        // die;
        // $role = role::where('id',$users->Role)->get();


        return view('admin.edit-details', compact('users', 'states', 'role','villname','distname','tehname', 'samname','panname','name', 'state','dist','teh','sam','pan','vill'));
    }

    public function addmember(Request $request)
    {
        $users = User::all();
        $old = User::orderBy('id', 'desc')->take(1)->get();

        $vill  = village::where('panch_id',$old[0]['village'])->get();
        $pan  = panchayat::where('samiti_id',$old[0]['panchayat'])->get();
        $sam  = samiti::where('teh_id',$old[0]['tehsil'])->get();
        $teh  = tehsil::where('dist_id',$old[0]['district'])->get();
        $dist  = district::where('state_id',$old[0]['State'])->get();
        $states = DB::table('states')->get();

        $role = DB::table('roles')->get();
        return view('admin.newadd', compact('states','role','old','dist','teh','sam','pan','vill'));
    }

   
    public function view($id)
    {
        $users = User::find($id);
        $state = state::where('id', $users->State)->first();
        if(isset($state->name)){
            $name = $state->name;
        } else {
            $name = 'Not Available';
        }


        $dist = district::where('id', $users->district)->first();
        if(isset($dist->dist_name)){
            $distname = $dist->dist_name;
        } else {
            $distname = 'Not Available';
        }
        
        $teh = tehsil::where('id', $users->tehsil)->first();
        if(isset($teh->teh_name)){
            $tehname = $teh->teh_name;
        } else {
            $tehname = 'Not Available';
        }
       
        $sam = samiti::where('id', $users->samiti)->first();
        if(isset($sam->samiti_name)){
            $samname = $sam->samiti_name;
        } else {
            $samname = 'Not Available';
        }
       
        $pan = panchayat::where('id', $users->panchayat)->first();
        if(isset($pan->panchayat_name)){
            $panname = $pan->panchayat_name;
        } else {
            $panname = 'Not Available';
        }
        $vill = village::where('id', $users->village)->first();
        if(isset($vill->village_name)){
            $villname = $vill->village_name;
        } else {
            $villname = 'Not Available';
        }

        $role = role::where('id',$users->Role)->get();

        return view('admin.view', compact('users', 'name','state','dist','distname','teh','tehname','sam','samname','pan','panname','vill','villname', 'role'));
    }


    public function status(Request $request, $id)
    {

        $users = User::where('id', $request->id)->get();

        foreach ($users as $userlist) {

            if ($userlist->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }


            $users = User::find($id);
            $users->status = $status;
            $users->update();
        }
        return redirect('/role-register')->with('status', "Status Change Successfully!!");
    
    }
    public function profile(Request $request, $id){
    $users = User::where('id', $request->id)->get();
     
    // print_r($users[0]['name']);
    // die;
    // print_r($users);
    $state = state::where('id', $users[0]['State'])->first();
        if(isset($state->name)){
            $name = $state->name;
        } else {
            $name = 'Not Available';
        }


        $dist = district::where('id', $users[0]['district'])->first();
        if(isset($dist->dist_name)){
            $distname = $dist->dist_name;
        } else {
            $distname = 'Not Available';
        }
        
        $teh = tehsil::where('id', $users[0]['tehsil'])->first();
        if(isset($teh->teh_name)){
            $tehname = $teh->teh_name;
        } else {
            $tehname = 'Not Available';
        }
       
        $sam = samiti::where('id', $users[0]['samiti'])->first();
        if(isset($sam->samiti_name)){
            $samname = $sam->samiti_name;
        } else {
            $samname = 'Not Available';
        }
       
        $pan = panchayat::where('id', $users[0]['panchayat'])->first();
        if(isset($pan->panchayat_name)){
            $panname = $pan->panchayat_name;
        } else {
            $panname = 'Not Available';
        }
        $vill = village::where('id', $users[0]['village'])->first();
        if(isset($vill->village_name)){
            $villname = $vill->village_name;
        } else {
            $villname = 'Not Available';
        }
    return view('admin.profile',compact('users', 'name','state','dist','distname','teh','tehname','sam','samname','pan','panname','vill','villname'));
  }
}
