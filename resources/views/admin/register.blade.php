@extends('layouts.newmaster')

@section('title')
     Registered Member
@endsection

@section('content')
<form method="POST" action="{{ Route('role') }}">
  @csrf
<!-- <div class="main-panel"> -->
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Registered Members</h3>
      @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
      <nav aria-label="breadcrumb">
        <!-- <ol class="breadcrumb"> -->
          <!-- <li class="breadcrumb-item"><a href="#">Tables</a></li>
          <li class="breadcrumb-item active" aria-current="page">List of Users</li> -->
        <!-- </ol> -->
      </nav>
    </div>
    <div class="row">
      <!-- <div class="col-lg-6 grid-margin stretch-card"> -->
        <div class="card">
          <div class="card-body">
            <!-- <h4 class="card-title">User List</h4> -->
            <div class="col-sm-4">
                 <a href="{{Route('add')}}" type="submit" class="btn btn-info add-new  float-right">+Member</a>
                    </div>
            </p>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>UserType</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <!-- <th>DOB</th> -->
                    <!-- <th>Email</th> -->
                    <!-- <th>Address</th> -->
                    <!-- <th>Role</th> -->
                    <!-- <th>City</th> -->
                    <!-- <th>State</h> -->
                    <!-- <th>Country</th> -->
                    <th>Status</th>
                    <th>Edit</th>
                    <th>View</th>

                    <!-- <th>Delete</th> -->


                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $data)
                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->usertype}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->Gender}}</td>
                    <!-- <td>{{$data->DOB}}</td> -->
                    <!-- <td>{{$data->email}}</td> -->
                    <!-- <td>{{$data->Address}}</td> -->
                    <!-- <td>{{$data->Role}}</td> -->
                    <!-- <td>{{$data->city}}</td> -->
                    <!-- <td>{{$data->State}}</td> -->
                    <!-- <td>{{$data->Country}}</td> -->
                    <td>
                      @if($data->status=="1")
                     <a href="{{route('status',['id'=>$data->id])}}">
                        <span class="btn btn-success">Active</span>
                        </a>
                      @else
                  <a href="{{route('status',['id'=>$data->id])}}">
                        <span class="btn btn-danger">Inactive</span>
                        </a>
                      @endif
                    </td>

                   <!-- <td> <a href="/change-status" class="btn btn-primary ">Status</a></td> -->
                    <td>
                    <!-- /role-edit/{{$data->id}} -->
                        <a href="{{route('edit',['id'=>$data->id])}}" class="btn btn-success ">Edit</a>
                        
                    </td>
                    <td> <a href="{{route('view',['id'=>$data->id])}}" class="btn btn-primary ">View</a></td>
                    <td>
                 
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      </form>
      @endsection 

      @section('scripts')

   @endsection 