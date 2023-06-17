@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Notification List</h4>
                    </div>

                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            @include('message.notification')

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Notification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($all_notification))
                            @foreach ($all_notification as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $value->message !!}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
