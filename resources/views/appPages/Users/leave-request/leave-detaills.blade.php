@extends('layouts.layout')
@section('content')

    <?php
    if ($leave_details->leave_type == 'medical_leave') {
        $leave_type = 'Medical Leave';
    } elseif ($leave_details->leave_type == 'earn_leave') {
        $leave_type = 'Earn Leave';
    } else {
        $leave_type = 'Casual Leave';
    }
    ?>

    <!-- ===============================Alert Message======================================= -->
    @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true"> ×</button>{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true"> ×</button>{{ session('error') }}</div>
    @endif
    <!-- ================================Alert Message====================================== -->


    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-8 col-xl-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Leave Details
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="requisition_header">Leave Type : </span><span
                                        class="requisition_text">{{ @$leave_details->leave_type }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="requisition_header">Leave Apply Date : </span><span
                                        class="requisition_text"><?= date('d-m-Y', strtotime($leave_details->apply_date)) ?></span>
                                </div>

                                <div class="col-md-4">
                                    <span class="requisition_header">Purpose : </span><span
                                        class="requisition_text">{{ @$leave_details->purpose }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="requisition_header">Resume Duty On : </span><span
                                        class="requisition_text"><?= date('d-m-Y', strtotime($leave_details->resume_duty_on)) ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="badge badge-danger">
                                        {{ $leave_details->leave_status }}
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <span class="requisition_header">Leave Date : </span><span
                                        class="requisition_text"><?= date('d-m-Y', strtotime($leave_details->from_date)) ?>
                                        to <?= date('d-m-Y', strtotime($leave_details->to_date)) ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================Requisition Permission Activity================== -->
            <div class="col-lg-4 col-xl-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Permission </h3>
                        <div class="card-options">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="latest-timeline scrollbar3" id="scrollbar3">
                            <ul class="timeline mb-0">
                                @if (isset($permission_details) && $permission_details != '')
                                    @foreach ($permission_details as $user)
                                        <li class="mt-0">
                                            <div class="d-flex"><span class="time-data">{{ @$user->permission_user->name }}</span><span class="ml-auto text-muted fs-11"><?php if ($user->permission_user->approve_date != '' && $user->permission_user->approve_date != null) {
                                                        echo date('d-m-Y h:i', strtotime($user->permission_user->approve_date ));
                                                    } ?></span></div>
                                            <p class="text-muted fs-12">
                                                <span class="text-info">
                                                    @if ( $user->user_id == Auth::id() )
                                                        <td><a class="btn btn-pill btn-info btn-sm"
                                                                data-target="#modaldemo1" data-toggle="modal"
                                                                type="button">{{ $user->leave_status }}</a></td>
                                                    @else
                                                        <td><a class="btn btn-pill btn-info btn-sm"
                                                                type="button">{{ $user->leave_status }}</a></td>
                                                    @endif
                                                </span>
                                            </p>
                                            @if (!empty($user->comment))
                                                <p class="text-muted fs-12"><span style="color:blue;cursor: pointer;"
                                                        data-placement="top" data-toggle="tooltip"
                                                        title="{{ $user->comment }}"><i class="fa fa-eye"></i> View
                                                        Note</span></p>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ================Requisition Permission Activity======================== -->
        </div>
    </div>

    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Change Status</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="POST" action="{{route('given-approval')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12">
                            <select name="permission" <?php if(@$permisison_status_own->leave_status=='Approved' || @$permisison_status_own->leave_status=='Rejected'){ echo"disabled";} ?>  class="form-control" required>
                                <option value="" disabled>Select One</option>
                                <option value="Pending" disabled <?php if(@$permisison_status_own->leave_status=='Pending'){ echo"selected";} ?> >Pending</option>
                                <option value="Approved" <?php if(@$permisison_status_own->leave_status=='Approved'){ echo"selected";} ?>>Approved</option>
                                <option value="Need Clarification" <?php if(@$permisison_status_own->leave_status=='Need Clarification'){ echo"selected";} ?>>Need Clarification</option>
                                <option value="Rejected" <?php if(@$permisison_status_own->leave_status=='Rejected'){ echo"selected";} ?>>Rejected</option>
                            </select>
                            <input type="hidden" name="leave_id" value="{{@$leave_details->id}}">
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-indigo" type="submit" <?php if(@$permisison_status_own->leave_status=='Approved' || @$permisison_status_own->leave_status=='Rejected'){ echo"disabled";} ?>><i class="fa fa-file"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

