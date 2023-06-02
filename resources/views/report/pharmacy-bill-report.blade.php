@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Pharmacy Bill Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-pharmacy-bill-report') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="discharge_status">Medicine Name </label>
                                            <select name="medicine_id" class="form-control select2-show-search" id="medicine_id">
                                                <option value="">Select Medicine Name</option>
                                                @foreach ($medicine_name as $key => $medicine_names)
                                                <option value="{{$medicine_names->id}}" {{@$all_search_data['medicine_id'] == $medicine_names->id ? 'selected':'' }}>{{$medicine_names->medicine_name}}
                                                </option>

                                                @endforeach
                                            </select>
                                            @error('medicine_id')
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
                                <th class="border-bottom-0">Medicine Name</th>
                                <th class="border-bottom-0">Sale Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @if (@$pharmacy_bill_details[0]->id != null)
                            @foreach ($pharmacy_bill_details as $value)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->first_name}} {{$value->middle_name}} {{$value->last_name}}</td>
                                <td>{{$value->medicine_name}}</td>
                                <td>{{$value->sale_price}}</td>
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