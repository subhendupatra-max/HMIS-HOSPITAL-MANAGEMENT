@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Pathology Test
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add-pathology-test-to-a-patient')
                        <a href="{{ route('add-pathology-test-to-a-patient') }}" class="btn btn-primary btn-sm"><i class="fa fa-money-bill"></i> Add </a>
                        @endcan
                        @can('pathology test')
                        <a href="{{ route('pathology-test-list') }}" class="btn btn-primary btn-sm"><i class="fa fa-vials"></i> Pathology Test </a>
                        @endcan
                        @can('pathology test master')
                        <a href="{{ route('pathology-test-master-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-mortar-pestle"></i> Test Master </a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl No.</th>
                                <th class="border-bottom-0">Patient Details</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Test Name</th>
                                <th class="border-bottom-0">Case Id</th>
                                <th class="border-bottom-0">Section</th>
                                <th class="border-bottom-0">Generated By</th>
                                <th class="border-bottom-0">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$pathology_patient_test)
                            @foreach ($pathology_patient_test as $value)
                            <?php
                            if ($value->section == 'OPD') {
                                $opd_details = DB::table('opd_details')->where('case_id', $value->case_id)->first();
                                $section_id = $opd_details->id;
                            }
                            if ($value->section == 'IPD') {
                                $ipd_details = DB::table('ipd_details')->where('case_id', $value->case_id)->first();
                                $section_id = $ipd_details->id;
                            }
                            if ($value->section == 'EMG') {
                                $opd_details = DB::table('emg_details')->where('case_id', $value->case_id)->first();
                                $section_id = $emg_details->id;
                            }
                            ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>{{ @$value->all_patient_details->prefix }} {{ @$value->all_patient_details->first_name }} {{ @$value->all_patient_details->middle_name }} {{ @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id }})</td>

                                <td>{{ @date('d-m-Y h:i A', strtotime($value->date)) }}</td>

                                <td>{{ @$value->test_details->test_name }}</td>
                                <td>{{ @$value->case_id }}</td>
                                <td><a class="textlink" href="{{ route('opd-profile', ['id' => base64_encode($section_id)]) }}">{{ @$value->section }}({{@$section_id}})</a>
                                </td>
                                <td>{{ @$value->generator_details->first_name }} {{ @$value->generator_details->last_name }}</td>
                                <td>{!! @$value->test_status !!}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">

                                            <a class="dropdown-item" href="{{ route('opd-bill-details', ['bill_id' => base64_encode($value->id)]) }}">
                                                <i class="fa fa-eye"></i> View
                                            </a>

                                            @can('edit-pathology-test-to-a-patient')
                                            <a class="dropdown-item" href="{{route('edit-pathology-test-patient',['id'=>base64_encode($value->id)])}}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @endcan

                                            @can('delete-pathology-test-to-a-patient')
                                            <a class="dropdown-item" href="{{route('delete-pathology-test-patient',['id'=>base64_encode($value->id)])}}">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            @endcan

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {!! $opd_billing_details->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection