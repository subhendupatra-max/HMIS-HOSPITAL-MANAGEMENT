@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-2">
                        <div class="row">

                                <a class="btn btn-primary btn-sm mb-2" href=""><i class="fa fa-edit"></i> Edit</a>

                                <a class="btn btn-primary btn-sm ml-2 mb-2" href=""><i class="fa fa-trash"></i> Delete</a>

                        </div>
                    </div>
                </div>
                <hr class="ipd_header_border">
                <div class="row">
                    <div class="col-md-6">
                        <span class="head_name">Patient Name </span> : <span
                            class="value_name">{{ @$medicine_bill->all_patient_details->prefix }} {{ @$medicine_bill->all_patient_details->first_name }} {{ @$medicine_bill->all_patient_details->middle_name }} {{ @$medicine_bill->all_patient_details->last_name }}(
                            {{ @$medicine_bill->all_patient_details->patient_prefix }}{{ @$medicine_bill->all_patient_details->id }}  )</span>
                    </div>
                    <div class="col-md-3">
                        <span class="head_name">Patient Age</span> : <span
                            class="value_name">{{ @$medicine_bill->all_patient_details->year }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="head_name"> Gender</span> : <span
                            class="value_name">{{ @$medicine_bill->all_patient_details->gender }}</span>
                    </div>
                </div>
               
                <hr class="ipd_header_border ">
                @if (isset($medicine_bill_details[0]->medicine_name))
                <div class="table-responsive mt-5">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Medicine category</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicine_bill_details as $value)
                                <tr>
                                    <td>{{ @$value->medicine_name }}</td>
                                    <td>{!! @$value->medicine_catagory_name !!}</td>
                                    <td>{!! @$value->qty !!} {!! @$value->unit !!}</td>
                                    <td>{!! @$value->amount !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
