@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Bed Status </h4>
                </div>
            
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @include('message.notification')

        <div class="card-body">
            <table class="table table-bordered text-nowrap" id="example">
                <thead>
                    <tr>
                        <th scope="col">Bed</th>
                        <th scope="col">Ward</th>
                        <th scope="col">Bed Status</th>
                        <th scope="col">Patient Details</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($beds))
                    @foreach ($beds as $value)
                    <?php
                     if ($value->is_used == 'yes'){
                        $ipd_patient_details = App\Models\IpdDetails::where('bed',$value->id)->where('discharged','no')->first();
                     }
                     ?>
                    <tr>
                        <td class="text-center">
                            @if($value->is_used == 'no')
                            <i class="fa fa-bed fa-2x text-success"></i>
                            @elseif ($value->is_used == 'yes')
                            <i class="fa fa-bed fa-2x text-danger"></i>
                            @else
                            <i class="fa fa-bed fa-2x text-warning"></i>
                            @endif
                             {{ @$value->bed_name }}
                        </td>
                        <td>{{@$value->bed_ward->ward_name }}</td>
                        <td>
                            @if($value->is_used == 'no')
                            <span class="badge badge-success">Free Bed</span>
                            @elseif ($value->is_used == 'yes')
                            <span class="badge badge-danger">Patient Admitted</span>
                            @else
                            <span class="badge badge-warning" onclick="changeBedStatus({{ $value->id }})">Under Maintenance</span>
                            @endif
                        </td>
                        <td>
                            @if ($value->is_used == 'yes')
                            <a class="textlink" href="{{route('ipd-profile',['id'=>base64_encode($ipd_patient_details->id)])}}"> {{ @$ipd_patient_details->all_patient_details->prefix }} {{
                                @$ipd_patient_details->all_patient_details->first_name }} {{ @$ipd_patient_details->all_patient_details->middle_name
                                }} {{ @$ipd_patient_details->all_patient_details->last_name }}({{ @$ipd_patient_details->all_patient_details->id }}) -- {{ @date('d-m-Y h:i A',strtotime(@$ipd_patient_details->appointment_date)) }} -- {{ @$ipd_patient_details->all_patient_details->phone }}</a>
                             -- 
                            {!! @$ipd_patient_details->ins_by == 'ori' ? '<span class="badge badge-info">Original</span>':'<span class="badge badge-secondary">False</span>' !!}
                            @endif
                        </td>
                     
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Bed Status Change
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update-status-bed') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select......</option>
                                <option value="no">Ready For Use</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    <input type="hidden" id="bed_id" name="bed_id"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function changeBedStatus(bed_id)
    {
        $('#bed_id').val(bed_id);
        $("#exampleModal").modal('show');
    }
</script>

<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
