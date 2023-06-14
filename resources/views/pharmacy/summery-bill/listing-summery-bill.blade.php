@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Billing Summery</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">


                <div class="col-lg-12 col-xl-12">
                    <div class="options px-5 pt-1  border-bottom pb-3">
                        <div class="row">
                            {{-- ================== Search patient ====================== --}}
                            <div class="options px-5 pt-5  border-right pb-3">
                                <form method="post" action="{{ route('summery-bill-pharmacy') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <select class="form-control  select2-show-search" name="case_id" required>
                                                <option value="">Search Case Id...</option>
                                                @if (isset($case_id))
                                                @foreach ($case_id as $item)
                                                <option value="{{ @$item->id }}">
                                                    {{ $item->id }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('case_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-2">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            {{-- ================== Search patient ====================== --}}

                            @if (isset($patient_details_information))
                            {{-- ================== patient Details ====================== --}}


                            {{-- ================== patient Details ====================== --}}
                            @endif

                        </div>
                    </div>
                    <div class="options px-5 pt-1  border-bottom pb-3">

                        <div class="row">

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col" style="width: 10%">Category</th> --}}
                                            <!-- <th scope="col">Name</th> -->
                                            <th scope="col">Name</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Batch No</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">MRP
                                            </th>
                                            <th scope="col">Sale Price</th>
                                            <th scope="col">Qty
                                            </th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">CGST
                                            <th scope="col">SGST
                                            </th>
                                            <th scope="col">IGST
                                            </th>
                                            <th scope="col">Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (@$medicine_billing[0]->id != null)
                                        @foreach ($medicine_billing as $value)

                                        <tr>

                                            <td> {{ @$value->all_patient_details->first_name}} {{ @$value->all_patient_details->middle_name}} {{ @$value->all_patient_details->last_name}} </td>

                                            <td> {{ @$value->section}} </td>

                                            <td> {{ @$value->medicine_billing_details->medicine_batch }} </td>
                                            <td> {{ @$value->medicine_billing_details->medicine_expiry_date }} </td>
                                            <td> {{ @$value->medicine_billing_details->mrp }} </td>

                                            <td> {{ @$value->medicine_billing_details->sale_price }} </td>

                                            <td> {{ @$value->medicine_billing_details->qty }} </td>

                                            <td> {{ @$value->medicine_billing_details->unit_name->medicine_unit_name }} </td>

                                            <td> {{ @$value->medicine_billing_details->cgst }} </td>
                                            <td> {{ @$value->medicine_billing_details->sgst }} </td>
                                            <td> {{ @$value->medicine_billing_details->igst }} </td>
                                            <td> {{ @$value->medicine_billing_details->amount }} </td>

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
        </div>
    </div>
</div>



@endsection