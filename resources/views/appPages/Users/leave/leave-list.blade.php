@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Leave List
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @if($value == 'present')
                        @can('create leave')
                        <a class="btn btn-primary"><i class="fa fa-plane-departure"></i>
                            Already In Leave</a>
                        @endcan
                        @else
                        @can('create leave')
                        <a href="{{ route('create-leave') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            Apply Leave</a>
                        @endcan
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @include('message.notification')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Leave No.</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">Apply Date</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($my_leave) && $my_leave != '')
                            @foreach ($my_leave as $leave)
                            <tr>
                                <td><a href="{{route('leave-details',['id'=>$leave->id])}}" style="color: blue;">{{ $leave->id }}</a>
                                </td>
                                <td>{{ $leave->leave_type }}</td>
                                <td><?= date('d-m-Y', strtotime($leave->apply_date)) ?></td>
                                <td>
                                    {{@$leave->from_date}} - {{@$leave->to_date}}
                                </td>

                                <td>
                                    <span class="badge badge-danger">
                                        {{ $leave->leave_status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href=""><i class="fa fa-eye"></i> View</a>
                                            @can('print requisition')
                                            <a class="dropdown-item" href="" target="popup"><i class="fa fa-print"></i> Print</a>
                                            @endcan

                                            @if($leave->leave_status != 'Approved' )
                                            @can('edit requisition')
                                            <a class="dropdown-item" href="{{route('edit-leave',['id'=>$leave->id])}}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                            @endif

                                            @can('delete requisition')
                                            <a class="dropdown-item" href=""><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

@endsection