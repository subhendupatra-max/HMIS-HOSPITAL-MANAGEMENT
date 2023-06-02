@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Blood Donor Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-blood-donor-details') }}">
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
                                <th scope="col">Donor Name</th>
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Contact No</th>
                                <th scope="col">Father Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @if (@$blood_donor_details[0]->id != null)
                            @foreach ($blood_donor_details as $item)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->donor_name}} </td>
                                <td>{{ @$item->date_of_birth}} </td>
                                <td>{{ @$item->blood_group}} </td>
                                <td>{{ @$item->gender}} </td>
                                <td>{{ @$item->father_name}} </td>
                                <td>{{ @$item->ph_no}} </td>
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