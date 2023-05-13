@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Blood Bank Status
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('View Blood Donar')
                        <a href="{{ route('all-blood-donor-details-listing') }}" class="btn btn-primary btn-sm"><i class="fa fa-file"></i>
                            Donor Details </a>
                        @endcan

                        @can('')
                        <a href="{{ route('pathology-test-list') }}" class="btn btn-primary btn-sm"><i class="fa fa-vials"></i> Blood Issue Details </a>
                        @endcan
                        @can('')
                        <a href="{{ route('pathology-test-master-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-mortar-pestle"></i> Components Issue </a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
        @can('')
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2 " style="display:inline-block">
                            @foreach ($blood_groups as $blood_group)

                            <a href="{{ route('blood-details',['id'=> base64_encode($blood_group->id) ]) }}" class="@if(@$blood_group_id == $blood_group->id) btn btn-secondary @else btn btn-primary @endif btn-sm d-block  mb-1 btnclr_area"><i class="fa fa-file"></i>
                                {{ $blood_group->blood_group_name }} </a>

                            @endforeach
                        </div>
                        @if(@$blood_group_id)
                        <div class="col-md-5" style="display:inline-block">
                            <div class="card cstmcard_area">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <div class="row">
                                            <h4 style="float:left">{{@$blood_groups_details_for_this_blood_group->blood_group_name }}
                                                Blood Details</h4>
                                            <div class="plsbtndesign">
                                                <a href="{{ route('add-blood',['id'=> base64_encode($blood_groups_details_for_this_blood_group->id) ]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-primary table-white ">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Bags</th>
                                                <th class="text-white">Lot</th>
                                                <th class="text-white">Institution</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blood as $item)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ @$item->bag}}</td>
                                                <td>{{ @$item->lot}}</td>
                                                <td>{{ @$item->institution}}</td>
                                                <td>
                                                    @can('')
                                                    <a href="{{ route('add-blood-issue-details',['blood_group_id'=> base64_encode($blood_groups_details_for_this_blood_group->id) , 'id'=> base64_encode($item->id)  ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Issue </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table-responsive -->
                            </div>
                        </div>
                        <div class="col-md-5" style="display:inline-block">
                            <div class="card cstmcard_area">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <div class="row">
                                            <h4 style="float:left">{{@$blood_groups_details_for_this_blood_group->blood_group_name }} Components Details</h4>
                                            <div class="plsbtndesign">
                                                <a href="{{ route('add-blood-components-details',['id'=> base64_encode($blood_groups_details_for_this_blood_group->id) ]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </h3>
                                </div>
                                <div class="table-responsive">
                                    <!-- <table class="table card-table table-vcenter text-nowrap table-danger"> -->
                                    <table class="table card-table table-vcenter text-primary table-white ">
                                    <thead class="bg-primary text-white">
                                            <tr>
                                                <th class="text-white">ID</th>
                                                <th class="text-white">Bags</th>
                                                <th class="text-white">Lot</th>
                                                <th class="text-white">Institution</th>
                                                <th class="text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($components as $item)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ @$item->getComponentsDetails->bag}}</td>
                                                <td>{{ @$item->getComponentsDetails->lot}}</td>
                                                <td>{{ @$item->getComponentsDetails->institution}}</td>
                                                <td>
                                                    @can('View blood components Details')
                                                    <a href="{{ route('add-blood-issue-details',['blood_group_id'=> base64_encode($blood_groups_details_for_this_blood_group->id) , 'id'=> base64_encode($item->id)  ]) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Issue </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table-responsive -->
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection