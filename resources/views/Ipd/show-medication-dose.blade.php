@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Medication
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('')
                        <a href="{{ route('add-medicaiton-dose',['ipd_id' => base64_encode($ipd_details->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Medication</a>
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
                        <table class="table table-bordered text-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl. No</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Time</th>
                                    <th class="border-bottom-0">Medicine Catagory</th>
                                    <th class="border-bottom-0">Medicine Name</th>
                                    <th class="border-bottom-0">Dosage</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $medication_details as $item)
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0"> {{ $item->date }} </td>
                                    <td class="border-bottom-0"> {{ $item->time }} </td>
                                    <td class="border-bottom-0">{{ @$item->medicine_catagory_name->medicine_catagory_name }}</td>
                                    <td class="border-bottom-0">{{ @$item->all_medicine_name->medicine_name }}</td>
                                    <td class="border-bottom-0">{{ @$item->dosage_name->dose }}</td>

                                    <td class="border-bottom-0">
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                @can('edit-medication-in-ipd')
                                                <a class="dropdown-item" href="{{ route('edit-medicaiton-dose',['ipd_id'=> base64_encode($ipd_details->id),'id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                                @endcan

                                                @can('delete-medication-in-ipd')
                                                <a class="dropdown-item" href="{{ route('delete-medicaiton-dose',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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