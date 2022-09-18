@extends('layouts.newmaster')

@section('title')
Edit District
@endsection


@section('content')
<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>
<div class="container my-4 text-black border-white body ">
    <h1 class="text-center ">Edit District</h1>
    <form action="{{Route('updatedist')}}" method="post">
        @csrf
        <div class="container mt-4 card p-3 w-50 border border-dark ">
            <div class="form-group required ">
                <label for="">State</label>
                <select class=" form-control border border-dark form-select form-select" value="{{$dist->state_id}}" id="state" name="state">
                    @foreach ($state as $state)
                    <option value="{{ $state->id }}" <?php if ($dist->state_id == $state->id) echo 'selected'; ?>>{{ $state->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('state')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">District</label>
                <input type="hidden" name="id" value="{{$dist['id']}}">
                <input type="text" class="form-control border border-dark" name="newdist" id="newdist" value="{{$dist->dist_name}}">
                <span class="text-danger">
                    @error('district')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group required ">
                <label for="">slug</label>
                <input type="text" class="form-control border border-dark" name="slug" id="slug" value="{{$dist->slug}}">
                <span class="text-danger">
                    @error('district')
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