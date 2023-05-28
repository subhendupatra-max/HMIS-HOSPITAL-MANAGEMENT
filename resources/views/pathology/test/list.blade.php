@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Pathology Test
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('add radiology test')
                        <a href="{{ route('add-pathology-test') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Add Pathology Test</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        {{-- ============= message ================ --}}
        @include('message.notification')
        {{-- ============= message ================ --}}
        @can('view pathology group test')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Test Name</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($all_test))
                            @foreach ($all_test as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a class="textlink" href="">{{$value->test_name}}({{$value->short_name}})</a></td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('view-pathology-test-details',['id'=> base64_encode($value->id)]) }}"><i class="fa fa-eye"></i> View</a>
                                            @can('edit pathology test')
                                            <a class="dropdown-item" href="{{ route('edit-pathology-test-details',['id'=> base64_encode($value->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                            @can('delete pathology test')
                                            <a class="dropdown-item" href="{{ route('delete-pathology-test-details',['id'=> base64_encode($value->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
    @endsection