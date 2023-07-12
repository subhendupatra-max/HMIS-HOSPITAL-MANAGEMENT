@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User List </h4>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @include('message.notification')

        <!-- ================================ Alert Message===================================== -->

        <div class="card-body">
            <table id="example" class="table table-borderless text-nowrap key-buttons">
                <thead class="bg-primary text-white">
                    <tr class="border-left">
                        <th class="text-white">Sl No.</th>
                        <th class="text-white">Emp Id</th>
                        <th class="text-white">Emp Name</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Department</th>
                        <th class="text-white">Designation</th>
                        <th class="text-white">Status</th>
                        @can('user profile || user active deactive || user edit || user delete')
                        <th class="text-white"> Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @if (isset($all_user))
                    @foreach ($all_user as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ @$item->employee_id }}</td>
                        <td><img style="height:25px;width: 25px" class="rounded-circle"
                                src="{{ asset('public/profile_picture') }}/{{ $item->profile_image }}">
                            <a class="textlink" href="{{ route('user-profile') }}/{{ base64_encode($item->id) }}"> {{ @$item->first_name }} {{ @$item->last_name }}</a>
                        </td>
                        <td>{{ @$item->email }}</td>
                        <td>{{ @$item->role }}</td>
                        <td>{{ @$item->department_details->department_name }}</td>
                        <td>{{ @$item->designation_details->designation_name }}</td>
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
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
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