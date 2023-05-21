@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    <h4 class="card-title">Discount List </h4>
                </div>
            </div>
        </div>
        <!-- ================================ Alert Message===================================== -->

        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button>{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button>{{ session('error') }}</div>
        @endif

        <div class="card-body">
            <table class="table table-bordered text-nowrap" id="example">
                <thead>
                    <tr>
                        <th scope="col">Discount No.</th>
                        <th scope="col">Bill No.</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Section</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Bill Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Requested By </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($discountList[0]->section)
                    @foreach ($discountList as $value)
                    <?php $discount_details = App\Models\DiscountDetails::where('discount_id', $value->id);
                                $total_bill_amount = $discount_details->sum('bill_amount');
                                $_bill_id = $discount_details->get();
                                ?>
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>
                            @foreach ($_bill_id as $values)
                                <span style="color:brown">{{  $values->bill_id }} </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('view-discount-details',['discount_id'=>base64_encode($value->id)])}}">
                                <span style="color:blue">{{ $value->patient_details->prefix . ' ' .
                                    $value->patient_details->first_name . ' ' . $value->patient_details->middle_name . '
                                    ' . $value->patient_details->last_name }}<br>{{
                                    $value->patient_details->patient_prefix . ' ' . $value->patient_details->id
                                    }}</span></a>

                        </td>
                        <td>
                            @if ($value->section == 'OPD')
                            <span class="badge badge-success">{{ $value->section }}</span>
                            @elseif ($value->section == 'IPD')
                            <span class="badge badge-danger">{{ $value->section }}</span>
                            @elseif ($value->section == 'EMG')
                            <span class="badge badge-info">{{ $value->section }}</span>
                            @else
                            <span class="badge badge-primary">{{ $value->section }}</span>
                            @endif
                        </td>
                        <td>{{ $value->patient_details->phone }}</td>
                        <td>{{ $total_bill_amount }}</td>
                        <td>
                            @if ($value->discount_status == 'Pending')
                            <span class="badge badge-warning">{{ $value->discount_status }}</span>
                            @elseif ($value->discount_status == 'Approved')
                            <span class="badge badge-success">{{ $value->discount_status }}</span>
                            @else
                            <span class="badge badge-danger">{{ $value->discount_status }}</span>
                            @endif

                        </td>
                        <td>{{ $value->request_by_details->first_name . ' ' . $value->request_by_details->last_name }}
                        </td>
                        <td><a class="btn btn-primary btn-sm"
                                href="{{route('view-discount-details',['discount_id'=>base64_encode($value->id)])}}"><i
                                    class="fa fa-eye"></i> View</a></td>
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