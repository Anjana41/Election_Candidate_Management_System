@extends('layouts.newmaster')

@section('title')
Add Panchayat

@endsection


@section('content')

<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>


<div class="container my-4 text-black border-white body ">

    <h1 class="text-center ">Add New Panchayat</h1>

    <form action="{{Route('storepan')}}" method="post">
        @csrf

        <div class="container mt-4 card p-3 w-50 border border-dark ">
            <div class="form-group required ">
                <label for="">State Name</label>
                <select class=" form-control border border-dark form-select form-select" id="state" name="state">
                    <option selected disabled>Select State</option>
                    @foreach ($state as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
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
                <select value=" " name="dist" id="dist" class="form-control form-select border border-dark">
                    <option value=" ">Select District</option>
                </select>
                <span class="text-danger">
                    @error('district')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">Tehsil Name</label>
                <select value=" " name="teh" id="teh" class="form-control form-select border border-dark">
                    <option value=" ">Select Tehsil</option>
                </select>
                <span class="text-danger">
                    @error('tehsil')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">Samiti Name</label>
                <select value=" " name="samiti" id="samiti" class="form-control form-select border border-dark">
                    <option value=" ">Select Samiti</option>
                </select>
                <span class="text-danger">
                    @error('samiti')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div>
                <div class="form-group required ">
                    <label for="">Panchayat Name</label>
                    <input type="text" class="form-control border border-dark" name="pan" id="pan" value="{{old('pan')}}">
                    <span class="text-danger">
                        @error('pan')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div>
                    <div class="form-group required ">
                        <label for="">slug</label>
                        <input type="text" class="form-control border border-dark" name="slug" id="slug" value="{{old('slug')}}">
                        <span class="text-danger">
                            @error('slug')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <button class="btn btn btn-primary btn-sm" type="submit" href="/allpanchayat">Add</button>
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

$('#pan').keyup(function(){
    //console.log($(this).val());
    $slug = slugify($(this).val());
    $('#slug').val($slug);
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection

@section('scripts')

@endsection