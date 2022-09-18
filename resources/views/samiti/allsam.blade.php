@extends('layouts.newmaster')

@section('title')
All Samiti

@endsection


@section('content')
@include('admin.message')

<form method="POST" action="{{ Route('allsam') }}">
    @csrf
    <div class="container-fluid my-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Samiti List</h6>
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
                                <th>Samiti Name</th>
                                <th>Edit</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($sam as $data)

                            <tr>
                                <td>{{$i++}}</td>
                                <?php
                                $distdata = DB::table('districts')->where('id', $data->dist_id)->first();
                                $statedata = DB::table('states')->where('id', $data->state_id)->first();
                                $tehdata = DB::table('tehsils')->where('id', $data->teh_id)->first();
                                ?>
                                <td>{{$statedata->name}}</td>
                                <td>{{$distdata->dist_name}}</td>
                                <td>{{$tehdata->teh_name}}</td>
                                <td>{{$data->samiti_name}}</td>
                                <td>
                                    <a type="button" href="/edit-samiti/{{$data->id}}" style="font-size:25px" class="bi bi-pencil-square"></a>
                                <td>
                                    @if($data->status=="1")
                                    <a href="{{route('samstatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-on" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    <a href="{{route('samstatus',['id'=>$data->id])}}">
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