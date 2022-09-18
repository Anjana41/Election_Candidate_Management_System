@extends('layouts.newmaster')

@section('title')
All States

@endsection


@section('content')

@include('admin.message')


<form method="POST" action="{{ Route('allstates') }}">
    @csrf
    <!-- <div class="col d-flex justify-content-center"> -->
    <div class="container-fluid">

        <!-- Page Heading -->


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All States</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered  table text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>Sr.no</th>
                                <th>State Name</th>
                                <th>Edit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($states as $data)

                            <tr>
                                <td>{{$i++}}</td>

                                <td>{{$data->name}}</td>


                                <td>
                                    <a type="button" href="/edit-state/{{$data->id}}" style="font-size:25px" class="bi bi-pencil-square"></a>
                                <td>
                                    @if($data->status=="1")
                                    <a href="{{route('statestatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-on" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    <a href="{{route('statestatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-off" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>


                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @endsection