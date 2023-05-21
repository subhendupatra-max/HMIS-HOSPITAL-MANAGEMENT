@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Profile
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                {{-- ========================================================================================= --}}
                <div class="col-lg-4 col-xl-4 border-right">

                    {{-- ================== patient name ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span class="profileHeding">{{ @$ipd_details->all_patient_details->first_name }}
                                    {{ @$ipd_details->all_patient_details->middle_name }}
                                    {{ @$ipd_details->all_patient_details->last_name }}({{
                                    @$ipd_details->all_patient_details->patient_prefix }}{{
                                    @$ipd_details->all_patient_details->id }})</span>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient name ====================== --}}

                    {{-- ================== patient information ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-venus-mars text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Gender :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->gender }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-users text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Gurdian Name :-
                                        </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->guardian_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-mobile-alt text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Mobile No :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0"><i class="fa fa-calendar text-primary"></i></td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Age :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->year }}Y
                                        {{ @$ipd_details->all_patient_details->month }}M
                                        {{ @$ipd_details->all_patient_details->day }}D
                                    </td>
                                </tr>
                                <tr colspan="2">
                                    <td class="py-2 px-0"><i class="fa fa-map-pin text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Address :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->all_patient_details->address }},{{
                                        @$ipd_details->patient_state->name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- ================== patient information ====================== --}}

                    {{-- ================== patient registation information ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">IPD Id :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{$ipd_details->ipd_prefix}}{{$ipd_details->id}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Department :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->department_details->department_name }}( {{
                                        @$ipd_details->department_details->department_code }})
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fas fa-user-md text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Doctor :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$ipd_details->doctor_details->first_name}}
                                        {{@$ipd_details->doctor_details->last_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-bed text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Bed :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{$ipd_details->bed_details->bed_name}} -
                                        {{$ipd_details->unit_details->bedUnit_name}} -
                                        {{$ipd_details->ward_details->ward_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-users text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Admitted By :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->department_details->admitted_by }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Admitted By Contact No. :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ @$ipd_details->department_details->admitted_by_contact_no }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <span style="font-weight: bold; font-size: 15px;">Latest Physical Condition</span>
                        <table class="table table_border_none">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Height :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$PhysicalDetails->height == null ?'':$PhysicalDetails->height.' cm'}}
                                    </td>

                                    <td class="py-2 px-0">
                                        <i class="fa fa-weight text-primary"></i>

                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Weight :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$PhysicalDetails->weight == null ?'':$PhysicalDetails->weight.' kg'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Pulse :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$PhysicalDetails->pulse == null ?'':$PhysicalDetails->pulse.' bpm'}}
                                    </td>

                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">BP :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$PhysicalDetails->bp == null ?'':$PhysicalDetails->bp.' mmHg'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Temp :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$PhysicalDetails->temperature == null ?'':$PhysicalDetails->temperature.'
                                        °C'}}
                                    </td>

                                    <td class="py-2 px-0">
                                        <i class="fa fa-rocket text-primary"></i>
                                    </td>
                                    <td class="py-2 px-0">
                                        <span class="font-weight-semibold w-50">Resp :- </span>
                                    </td>
                                    <td class="py-2 px-0">
                                        {{@$PhysicalDetails->respiration == null ?'':$PhysicalDetails->respiration.'
                                        b/m'}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- ================== patient registation information ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-weight: bold; font-size: 15px;">Total Payment Amount : ₹{{
                                    $payment_amount }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <span style="font-weight: bold; font-size: 15px;">Total Billing Amount : ₹{{
                                    $billing_amount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ========================================================================================= --}}

                {{-- ========================================================================================= --}}
                <div class="col-lg-8 col-xl-8 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">

                                <div class="row">
                                    <div class="col-md-6">
                                        <canvas id="canvas"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="myChart" style="width:70%;max-width:400px"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Pathology Test</h5>
                                @if (@$PathologyTestDetails[0]->id != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Test Name</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Billing Status</th>
                                                <th class="text-white">Test Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (@$PathologyTestDetails as $item)
                                            <tr>
                                                <td>{{ @$item->test_details->test_name }}</td>
                                                <td>{{@date('d-m-Y h:i A',strtotime($item->date))}}</td>
                                                <td>
                                                    @if($item->billing_status == '0')
                                                    <span class="badge badge-warning">Billing Not Done</span>
                                                    @elseif ($item->billing_status == '1')
                                                    <span class="badge badge-warning">Billing Done</span>
                                                    @else
                                                    <span class="badge badge-warning">Charge Added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->test_status == '0')
                                                    <span class="badge badge-warning">Sample Not Collected</span>
                                                    @else
                                                    <span class="badge badge-success">Sample Collected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Pathology Test done **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Radiology Test</h5>
                                @if (@$RadiologyTestDetails[0]->id != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-success">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th class="text-white">Test Name</th>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Billing Status</th>
                                                <th class="text-white">Test Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($RadiologyTestDetails as $item)
                                            <tr>
                                                <td>{{ @$item->test_details->test_name }}</td>
                                                <td>{{@date('d-m-Y h:i A',strtotime($item->date))}}</td>
                                                <td>
                                                    @if($item->billing_status == '0')
                                                    <span class="badge badge-warning">Billing Not Done</span>
                                                    @elseif ($item->billing_status == '1')
                                                    <span class="badge badge-warning">Billing Done</span>
                                                    @else
                                                    <span class="badge badge-warning">Charge Added</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->test_status == '0')
                                                    <span class="badge badge-warning">Sample Not Collected</span>
                                                    @else
                                                    <span class="badge badge-success">Sample Collected</span>
                                                    @endif
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Radiology Test done **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Ambulance</h5>
                                @if (@$PhysicalDetails[0]->height != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-danger">
                                        <thead class="bg-danger text-white">
                                            <tr>
                                                <th class="text-white">Height</th>
                                                <th class="text-white">Weight</th>
                                                <th class="text-white">Pulse</th>
                                                <th class="text-white">BP</th>
                                                <th class="text-white">Temp</th>
                                                <th class="text-white">Resp</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach (@$PhysicalDetails as $item)
                                            <tr>
                                                <td>{{@$item->height == null ?'':$item->height.' cm'}}</td>
                                                <td>{{@$item->weight == null ?'':$item->weight.' kg'}}</td>
                                                <td>{{@$item->pulse == null ?'':$item->pulse.' bpm'}}</td>
                                                <td>{{@$item->bp == null ?'':$item->bp.' mmHg'}}</td>
                                                <td>{{@$item->temperature == null ?'':$item->temperature.' °C'}}</td>
                                                <td>{{@$item->respiration == null ?'':$item->respiration.' b/m'}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Ambulance used **</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <h5>Blood Bank</h5>
                                @if (@$PhysicalDetails[0]->height != null)
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-danger">
                                        <thead class="bg-danger text-white">
                                            <tr>
                                                <th class="text-white">Height</th>
                                                <th class="text-white">Weight</th>
                                                <th class="text-white">Pulse</th>
                                                <th class="text-white">BP</th>
                                                <th class="text-white">Temp</th>
                                                <th class="text-white">Resp</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach (@$PhysicalDetails as $item)
                                            <tr>
                                                <td>{{@$item->height == null ?'':$item->height.' cm'}}</td>
                                                <td>{{@$item->weight == null ?'':$item->weight.' kg'}}</td>
                                                <td>{{@$item->pulse == null ?'':$item->pulse.' bpm'}}</td>
                                                <td>{{@$item->bp == null ?'':$item->bp.' mmHg'}}</td>
                                                <td>{{@$item->temperature == null ?'':$item->temperature.' °C'}}</td>
                                                <td>{{@$item->respiration == null ?'':$item->respiration.' b/m'}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <span style="color:brown">** No Blood or Blood Component used **</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                {{-- ========================================================================================= --}}
            </div>
        </div>
    </div>
</div>
<script>
    var xValues = ["Cradit Limit", "Billing"];
    var yValues = [55, 15];
    var barColors = [
      "#b91d47",
      "#1e7145"
    ];
    
    new Chart("myChart", {
      type: "pie",
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
          text: "Cradit Limit"
        }
      }
    });
</script>

<script>
    var barChartData = {
  labels: [
    "20-05-2023",
    "21-05-2023",
    "22-05-2023",
    "23-05-2023",
    "24-05-2023",


  ],
  datasets: [
    {
      label: "Billing Amount",
      backgroundColor: "red",
      borderColor: "red",
      borderWidth: 1,
      data: [3000, 5000, 6000, 7000,3500]
    },
    {
      label: "Payment Amount",
      backgroundColor: "blue",
      borderColor: "blue",
      borderWidth: 1,
      data: [1000, 5000, 3000, 5000, 3000]
    },
   
  ]
};

var chartOptions = {
  responsive: true,
  legend: {
    position: "top"
  },
  title: {
    display: true,
    text: "Daily Billing Payment"
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  }
}

window.onload = function() {
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myBar = new Chart(ctx, {
    type: "bar",
    data: barChartData,
    options: chartOptions
  });
};

</script>
@endsection