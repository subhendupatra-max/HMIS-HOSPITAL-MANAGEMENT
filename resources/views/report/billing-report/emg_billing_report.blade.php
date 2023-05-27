@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">EMG Biliing Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-emg-billing-report') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">

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
                                <th scope="col">Bill Id</th>
                                <th scope="col">Patient Name </th>
                                <th scope="col">Bill Amount(Rs)</th>
                                <th scope="col">Billing Date</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col"> Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $due = 0;
                            $payment = 0;
                            ?>
                            @if (@$billing_report[0]->id != null)
                            @foreach ($billing_report as $value)
                            <?php $i = $i + $value->grand_total; ?>
                            <?php

                            if ($value->payment_status == 'Due') {
                                $due = $due + $value->grand_total;
                            } else {
                                $payment = $payment + $value->grand_total;
                            }
                            ?>
                            <tr>
                                <td>{{ @$value->bill_prefix }}{{ @$value->id }}</td>
                                <td>{{ @$value->patient_details->first_name }} {{ @$value->patient_details->middle_name }} {{ @$value->patient_details->last_name }}</td>
                                <td>{{ @$value->grand_total }}</td>

                                <td>{{ date('d-m-Y h:i A',strtotime(@$value->bill_date)) }}</td>
                                <td>
                                    {{ @$value->payment_status }}
                                </td>
                                <td>
                                    {{ @$value->status }}
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
<!-- <script>
    var xValues = ["Total Payment", "Total Due"];
    var yValues = ['<?php echo $payment ?>', '<?php echo $due ?>'];
    var barColors = [
        "#1e7145",
        "#b91d47",
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
</script> -->

<script>
    var xValues = ["Total Payment", "Total Due"];
    var yValues = ['<?php echo $payment ?>', '<?php echo $due ?>'];
    var barColors = [
        "#b91d47",
        "#00aba9",

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
        options: {
            title: {
                display: true,
                text: "Total Belling Report"
            }
        }
    });
</script>
@endsection