@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Nurse Note
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        @can('add timeline ipd')
                        <a class="btn btn-primary btn-sm" href="{{ route('add-nurse-note-details', ['ipd_id' => base64_encode($ipd_details->id)]) }}"><i class="fa fa-plus"></i> Add Nurse Note </a>
                        @endcan
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="col-xl-12 col-lg-12 col-md-12 mt-3">
                <div class="latest-timeline scrollbar3" id="scrollbar3">
                    <ul class="timeline mb-0">
                        @foreach ( $nurseNoteDetails as $item)
                        <li class="mt-0">
                            <div class="d-flex"><span class="time-data">{{ @$item->nurseNames->first_name }} {{ @$item->nurseNames->last_name }}</span>
                                <span class="ml-auto text-muted fs-11">
                                    {{ date('d-m-Y h:i A',strtotime( $item->date )) }}
                                    @can('edit timeline ipd')
                                    <a href="{{ route('edit-ipd-nurse-note-details',['ipd_id' => base64_encode($ipd_details->id) , 'id' => base64_encode($item->id)]) }}"><i class="fa fa-edit ml-4"></i> Edit</a>
                                    @endcan

                                    @can('delete timeline ipd')
                                    <a href="{{ route('delete-ipd-nurse-note-details',['id' => base64_encode($item->id)]) }}"><i class="fa fa-trash ml-2"></i> Delete</a>
                                    @endcan
                                </span>
                            </div>
                            <p class="text-muted fs-12"> {{ $item->note }}</p>

                        </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection