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
        <div class="card-header d-block">
            <form method="POST" action="{{ route('search-by-bed-and-ward') }}">
                @csrf
            <div class="row">
                <div class="col-md-4 card-title">
                    <input name="bed_ward" type="text" value="{{ @$request_data['bed_ward'] }}" placeholder="Search By Ward..." />
        
                </div>
                <div class="col-md-4 card-title">
                    <input name="bed" type="text" value="{{ @$request_data['bed'] }}" placeholder="Search By Bed No..." />
                </div>
                <div class="col-md-4 card-title">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
            </form>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @include('message.notification')
        @foreach ($bed_and_ward as $key => $value)
        @isset($value[0]->bed_name)
        <div class="card-header" style="background-color: rgb(223, 223, 223)">
            <h4 class="card-title" >{{ @$key }} </h4>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($value as $key1 => $item)
                    <?php
                    if ($item->is_used != 'no'){
                       $ipd_patient_details = App\Models\IpdDetails::where('bed',$item->id)->where('discharged','no')->first();
                    }
                    ?>

                        <div class="col-md-1">
                            @isset($ipd_patient_details)
                            <a href="{{route('ipd-profile',['id'=>base64_encode($ipd_patient_details->id)])}}"
                                data-placement="top" data-toggle="tooltip" title="{!! 'P Name : '.@$ipd_patient_details->all_patient_details->prefix .' '.
                                    @$ipd_patient_details->all_patient_details->first_name .' '. @$ipd_patient_details->all_patient_details->middle_name
                                    .' '. @$ipd_patient_details->all_patient_details->last_name .' ( '. @$ipd_patient_details->all_patient_details->id .') // DOA : ' . @date('d-m-Y h:i A',strtotime(@$ipd_patient_details->appointment_date)).' // PH : '. @$ipd_patient_details->all_patient_details->phone !!}" >
                            @endisset
                                @if($item->is_used == 'no')
                                    @if(@$ipd_patient_details->ins_by == 'sys')
                                        <i class="fa fa-bed fa-3x text-info"></i>
                                    @else
                                        <i class="fa fa-bed fa-3x text-success"></i>
                                    @endif
                                @elseif ($item->is_used == 'yes')
                                <i class="fa fa-bed fa-3x text-danger"></i>
                                @else
                                <i class="fa fa-bed fa-3x text-warning"></i>
                                @endif
                                <h3 class="appointment-heading"> {{ $item->bed_name }}</h3>
                            @isset($ipd_patient_details)
                            </a>
                            @endisset
                        </div>
                
                    @endforeach
                </div>
            </div>
        </div>
        @endisset
        @endforeach

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
                                <option value="no">Ready For Used</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" id="bed_id" name="bed_id" />
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