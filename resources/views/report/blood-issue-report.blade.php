@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Blood Issue Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-blood-issue-report') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="blood_group_id">Blood Group</label>
                                            <select name="blood_group_id" class="form-control select2-show-search" id="blood_group_id">
                                                <option value="">Select Blood Group</option>
                                                @foreach ($blood_group as $key => $blood_groups)
                                                <option value="{{$blood_groups->id}}" {{@$all_search_data['blood_group_id'] == $blood_groups->id ? 'selected':'' }}>{{$blood_groups->blood_group_name}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('blood_group_id')
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
                                <th scope="col">Sl No.</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Issue Date</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Refference Name</th>
                                <th scope="col">Technician</th>
                                <th scope="col">Payment Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @if (@$blood_issue_details[0]->id != null)
                            @foreach ($blood_issue_details as $item)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->patient_details->first_name }} {{ @$item->patient_details->last_name }}</td>
                                <td>{{ @$item->blood_group_details->blood_group_name}} </td>
                                <td>{{ @$item->issue_date}} </td>
                                <td>{{ @$item->doctor_details->first_name}} {{ @$item->doctor_details->last_name}}</td>
                                <td>{{ @$item->reference_name}} </td>
                                <td>{{ @$item->technician}} </td>
                                <td>{{ @$item->payment_amount}} </td>
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