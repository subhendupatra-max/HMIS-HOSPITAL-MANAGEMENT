@extends('layouts.layout')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Referral Commission Report</div>
            </div>
            @include('message.notification')
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-12 border-right">
                                <form method="POST" action="{{ route('fetch-referral-payment-report') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="payment_mode">Referrar Name <span
                                                        class="text-danger">*</span></label>
                                                <select name="referrar_name" class="form-control select2-show-search"
                                                    id="referrar_name">
                                                    <option value="">Select Referrar Name....</option>
                                                    @foreach ($referer as $value)
                                                        <option value="{{ $value->id }}" {{ @$all_search_data['referrar_name'] == $value->id ? 'selected':'' }}>
                                                            {{ $value->referral_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('payment_mode')
                                                    <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                          
                                            <div class="form-group col-md-4 addopdd">
                                                <label>From Date <span class="text-danger">*</span></label>
                                                <input type="date" value="@if(@$all_search_data['from_date'] != null) {{ date('Y-m-d',strtotime($all_search_data['from_date'])) }} @endif" name="from_date"
                                                    required />
                                                @error('from_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4 addopdd ">
                                                <label>To Date <span class="text-danger">*</span></label>
                                                <input type="date" name="to_date"
                                                    value="@if(@$all_search_data['from_date'] != null) {{ date('Y-m-d',strtotime($all_search_data['to_date'])) }}  @endif" required />
                                                @error('to_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i
                                                class="fa fa-search"></i> Search</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Patient Details</th>
                                    <th scope="col">Bill Id</th>
                                    <th scope="col">Bill Amount</th>
                                    <th scope="col">Commission Amount(Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @if (@$referral_payment_details[0]->id != null)
                                    @foreach ($referral_payment_details as $value)
                                        <?php $i += intval($value->commission_amount); ?>
                                        <tr>
                                            <td>{{ date('d-m-Y h:i A', strtotime(@$value->date)) }}</td>
                                            <td>
                                                {{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }}<br>
                                                {{ @$value->all_patient_details->patient_prefix }}{{ @$value->all_patient_details->id }}
                                            </td>
                                            <td>{{ @$value->bill_id }}</td>
                                            <td>{{ @$value->bill_amount }}</td>
                                            <td>{{ @$value->commission_amount }}</td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
           <div class="">
            <div class="container mt-5" style="margin-left: 57px;">
                <div class="d-flex justify-content-end">
                    <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                        </span>
                        <span class="bilpo_name">{{ @$i }}</span>
                </div>
              
                

            </div>
           </div>
            </div>
        </div>
    </div>

@endsection
