@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Bill List</h4>
                    </div>
                    @can('Add Patient Billing')
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <a class="btn btn-primary btn-sm" href="{{ route('add-patient-billing',base64_encode($patient_id)) }}"><i class="fa fa-plus"></i> Add Billing</a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->
            @include('message.notification')

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Bill No.</th>
                            <th scope="col">Bill Date</th>
                            <th scope="col">Bill Amount</th>
                            <th scope="col">Discount Status</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Payment Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @if (isset($billing_details))
                            @foreach ($billing_details as $value)
                            <?php $total += $value->grand_total;
                                $payment_amount = DB::table('payments')->where('bill_id',$value->id)->sum('payment_amount');
                            ?>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a class="text-info" href="{{ route('view-bill-details',$value->id) }}">{{ $value->bill_prefix }}{{ $value->id }}</a></td>
                                        <td>{{ date('d-m-Y h:i A',strtotime($value->bill_date)) }}</td>
                                        <td>{{ $value->grand_total }}</td>
                                        <td><span class="badge badge-primary">{{ $value->discount_status }}</span></td>
                                        <td><span class="badge badge-success">{{ $value->payment_status }}</span></td>
                                        <td>{{ $payment_amount }}</td>
                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">

                                                    <a class="dropdown-item" href="{{ route('view-bill-details',$value->id) }}"><i class="fa fa-eye"></i> View</a>
                                             
                                                    <a class="dropdown-item" href="">
                                                        <i class="fa fa-edit"></i> Edit</a>

                                                    <a class="dropdown-item" href="{{route('print-patient-bill',['bill_id'=>base64_encode($value->id)])}}"><i class="fa fa-print"></i> Print </a>
                                       
                                                    <a class="dropdown-item" href="{{ route('delete-patient-bill',['bill_id'=>base64_encode($value->id)]) }}"><i class="fa fa-trash"></i> Delete</a>

                                                @if($value->payment_status == 'Due')  
                                                    @can('take Payment')
                                                        <a class="dropdown-item" href="{{ route('add-payment-bill',['bill_id'=>base64_encode($value->id)]) }}"><i class="fa fa-rupee"></i> Add Payment</a>
                                                    @endcan
                                                @endif

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="mt-4">
                    <h4 style="text-align: center">Total : ₹ {{ $total }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modaldemo2">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Take Payment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('after-new-old')}}" method="post">
                @csrf
                <div class="modal-body">
fdsfdsfs
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary text-right" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
