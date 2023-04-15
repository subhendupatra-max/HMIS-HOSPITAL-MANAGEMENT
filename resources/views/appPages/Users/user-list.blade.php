@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User List </h4>
            </div>
            <!-- ================================ Alert Message===================================== -->

            @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif

            <!-- ================================ Alert Message===================================== -->
            {{-- <div class="card-body" style="padding:0px 0px 0px 0px">
                <button class="btn btn-default" onclick="card_view_contect()"><i class="fa fa-address-card"></i> Card
                    View</button>
                <button class="btn btn-default" onclick="list_view_contect()"><i class="fa fa-list"></i> List View</button>

            </div> --}}
            {{-- <div class="card-body" id="card_view">
                <div class="row">
                    @if (isset($all_user))
                        @foreach ($all_user as $item)
                            <div class="col-lg-12 col-xl-3 col-sm-12">
                                <div class="card  mb-5">
                                    <div class="card-body">
                                        <div class="media mt-0">
                                            <figure class="rounded-circle align-self-start mb-0">
                                                <img src="{{ asset('public/profile_picture') }}/{{ $item->profile_image }}"
                                                    class="avatar brround avatar-md mr-3">
                                            </figure>
                                            <div class="media-body time-title1 ">
                                                <h6 class="time-title p-0 mb-0 font-weight-semibold leading-normal">
                                                    {{ @$item->name }}</h6>
                                                {{ @$item->role_as }}
                                                @if ($item->is_active == '1')
                                                    <span class="badge badge-success">Enable</span>
                                                @else
                                                    <span class="badge badge-secondary">Disable</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('user-profile') }}/{{ base64_encode($item->id) }}"
                                                class="btn btn-info btn-sm d-none d-sm-block mr-2"><i
                                                    class="fa fa-address-card" data-placement="top" data-toggle="tooltip"
                                                    title="View Profile"></i> </a>
                                            <a href="tel:{{ $item->phone_no }}"
                                                class="btn btn-primary btn-sm d-none d-sm-block" data-placement="top"
                                                data-toggle="tooltip" title="Call"><i class="fa fa-phone"></i></a>

                                        </div>
                                    </div>
                                    <div class="card-footer text-secondary border-top">
                                        Email: <a class="text-primary"
                                            href="mailto:{{ @$item->email }}">{{ @$item->email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div> --}}
            {{-- <div class="card-body" style="display:none" id="list_view"> --}}
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

    {{-- <script type="text/javascript">
        function card_view_contect() {
            $('#list_view').attr('style', 'display:none');
            $('#card_view').removeAttr('style', true);
        }

        function list_view_contect() {
            $('#card_view').attr('style', 'display:none');
            $('#list_view').removeAttr('style', true);
        }
    </script> --}}

    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
