@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Work Station : {{ @$work_details->work_station_name }}</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('add work station user')
                        <a class="btn btn-primary btn-sm" data-target="#modaldemo1" data-toggle="modal" href="#"><i class="fa fa-file"></i> Add Staff</a>
                        @endcan
                    </div>
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            @include('message.notification')

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($work_details_user))
                            @foreach ($work_details_user as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ @$value->staff_details->first_name }} {{ @$value->staff_details->last_name }}</td>
                                    <td>{{ @$value->staff_details->role }}</td>

                                    <td>
                                        <a class="btn btn-danger btn-sm" href="{{ route('work-station-staff-delete',['id'=>$value->id,'station_id'=>$value->station_id]) }}"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Staff For Work Station</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('add-work-station-staff') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                            <input type="hidden" name="station_id" value="{{ $id }}"  />
                            <div class="form-group col-md-12 d-inline-block">
                                <label class="form-label">Staff <span class="text-danger">*</span></label>
                                <select name="staff_id[]" multiple="multiple"
                                    class="form-control multi-select select2-show-search">
                                    <option value="">Select One</option>
                                    @if ($user_list)
                                        @foreach ($user_list as $value)
                                            <option value="{{ $value->id }}">{{ $value->first_name }}
                                                {{ $value->last_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('staff_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-indigo" type="submit">Save</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
