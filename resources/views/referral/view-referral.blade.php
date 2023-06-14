@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="pro-user-username mb-3 font-weight-bold">{{ @$referral->referral_name }}  <i class="fa fa-check-circle text-success"></i></h4>
                </div>

                <div class="col-md-6 text-right">

                    {{-- @can('edit patient')
                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Details</a>
                    @endcan

                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" style="">

                        <a class="dropdown-item" href=""><i class="fa fa-plus"></i> OPD Registation</a>
                        <a class="dropdown-item" href="><i class="fa fa-stethoscope"></i> EMG Registation</a>
                    </div> --}}

                </div>

            </div>
        </div>
        <div class="card-body p-0">
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Referral Details </h5>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Phone No </span>
                                        </td>
                                        <td class="py-2 px-5">{!!$referral->phone_no!!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <spddress class="font-weight-semibold w-50">Address </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$referral->address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">OPD Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$referral->opd_commission }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> IPD Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$referral->ipd_commission }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">EMG Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$referral->emg_commission }}
                                        </td>
                                    </tr>
                           
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Pharmacy Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$referral->pharmacy_commission }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Pathology Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">{!!$referral->pathology_commission!!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <spddress class="font-weight-semibold w-50">Radiology Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">
                                            {{ @$referral->radiology_commission }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50">Ambulance Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$referral->ambulance_commission }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-5">
                                            <span class="font-weight-semibold w-50"> Blood Bank Commission(%) </span>
                                        </td>
                                        <td class="py-2 px-5">{{ @$referral->blood_bank_commission }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Opd Registation Details </h5>
                <div class="col-md-12">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">OPD Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Last Visit Details</th>
                                <th scope="col">TAT(Turn around time)</th>
                                <th scope="col">Total Billing(Rs)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($opd_registaion_list))
                            @foreach ($opd_registaion_list as $value)
                            <?php
                            $appoint_date = $value->appointment_date;
                            $last_activity = DB::table('patient_charges')->where('section','OPD')->where('case_id',$value->opd_details_data->case_id)->orderBy('id','DESC')->first();

                            $total_billing = DB::table('patient_charges')->where('section','OPD')->where('case_id',$value->opd_details_data->case_id)->sum('amount');


                            if($last_activity != null){
                            $end_date = date('Y-m-d h:m:s',strtotime($last_activity->charges_date));
                            $startDate_ = new DateTime($appoint_date);
                            $endDate_ = new DateTime($end_date);
                            $interval = $startDate_->diff($endDate_);
                            $tat = $interval->format('%a days %h hours, %i minutes');
                            }else{
                                $tat = 'Only registation done';
                            }

                             ?>
                            <tr>
                                <td><a class="textlink" href="{{ route('opd-profile', ['id' => base64_encode($value->id)]) }}">{{
                                        @$value->id }}</a>
                                </td>
                                <td>
                                    {{ @$value->opd_details_data->all_patient_details->prefix }}
                                    {{ @$value->opd_details_data->all_patient_details->first_name }}
                                    {{ @$value->opd_details_data->all_patient_details->middle_name }}
                                    {{ @$value->opd_details_data->all_patient_details->last_name }}({{ @$value->opd_details_data->all_patient_details->id
                                    }})<br>
                                    <i class="fa fa-venus-mars text-primary"></i>
                                    {{ @$value->opd_details_data->all_patient_details->gender }} <i class="fa fa-calendar-plus-o text-primary"></i>
                                    @if (@$value->opd_details_data->all_patient_details->year != 0)
                                    {{ @$value->opd_details_data->all_patient_details->year }}y
                                    @endif
                                    @if (@$value->opd_details_data->all_patient_details->month != 0)
                                    {{ @$value->opd_details_data->all_patient_details->month }}m
                                    @endif
                                    @if (@$value->opd_details_data->all_patient_details->day != 0)
                                    {{ @$value->opd_details_data->all_patient_details->day }}d
                                    @endif

                                </td>
                                <td>{{ @$value->opd_details_data->all_patient_details->guardian_name }}</td>
                                <td>{{ @$value->opd_details_data->all_patient_details->phone }}</td>
                                <td>{{ @$value->opd_details_data->case_id }}</td>
                                <td>
                                    @if (isset($value->department_id))
                                    <i class="fa fa-cubes text-primary"></i>
                                    {{
                                    @$value->department_details->department_name
                                    }}
                                    <br>
                                    @endif
                                    @if (isset($value->cons_doctor))
                                    <i class="fas fa-user-md text-primary"></i>
                                    {{ @$value->doctor->first_name }}
                                    {{ @$value->doctor->last_name }}<br>
                                    @endif
                                    @if (isset($value->appointment_date))
                                    <i class="fa fa-calendar text-primary"></i>
                                    {{ date('d-m-Y h:i A',
                                    strtotime($value->appointment_date)) }}
                                    @endif
                                </td>
                                <td><?php echo $tat; ?></td>
                                <td>{{ @$total_billing }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                        @can('Apply Commission')
                                            <a class="dropdown-item" href="{{ route('apply-opd-commission',['case_id'=>base64_encode(@$value->opd_details_data->case_id),'ref_id' => base64_encode( @$referral->radiology_commission )] ) }}"><i class="fa fa-cube"></i>
                                                Apply Commission</a>
                                        @endcan
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body border-top">
                <h5 class="font-weight-bold">Emg Registation Details </h5>
                <div class="col-md-12">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">Emg Id</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">G. Name/P. Type</th>
                                <th scope="col">Medico Legal Case</th>
                                <th scope="col">Appointment Date</th>
                                <th scope="col">TAT(Turn around time)</th>
                                <th scope="col">Total Billing(Rs)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($emg_registaion_list))
                            @foreach ($emg_registaion_list as $value)
                            <?php
                            $appoint_date = $value->appointment_date;
                            $last_activity = DB::table('patient_charges')->where('section','EMG')->where('case_id',$value->emg_details_data->case_id)->orderBy('id','DESC')->first();

                            $total_billing = DB::table('patient_charges')->where('section','EMG')->where('case_id',$value->emg_details_data->case_id)->sum('amount');

                            if($last_activity != null){
                            $end_date = date('Y-m-d h:m:s',strtotime($last_activity->charges_date));
                            $startDate_ = new DateTime($appoint_date);
                            $endDate_ = new DateTime($end_date);
                            $interval = $startDate_->diff($endDate_);
                            $tat = $interval->format('%a days %h hours, %i minutes');
                            }else{
                                $tat = 'Only registation done';
                            }
                            ?>
                            <tr>

                                <td><a class="textlink" href="{{route('emg-patient-profile',['id'=>base64_encode($value->emg_details_data->id)])}}">{{ @$value->emg_details_data->id }}</a></td>
                                <td>
                                    {{ @$value->emg_details_data->all_patient_details->prefix }} {{
                                    @$value->emg_details_data->all_patient_details->first_name }} {{
                                    @$value->emg_details_data->all_patient_details->middle_name }} {{
                                    @$value->emg_details_data->all_patient_details->last_name }} ({{ @$value->emg_details_data->all_patient_details->id
                                    }})<br>
                                    <i class="fa fa-venus-mars text-primary"></i> {{
                                    @$value->emg_details_data->all_patient_details->gender }} <i class="fa fa-calendar-plus-o text-primary"></i> {{
                                    @$value->emg_details_data->all_patient_details->year }}Y {{ @$value->emg_details_data->all_patient_details->month }}M {{
                                    @$value->emg_details_data->all_patient_details->day }}D
                                </td>
                                <td>{{ @$value->emg_details_data->all_patient_details->phone }}</td>
                                <td>
                                    <i class="fa fa-user-secret text-primary"></i> {{
                                    @$value->emg_details_data->all_patient_details->guardian_name }}<br>
                                    <i class="fa fa-adjust text-primary"></i> {{
                                    @$value->emg_details_data->all_emg_visit_details->patient_type }}
                                </td>
                                <td>{{ @$value->medico_legal_case }}</td>
                                <td>
                                    @if(isset($value->appointment_date))
                                    {{ date('d-m-Y h:i A',strtotime($value->appointment_date)) }}
                                    @endif
                                </td>
                                <td>{{ @$tat }}</td>
                                <td>{{ @$total_billing }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                     
                                            <a class="dropdown-item" href=""><i class="fa fa-cube"></i>
                                                Apply Commission</a>

                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body border-top">
                <h5 class="font-weight-bold">IPD Registation Details </h5>
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-default">
                        <thead>
                            <tr>
                                <th scope="col">IPD Id</th>
                                <th scope="col">Patient Information</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Admission Information</th>
                                <th scope="col">Admission Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">TAT(Turn around time)</th>
                                <th scope="col">Total Billing(Rs)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($ipd_patient_list))
                            @foreach ($ipd_patient_list as $value)
                            <?php
                            $appoint_date = $value->appointment_date;
                            $last_activity = DB::table('patient_charges')->where('section','IPD')->where('case_id',$value->case_id)->orderBy('id','DESC')->first();

                            
                            $total_billing = DB::table('patient_charges')->where('section','IPD')->where('case_id',$value->case_id)->sum('amount');


                            if($last_activity != null){
                            $end_date = date('Y-m-d h:m:s',strtotime($last_activity->charges_date));
                            $startDate_ = new DateTime($appoint_date);
                            $endDate_ = new DateTime($end_date);
                            $interval = $startDate_->diff($endDate_);
                            $tat = $interval->format('%a days %h hours, %i minutes');
                            }else{
                                $tat = 'Only registation done';
                            }
                            ?>
                            <tr>
                                <td><a class="textlink" href="{{route('ipd-profile',['id'=>base64_encode($value->id)])}}">{{ @$value->id }}</a></td>
                                <td>
                                    <i class="fa fa-user text-primary"></i> {{ @$value->all_patient_details->prefix }}
                                    {{ @$value->all_patient_details->first_name }} {{
                                    @$value->all_patient_details->middle_name }} {{
                                    @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id }})
                                    <br>
                                    <i class="fa fa-users text-primary"></i>
                                    {{ @$value->all_patient_details->guardian_name }}
                                    <br>
                                    <i class="fa fa-venus-mars text-primary"></i> {{
                                    @$value->all_patient_details->gender }} //


                                    <i class="fa fa-calendar-plus-o text-primary"></i> {{
                                    @$value->all_patient_details->year }}Y {{ @$value->all_patient_details->month }}M {{
                                    @$value->all_patient_details->day }}D

                                </td>
                                <td>{{ @$value->all_patient_details->phone }}</td>
                                <td>
                                    @if(isset($value->department_id))
                                    <i class="fa fa-cubes text-primary"></i> {{
                                    @$value->department_details->department_name }}( {{
                                    @$value->department_details->department_code }}) <br>
                                    @endif
                                    @if(isset($value->cons_doctor))
                                    <i class="fas fa-user-md text-primary"></i> {{ @$value->doctor_details->first_name
                                    }} {{ @$value->doctor_details->last_name }} <br>
                                    @endif
                                    @if(isset($value->bed_ward_id))
                                    <i class="fa fa-bed text-primary"></i> {{ @$value->bed_details->bed_name }} - {{
                                    @$value->ward_details->ward_name }} - {{ @$value->unit_details->bedUnit_name }}
                                    @endif
                                </td>
                                <td>
                                    {{ date('d-m-Y h:i A',strtotime($value->appointment_date)) }}
                                </td>
                                <td>
                                    @if($value->status == 'admitted')
                                    <span class="badge badge-success">Admission</span>
                                    @elseif ($value->status == 'discharged_planed')
                                    <span class="badge badge-warning">Discharge Planed</span>
                                    @else
                                    <span class="badge badge-secondary">Discharged</span>
                                    @endif
                                </td>
                                <td>{{ @$tat }}</td>
                                <td>{{ @$total_billing }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                           
                                            <a class="dropdown-item" href="{{ route('print-opd-patient', base64_encode(@$value->id)) }}"><i class="fa fa-cube"></i>
                                                    Apply Commission</a>
                                           
                                        </div>
                                    </div>
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
</div>

@endsection