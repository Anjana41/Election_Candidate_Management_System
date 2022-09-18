@extends('layouts.newmaster')

@section('title')
Add district

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

    <h1 class="text-center ">Add New Disctrict</h1>

    <form action="{{Route('storedist')}}" method="post">
        @csrf

        <div class="container mt-4 card p-3 w-50 border border-dark ">
            <div class="form-group required ">
                <label for="">State</label>
                <select class=" form-control border border-dark form-select form-select" value="{{old('state')}}" id="state" name="state">
                    <option selected disabled>Select State</option>
                    @foreach ($states as $state)
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
                <input type="text" class="form-control border border-dark" name="newdist" id="newdist" value="{{old('newdist')}}">

                <span class="text-danger">
                    @error('district')
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
                    <button class="btn btn btn-primary btn-sm" type="submit" href="/alldistrict">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function slugify(text) {
    return text.toString().toLowerCase()
      .replace(/\s+/g, '-')           // Replace spaces with -
      .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start of text
      .replace(/-+$/, '');            // Trim - from end of text
}

$('#newdist').keyup(function(){
    //console.log($(this).val());
    $slug = slugify($(this).val());
    $('#slug').val($slug);
});
</script>


@endsection

@section('scripts')

@endsection