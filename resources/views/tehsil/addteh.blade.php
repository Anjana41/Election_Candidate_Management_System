@extends('layouts.newmaster')

@section('title')
Add Tehsil

@endsection


@section('content')

<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>
<!-- @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{session('status')}}
    </div>
    @endif -->

<div class="container my-4 text-black border-white body ">

    <h1 class="text-center ">Add New Tehsil</h1>

    <form action="{{Route('storeteh')}}" method="post">
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
                <select value=" " name="newdist" id="newdist" class="form-control form-select border border-dark">
                    <option value=" ">Select District</option>
                </select>
                <span class="text-danger">
                    @error('district')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div>
                <div class="form-group required ">
                    <label for="">Tehsil Name</label>
                    <input type="text" class="form-control border border-dark" name="newteh" id="newteh" value="{{old('newteh')}}">
                    <span class="text-danger">
                        @error('tehsil')
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
                        <button class="btn btn btn-primary btn-sm" type="submit" href="/alltehsil">Add</button>
                    </div>
                </div>
            </div>
    </form>
</div>

<!-- <script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            var stateId = this.value;
            $('#newdist').html('');
            $.ajax({
                url: '{{ route('getdist') }}?state_id=' + stateId
                type: 'get',
                success: function(res) {
                    console.log(res);
                    $('#newdist').html('<option value="">Select district</option>');
                    $.each(res, function(key, value) {
                        $('#newdist').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script> -->
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
                    $('#newdist').html('<option value="">Select District</option>');
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection

@section('scripts')

@endsection