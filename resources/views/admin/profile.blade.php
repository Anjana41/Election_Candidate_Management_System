@extends('layouts.newmaster')

@section('title')
  Profile

@endsection


@section('content')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
.my-4 {
    margin-top: 0.0rem!important;
    margin-bottom: 15.0rem!important;
}

</style>

<div class="container my-4">
    <h1 class="text-center">Profile</h1>
<div class="row">
    <div class="col-md-12">
        <div class="card position-top  margin-top 10rem">
            <div class="card-header">
      
                 {{$users[0]['name']}}
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Name: </label>
                            {{$users[0]['name']}}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Usertype: </label>
                            {{$users[0]['usertype']}}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Phone: </label>
                            {{$users[0]['phone']}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Gender: </label>
                            {{$users[0]['Gender']}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >DOB: </label>

                            {{date('d F,y',strtotime($users[0]['DOB']))}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Email: </label>
                            {{$users[0]['email']}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Address: </label>
                            {{$users[0]['Address']}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Role: </label>
                            
                            <?php
                                if(isset($users[0]['Role'])){
                                    $role_data = array();
                                    $role_data = json_decode($users[0]['Role']);
                                $implode_role_data = implode(',',$role_data);
                                  
                               } else{
                                $implode_role_data="  ";
                               }?>

                            {{$implode_role_data}}
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Status: </label>
                            @if($users[0]['status']=="1")
                           Active
                           @else 
                          Inactive
                             @endif
                           
                        </div>
                    </div>
                   
                   
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Country: </label>
                            India
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >District: </label>
                            {{$distname}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Tehsil: </label>
                            {{$tehname}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Samiti: </label>
                            {{$samname}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Panchayat: </label>
                            {{$panname}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-2 border">
                            <label >Village: </label>
                            {{$villname}}
                        </div>
                    </div>
                   
                    <div>
                <a href="/role-register" type="submit" class="btn btn-primary btn-sm">Back</a>
                </div>
                           


                </div>
                
            </div>
           
        </div>

        @endsection 
