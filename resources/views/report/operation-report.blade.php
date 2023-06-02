@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Operaiton Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-operation-report') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="discharge_status">Operation Catagory </label>
                                            <select name="operatoin_catagory" class="form-control select2-show-search" id="operatoin_catagory">
                                                <option value="">Select Operation Catagory</option>
                                                @foreach ($operation_catagory as $key => $catagory)
                                                <option value="{{$catagory->id}}" {{@$all_search_data['operatoin_catagory'] == $catagory->id ? 'selected':'' }}>{{$catagory->operation_catagory_name}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('operatoin_catagory')
                                            <small class="text-danger">{{ $message }}</sma>
                                                @enderror
                                        </div>
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="operation_name">Operation Name </label>
                                            <select name="operation_name" class="form-control select2-show-search" id="operation_name">
                                                <option value="">Select Operation Catagory</option>
                                                @foreach ($operation_id as $key => $operation_ids)
                                                <option value="{{$operation_ids->id}}" {{@$all_search_data['operation_name'] == $operation_ids->id ? 'selected':'' }}>{{$operation_ids->operation_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('operation_name')
                                            <small class="text-danger">{{ $message }}</sma>
                                                @enderror
                                        </div>
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="operation_status">Operation Status </label>
                                            <select name="operation_status" class="form-control select2-show-search" id="operation_status">
                                                <option value="">Select Discharge Status</option>
                                                @foreach (Config::get('static.main_operation_status') as $lang => $operation_status)
                                                <option value="{{$operation_status}}" {{@$all_search_data['operation_status'] == $operation_status ? 'selected':'' }}>{{$operation_status}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('operation_status')
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
                                <th class="border-bottom-0">Operation Name</th>
                                <th class="border-bottom-0">Operation Department</th>
                                <th class="border-bottom-0">Operation Catagory </th>
                                <th class="border-bottom-0">Consultant Doctor</th>
                                <th class="border-bottom-0">Date From</th>
                                <th class="border-bottom-0">Date To</th>
                                <th class="border-bottom-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @if (@$operation_details[0]->operation_name != null)
                            @foreach ($operation_details as $operation_detail)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$operation_detail->first_name }} {{$operation_detail->middle_name }} {{$operation_detail->last_name }}</td>
                                <td> {{ @$operation_detail->operation_name }} </td>
                                <td> {{ @$operation_detail->department_name }} </td>
                                <td> {{ @$operation_detail->operation_catagory_name }} </td>
                                <td> {{ @$operation_detail->doctor_first_name }} {{ @$operation_detail->doctor_last_name }} </td>
                                <td> {{ @$operation_detail->operation_date_from }} </td>
                                <td> {{ @$operation_detail->operation_date_to }} </td>

                                <td> @if($operation_detail->status == 'Pending')
                                    <span class="badge badge-warning"> {{ $operation_detail->status }}</span>
                                    @elseif($operation_detail->status == 'Complete')
                                    <span class="badge badge-success"> {{ $operation_detail->status }}</span>
                                    @else
                                    <span class="badge badge-secondary"> {{ $operation_detail->status }}</span>
                                    @endif
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