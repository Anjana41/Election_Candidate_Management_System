@extends('layouts.newmaster')

@section('title')
All Members

@endsection


@section('content')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
<style>
   #button {
     line-height: 25px;
     width: 100px;
     margin-top: 1px;
     margin-right: 2px;
     position:absolute;
     top:0.5%;
     right:1%;
 }
</style>
@include('admin.message')

<form method="POST" action="{{ Route('role') }}">
  @csrf
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Members</h6>
        <a href="/add-member" type="submit" id="button" class="btn btn-primary btn-sm">Add Member</a>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered  table text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>UserType</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Edit</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              ?>
              @foreach($users as $data)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$data->usertype}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->Gender}}</td>

                <td>
                  @if($data->status=="1")
                  <a href="{{route('status',['id'=>$data->id])}}">
                    <i style="font-size:25px" class="fas fa-toggle-on" aria-hidden="true"></i>
                  </a>
                  @else
                  <a href="{{route('status',['id'=>$data->id])}}">
                    <i style="font-size:25px" class="fas fa-toggle-off" aria-hidden="true"></i>
                  </a>
                  @endif
                </td>

                <td>
                  <a type="button" href="{{route('edit',['id'=>$data->id])}}" style="font-size:25px" class="bi bi-pencil-square"></a>

                </td>
                <td> <a style="font-size:25px" href="{{route('view',['id'=>$data->id])}}" class="bi bi-eye-fill ">
                </td>

            
              </tr>
              @endforeach
            </tbody>

          </table>
          <div class="pagination">
            {!! $users->links() !!}
        </div>

        </div>
      </div>
    </div>

  </div>

  </div>
  {{-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> --}}



  </body>
  


  @endsection