@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                       Referral Person List
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            @can('Referral Payment List')
                            <a href="{{ route('referral-payment-list') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i> Referral Payment</a>
                            @endcan
                            @can('')
                                <a href="{{ route('add-referral') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-user"></i> Add Referral Person</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            @include('message.notification')

            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl No.</th>
                                    <th class="border-bottom-0">Referral Name</th>
                                    <th class="border-bottom-0">Phone No</th>
                                    <th class="border-bottom-0">Address</th>
                                    <th class="border-bottom-0">Standard Commission(%)</th>
                                    <th class="border-bottom-0">OPD Commission(%)</th>
                                    <th class="border-bottom-0">EMG Commission(%)</th>
                                    <th class="border-bottom-0">IPD Commission(%)</th>
                                    <th class="border-bottom-0">Pharmacy Commission(%)</th>
                                    <th class="border-bottom-0">Pathology Commission(%)</th>
                                    <th class="border-bottom-0">Radiology Commission(%)</th>
                                    <th class="border-bottom-0">Blood Bank Commission(%)</th>
                                    <th class="border-bottom-0">Ambulance Commission(%)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (@$refferal_person)
                                @foreach ($refferal_person as $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ @$value->referral_name }}</td>
                                    <td>{{ @$value->phone_no }}</td>
                                    <td>{{ @$value->address }}</td>
                                    <td>{{ @$value->standard_commission }}</td>
                                    <td>{{ @$value->opd_commission }}</td>
                                    <td>{{ @$value->emg_commission }}</td>
                                    <td>{{ @$value->ipd_commission }}</td>
                                    <td>{{ @$value->pharmacy_commission }}</td>
                                    <td>{{ @$value->pathology_commission }}</td>
                                    <td>{{ @$value->radiology_commission }}</td>
                                    <td>{{ @$value->blood_bank_commission }}</td>
                                    <td>{{ @$value->ambulance_commission }}</td>
                                    <td>
                                        <div class="card-options">
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                <a class="dropdown-item" href="{{route('view-refferal',['id'=>base64_encode($value->id)])}}">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <a class="dropdown-item" href="{{route('edit-refferal',['id'=>base64_encode($value->id)])}}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a class="dropdown-item" href="{{route('delete-refferal-person',['id'=>base64_encode($value->id)])}}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
