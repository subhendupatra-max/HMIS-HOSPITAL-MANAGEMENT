@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">
                {{-- ===========================nav menu=========================== --}}
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#profile" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-th"></i> Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#oxygen" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-circle"></i> Oxygen Monitoring </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#medication" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-circle"></i> Medication </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#operation" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fas fa-hand-holding-medical"></i> Operation </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#nurse_note" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-user-nurse"></i> Nurse Note </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#charges" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-file-alt"></i> Charges </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#payment" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-rupee-sign"></i> Payment </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#bed_history" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="fa fa-bed"></i> Bed History </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border py-2 px-2 m-1" data-toggle="tab" href="#timeline" role="tab" aria-selected="false">
                        <span class="nav-link-icon d-block"><i class="far fa-calendar-check"></i> Timeline </span>
                    </a>
                </li>
                {{-- ===========================nav menu=========================== --}}

                {{-- =========================== Button =========================== --}}
                <li class="nav-item" style="margin-left: auto;">
                    <div class="card-options">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a>

                            @can('')
                            <a class="dropdown-item" href=""><i class="fa fa-edit"></i> Edit</a>
                            @endcan

                            @can('')
                            <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Delete</a>
                            @endcan

                        </div>
                    </div>
                </li>
                {{-- =========================== Button =========================== --}}
            </ul>

            <div class="panel-body tabs-menu-body">
                <div class="tab-content">
                    {{-- =================== profile =========================== --}}
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="profileHeding">{{ @$ipd_details->all_patient_details->first_name }}
                                    {{ @$ipd_details->all_patient_details->middle_name }}
                                    {{ @$ipd_details->all_patient_details->last_name }}({{ @$ipd_details->all_patient_details->patient_prefix }}{{ @$ipd_details->all_patient_details->id }})</span>
                                <hr class="hr_line">
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
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
                                                            {{ @$ipd_details->all_patient_details->address }},{{ @$ipd_details->patient_state->name }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <hr class="hr_line">
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
                                                            {{ @$ipd_details->department_details->department_name }}( {{ @$ipd_details->department_details->department_code }})
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
                                                            {{@$ipd_details->doctor_details->first_name}} {{@$ipd_details->doctor_details->last_name}}
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
                                                            {{$ipd_details->bed_details->bed_name}} - {{$ipd_details->unit_details->bedUnit_name}} - {{$ipd_details->ward_details->ward_name}}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr_line">
                            <div class="col-md-6 vl_line">
                                <h5>LAB INVESTIGATION</h5>
                                <div class="col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Joan Powell</td>
                                                    <td>Associate Developer</td>
                                                    <td>$450,870</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Gavin Gibson</td>
                                                    <td>Account manager</td>
                                                    <td>$230,540</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Julian Kerr</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>$55,300</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>Cedric Kelly</td>
                                                    <td>Accountant</td>
                                                    <td>$234,100</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <td>Samantha May</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>$43,198</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- =================== profile =========================== --}}

                    {{-- =================== charges =========================== --}}
                    <div class="tab-pane" id="charges">
                        <div class="d-block" style="border-bottom: 1px">
                            <div class="row">
                                <div class="col-md-6 card-title">
                                    Charges
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="d-block">
                                        @can('add ipd charges')
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#openChargesModal"><i class="fa fa-user"></i> Add Charges </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <div class="">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">Sl. No</th>
                                            <th class="border-bottom-0">Department</th>
                                            <th class="border-bottom-0">Ward - Unit</th>
                                            <th class="border-bottom-0">Bed</th>
                                            <th class="border-bottom-0">Duration</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-bottom-0">1</td>
                                            <td class="border-bottom-0">Gereral Medicine(099)</td>
                                            <td class="border-bottom-0">General Medicine Female / Unit 1</td>
                                            <td class="border-bottom-0">GMD-8099900</td>
                                            <td class="border-bottom-0">
                                                <span>From Date</span> : <span>12-09-2023 10:00 am</span><br>
                                                <span>To Date</span> : <span>12-09-2023 12:00 am</span><br>
                                                <span>Duration</span> : <span>2 hr</span>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- =================== charges =========================== --}}

                    {{-- =================== Timeline =========================== --}}
                    <div class="tab-pane" id="timeline">
                        <div class="row">
                            <div class="col-md-6 card-title">
                                Timeline List
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-block">
                                    @can('')
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user"></i> Add Timeline </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="latest-timeline scrollbar3" id="scrollbar3">
                                <ul class="timeline mb-0">
                                    @foreach ( $timelineDetails as $item)
                                    <li class="mt-0">
                                        <div class="d-flex"><span class="time-data">{{ $item->title }}</span><span class="ml-auto text-muted fs-11">
                                                {{ date('d-m-Y h:i A',strtotime( $item->date )) }}
                                                @can(' ')
                                                <a onclick="timelineEditButton(<?php echo "$item->id"  ?>)"><i class="fa fa-edit ml-4"></i> Edit</a>
                                                @endcan

                                                @can(' ')
                                                <a onclick="timelineDeleteButton(<?php echo "$item->id"  ?>)"><i class="fa fa-trash ml-2"></i> Delete</a>
                                                @endcan

                                            </span></div>
                                        <p class="text-muted fs-12"> {{ $item->description }}</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- =================== Timeline =========================== --}}

                    {{-- =================== bed history =========================== --}}
                    <div class="tab-pane" id="bed_history">
                        <div class="d-block" style="border-bottom: 1px">
                            <div class="row">
                                <div class="col-md-6 card-title">
                                    Bed History
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="d-block">
                                        @can('add bed transfar history')
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#openBedTransfar"><i class="fa fa-exchange"></i>Transfer Bed </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <!-- <div class=""> -->
                        <div class="table-responsive">
                            <table table class="table table-bordered text-nowrap" id="example2">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Department</th>
                                        <th class="border-bottom-0">Ward - Unit</th>
                                        <th class="border-bottom-0">Bed</th>
                                        <th class="border-bottom-0">Duration</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $bedHistory as $item)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0"> {{ $item->department_details->department_name }} </td>
                                        <td class="border-bottom-0"> {{ $item->ward_details->ward_name }} - {{ $item->unit_details->bedUnit_name }}</td>
                                        <td class="border-bottom-0">{{ @$item->bed_details->bed_name }}</td>
                                        <td class="border-bottom-0">
                                            <span>From Date</span> : <span>{{ $item->from_date }}</span><br>
                                            <span>To Date</span> : <span>{{ $item->to_date }}</span><br>
                                            <span>Duration</span> : <span> </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if(!isset($item->to_date))
                                            @can('')
                                            <a onclick="bedHistoryEditButton('<?php echo $item->id  ?>','<?php echo $item->from_date;  ?>')" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                            @endcan
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- </div> -->
                    </div>
                    {{-- =================== bed history =========================== --}}

                    {{-- =================== Operation =========================== --}}
                    <div class="tab-pane" id="operation">
                        <div class="row">
                            <div class="col-md-6 card-title">
                                Operation
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-block">
                                    @can('')
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addOperationModal"><i class="fa fa-user"></i> Add Medication </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Operation Department</th>
                                        <th class="border-bottom-0">Operation Name</th>
                                        <th class="border-bottom-0">Consultant Doctor</th>
                                        <th class="border-bottom-0">Date</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $operation_details as $item)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">{{ @$item->operation_departments->department_name }} </td>
                                        <td class="border-bottom-0">{{ @$item->operation_name }}</td>
                                        <td class="border-bottom-0">{{ @$item->consultant_doctor }}</td>
                                        <td class="border-bottom-0">{{ @$item->operation_date }}</td>
                                        <td class="border-bottom-0"> {{ @$item->status }} </td>
                                        <td class="border-bottom-0">
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @can('edit operation theatre')
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fa fa-edit"></i> Edit</a>
                                                    @endcan
                                                    @can('delete operation theatre')
                                                    <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                                    @endcan
                                                    @can('change status operation theatre')
                                                    <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Change Status</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- =================== Operation =========================== --}}

                    {{-- =================== Payment =========================== --}}
                    <div class="tab-pane" id="payment">
                        <div class="row">
                            <div class="col-md-6 card-title">
                                Payment
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-block">
                                    @can('')
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPaymentModal"><i class="fa fa-user"></i> Add Payment </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Date</th>
                                        <th class="border-bottom-0">Amount</th>
                                        <th class="border-bottom-0">Payement Mode</th>
                                        <th class="border-bottom-0">Note</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $paymentDetails as $item )
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">{{ @$item->payment_date }} </td>
                                        <td class="border-bottom-0">{{ @$item->amount }}</td>
                                        <td class="border-bottom-0">{{ @$item->payment_mode }}</td>
                                        <td class="border-bottom-0">{{ @$item->note }}</td>
                                        <td class="border-bottom-0">
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @can('edit ipd payment')
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fa fa-edit"></i> Edit</a>
                                                    @endcan

                                                    @can('delete ipd payment')
                                                    <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
                                                    @endcan

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- =================== Payment =========================== --}}

                    {{-- =================== Oxygen Monitering =========================== --}}
                    <div class="tab-pane" id="oxygen">
                        <div class="d-block" style="border-bottom: 1px">
                            <div class="col-md-6 card-title">
                                Oxygen Monitoring
                            </div>
                            <hr class="hr_line" />
                            <div class="row col-md-12">
                                <div class="col-md-4 text-left">
                                    <div class="d-block">
                                        <button id="reset" class="btn btn-warning btn-sm">Reset</button>
                                        <button id="start" class="btn btn-primary btn-sm">Start</button>
                                        <button id="pause" class="btn btn-danger btn-sm">Pause</button>
                                        <h3> <span id="timeDisplay" name="timeDisplay">0</span><span>s</span> </h3>
                                        <div style="display:none;" id="addButton">
                                            <button id="add" onclick="add( <?php echo $ipd_details->id ?> )" class="btn btn-success">add</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 m-right">
                                    <div class="table-responsive">
                                        <table id="monitoring_id" class="table card-table table-vcenter text-nowrap table-primary">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="text-white">SL No.</th>
                                                    <th class="text-white">Duration (In Seconds)</th>
                                                    <th class="text-white">Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ( $oxygen_monitering as $oxygen)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration}}</th>
                                                    <td>{{ $oxygen->oxygen_time }}</td>
                                                    <td>{{ $oxygen->created_at }}</td>
                                                </tr>
                                                <?php
                                                $i = $i + $oxygen->oxygen_time;
                                                ?>

                                                @endforeach

                                                <?php
                                                if ($i >= 60) {
                                                    $min = number_format(($i / 60), 2);
                                                    $t = $min . "m ";
                                                } else {
                                                    $t = $i . "s ";
                                                }

                                                ?>
                                                <tr>
                                                    <td>
                                                        Total Duraiton =
                                                    </td>
                                                    <td colspan="2"> {{ $t }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />

                    </div>
                    {{-- =================== Oxygen Monitering =========================== --}}


                    {{-- =================== Medication =========================== --}}
                    <div class="tab-pane" id="medication">
                        <div class="row">
                            <div class="col-md-6 card-title">
                                Medication
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-block">
                                    @can('')
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMedicationModal"><i class="fa fa-user"></i> Add Medication </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <diav class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Date</th>
                                        <th class="border-bottom-0">Time</th>
                                        <th class="border-bottom-0">Medicine Catagory</th>
                                        <th class="border-bottom-0">Medicine Name</th>
                                        <th class="border-bottom-0">Dosage</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $medication_details as $item)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0"> {{ $item->date }} </td>
                                        <td class="border-bottom-0"> {{ $item->time }} </td>
                                        <td class="border-bottom-0">{{ @$item->medicine_catagory_name->medicine_catagory_name }}</td>
                                        <td class="border-bottom-0">{{ @$item->all_medicine_name->medicine_name }}</td>
                                        <td class="border-bottom-0">{{ @$item->dosage_name->dose }}</td>

                                        <td class="border-bottom-0">
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @can('edit operation theatre')
                                                    <a class="dropdown-item" onclick="editMedicationModal(<?php echo $item->id ?>)">
                                                        <i class="fa fa-edit"></i> Edit</a>
                                                    @endcan
                                                    @can('delete operation theatre')
                                                    <a class="dropdown-item" onclick="deleteMedicationModal('<?php echo $item->id  ?>')"><i class="fa fa-trash"></i> Delete</a>
                                                    @endcan
                                                    @can('change status operation theatre')
                                                    <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Change Status</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </diav>
                    </div>
                    {{-- =================== Medication =========================== --}}

                    {{-- =================== Nurse Note  =========================== --}}
                    <div class="tab-pane" id="nurse_note">
                        <div class="row">
                            <div class="col-md-6 card-title">
                                Nurse Note
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="d-block">
                                    @can('')
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nurseNoteOpen"><i class="fa fa-user"></i> Add Nurse Note </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <hr class="hr_line" />
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="latest-timeline scrollbar3" id="scrollbar3">
                                <ul class="timeline mb-0">
                                    @foreach ( $nurseNoteDetails as $item)
                                    <li class="mt-0">
                                        <div class="d-flex"><span class="time-data">{{ @$item->nurseNames->first_name }} {{ @$item->nurseNames->last_name }}
                                                <p class="text-muted fs-12"> {{ $item->note }}</p>
                                            </span><span class="ml-auto text-muted fs-11">
                                                {{ date('d-m-Y h:i A',strtotime( $item->date )) }}

                                            </span></div>
                                        <p class="text-muted fs-12"> {{ $item->comment }}</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- =================== Nurse Note  =========================== --}}
                </div>
            </div>
            <!-- <div class="new"> -->
        </div>
    </div>
