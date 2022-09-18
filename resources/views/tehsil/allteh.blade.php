@extends('layouts.newmaster')

@section('title')
All Tehsil

@endsection


@section('content')

@include('admin.message')

<form method="POST" action="{{ Route('allstates') }}">
    @csrf
    <div class="container-fluid my-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tehsil List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered  table text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>State Name</th>
                                <th>District Name</th>
                                <th>Tehsil Name</th>
                                <th>Edit</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($teh as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <?php
                                $distdata = DB::table('districts')->where('id', $data->dist_id)->first();
                                $statedata = DB::table('states')->where('id', $data->state_id)->first();
                                ?>
                                <td>{{$statedata->name}}</td>
                                <td>{{$distdata->dist_name}}</td>
                                <td>{{$data->teh_name}}</td>
                                <td>
                                    <a type="button" href="/edit-tehsil/{{$data->id}}" style="font-size:25px" class="bi bi-pencil-square"></a>
                                <td>
                                    @if($data->status=="1")
                                    <a href="{{route('tehstatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-on" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    <a href="{{route('tehstatus',['id'=>$data->id])}}">
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

    @endsection