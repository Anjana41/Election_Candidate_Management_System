@extends('layouts.newmaster')

@section('title')
Edit Details

@endsection


@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2 {
        width: 100% !important;
    }

    .w-50 {
        width: 75% !important;
    }

    .form-row>.col,
    .form-row>[class*=col-] {
        padding-right: 17px;
        padding-left: 17px;
    }

    .select2-container .select2-selection--multiple {
        min-height: 37px;
        border: 1px solid #6e707e;
    }
</style>

<div class="container my-4  text-black  border-black">
    <h1 class="text-center ">Update Member Details</h1>
    <form action="{{route('update')}}" method="post">
        @csrf
        <div class="container mt-4 card p-3  w-50  ">
            <div class="form-row">
                <div class="form-group col-md-6 required ">
                    <label for="">Name</label>
                    <input type="hidden" name="id" value="{{$users['id']}}">

                    <input type="text" class="form-control border border-dark  " id="" name="name" value="{{$users->name}}">

                    <span class="text-danger">
                        @error('name')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="">Phone</label>
                    <input type="hidden" name="id" value="{{$users['id']}}">
                    <input type="" class="form-control border border-dark" id="" name="phone" value="{{$users->phone}}">
                    <span class="text-danger">
                        @error('name')
                        {{$message}}
                        @enderror
                    </span>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Gender</label>
                    <select name="gender" id="gender" class="form-control form-select border border-dark ">
                        <option>{{$users->Gender}}</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                    <span class="text-danger">
                        @error('gender')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">DOB</label>
                    <input type="date" class="form-control border border-dark" id="" name="dob" value="{{$users->DOB}}">
                    <span class="text-danger">
                        @error('dob')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Usertype</label>
                    <select name="usertype" id="usertype" class="form-control form-select border border-dark">
                        <option>{{$users->usertype}}</option>
                        <option>admin</option>
                        <option>user</option>
                    </select>
                    <span class="text-danger">
                        @error('usertype')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="">Email</label>
                    <input type="email" class="form-control border border-dark" id="email" name="email" value="{{$users->email}}">
                    <span class="text-danger">
                        @error('email')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Address</label>
                    <input type="text" class="form-control border border-dark" id="address" name="address" value="{{$users->Address}}">
                    <span class="text-danger">
                        @error('address')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <?php
                $role_data = array();
                $role_data = json_decode($users->Role);
                
                // if ($role_data != NULL) {
                //     $role_data;
                //     $implode_role_data = implode(',', $role_data);
                // } else {
                //     $implode_role_data = "no role assigned";
                // }
            //     echo"<pre>";
            //     print_r($role);

            //   print_r($role_data);
            //     die;
             if($role_data !=NULL){
                $data_role = $role_data;
             }
             else{

                $data_role = [];
             }
            //  print_r($data_role);
            //  die;
                ?>
                <div class="form-group col-md-6">
                    <label for="">Role</label>
                    <select id="role" value="" class="form-control select2 border border-dark" name="role[]" multiple="multiple">
                        @foreach($role as $roles)
                        <option value="{{ $roles->role_name }}" @foreach($data_role as $key => $value){{$value == $roles->role_name ? 'selected': ''}} @endforeach> {{ $roles->role_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <form action="">
                        <label for="">State</label>
                        <select class=" form-control border border-dark form-select form-select" value="{{$users->state_id}}" id="state" name="state">
                            @foreach ($states as $state)

                            <option value="{{ $state->id }}" <?php if ($users->State == $state->id) echo 'selected'; ?>>{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('state')
                            {{$message}}
                            @enderror
                        </span>
                    </form>
                </div>
                <div class="form-group col-md-6">
                    <label for="">District</label>
                    <select value="{{$users->district}}" name="district" id="district" class="form-control form-select border border-dark">
                        @foreach ($dist as $dist)
                        <option value="{{$dist->id}}" <?php if ($users->district == $dist->id) echo 'selected'; ?>>{{ $dist->dist_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('district')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Tehsil</label>
                    <select value="{{$users->tehsil}}" name="tehsil" id="tehsil" class="form-control form-select border border-dark">
                        @foreach ($teh as $teh)
                        <option value="{{$teh->id}}" <?php if ($users->tehsil == $teh->id) echo 'selected'; ?>>{{ $teh->teh_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('tehsil')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Samiti</label>
                    <select value="{{$users->samiti}}" name="samiti" id="samiti" class="form-control form-select border border-dark">
                        @foreach ($sam as $sam)
                        <option value="{{$sam->id}}" <?php if ($users->samiti == $sam->id) echo 'selected'; ?>>{{ $sam->samiti_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('samiti')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Panchayat</label>
                    <select value="{{$users->panchayat}}" name="panchayat" id="panchayat" class="form-control form-select border border-dark">
                        @foreach ($pan as $pan)
                        <option value="{{$pan->id}}" <?php if ($users->panchayat == $pan->id) echo 'selected'; ?>>{{ $pan->panchayat_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('panchayat')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Village</label>
                    <select value="{{$users->village}}" name="village" id="village" class="form-control form-select border border-dark">
                        @foreach ($vill as $vill)
                        <option value="{{$vill->id}}" <?php if ($users->village == $vill->id) echo 'selected'; ?>>{{ $vill->village_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('village')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <!-- 
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control border border-success " id="" name="password" value="">
                    <span class="text-danger">
                        @error('password')
                        {{$message}}
                        @enderror
                    </span>
                </div> -->
            <!-- <div class="form-check">
                <label class="text-black" for="">Change Status</label>
                <br>
                <input type="radio" name="status" id="status" value="1" {{ ($users->status=="1")? "checked" : "" }}>Active
                <input type="radio" name="status" id="status" value="0" {{ ($users->status=="0")? "checked" : "" }}>Inactive

            </div> -->
            <div>


                <button class="btn btn btn-primary btn-sm" type="submit" href="">Update</button>
                <!-- <a href="/role-register" type="submit" class="btn btn-danger btn-sm">Cancel</a> -->
            </div>
        </div>
    </form>

</div>

</div>
</div>

</div>




<script>
    jQuery(document).ready(function() {
        jQuery('#state').change(function() {
            let stateId = jQuery(this).val();
            jQuery.ajax({
                url: '/getdistrict',
                type: 'post',
                data: 'stateId=' + stateId +
                    '&_token={{csrf_token()}}',
                success: function(result) {
                    console.log(result);
                    jQuery('#district').html(result);
                    $('#district').html('<option value="">Select District</option>');
                    $.each(result, function(key, val) {
                        $('#district').append('<option value="' + val
                            .id + '">' + val.dist_name + '</option>');
                    });
                }

            });

        });
        jQuery('#district').change(function() {
            let distId = jQuery(this).val();
            jQuery.ajax({
                url: '/gettehsil',
                type: 'post',
                data: 'distId=' + distId +
                    '&_token={{csrf_token()}}',
                success: function(result) {
                    console.log(result);
                    jQuery('#tehsil').html(result);
                    $('#tehsil').html('<option value="">Select Tehsil</option>');
                    $.each(result, function(key, val) {
                        $('#tehsil').append('<option value="' + val
                            .id + '">' + val.teh_name + '</option>');
                    });
                }

            });

        });
        jQuery('#tehsil').change(function() {
            let tehId = jQuery(this).val();
            jQuery.ajax({
                url: '/getsamiti',
                type: 'post',
                data: 'tehId=' + tehId +
                    '&_token={{csrf_token()}}',
                success: function(result) {
                    console.log(result);
                    jQuery('#samiti').html(result);
                    $('#samiti').html('<option value="">Select Samiti</option>');
                    $.each(result, function(key, val) {
                        $('#samiti').append('<option value="' + val
                            .id + '">' + val.samiti_name + '</option>');
                    });
                }

            });

        });
        jQuery('#samiti').change(function() {
            let samId = jQuery(this).val();
            jQuery.ajax({
                url: '/getpanchayat',
                type: 'post',
                data: 'samId=' + samId +
                    '&_token={{csrf_token()}}',
                success: function(result) {
                    console.log(result);
                    jQuery('#panchayat').html(result);
                    $('#panchayat').html('<option value="">Select Panchayat</option>');
                    $.each(result, function(key, val) {
                        $('#panchayat').append('<option value="' + val
                            .id + '">' + val.panchayat_name + '</option>');
                    });
                }

            });

        });
        jQuery('#panchayat').change(function() {
            let panId = jQuery(this).val();
            jQuery.ajax({
                url: '/getvillage',
                type: 'post',
                data: 'panId=' + panId +
                    '&_token={{csrf_token()}}',
                success: function(result) {
                    console.log(result);
                    jQuery('#village').html(result);
                    $('#village').html('<option value="">Select Village</option>');
                    $.each(result, function(key, val) {
                        $('#village').append('<option value="' + val
                            .id + '">' + val.village_name + '</option>');
                    });
                }

            });

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#role').select2({
            width: 'resolve',
            multiple: true,
        });
    });
</script>

@endsection


<!-- @section('scripts')

@endsection -->