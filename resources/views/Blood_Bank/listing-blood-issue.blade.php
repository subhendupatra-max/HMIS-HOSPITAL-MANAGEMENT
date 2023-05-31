@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Blood Issue Details
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">


                    </div>
                </div>
            </div>
        </div>
        <!-- ================================= Message ======================================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <!-- ================================= Message ======================================== -->
        @can('View Blood Donar')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Issue Date</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Refference Name</th>
                                <th scope="col">Technician</th>
                                <th scope="col">Payment Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blood_issue_details as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->patient_details->first_name }} {{ @$item->patient_details->last_name }}</td>
                                <td>{{ @$item->blood_group_details->blood_group_name}} </td>
                                <td>{{ @$item->issue_date}} </td>
                                <td>{{ @$item->doctor_details->first_name}} {{ @$item->doctor_details->last_name}}</td>
                                <td>{{ @$item->reference_name}} </td>
                                <td>{{ @$item->technician}} </td>
                                <td>{{ @$item->payment_amount}} </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit')
                                            <a class="dropdown-item" href="{{ route('edit-blood-issue-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete')
                                            <a class="dropdown-item" href="{{ route('delete-blood-issue-details',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

@endsection