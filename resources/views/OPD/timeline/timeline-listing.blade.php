@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Timeline
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add timeline list opd')
                        <a href="{{ route('add-timeline-lisitng-in-opd',['id' => base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Timeline </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-profile' ? 'active' : '' }}" href="{{route('opd-profile',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-home"></i> Profile</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-billing' ? 'active' : '' }}" href="{{route('opd-billing',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-money-bill"></i> Billing</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-payment' ? 'active' : '' }}" href="{{route('payment-listing-in-opd',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="fa fa-rupee-sign"></i> Payment</a>
                            <a class="dropdown-item {{ Request::segment(2) == 'opd-timeline' ? 'active' : '' }}" href="{{route('timeline-lisitng-in-opd',['id'=>base64_encode($opd_patient_details->id)])}}"><i class="far fa-calendar-check"></i> Timeline</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="latest-timeline scrollbar3" id="scrollbar3">
                    <ul class="timeline mb-0">
                        @foreach ( $timelineDetails as $item)
                        <li class="mt-0">
                            <div class="d-flex"><span class="time-data">{{ $item->title }}</span><span class="ml-auto text-muted fs-11">
                                    {{ date('d-m-Y h:i A',strtotime( $item->date )) }}
                                    @can('')
                                    <a href="{{ route('edit-timeline-lisitng-in-opd',['id'=> base64_encode($item->id),'opd_id'=> base64_encode($opd_patient_details->id)]) }}"> <i class="fa fa-edit ml-4"></i> Edit</a>
                                    @endcan

                                    @can('')
                                    <a href="{{ route('delete-timeline-lisitng-in-opd',['id'=> base64_encode($item->id)]) }}"> <i class="fa fa-trash ml-2"></i> Delete</a>
                                    @endcan

                                </span></div>
                            <p class="text-muted fs-12"> {{ $item->description }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection
