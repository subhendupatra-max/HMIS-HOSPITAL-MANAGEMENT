@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Medicine Details</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Name</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->medicine_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Catagory </span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->catagory_name->medicine_catagory_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Company</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->medicine_company }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Tax</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->tax }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Note</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->note }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Composition</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->medicine_composition }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50"> Medicine Group</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->medicine_group }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Min Level</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->min_level }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Unit</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        {{ @$medicine_details->unit_name->medicine_unit_name }}

                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50">Medicine Photo</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        @if(@$medicine_details->medicine_photo != null)
                                        <img src="{{ asset('public/assets/images/medicine') }}/{{ @$medicine_details->medicine_photo }}" style="width: 50px;  height: 40px;">
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="py-2 px-5">
                                        <span class="font-weight-semibold w-50 text-success">Avilable Stock</span>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span class="text-success">{{ @$avilable_stock }}</span>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <div class="card-body p-0 border-top">
            <div class="col-md-12">
                <div class="btn-list p-3">
                    <a class="btn btn-success btn-sm" href="{{ route('medicine-stock-details',['medicine_id'=>$medicine_details->id]) }}"><i class="fa fa-capsules"></i> Medicine Stock</a>
                    <a class="btn btn-danger btn-sm" href="{{ route('bad-medicine-details',['medicine_id'=>$medicine_details->id]) }}"><i class="fa fa-certificate"></i> Medicine Bad Stock</a>
                </div>
            </div>
        </div>

        @if(@$status == 'good_medicine')
        <div class="card-body">
            <h5>Medicine Stock Details</h5>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Batch No</th>
                                <th class="border-bottom-0">Expire Date</th>
                                <th class="border-bottom-0">QTY</th>
                                <th class="border-bottom-0">MRP</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Purchase Rate</th>
                                <th class="border-bottom-0">Sale Rate</th>
                                <th class="border-bottom-0">CGST</th>
                                <th class="border-bottom-0">SGST</th>
                                <th class="border-bottom-0">IGST</th>
                                <th class="border-bottom-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$medicine_details_stock[0]->id != null)
                            @foreach ($medicine_details_stock as $value)
                            <tr>
                                <td>{{ @$value->batch_no }}</td>
                                <td>{{ @$value->exp_date }}</td>
                                <td>{{ @$value->qty }}</td>
                                <td>{{ @$value->mrp }}</td>
                                <td>{{ @$value->discount }}</td>
                                <td>{{ @$value->p_rate }}</td>
                                <td>{{ @$value->s_rate }}</td>
                                <td>{{ @$value->cgst }}</td>
                                <td>{{ @$value->sgst }}</td>
                                <td>{{ @$value->igst }}</td>
                                <td>{{ @$value->amount }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @endif



        @if(@$status == 'bad_medicine')
        <div class="card-body">
            <div class="card-header">

                <div class="col-md-12 row">
                    <div class="col-md-6 card-title">
                        Expiry Medicine Details
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('add-bad-medicine',['medicine_id'=>$medicine_details->id]) }}"><i class="fa fa-plus"></i> Add Bad Medicine</a>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Batch No</th>
                                <th class="border-bottom-0">Qty</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$medicine_bad_stock[0]->id != null)
                            @foreach($medicine_bad_stock as $value)
                            <tr>
                                <td>{{ $value->batch_no }}</td>
                                <td>{{ $value->qty }}</td>
                   
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @endif
    </div>
</div>


@endsection