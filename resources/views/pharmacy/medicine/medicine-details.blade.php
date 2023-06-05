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
        @if(true)
        @include('pharmacy.medicine.medicine-bad-stock')
        @endif
        @if(true)
        @include('pharmacy.medicine.medicine-good-stock')
        @endif
    </div>
</div>


@endsection