@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD Income Report</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-8 border-right">
                            <form method="POST" action="{{ route('fetch-opd-patient-report') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="visit_type">Visit Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="visit_type" class="form-control select2-show-search"
                                                id="visit_type">
                                                <option value="">Visit Type.....</option>
                                                <option value="New Visit" {{@$all_search_data['visit_type']=='New Visit'
                                                    ? 'selected' :'' }}>New-Visit</option>
                                                <option value="Revisit" {{@$all_search_data['visit_type']=='Revisit'
                                                    ? 'selected' :'' }}>Revisit</option>
                                            </select>
                                            @error('visit_type')
                                            <small class="text-danger">{{ $message }}</sma>
                                                @enderror
                                        </div>
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="patient_type">Patient Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="patient_type" onchange="getDetailsAccordingType(this.value)"
                                                class="form-control select2-show-search" id="patient_type">
                                                <option value="">Patient Type..... </option>
                                                @foreach (Config::get('static.patient_types') as $key => $patient_type)
                                                <option value="{{$patient_type}}"
                                                    {{@$all_search_data['patient_type']=='Revisit' ? 'selected' :'' }}>
                                                    {{$patient_type}}</option>
                                                @endforeach
                                            </select>

                                            @error('patient_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="department"> Department <span
                                                    class="text-danger">*</span></label>
                                            <select name="department" class="form-control select2-show-search"
                                                id="department">
                                                <option value="">Department</option>
                                                @foreach ($departments as $key => $department)
                                                <option value="{{$department->id}}"
                                                    {{@$all_search_data['department']==$department->id ? 'selected':''
                                                    }}> {{$department->department_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 newaddappon">
                                            <label for="cons_doctor">Consultant Doctor <span
                                                    class="text-danger">*</span></label>
                                            <select name="cons_doctor" class="form-control select2-show-search"
                                                id="cons_doctor">
                                                <option value="">Consultant Doctor</option>
                                                @foreach ($doctors as $key => $doctor)
                                                <option value="{{$doctor->id}}"
                                                    {{@$all_search_data['cons_doctor']==$doctor->id ? 'selected':'' }} >
                                                    {{$doctor->first_name}}
                                                    {{$doctor->last_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('cons_doctor')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4 addopdd">
                                            <label>From Date <span class="text-danger">*</span></label>
                                            <input type="date" name="from_date"
                                                value="{{ date(@$all_search_data['from_date']) }}" required />
                                            @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 addopdd ">
                                            <label>To Date <span class="text-danger">*</span></label>
                                            <input type="date" name="to_date"
                                                value="{{ date(@$all_search_data['to_date']) }}" required />
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
                                <th scope="col">OPD Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Patient Type</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">Department</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Visit Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @if (@$opd_patient_report[0]->id != null)
                            @foreach ($opd_patient_report as $value)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ @$value->opd_details_data->opd_prefix }}{{ @$value->opd_details_data->id }}</td>
                                <td>{{ @$value->opd_details_data->all_patient_details->prefix }}
                                    {{ @$value->opd_details_data->all_patient_details->first_name }}
                                    {{ @$value->opd_details_data->all_patient_details->middle_name }}
                                    {{ @$value->opd_details_data->all_patient_details->last_name }}({{
                                    @$value->opd_details_data->all_patient_details->id }})</td>
                                <td> @if (@$value->opd_details_data->all_patient_details->year != 0)
                                    {{ @$value->opd_details_data->all_patient_details->year }}y
                                    @endif
                                    @if (@$value->opd_details_data->all_patient_details->month != 0)
                                    {{ @$value->opd_details_data->all_patient_details->month }}m
                                    @endif
                                    @if (@$value->opd_details_data->all_patient_details->day != 0)
                                    {{ @$value->opd_details_data->all_patient_details->day }}d
                                    @endif</td>
                                <td>{{ @$value->opd_details_data->all_patient_details->guardian_name }}</td>
                                <td>{{ @$value->opd_details_data->all_patient_details->phone }}</td>
                                <td>{{ @$value->patient_type }}</td>
                                <td>{{ @$value->opd_details_data->case_id }}</td>
                                <td>{{ date('d-m-Y h:i A',
                                    strtotime(@$value->appointment_date)) }}</td>
                                <td> {{ @$value->department_details->department_name }}
                                </td>
                                <td>{{ @$value->doctor->first_name }}
                                    {{ @$value->doctor->last_name }}</td>
                                <td>
                                    {{ @$value->visit_type }}
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