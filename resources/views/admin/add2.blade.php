@extends('layouts.newmaster')

@section('title')
  Add Member

@endsection


@section('content')
<!-- CSS only -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container my-4 bg-dark text-white border-white">
        <h1 class="text-center ">Update Member Details</h1>
        <form action="{{route('store')}}" method="post">
            @csrf
  
            <div class="container mt-4 card p-3 bg-dark w-50  ">
              

             
                <div class="form-group required ">
                    <label for="">Name</label>
                    <input type="text" class="form-control border border-succes" name="name" id="name" value="{{old('name')}}">
                    
                    <span class="text-danger">
                        @error('name')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group required">
                    <label for="">Phone</label>

                    <input type="" class="form-control border border-success"   id="" name="phone"value="{{old('phone')}}">
                    
                    <span class="text-danger">
                        @error('phone')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                    <!-- <input type="enum" class="form-control border border-success" id="" name="gender"> -->

                    <select value="{{old('gender')}}" name="gender" id="gender" class="form-control form-select border border-success ">
                        
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
                <div class="form-group">
                    <label for="">DOB</label>
                    <input type="date" class="form-control border border-success" id="" name="dob" value="{{old('dob')}}">
                    <span class="text-danger">
                        <!-- @error('name')
                        {{$message}}
                        @enderror -->
                    </span>
                </div>
                <div class="form-group">
                    <label for="">Usertype</label>
                    <!-- <input type="enum" class="form-control border border-success" id="" name="gender"> -->

                    <select value="{{old('usertype')}}" name="usertype" id="usertype" class="form-control form-select border border-success">
                        <option>admin</option>
                        <option>user</option>
                    </select>
                    <span class="text-danger">
                        @error('usertype')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <div class="form-group required">
                    <label for="">Email</label>
                    <input type="email" class="form-control border border-success" id="email" name="email" value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control border border-success" id="address" name="address" value="{{old('address')}}">
                    <span class="text-danger">
                        <!-- @error('name')
                        {{$message}}
                        @enderror -->
                    </span>
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select value="{{old('role[]')}}" id="role" class="js-example-basic-multiple form-control border border-succes form-select" name="role[]" multiple="multiple">
                          <option value="Manger">Manger</option>
                          <option value="Seller">seller</option>
                          <option value="Buyer">buyer</option>
                          <option value="advertiser">advertiser</option>
                          <option value="adviser">adviser</option>
                         <option value="staff">staff</option>
                     </select>
                    <span class="text-danger">
                        <!-- @error('name')
                        {{$message}}
                        @enderror -->
                    </span>
                </div>
              
                <div class="form-group">
                    <form action="">
                    <label for="">State</label>
                     <select value="{{old('state')}}" class="form-control border border-success form-select" name='state' id="state">
                <option selected disabled>Select state</option>
                @foreach ($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
                    
                    <span class="text-danger">
                        @error('state')
                        {{$message}}
                        @enderror
                    </span>
                    </form>
                </div>
                <div class="form-group">
                    <label for="">City</label>

                    <select value="{{old('city')}}"name="city" id="city" class="form-control form-select border border-success">
                        
                    </select>
                    <span class="text-danger">
                        @error('city')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control border border-success " id="" name="password" value="">
                    <span class="text-danger">
                        @error('password')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control border border-success " id="" name="password_confirmation" value="">
                    <span class="text-danger">
                        @error('password_confirmation')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <div>
                <button class="btn btn btn-success btn-sm" type="submit"  href="">Add</button>
                <a href="/role-register" type="submit" class="btn btn-danger btn-sm">Cancel</a>
                </div>
            </div>
        </form>

    </div>

            </div>
          </div>
        
        </div>


        <script type="text/javascript">
        $(document).ready(function () {
            $('#state').on('change', function () {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: '{{ route('getCities') }}?state_id='+stateId,
                    type: 'get',
                    success: function (res) {
                        console.log(res);
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res, function (key, value) {
                            $('#city').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
<script>
$(document).ready(function() {
    $('#role').select2();
    multiple:true
    tags:true
});
</script>

        @endsection 


<!-- @section('scripts')

@endsection -->