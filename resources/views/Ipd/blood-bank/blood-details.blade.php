@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                <h4 class="pro-user-username mb-3 font-weight-bold"> {{
                        @$patient_details_information->first_name }} {{ @$patient_details_information->middle_name }} {{ @$patient_details_information->last_name }} ({{ @$patient_details_information->patient_prefix }})<i class="fa fa-check-circle text-success"></i></h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('message.notification')

        <div class="card-body">
            <div class="options px-5 pt-2  border-bottom pb-1">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h5>
                            Blood Issue Details
                        </h5>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-white">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th class="text-white">Blood Group</th>
                                        <th class="text-white">Date</th>
                                        <th class="text-white">Bag</th>
                                        <th class="text-white">Blood Quentity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (@$blood_details as $item)

                                    <tr>
                                        <td>{{@$item->blood_group_details->blood_group_name}}</td>
                                        <td> {{@$item->issue_date}}</td>
                                        <td> {{@$item->bag}}</td>
                                        <td> {{@$item->blood_qty}}</td>
                                    </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            <div class="options px-5 pt-2  border-bottom pb-1">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h5>
                            Blood Components Issue Details
                        </h5>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-white">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th class="text-white">Blood Group</th>
                                        <th class="text-white">Date</th>
                                        <th class="text-white">Bag</th>
                                        <th class="text-white">Blood Components Quentity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (@$components_details as $item)

                                    <tr>
                                        <td>{{@$item->blood_group_details->blood_group_name}}</td>
                                        <td> {{@$item->issue_date}}</td>
                                        <td> {{@$item->bag}}</td>
                                        <td> {{@$item->components_qty}}</td>
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
</div>

@endsection