@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title"> </h4>
                </div>
            </div>
        </div>

        <!-- ================================ Alert Message===================================== -->

        @include('message.notification')

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover card-table table-vcenter text-nowrap border-left border-right border-bottom">
                <thead class="bg-primary text-white">
                    <tr class="border-left">
                        <th  class="text-white">Staff Name</th>
                        @foreach ($daterange as $date)
                            <th  class="text-white">
                                {{ date('jS M',strtotime($date)) }}
                                <input type="hidden" name="duty_date" value="{{ $date }}" />
                            </th>
                        @endforeach
                      
                    </tr>
                </thead>

                <tbody>
                    @if(@$staffDetails[0]->id != null)
                    @foreach ($staffDetails as $value)
                    <tr>
                        <td class="border-right">
                            {{ @$value->staff_details->first_name }}
                            {{ @$value->staff_details->middle_name }}
                        </td>
                        @foreach ($daterange as $date)
                        <td class="border-right">
                            <select name="" class="select2-show-search form-control" id="slot{{ $value->id }}" >
                                <option value="">Select One.....</option>
                                @foreach ($working_slot_Details as $values)
                                    <option value="">
                                        <span style="color:{{ @$values->color }}">{{ $values->working_slot_name }}({{ date('h:i A',strtotime($values->from_time)) }} -  {{ date('h:i A',strtotime($values->to_time)) }})</span>
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        @endforeach
                        {{-- <td>
                            <span id="total_time{{ $value->id }}"></span>
                        </td> --}}
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" style="text-align: center;">
                            <img src="{{ asset('public/no_found_data/no_data.png') }}" alt="loader" width="400px"
                            height="160px">
                        </td>
                    </tr>
                    @endif
                </tbody>

            </table>
            </div>
        </div>
    </div>
</div>

<script>
    function getChanges(id)
    {


    }
</script>


<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
