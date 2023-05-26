@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Oxygen Monitoring
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-header">
            @include('ipd.include.patient-name')
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="d-block" style="border-bottom: 1px">

                        <div class="col-md-12 ">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap" id="example">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Duration (In Seconds)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $seconds = 0;
                                         $total_duration = 0;
                                         ?>
                                        @if (@$oxygen_monitering[0]->start_time != null)
                                        @foreach ($oxygen_monitering as $value)
                                        <?php
                                             $seconds += $value->duration;
                                             $total_duration = floor($seconds / 60);
                                             ?>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> {{ date('d-m-Y h:i a',strtotime($value->start_time ))}}</td>
                                            <td>
                                                @if($value->end_time == null)
                                                <form action="{{ route('end-oxygen-in-ipd') }}" method="POST">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="datetime-local" name="end_time" required />
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $value->id }}" />
                                                            <input type="hidden" name="ipd_id" value="{{ $ipdId }}" />
                                                            <input type="hidden" name="start_time"
                                                                value="{{ $value->start_time }}" />
                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary  btn-sm"
                                                                    type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @else
                                                @if(@$value->end_time != null)
                                                {{ @date('d-m-Y h:i a',strtotime($value->end_time ))}}
                                                @endif
                                                @endif
                                            </td>
                                            <td>{{ @$value->duration }}</td>

                                        </tr>
                                        @endforeach
                                        @endif
                                        @if(@$oxygen_monitering_last->end_time != null ||
                                        !isset($oxygen_monitering_last))
                                        <tr>
                                            <td>New Start</td>
                                            <td>
                                                <form action="{{ route('start-oxygen-in-ipd') }}" method="POST">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="datetime-local" name="start_time"
                                                                    required />
                                                            </div>
                                                            <input type="hidden" name="ipd_id" value="{{ $ipdId }}" />

                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary  btn-sm"
                                                                    type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>End Time</td>
                                            <td>Duration (In Seconds)</td>

                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <span style="color:blue;font-weight:700;font-size:15px;margin:19px 17px 14px 33px">Total
                                    : {{ @$total_duration.' min' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection