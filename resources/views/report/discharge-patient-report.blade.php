@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Discharge Patient Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-discharge-patient-report') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="discharge_status">Discharge Status </label>
                                            <select name="discharge_status" class="form-control select2-show-search" id="discharge_status">
                                                <option value="">Select Discharge Status</option>
                                                @foreach (Config::get('static.discharge_type') as $lang => $dischargeType)
                                                <option value="{{$dischargeType}}" {{@$all_search_data['discharge_status'] == $dischargeType ? 'selected':'' }}>{{$dischargeType}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('discharge_status')
                                            <small class="text-danger">{{ $message }}</sma>
                                                @enderror
                                        </div>
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="icd_code">Icd Code </label>
                                            <select name="doctor" class="form-control select2-show-search" id="doctor">
                                                <option value="">Select Icd Code</option>
                                                @foreach ($icd_code as $key => $icd_codes)
                                                <option value="{{$icd_codes->id}}" {{@$all_search_data['icd_code'] == $icd_codes->id ? 'selected':'' }}>{{ $icd_codes->diagonasis_name }}({{
                                                        $icd_codes->icd_code }})
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('icd_code')
                                            <small class="text-danger">{{ $message }}</sma>
                                                @enderror
                                        </div>


                                        <div class="form-group col-md-4 addopdd">
                                            <label>From Date <span class="text-danger">*</span></label>
                                            <input type="date" name="from_date" value="{{ date(@$all_search_data['from_date']) }}" required />
                                            @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 addopdd ">
                                            <label>To Date <span class="text-danger">*</span></label>
                                            <input type="date" name="to_date" value="{{ date(@$all_search_data['to_date']) }}" required />
                                            @error('to_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 border-right">
                            <canvas id="myChart" style="width:100%;max-width:300px"></canvas>
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
                                <th class="border-bottom-0">SL. No</th>
                                <th class="border-bottom-0">Patient Name</th>
                                <th class="border-bottom-0">Discharge Date</th>
                                <th class="border-bottom-0">Discharge Status</th>
                                <th class="border-bottom-0">Icd Code </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @if (@$discharge_details[0]->id != null)
                            @foreach ($discharge_details as $value)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->patient_details->first_name}} {{$value->patient_details->middle_name}}{{$value->patient_details->last_name}}</td>
                                <td>{{$value->discharge_date}}</td>
                                <td>{{$value->discharge_status}}</td>
                                <td>{{$value->diagnosis_details->diagonasis_name}}({{$value->diagnosis_details->icd_code}})</td>
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
<script>
    var xValues = ["No of Patient"];
    var yValues = ['<?php echo $i ?>'];
    var barColors = [
        "#1e7145"
    ];

    new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
    });
</script>
@endsection