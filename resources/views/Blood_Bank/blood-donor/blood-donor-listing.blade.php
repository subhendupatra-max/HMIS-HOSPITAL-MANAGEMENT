@extends('layouts.layout')
@section('content')


<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Donor Details
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">

                        @can('Add Blood Donar')
                        <a href="{{route('add-blood-donor')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Donor Details</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>


        <!-- ================================= Message ======================================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <!-- ================================= Message ======================================== -->
        @can('View Blood Donar')
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Donor Name</th>
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Contact No</th>
                                <th scope="col">Father Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bloodDonorDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->donor_name}} </td>
                                <td>{{ @$item->date_of_birth}} </td>
                                <td>{{ @$item->blood_group}} </td>
                                <td>{{ @$item->gender}} </td>
                                <td>{{ @$item->father_name}} </td>
                                <td>{{ @$item->ph_no}} </td>
                                <td>{{ @$item->address}} </td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            @can('edit medicine requisition')
                                            <a class="dropdown-item" href="{{ route('edit-blood-donor',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine requisition')
                                            <a class="dropdown-item" href="{{ route('delete-blood-donor',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

@endsection