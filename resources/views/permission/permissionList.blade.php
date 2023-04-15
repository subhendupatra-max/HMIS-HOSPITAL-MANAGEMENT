@extends('layouts.layout')

@section('content')
    @can('add permission')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
                @endif
                <h5 class="card-title  fs-3 fw-bolder" style="padding-left: 1%">Add Permission</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ route('addPermission') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="permission" name="permission"
                                placeholder="Enter Permission" required>
                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-start mt-3 ml-3">
                        <button type="submit" class="btn btn-primary"><i class="ri-add-circle-fill"></i>&nbsp;Add
                            Permission</button>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>
    </div>
    @endcan
    <div class="col-md-6">
        <div class="card">
            <div class="card-body fw-bold">
                <div class="text-left ">
                    <h5 class="card-title fs-3 fw-bolder">Permission List</h5>
                </div>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Permission</th>
                           {{-- @can('edit permission')
                            <th scope="col">Edit Role</th>
                            @endcan --}}
                            @can('delete permission')
                            <th scope="col">Delete Role</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perms as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                            {{--    @can('edit permission')
                                <td>
                                    <a href="{{ route('permissionEdit', ['id' => base64_encode($item->id)]) }}"
                                        class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top"
                                        title="Edit Permission"><i
                                            class="fa fa-pencil"></i></a>
                                </td>
                                @endcan --}}
                                @can('delete permission')
                                <td>
                                    <form action="{{ route('deletePermission') }}" method="POST" id="delete">
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"
                                            data-toggle="tooltip-primary" data-placement="top" title=""
                                            data-title="Remove Permission"><i
                                                class="fa fa-trash"></i></button>
                                        <input type="hidden" name="permId" value="{{ $item->id }}">
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $perms->links() !!}
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#removeIcon").click(function(e) {
                e.preventDefault();
                $("#delete").submit();
            });
        });
    </script>
@endsection
