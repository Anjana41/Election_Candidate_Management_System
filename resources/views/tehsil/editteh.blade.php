@extends('layouts.newmaster')

@section('title')
Edit Tehsil
@endsection


@section('content')
<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>
<div class="container my-4 text-black border-white body ">
    <h1 class="text-center ">Edit Tehsil</h1>
    <form action="{{Route('updateteh')}}" method="post">
        @csrf
        <div class="container mt-4 card p-3 w-50 border border-dark ">
            <div class="form-group required ">
                <label for="">State Name</label>
                <select class=" form-control border border-dark form-select form-select" value="{{$teh->state_id}}" id="state" name="state">
                    @foreach ($state as $state)
                    <option value="{{ $state->id }}" <?php if ($teh->state_id == $state->id) echo 'selected'; ?>>{{ $state->name }}</option>
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
                <select value="{{$teh->dist_id}}" name="newdist" id="newdist" class="form-control form-select border border-dark">

                    @foreach ($dist as $dist)
                    <option value="{{$dist->id}}" <?php if ($teh->dist_id == $dist->id) echo 'selected'; ?>>{{ $dist->dist_name }}</option>
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
                <input type="hidden" name="id" value="{{$teh['id']}}">
                <input type="text" class="form-control border border-dark" name="newteh" id="newteh" value="{{$teh->teh_name}}">
                <span class="text-danger">
                    @error('tehsil')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">slug</label>
                <input type="text" class="form-control border border-dark" name="slug" id="slug" value="{{$teh->slug}}">
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
                    jQuery('#newdist').html(result);
                    $('#newdist').html('<option value="">Select district</option>');
                    $.each(result, function(key, val) {
                        $('#newdist').append('<option value="' + val
                            .id + '">' + val.dist_name + '</option>');
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

$('#newteh').keyup(function(){
    //console.log($(this).val());
    $slug = slugify($(this).val());
    $('#slug').val($slug);
});
</script>


@endsection

@section('scripts')

@endsection