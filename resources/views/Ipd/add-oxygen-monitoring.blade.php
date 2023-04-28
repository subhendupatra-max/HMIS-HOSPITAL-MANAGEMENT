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
            <div class="row no-gutters">
                <div class="col-md-12 mt-2">
                    <div class="d-block" style="border-bottom: 1px">

                        <div class="col-md-12 ">
                            <div class="table-responsive">
                                <table id="monitoring_id" class="table card-table table-vcenter text-nowrap table-primary">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="text-white">SL No.</th>
                                            <th class="text-white">Start Time</th>
                                            <th class="text-white">End Time</th>
                                            <th class="text-white">Duration (In Seconds)</th>
                                            <th class="text-white">Date</th>
                                            <th class="text-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ( $oxygen_monitering as $oxygen)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration}}</th>
                                            <td> <button id="start" class="btn btn-primary btn-sm">Start O2</button>
                                                <h4>
                                                    <span id="timeDisplay" name="timeDisplay">0</span><span>s</span>
                                                </h4>
                                            </td>
                                            <td> <button id="pause" class="btn btn-danger btn-sm">End O2</button></td>
                                            <td>{{ $oxygen->oxygen_time }}</td>
                                            <td>{{ $oxygen->created_at }}</td>
                                            <td><a href="{{ route('delete-oxygen-monitoring',['id'=> base64_encode($oxygen->id)]) }}"><i class="fa fa-trash "></i></a></td>
                                        </tr>
                                        <?php
                                        $i = $i + $oxygen->oxygen_time;
                                        ?>

                                        @endforeach

                                        <?php
                                        if ($i >= 60) {
                                            $min = number_format(($i / 60), 2);
                                            $t = $min . "m ";
                                        } else {
                                            $t = $i . "s ";
                                        }

                                        ?>
                                        <tr>
                                            <td>
                                                Total Duraiton =
                                            </td>
                                            <td colspan="5"> {{ $t }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="hr_line" />

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#reset").click(Reset);
    $("#start").click(Start);
    $("#pause").click(Pause);

    var timerId;
    var time = 0;
    var seconds;

    // Call this function to update the text display
    function UpdateText(seconds) {
        // timeElapsed += seconds;
        const now = new Date();
        const date = now.toLocaleDateString();
        const time = now.toLocaleTimeString();
        const datetime = `${date} ${time}`;
        // $("#timeDisplay").text(seconds);
        // $("#timeDisplay").text(datetime);
        $("#timeDisplay").text(datetime);

    }

    // YOUR CODE GOES HERE


    function UpdateTime() {
        seconds++;
        UpdateText(seconds);
    }

    function Reset() {
        $("#addButton").attr('style', 'display:none', true);
        console.log("Reset Clicked");
        seconds = 0;
        UpdateText(seconds)

    }

    function Start() {
        $("#addButton").attr('style', 'display:none', true);
        console.log("Start Clicked");
        // fix the start button bug for multiple clicks
        window.clearInterval(timerId);
        timerId = window.setInterval(UpdateTime, 1000);
    }

    function Pause() {
        $("#addButton").removeAttr('style', true);
        console.log("Pause Clicked");
        window.clearInterval(timerId);
        UpdateText(seconds)
    }
    Reset();

    function add(ipd_id) {

        var otwotime = $("#timeDisplay").text();
        $.ajax({
            url: "{{ route('save-oxygen-monitoring-details') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                otwotime_value: otwotime,
                ipdID: ipd_id,
            },
            success: function(response) {
                $("#addButton").attr('style', 'display:none', true);
                $('#monitoring_id').load(location.href + ' #monitoring_id');

                console.log(response);
                seconds = 0;
                UpdateText(seconds)
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>
@endsection