@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Pathology Test List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('add pathology test')
                        <a href="{{ route('add-pathology-test-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i>Add Pathology Test </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Parameter Name</th>
                                <th class="border-bottom-0">Test Value</th>

                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($pathologyparameterDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->parameter_name}}{{$item->formula}}</td>
                                <td>
                                    <input type="text" name="{{$item->parameter_name}}" id="{{$item->parameter_name}}" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('resources\views\pathology\test-formula\test_formula.js') }}"></script>

@endsection
