@extends('layouts.newmaster')

@section('title')
Add Member

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


<div class="container my-4 text-black border-white body ">
    <h1 class="text-center ">Add New Member</h1>
    <form id="form" action="{{route('store')}}" method="post">
        @csrf

        <div class="container mt-4 card p-3 w-50  ">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="">State</label>
                    <select value="{{$old[0]['State']}}" class="form-control border border-dark form-select" name='state' id="state">
                        <option selected disabled>Select state</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}" <?php if ($old[0]['State'] == $state->id) echo 'selected'; ?>>{{ $state->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('state')
                        {{$message}}
                        @enderror
                    </span>

                </div>
                <div class="form-group col-md-2">
                    <label for="">District</label>
                    <select value="{{$old[0]['district']}}" class="form-control border border-dark form-select" name='district' id="district">
                        <option selected disabled>Select trict</option>
                        @foreach ($dist as $dists)
                        <option value="{{$dists->id}}" <?php if ($old[0]['district'] == $dists->id) echo 'selected'; ?>>{{ $dists->dist_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('district')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <div class="form-group col-md-2">
                    <label for="">Tehsil</label>
                    <select value="{{$old[0]['tehsil']}}" class="form-control border border-dark form-select" name='tehsil' id="tehsil">
                        <option selected disabled>Select Tehsil</option>
                        @foreach ($teh as $tehs)
                        <option value="{{$tehs->id}}" <?php if ($old[0]['tehsil'] == $tehs->id) echo 'selected'; ?>>{{ $tehs->teh_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('tehsil')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Samiti</label>
                    <select value="{{$old[0]['samiti']}}" class="form-control border border-dark form-select" name='samiti' id="samiti">
                        <option selected disabled>Select Samiti</option>
                        @foreach ($sam as $sams)
                        <option value="{{$sams->id}}" <?php if ($old[0]['samiti'] == $sams->id) echo 'selected'; ?>>{{ $sams->samiti_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('samiti')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Panchayat</label>
                    <select value="{{$old[0]['panchayat']}}" class="form-control border border-dark form-select" name='panchayat' id="panchayat">
                        <option selected disabled>Select Panchayat</option>
                        @foreach ($pan as $pans)
                        <option value="{{$pans->id}}" <?php if ($old[0]['panchayat'] == $pans->id) echo 'selected'; ?>>{{ $pans->panchayat_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('panchayat')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Village</label>
                    <select value="{{$old[0]['village']}}" class="form-control border border-dark form-select" name='village' id="village">
                        <option selected disabled>Select Vilage</option>
                        @foreach ($vill as $vills)
                        <option value="{{$vills->id}}" <?php if ($old[0]['village'] == $vills->id) echo 'selected'; ?>>{{ $vills->village_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('village')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 required ">
                    <label for="">Name</label>
                    <input type="text" class="form-control border border-dark" name="name" id="name" value="{{old('name')}}">
                    <span class="text-danger">
                        @error('name')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="">Phone</label>
                    <input type="number" id="phone" maxlength="10" type="" class="form-control border border-dark" id="" name="phone" value="{{old('phone')}}">
                    <span class="text-danger">
                        @error('phone')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Gender</label>
                    <select value="{{old('gender')}}" name="gender" id="gender" class="form-control form-select border border-dark ">
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
                    <input type="date" class="form-control border border-dark" id="" name="dob" value="{{old('dob')}}">
                    <span class="text-danger">
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Usertype</label>
                    <select value="{{old('usertype')}}" name="usertype" id="usertype" class="form-control form-select border border-dark">
                        <option>user</option>
                        <option>admin</option>
                    </select>
                    <span class="text-danger">
                        @error('usertype')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="">Email</label>
                    <input type="email" class="form-control border border-dark" id="email" name="email" value="{{old('email')}}">
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
                    <input type="text" class="form-control border border-dark" id="address" name="address" value="{{old('address')}}">
                    <span class="text-danger">
                        @error('address')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Role</label>
                    <select name="role[]" id="role" class="select2 form-control form-select border border-dark" multiple="multiple">
                        @foreach($role as $role)
                        <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('role')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>

            <div>
                <button class="btn btn btn-primary btn-sm" type="submit" href="">Add</button>
                <button class="btn btn btn-primary btn-sm" onclick="document.getElementById('form').reset(); document.getElementById('from').value = null; return false;">
                    Reset
                </button>

            </div>
        </div>
    </form>

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
<!-- <script>
    var tele = document.querySelector('#phone');

    tele.addEventListener('keyup', function(e) {
        if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)) {
            tele.value += '-';
        }
    });
</script> -->
@endsection

@section('scripts')

@endsection