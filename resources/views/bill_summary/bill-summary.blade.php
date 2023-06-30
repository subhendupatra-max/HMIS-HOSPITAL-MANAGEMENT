@extends('layouts.layout')
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <form action="{{ route('billing-summary') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row mt-5 ml-2">
                    <div class="form-group col-md-6">
                      
                        <input type="number" style="margin: 0px 0px 0px 0px;" class="form-control billsummary" id="uhid_no_case_id"
                            name="uhid_no_case_id" required placeholder="Patient's Bill Search">
                        @error('uhid_no_case_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-5">
                        <select name="case_id_or_uhid_select" class="form-control">
                            <option value="">Select One...</option>
                            <option value="case_id">Case Id</option>
                            <option value="uhid">UHID</option>
                        </select>
                    </div>
                 
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-sm ml-6 mb-3"> <i class="fa fa-search"></i>
                    Search</button>
                </div>
              
            </form>
            </div>
        </div>
        <div class="col-lg-8">
        @if(@$uhid_no_case_id == null)
            <div class="card">
                <img src="{{ asset('public/no_found_data/no_data.png') }}" alt="loader" width="400px"
                height="160px" style="margin: 146px 0px 210px 253px;">
            </div>
        @else
            <div class="card">
                <div class="card-header d-block">
                    <div class="row">
                        <div class="col-md-4 card-title">
                            Bill Details
                        </div>
                        <div class="col-md-8 text-right">
                            <div class="d-block">
                                {{-- <a class="btn btn-primary btn-sm" href="{{ route('edit-opd-bill',['bill_id' => base64_encode($bill_details->id),'id' => base64_encode($bill_details->opd_id) ]) }}"  data-placement="top" data-toggle="tooltip" title="Edit Bill"><i class="fa fa-edit"></i> Edit</a> --}}
                                <a class="btn btn-primary btn-sm" href="{{route('print-patient-bill',['bill_id'=>base64_encode($bill_details->id)])}}" data-placement="top" data-toggle="tooltip" title="Print Bill Copy"><i class="fa fa-print"></i> Print</a>
        
                                <a class="btn btn-primary btn-sm" href="{{route('print-patient-payement-slip',['bill_id'=>base64_encode($bill_details->id)])}}" data-placement="top" data-toggle="tooltip" title="Print Payment Slip"><i class="fa fa-print"></i> Payment Slip</a>
        
                                @if($bill_details->payment_status == 'Due')
                                @can('take Payment')
                                <a class="btn btn-primary btn-sm" href="{{route('add-payment-bill',['bill_id'=>base64_encode($bill_details->id)])}}" data-placement="top" data-toggle="tooltip" title="add payment"><i class="fa fa-rupee"></i> Add Payment</a>
                                @endcan
                                @endif
                   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        {{-- ========================================================================== --}}
                        <div class="col-lg-4 col-xl-4 border-right">
                            <div class="mt-2">
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Bill No : </span><span class="requisition_text">{{
                                        @$bill_details->bill_prefix }}{{ @$bill_details->id }}</span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Bill Date : </span><span class="requisition_text">
                                        <?= date('d-m-Y h:i', strtotime($bill_details->bill_date)) ?>
                                    </span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Created By : </span><span class="requisition_text">{{
                                        @$bill_details->created_details->first_name }}
                                        {{ @$bill_details->created_details->last_name }}</span>
                                </div>
        
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Payment Status </span><span class="badge badge-success">{{
                                        $bill_details->payment_status }}</span>
                                </div>
        
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Discount Status </span><span class="badge badge-success">{{
                                        $bill_details->discount_status }}</span>
                                </div>
                                @if($bill_details->discount_status != 'Not applied')
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Requested Discount Amount : </span><span style="color:red">
                                        {{ $discount_details->discount->asking_discount_amount }} {{
                                        $discount_details->discount->discount_type == 'flat' ? 'Rs' : '%' }}</span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Requested Discount Date </span><span
                                        class="requisition_text"> :
                                        <?= date('d-m-Y h:i', strtotime($discount_details->discount->asking_discount_time)) ?>
                                    </span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Requested Discount By </span><span
                                        class="requisition_text"> : {{
                                        $discount_details->discount->request_by_details->first_name }} {{
                                        $discount_details->discount->request_by_details->last_name }} </span>
                                </div>
                                @endif
                                @if($bill_details->discount_status == 'Approved')
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Appoved Discount Amount </span><span
                                        class=requisition_text"> : {{ $discount_details->discount->given_discount_amount }} {{
                                        $discount_details->discount->given_discount_type == 'flat' ? 'Rs' : '%' }}</span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Appoved Discount Date </span><span
                                        class="requisition_text"> :
                                        <?= date('d-m-Y h:i', strtotime($discount_details->discount->given_discount_time)) ?>
                                    </span>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <span class="requisition_header">Appoved Discount By </span><span class="requisition_text">
                                        : {{ @$discount_details->discount->given_by_details->first_name }} {{
                                        @$discount_details->discount->given_by_details->last_name }} </span>
                                </div>
                                @endif
        
                                @if($bill_details->payment_status != 'Due')
                                <div class="col-md-12">
                                    <img src="{{ asset('public/others/paid.png') }}" style="margin: 47px 0px 0px 125px;">
                                </div>
                                @endif
        
        
        
                            </div>
                        </div>
                        {{-- ========================================================================== --}}
        
                        {{-- ========================================================================= --}}
                        <div class="col-lg-8 col-xl-8 border-right">
                            {{-- ================== add new patient ====================== --}}
                            <div class="options px-5 pt-2  border-bottom pb-1">
                                <div class="row">
                                   
                                    <div class="table-responsive">
                                        <h5>Charge details</h5>
                                        <table class="table table-striped card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Charge Name</th>
                                                    <th>Charge Amount</th>
                                                    <th>Qty</th>
                                      
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($patient_charge_details) && $patient_charge_details != '')
                                                @foreach ($patient_charge_details as $charge)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ @$charge->charges_name }}</td>
                                                    <td>{{ @$charge->standard_charges }}</td>
                                                    <td>{{ @$charge->qty }}</td>
                             
                                                    <td>{{ @$charge->amount }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="container mt-5" style="margin-left: -53px;">
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                                                    ₹ {{ @$bill_details->total_amount }} </span>
                                            </div>
                                            @if($bill_details->discount_status == 'Approved' )
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Discount </span><span class="bilpo_value"> :
                                                    {{ @$discount_details->discount->given_discount_amount }} {{
                                                    @$discount_details->discount->given_discount_type == 'flat' ? 'Rs': '%'
                                                    }}</span>
                                            </div>
                                            @endif
            
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Grand Total </span><span class="bilpo_value"> :
                                                    ₹ {{ number_format((float) $bill_details->grand_total, 2, '.', '') }}
                                                    </span>
                                            </div>
        
                                        </div>
                                        <h5>Payment details</h5>
                                        <table class="table table-striped card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Payment Id</th>
                                                    <th>Payment Date</th>
                                                    <th>Payment Amount</th>
                                                    <th>Payment Mode</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $payment_total = 0; ?>
                                                @if (isset($payment_details) && $payment_details != '')
                                                @foreach ($payment_details as $payment)
                                                <?php $payment_total += $payment->payment_amount;  ?>
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ @$payment->payment_prefix }}{{ @$payment->id }}</td>
                                                    <td>{{ date('Y-m-d h:i A',strtotime(@$payment->payment_date)) }}</td>
                                                    <td>{{ @$payment->payment_amount }}</td>
                                                    <td>{{ @$payment->payment_mode }}</td>
                                                    <td>{{ @$payment->note }}</td>
                                                    <td>
                                                        @can('edit Payment')
                                                            <a class="text-success" href="{{ route('edit-bill-payment',base64_encode($payment->id)) }}"><i class="fa fa-edit"></i></a>
                                                        @endcan
                                                        @can('delete Payment')
                                                        <a class="text-danger" href="{{ route('delete-bill-payment',base64_encode($payment->id)) }}"><i class="fa fa-trash"></i></a>
                                                        @endcan
                                              
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="container mt-5" style="margin-left: -53px;">
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Total 0Paid </span><span class="bilpo_value"> :
                                                   ₹ {{ @$payment_total }} </span>
                                            </div>
                                         
                                        @if($bill_details->payment_status == 'Due')
                                        <?php $due_amount = $bill_details->grand_total - $payment_total  ?>
                                            <div class="d-flex justify-content-end">
                                                <span class="bilpo_name">Total Due </span><span class="bilpo_value"> :
                                                   ₹ {{ @$due_amount }} </span>
                                            </div>
                                        @endif
                                        </div>
                                  
                                    </div><!-- bd -->
                                </div>
        
                            </div>
                        </div>
                        {{-- ======================================================================== --}}
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
</div>
@endsection