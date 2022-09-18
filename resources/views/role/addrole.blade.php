@extends('layouts.newmaster')

@section('title')
Add Role

@endsection


@section('content')

<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>

<div class="container my-4 text-black border-white body ">

    <h1 class="text-center ">Add New Role</h1>
   
    <form action="{{Route('storerole')}}" method="post">
        @csrf

        <div class="container mt-4 card p-3 w-50 border border-dark ">

            <div class="form-group required ">
                <label for="">Role Name</label>
                <input type="text" class="form-control border border-dark" name="role" id="role" value="{{old('role')}}">
                <span class="text-danger">
                    @error('role')
                    {{$message}}
                    @enderror
                </span>
            </div>
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
                <button class="btn btn btn-primary btn-sm" type="submit" href="/allrole">Add</button>
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

$('#role').keyup(function(){
    //console.log($(this).val());
    $slug = slugify($(this).val());
    $('#slug').val($slug);
});
</script>


@endsection

@section('scripts')

@endsection