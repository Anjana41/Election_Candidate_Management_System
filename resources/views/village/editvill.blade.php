@extends('layouts.newmaster')

@section('title')
Edit Panchayat
@endsection


@section('content')
<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>
<div class="container my-4 text-black border-white body ">
    <h1 class="text-center ">Edit Village</h1>
    <form action="{{Route('updatevill')}}" method="post">
        @csrf
        <div class="container mt-4 card p-3 w-50 border border-dark ">
            <div class="form-group required ">
                <label for="">State Name</label>
                <select class=" form-control border border-dark form-select form-select" value="{{$vill->state_id}}" id="state" name="state">
                    @foreach ($state as $state)
                    <option value="{{ $state->id }}" <?php if ($vill->state_id == $state->id) echo 'selected'; ?>>{{ $state->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('state')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">District Name</label>
                <select value="{{$vill->dist_id}}" name="dist" id="dist" class="form-control form-select border border-dark">
                    @foreach ($dist as $dist)
                    <option value="{{$dist->id}}" <?php if ($vill->dist_id == $dist->id) echo 'selected'; ?>>{{ $dist->dist_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('district')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">Tehsil Name</label>
                <select value="{{$vill->teh_id}}" name="teh" id="teh" class="form-control form-select border border-dark">
                    @foreach ($teh as $teh)
                    <option value="{{$teh->id}}" <?php if ($vill->teh_id == $teh->id) echo 'selected'; ?>>{{ $teh->teh_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('tehsil')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">Samiti Name</label>
                <select value="{{$vill->samiti_id}}" name="samiti" id="samiti" class="form-control form-select border border-dark">
                    @foreach ($sam as $sam)
                    <option value="{{$sam->id}}" <?php if ($vill->samiti_id == $sam->id) echo 'selected'; ?>>{{ $sam->samiti_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('samiti')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">Panchayat Name</label>
                <select value="{{$vill->panch_id}}" name="pan" id="pan" class="form-control form-select border border-dark">
                    @foreach ($pan as $pan)
                    <option value="{{$pan->id}}" <?php if ($vill->samiti_id == $pan->id) echo 'selected'; ?>>{{ $pan->panchayat_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('pan')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">Village Name</label>
                <input type="hidden" name="id" value="{{$vill['id']}}">
                <input type="text" class="form-control border border-dark" name="village" id="village" value="{{$vill->village_name}}">
                <span class="text-danger">
                    @error('village')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">slug</label>
                <input type="text" class="form-control border border-dark" name="slug" id="slug" value="{{$vill->slug}}">
                <span class="text-danger">
                    @error('slug')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div>
                <button class="btn btn btn-primary btn-sm" type="submit" href="">update</button>
            </div>
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
                    jQuery('#dist').html(result);
                    $('#dist').html('<option value="">Select District</option>');
                    $.each(result, function(key, val) {
                        $('#dist').append('<option value="' + val
                            .id + '">' + val.dist_name + '</option>');
                    });
                }

            });

        });
        jQuery('#dist').change(function() {
            let distId = jQuery(this).val();
            jQuery.ajax({
                url: '/gettehsil',
                type: 'post',
                data: 'distId=' + distId +
                    '&_token={{csrf_token()}}',
                success: function(result) {
                    console.log(result);
                    jQuery('#teh').html(result);
                    $('#teh').html('<option value="">Select Tehsil</option>');
                    $.each(result, function(key, val) {
                        $('#teh').append('<option value="' + val
                            .id + '">' + val.teh_name + '</option>');
                    });
                }

            });

        });
        jQuery('#teh').change(function() {
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
                    jQuery('#pan').html(result);
                    $('#pan').html('<option value="">Select Panchayat</option>');
                    $.each(result, function(key, val) {
                        $('#pan').append('<option value="' + val
                            .id + '">' + val.panchayat_name + '</option>');
                    });
                }

            });

        });
    });
</script>
<script>
    function slugify(text) {
    return text.toString().toLowerCase()
      .replace(/\s+/g, '-')           // Replace spaces with -
      .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start of text
      .replace(/-+$/, '');            // Trim - from end of text
}

$('#village').keyup(function(){
    //console.log($(this).val());
    $slug = slugify($(this).val());
    $('#slug').val($slug);
});
</script>



@endsection

@section('scripts')

@endsection