</div>

<!-- ============================= add operation modal ============================ -->
<div class="modal fade" id="addOperationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Operation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-ipd-operation-details') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ipd_details_id" value="{{ $ipd_details->id }}" />
                    <div class="row">

                        <div class="col-md-6">
                            <label for="operation_department" class="form-label">operation_department <span class="text-danger">*</span></label>
                            <select name="operation_department" class="form-control select2-show-search" id="operation_department" onchange="getOperation_Department(this.value)">
                                <option value="">Select</option>
                                @foreach ($departments as $key => $department)
                                <option value="{{$department->id}}"> {{$department->department_name}}</option>
                                @endforeach
                            </select>
                            @error('operation_department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="operation_catagory" class="form-label"> Operation Category <span class="text-danger">*</span></label>
                            <select name="operation_catagory" class="form-control select2-show-search" id="operation_catagory" onchange="getCatagory(this.value)">
                                <option value="">Select..</option>
                            </select>
                            @error('operation_catagory')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="operation_type" class="form-label"> Operation Type <span class="text-danger">*</span></label>
                            <select name="operation_type" class="form-control select2-show-search" id="operation_type">
                                <option value="">Select..</option>
                            </select>
                            @error('operation_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="operation_name" class="form-label"> Operation Name <span class="text-danger">*</span></label>
                            <input type="text" name="operation_name" class="form-control" id="operation_name" />
                            @error('operation_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="operation_date" class="form-label">Operation Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="operation_date" name="operation_date" required>
                            @error('operation_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="consultant_doctor" class="form-label">Consultant Doctor<span class="text-danger">*</span></label>
                            <select name="consultant_doctor" class="form-control select2-show-search" id="consultant_doctor">
                                <option value="">Select Consultant Doctor...</option>
                                @foreach ($cons_doctor as $key => $doctor)
                                <option value="{{$doctor->id}}"> {{$doctor->first_name}}
                                    {{$doctor->first_name}} {{$doctor->last_name}}
                                </option>
                                @endforeach
                            </select>
                            @error('consultant_doctor')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ass_consultant_1" class="form-label">Assistant Consultant 1 </label>
                            <input type="text" class="form-control" id="ass_consultant_1" name="ass_consultant_1">
                            @error('ass_consultant_1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ass_consultant_1" class="form-label">Medicine Name </label>
                            <input type="text" class="form-control" id="ass_consultant_1" name="ass_consultant_1">
                            @error('ass_consultant_1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ass_consultant_2" class="form-label">Assistant Consultant 2 </label>
                            <input type="text" class="form-control" id="ass_consultant_2" name="ass_consultant_2">
                            @error('ass_consultant_2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="anesthetist" class="form-label"> Anesthetist </label>
                            <input type="text" class="form-control" id="anesthetist" name="anesthetist" value="{{ old('anesthetist') }}">
                            @error('anesthetist')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="anaethesia_type" class="form-label"> Anesthesia Type </label>
                            <input type="text" class="form-control" id="anaethesia_type" name="anaethesia_type" value="{{ old('anaethesia_type') }}">
                            @error('anaethesia_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ot_technician" class="form-label"> OT Technician </label>
                            <input type="text" class="form-control" id="ot_technician" name="ot_technician" value="{{ old('ot_technician') }}">
                            @error('ot_technician')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ot_assistant" class="form-label"> OT Assistant </label>
                            <input type="text" class="form-control" id="ot_assistant" name="ot_assistant" value="{{ old('ot_assistant') }}">
                            @error('ot_assistant')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-control" name="status">
                                <option value="">Select</option>
                                @foreach (Config::get('static.operation_status') as $lang => $item)
                                <option value="{{$item}}"> {{$item}}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="remark" class="form-label">Remarks </label>
                            <textarea name="remark" id="remark" class="form-control"> </textarea>
                            @error('remark')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Operation</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add operation modal ============================ -->

<!-- ============================= add timeline modal ============================ -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add TimeLine
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-timeline-lisitng-in-ipd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control"> </textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="attach_document" class="form-label">Attach Document <span class="text-danger">*</span></label>
                            <input type="file" id="attach_document" name="attach_document">
                            @error('attach_document')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Timeline</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add timeline modal ============================ -->

<!-- ============================= add medication modal ============================ -->
<div class="modal fade" id="addMedicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Medication
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-medicaiton-dose') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time" name="time" required>
                            @error('time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="medicine_catagory_id" class="form-label">Medicine Category <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible" name="medicine_catagory_id" id="medicine_catagory_id" required>
                                <optgroup>
                                    <option value=" ">Select Medicine Category</option>
                                    @foreach ($medicine_catagory as $item)
                                    <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('medicine_catagory_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                            <select name="medicine_name" id="medicine_name" class="form-control select2-show-search">
                                <option value="">Select Medicine Name</option>
                            </select>
                            @error('medicine_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="dosage" class="form-label">Dosage <span class="text-danger">*</span></label>
                            <select name="dosage" id="dosage" class="form-control select2-show-search">
                                <option value="">Select Dosage</option>
                            </select>
                            @error('dosage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                            <textarea name="remarks" id="remarks" class="form-control" rowsapan="1"> </textarea>
                            @error('remarks')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Medication</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add medication modal ============================ -->

<!-- ============================= edit medication modal ============================ -->
<div class="modal fade" id="editMedicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit Medication
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-medicaiton-dose') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="m_edit_ipd_id" value="{{ $ipd_details->id }}" />
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="m_edit_date" name="m_edit_date" required>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="m_edit_time" name="m_edit_time" required>
                            @error('time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_medicine_catagory_id" class="form-label">Medicine Category <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="m_medicine_catagory_id" id="m_medicine_catagory_id" required>

                                <option value=" ">Select Medicine Category</option>

                            </select>
                            @error('m_medicine_catagory_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_e_medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                            <select name="m_e_medicine_name" id="m_e_medicine_name" class="form-control select2-show-search">
                                <option value="">Select Medicine Name</option>
                            </select>
                            @error('m_e_medicine_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_e_dosage" class="form-label">Dosage <span class="text-danger">*</span></label>
                            <select name="m_e_dosage" id="m_e_dosage" class="form-control select2-show-search">
                                <option value="">Select Dosage</option>
                            </select>
                            @error('m_e_dosage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_e_remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                            <textarea name="m_e_remarks" id="m_e_remarks" class="form-control" rowsapan="1"> </textarea>
                            @error('m_e_remarks')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Medication</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= edit medication modal ============================ -->

<!-- ============================= add bed history ============================ -->
<div class="modal fade" id="openBedTransfar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Bed History
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-bed-transfar-history') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $ipd_details->patient_id }}" />
                    <input type="hidden" name="case_id" value="{{ $ipd_details->case_id }}" />
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                    <input type="hidden" name="previous_bed_id" value="{{$ipd_details->bed_details->id}}" />
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="from_time" class="form-label"> Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="from_time" name="from_time" required>
                            @error('from_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                            <select name="department" class="form-control select2-show-search" id="department" onchange="getDoctor_ward(this.value,<?php echo $ipd_details->ward_details->ward_name ?>)">
                                <option value="">Select</option>
                                @foreach ($departments as $key => $department)
                                <option value="{{$department->id}}"> {{$department->department_name}}</option>
                                @endforeach
                            </select>
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="ward" class="form-label"> Ward <span class="text-danger">*</span></label>
                            <select name="ward" onchange="getBed()" class="form-control select2-show-search" id="bed_ward">
                                <option value="">Select..</option>
                            </select>
                            @error('ward')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="unit" class="form-label"> Unit <span class="text-danger">*</span></label>
                            <select name="unit" onchange="getBed()" class="form-control select2-show-search" id="unit">
                                <option value="">Select..</option>
                                @foreach ($units as $key => $unit)
                                <option value="{{$unit->id}}"> {{$unit->bedUnit_name}}</option>
                                @endforeach
                            </select>
                            @error('unit')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"> Bed <span class="text-danger">*</span></label>
                            <select name="bed" class="form-control select2-show-search" id="bed">
                                <option value="">Select..</option>
                            </select>
                            @error('bed')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Bed History</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add bed history ============================ -->

<!-- ============================= edit bed history ============================ -->
<div class="modal fade" id="editBedHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit Bed History
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bed_histry_id" name="bed_histry_id" />

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="from_time" class="form-label"> Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="from_time" name="from_time" required>
                            @error('from_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Bed History</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= edit bed history ============================ -->

<!-- ============================= add nurse note modal ============================ -->
<div class="modal fade" id="nurseNoteOpen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Nurse Note
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-nurse-note-details') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="date" name="date" required>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nurse" class="form-label">Nurse <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('nurse') }}" name="nurse" id="nurse" required>
                                <optgroup>
                                    <option value=" ">Select Nurse </option>
                                    @foreach ($nurseName as $item)
                                    <option value="{{$item->id}}"> {{$item->first_name}} {{$item->last_name}} </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('nurse')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="note" class="form-label"> Note </label>
                            <textarea name="note" class="form-control">  </textarea>
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="comment" class="form-label"> Comment </label>
                            <textarea name="comment" class="form-control">  </textarea>
                            @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Note</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add nurse note modal ============================ -->
<!-- ============================= add payment modal ============================ -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Payment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-ipd-payment-details') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                    <div class="row">

                        <div class="col-md-6">
                            <label for="payment_date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required>
                            @error('payment_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                            @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="payment_mode" class="form-label">Payment Mode </label>
                            <select id="payment_mode" class="form-control" name="payment_mode">
                                <option value="">Select Payment Mode... </option>
                                @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                                <option value="{{$item}}"> {{$item}}</option>
                                @endforeach
                                @error('payment_mode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="note" class="form-label">Note </label>
                            <textarea name="note" id="note" class="form-control"> </textarea>
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Payment</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add payment modal ============================ -->

<!-- ============================= add charges modal ============================ -->
<div class="modal fade" id="openChargesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add Charges
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-ipd-charges-details') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                    <div class="row">

                        <div class="col-md-6">
                            <label for="charge_type_id" class="form-label">Date <span class="text-danger">*</span></label>

                            @error('charge_type_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="amount" class="form-label">Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                            @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="payment_mode" class="form-label">Payment Mode </label>
                            <select id="payment_mode" class="form-control" name="payment_mode">
                                <option value="">Select Payment Mode... </option>
                                @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                                <option value="{{$item}}"> {{$item}}</option>
                                @endforeach
                                @error('payment_mode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="note" class="form-label">Note </label>
                            <textarea name="note" id="note" class="form-control"> </textarea>
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Payment</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================= add charges modal ============================ -->
<script>
    function getDoctor_ward(department, ward) {

        $('#bed_ward').html('<option value="" >Select...</option>');

        // alert(bed_ward_id);
        $.ajax({
            url: "{{ route('find-doctor-and-ward-by-department-in-ipd') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                department_id: department,
            },
            success: function(response) {
                console.log(response);
                $.each(response.ward, function(key, values) {
                    $('#bed_ward').append(`<option value="${values.id}"  >${values.ward_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });


    }

    function getBed() {
        var bedward = $('#bed_ward').val();
        var bedunit = $('#unit').val();
        $('#bed').empty();
        $('#bed').html(`<option value="">Select.....</option>`)
        $.ajax({
            url: "{{ route('find-bed-by-bed-ward') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                bed_ward: bedward,
                bed_unit: bedunit,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    $('#bed').append(`<option value="${value.id	}">${value.bed_name }</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


<script>
    function timelineEditButton(timeline_id) {
        $.ajax({
            url: "{{ route('find-timeline-details') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                timelineId: timeline_id,
            },
            success: function(response) {

                var date = new Date(response.date);
                var newDate = date.toString('yyyy-mm-dd hh:mm:ss');

                console.log(response.date);
                $('#e_opd_id').val(response.opd_id);
                $('#e_title').val(response.title);
                $('#e_timeline_id').val(response.id);
                $('#e_date').val(newDate);
                $('#e_description').val(response.description);
                $("#timelineEdit").modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    function bedHistoryEditButton(bedHistoy_id, from_date) {
        alert(bedHistoy_id);
        alert(from_date);
        $("#bed_histry_id").val(bedHistoy_id);
        var now = new Date(from_date);
        var formattedDate = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' + now.getDate().toString().padStart(2, '0') + 'T' + now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

        var dateString = formattedDate.toISOString().slice(0, 16);
        //  $('#datetime-input').val(dateString);
        alert(formattedDate);

        $('#from_time').val(dateString);
        $("#editBedHistory").modal('show');

    }
</script>


<script>
    $("#reset").click(Reset);
    $("#start").click(Start);
    $("#pause").click(Pause);

    var timerId;
    var time = 0;
    var seconds;

    // Call this function to update the text display
    function UpdateText(seconds) {
        // timeElapsed += seconds;
        $("#timeDisplay").text(seconds);

    }

    // YOUR CODE GOES HERE


    function UpdateTime() {
        seconds++;
        UpdateText(seconds);
    }

    function Reset() {
        $("#addButton").attr('style', 'display:none', true);
        console.log("Reset Clicked");
        seconds = 0;
        UpdateText(seconds)

    }

    function Start() {
        $("#addButton").attr('style', 'display:none', true);
        console.log("Start Clicked");
        // fix the start button bug for multiple clicks
        window.clearInterval(timerId);
        timerId = window.setInterval(UpdateTime, 1000);
    }

    function Pause() {
        $("#addButton").removeAttr('style', true);
        console.log("Pause Clicked");
        window.clearInterval(timerId);
        UpdateText(seconds)
    }
    Reset();

    function add(ipd_id) {

        var otwotime = $("#timeDisplay").text();
        $.ajax({
            url: "{{ route('save-oxygen-monitoring-details') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                otwotime_value: otwotime,
                ipdID: ipd_id,
            },
            success: function(response) {
                $("#addButton").attr('style', 'display:none', true);
                $('#monitoring_id').load(location.href + ' #monitoring_id');

                console.log(response);
                seconds = 0;
                UpdateText(seconds)
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_id = $(this).val();

            $("#medicine_name").html('<option value=" ">Select Medicine Name...</option>');
            $.ajax({
                url: "{{ route('find-medicine-name-by-medicine-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    medicine_catagory_id: medicine_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#medicine_name').append(`<option value="${value.id}">${value.medicine_name}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_catagory_id = $(this).val();

            $("#dosage").html('<option value=" ">Select Dose...</option>');
            $.ajax({
                url: "{{ route('find-dosage-by-medicine-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    medicine_catagory_id_for_dose: medicine_catagory_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#dosage').append(`<option value="${value.id}">${value.dose}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    function editMedicationModal(medication_dose_id) {
        $.ajax({
            url: "{{ route('find-medication-details') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                medicationDoseId: medication_dose_id,
            },
            success: function(response) {
                $.each(response.edit_medicine_catagory, function(key, value) {
                    if (response.edit_medication_dose.medicine_catagory_id == value.id) {
                        var sel = "selected";
                    }
                    $('#m_medicine_catagory_id').append(`<option value="${value.id}" ${sel}>${value.medicine_catagory_name}</option>`);
                });
                medicine_name_and_dose('response.edit_medication_dose.medicine_name', 'response.edit_medication_dose.dosage');

                var date = new Date(response.date);
                var newDate = date.toString('yyyy-mm-dd hh:mm:ss');

                $("#editMedicationModal").modal('show');

                $('#m_edit_date').val(newDate);
                $('#m_edit_time').val(response.ipd_id);

                //  $('#m_e_medicine_name').val(response.medicine_name);
                // $('#m_e_dosage').val(response.dosage);
                $('#m_e_remarks').val(response.remarks);
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    function medicine_name_and_dose(medicine_name = null, dosage = null) {
        let medicine_catagory_id = $('#m_medicine_catagory_id').val();
        //alert('uy'+medicine_catagory_id);
        $("#dosage").html('<option value=" ">Select Dose...</option>');
        $.ajax({
            url: "{{ route('find-dosage-and-name-by-medicine-catagory') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                medicine_catagory_id_for_dose: medicine_catagory_id,
            },

            success: function(response) {
                console.log(response);
                $.each(response.dosage, function(key, value) {
                    if (dosage == value.id) {
                        var sel = "selected";
                    }
                    $('#m_e_dosage').append(`<option value="${value.id}" ${sel}>${value.dose}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getCatagory(catagory) {
        // alert(catagory);
        $.ajax({
            url: "{{ route('find-operation-name-by-operation-catagory') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                catagory_id: catagory,
            },
            success: function(response) {
                console.log(response);

                $('#operation_name').val(response.operation_name);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


<script>
    function getOperation_Department(department) {
        $('#operation_type').html('<option value="" >Select...</option>');
        $('#operation_catagory').html('<option value="" >Select...</option>');
        // alert(department);
        var div_data = '';
        $.ajax({
            url: "{{ route('find-operation-type-and-catagory-by-department') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                department_id: department,
            },
            success: function(response) {
                console.log(response);

                if (department == '60') {
                    div_data = "<option value='Normal'>Normal</option><option value='Cesarean '>Cesarean</option>";
                } else {
                    div_data = "<option value='Mejor'>Mejor</option><option value='Minor'>Minor</option>";
                }
                $('#operation_type').append(div_data);

                $.each(response, function(key, values) {
                    $('#operation_catagory').append(`<option value="${values.id}"> ${values.operation_catagory_name} </option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

@endsection