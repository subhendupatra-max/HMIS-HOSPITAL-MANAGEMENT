@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!-- ================== message============================== -->
    @if (session('success'))
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
    @endif
    <!-- ================== message============================== -->

    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    All Header
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Id</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        @foreach ($allheader as $key => $allheaders)
                        <tbody>
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ @$allheaders->header_name }}</td>
                                <td>
                                  @if(isset($allheaders->logo))  <img src="{{ asset('public/assets/images/header') }}/{{ @$allheaders->logo }}" style="width: 50px;  height: 40px;"> @endif
                                </td>
                                <td>
                                    <a href="{{ route('all-header-details', base64_encode($allheaders->id)) }}">
                                        <button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>


    @endsection