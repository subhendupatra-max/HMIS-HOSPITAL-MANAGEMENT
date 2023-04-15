@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Timeline List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('add timeline list opd')
                        <a href="{{ route('add-timeline-lisitng-in-opd',['id' => base64_encode($opd_id)]) }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add Timeline </a>
                        @endcan
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
                                    <a href="{{ route('edit-timeline-lisitng-in-opd',['id'=> base64_encode($item->id)]) }}"> <i class="fa fa-edit ml-4"></i> Edit</a>
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