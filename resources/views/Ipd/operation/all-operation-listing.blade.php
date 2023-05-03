@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Operation
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('add-ipd-operation-details',['ipd_id' => base64_encode($ipd_details->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Operation</a>
                        @endcan

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('message.notification')
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl. No</th>
                                    <th class="border-bottom-0">Operation Department</th>
                                    <th class="border-bottom-0">Operation Name</th>
                                    <th class="border-bottom-0">Consultant Doctor</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $operation_details as $item)
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">{{ @$item->operation_departments->department_name }} </td>
                                    <td class="border-bottom-0">{{ @$item->operation_name }}</td>
                                    <td class="border-bottom-0">{{ @$item->doctorName->first_name }} {{ @$item->doctorName->last_name }}</td>
                                    <td class="border-bottom-0">{{ @$item->operation_date }}</td>
                                    <td class="border-bottom-0"> {{ @$item->status }} </td>
                                    <td class="border-bottom-0">
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                @can('edit operation theatre')
                                                <a class="dropdown-item" href="#">
                                                    <i class="fa fa-edit"></i> Edit</a>
                                                @endcan
                                                @can('delete operation theatre')
                                                <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                                @endcan
                                                @can('change status operation theatre')
                                                <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Change Status</a>
                                                @endcan
                                            </div>
                                        </div>
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
</div>


@endsection