@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title"> Patient List </h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('patient_search-in-opd') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="uhid_no">Patient UHID</label>
                                    <input type="text" class="form-control" id="uhid_no" value="{{ old('uhid_no') }}"
                                        name="uhid_no" placeholder="Enter UHID No.">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="patient_name">Patient Name</label>
                                    <input type="text" class="form-control" id="patient_name"
                                        value="{{ old('patient_name') }}" name="patient_name"
                                        placeholder="Enter Patient Name">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="mobile_no">Patient Mobile No. </label>
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="{{ old('mobile_no') }}"
                                        name="mobile_no" placeholder="Enter Mobile No.">

                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary" style="margin: 27px 0px 0px 0px "><i
                                            class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                            @can('user profile || user active deactive || user edit || user delete')
                                <th scope="col"> Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($all_user))
                            @foreach ($all_user as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><img alt="User Avatar" style="height:25px;width: 25px" class="rounded-circle"
                                            src="{{ asset('public/profile_picture') }}/{{ $item->profile_image }}">
                                        {{ @$item->first_name }} {{ @$item->last_name }}</td>
                                    <td>{{ @$item->email }}</td>
                                    <td>{{ @$item->role }}</td>
                                    <td>{{ @$item->department->department_name }}</td>
                                    <td>
                                        @if ($item->is_active == '1')
                                            <span class="badge badge-success">Enable</span>
                                        @else
                                            <span class="badge badge-secondary">Disable</span>
                                        @endif

                                    </td>

                                    @can('user profile || user active deactive || user edit || user delete')
                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @can('user profile')
                                                        <a class="dropdown-item"
                                                            href="{{ route('user-profile') }}/{{ base64_encode($item->id) }}"><i
                                                                class="fa fa-eye"></i> View</a>
                                                    @endcan
                                                    @can('user active deactive')
                                                        @if ($item->id != Auth::id())
                                                            <a class="dropdown-item"
                                                                href="{{ route('user-enable-disable', base64_encode($item->id)) }}"><i
                                                                    class="fa fa-user-lock"></i> Enable/Disable</a>
                                                        @endif
                                                    @endcan

                                                    @if (auth()->user()->can('user edit') || $item->id == Auth::id())
                                                        <a class="dropdown-item"
                                                            href="{{ route('user-edit', base64_encode($item->id)) }}"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    @endif

                                                    @can('user delete')
                                                        @if ($item->id != Auth::id())
                                                            <a class="dropdown-item"
                                                                href="{{ route('user-delete', base64_encode($item->id)) }}"><i
                                                                    class="fa fa-trash"></i> Delete</a>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
