@extends('layouts.newmaster')

@section('title')
Add State

@endsection


@section('content')

<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>
<div class="container my-4 text-black border-white body ">

    <h1 class="text-center ">Add New State</h1>
   
    <form action="{{Route('storestate')}}" method="post">
        @csrf

        <div class="container mt-4 card p-3 w-50 border border-dark ">

            <div class="form-group required ">
                <label for="">State Name</label>
                <input type="text" class="form-control border border-dark" name="newstate" id="newstate" value="{{old('newstate')}}">
                <span class="text-danger">
                    @error('state')
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
                <button class="btn btn btn-primary btn-sm" type="submit" href="/allstates">Add</button>
            </div>
        </div>
</div>
</form>
</div>
{{-- <script>
    $("#newstate").keyup(function() {
    $("#slug").val($("#newstate").val()).change();
    val= val.replace(/ /g,"-");
 });

</script> --}}

<script>
    function slugify(text) {
    return text.toString().toLowerCase()
      .replace(/\s+/g, '-')           // Replace spaces with -
      .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start of text
      .replace(/-+$/, '');            // Trim - from end of text
}

$('#newstate').keyup(function(){
    //console.log($(this).val());
    $slug = slugify($(this).val());
    $('#slug').val($slug);
});
</script>


@endsection

@section('scripts')

@endsection