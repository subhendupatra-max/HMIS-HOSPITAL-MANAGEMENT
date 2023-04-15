@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        Pathology Test Master List
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            @can('add pathology test master')
                                <a href="{{ route('add-pathology-test-master-details') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i> Add Pathology Test Master</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============= message ================ --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif
            {{-- ============= message ================ --}}
            @can('view pathology test list')
                <div class="card-body">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="example2">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">Sl. No</th>
                                        <th class="border-bottom-0">Test Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pathologyTest as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a class="textlink" href="{{ route('view-pathology-test-details', ['id' => $item->id]) }}">{{ $item->test_name }}</a></td>
                                            <td>
                                                <div class="card-options">
                                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">Action <i
                                                            class="fa fa-caret-down"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('view-pathology-test-details', ['id' => $item->id]) }}"><i
                                                                class="fa fa-eye"></i> View</a>


                                                        @can('edit pathology test')
                                                            <a class="dropdown-item"
                                                                href="{{ route('edit-pathology-test-details', ['id' => $item->id]) }}"><i
                                                                    class="fa fa-edit"></i> Edit</a>
                                                        @endcan

                                                        @can('delete pathology test')
                                                            <a class="dropdown-item"
                                                                href="{{ route('delete-pathology-test-details', ['id' => $item->id]) }}"><i
                                                                    class="fa fa-trash"></i> Delete</a>
                                                        @endcan

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endcan
        </div>
    @endsection
