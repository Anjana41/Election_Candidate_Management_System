@extends('layouts.newmaster')

@section('title')
All Panchayat

@endsection


@section('content')
@include('admin.message')
<form method="POST" action="{{ Route('allvill') }}">
    @csrf
    <div class="container-fluid my-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Village List</h6>
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
                                <th>Panchayat Name</th>
                                <th>Village Name</th>
                                <th>Edit</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($vill as $data)

                            <tr>
                                <td>{{$i++}}</td>
                                <?php
                                $distdata = DB::table('districts')->where('id', $data->dist_id)->first();
                                $statedata = DB::table('states')->where('id', $data->state_id)->first();
                                $tehdata = DB::table('tehsils')->where('id', $data->teh_id)->first();
                                $samdata = DB::table('samitis')->where('id', $data->samiti_id)->first();
                                $pandata = DB::table('panchayats')->where('id', $data->panch_id)->first();


                                ?>
                                <td>{{$statedata->name}}</td>
                                <td>{{$distdata->dist_name}}</td>
                                <td>{{$tehdata->teh_name}}</td>
                                <td>{{$samdata->samiti_name}}</td>
                                <td>{{$pandata->panchayat_name}}</td>
                                <td>{{$data->village_name}}</td>


                                <td>
                                    <a type="button" href="/edit-village/{{$data->id}}" style="font-size:25px" class="bi bi-pencil-square"></a>
                                <td>
                                    @if($data->status=="1")
                                    <a href="{{route('villstatus',['id'=>$data->id])}}">
                                        <i style="font-size:25px" class="fas fa-toggle-on" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    <a href="{{route('villstatus',['id'=>$data->id])}}">
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