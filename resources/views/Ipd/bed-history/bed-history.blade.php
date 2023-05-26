@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Bed History
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="{{ route('bed-transfar-history-print-in-ipd',['ipd_id' => base64_encode($ipd_details->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Transfer Report</a>
                        @can('')
                        <a href="{{ route('add-bed-transfar-history-in-ipd',['ipd_id' => base64_encode($ipd_details->id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-alt-circle-left"></i> Bed Transfer</a>
                        @endcan

                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-header">
            @include('ipd.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body ">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                        <table table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sl. No</th>
                                    <th class="border-bottom-0">Department</th>
                                    <th class="border-bottom-0">Ward - Unit</th>
                                    <th class="border-bottom-0">Bed</th>
                                    <th class="border-bottom-0">Duration</th>
                                    <th class="border-bottom-0">Status</th>
                                    @can('edit bed transfar history')
                                    <th class="border-bottom-0">Action</th>
                                    @endcan

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

                                    </td>
                                    <td>
                                        {!! $item->is_present == 'no' ? '<span class="badge badge-danger">Moved from here</span>':'<span class="badge badge-success">Present Here</span>' !!}
                                    </td>
                                    @can('edit bed transfar history')
                                    <td class="border-bottom-0">
                                        @if(!isset($item->to_date))
                                        <a onclick="bedHistoryEditButton('<?php echo $item->id  ?>','<?php echo $item->from_date;  ?>')" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                        @endif
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




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
                <form action="{{ route('update-bed-hidtroy-from-date') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bed_histry_id" id="bed_histry_id" />

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="from_time" class="form-label">From Date <span class="text-danger">*</span></label>
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


<script>
    function bedHistoryEditButton(bedHistoy_id, from_date) {
        $("#bed_histry_id").val(bedHistoy_id);
        $("#editBedHistory").modal('show');
    }
</script>
@endsection