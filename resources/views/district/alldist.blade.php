@extends('layouts.newmaster')

@section('title')
All Districts

@endsection


@section('content')
<style>
    .my-4 {
        margin-top: 0.0rem !important;
        margin-bottom: 25.0rem !important;

    }
</style>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>

@include('admin.message')

<form method="POST" action="{{ Route('allstates') }}">
    @csrf
    <!-- <div class="col d-flex justify-content-center"> -->
    <div class="container-fluid my-4">

        <!-- Page Heading -->


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">District List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered  table text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>Sr.no</th>
                                <th>State Name</th>
                                <th>District Name</th>
                                <th>Edit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($dist as $data)

                            <tr>
                                <td>{{$i++}}</td>
                                <?php
                                $statedata = DB::table('states')->where('id', $data->state_id)->first();
                                ?>
                                <td>{{$statedata->name}}</td>
                                <td>{{$data->dist_name}}</td>
                                <td>
                                    <a type="button" href="/edit-district/{{$data->id}}" style="font-size:25px" class="bi bi-pencil-square"></a>
                                <td>
                                    @if($data->status=="1")
                                    <a href="{{route('diststatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-on" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    <a href="{{route('diststatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-off" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>


                                </td>@php

                                @endphp

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