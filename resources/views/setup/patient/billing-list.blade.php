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
                            <th scope="col">Bill No</th>
                            <th scope="col">Bill Date</th>
                            <th scope="col">Bill Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @if (isset($billing_details))
                            @foreach ($billing_details as $value)
                            <?php $total += $value->grand_total; ?>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->bill_prefix }}{{ $value->id }}</td>
                                        <td>{{ date('d-m-Y h:i A',strtotime($value->bill_date)) }}</td>
                                        <td>{{ $value->grand_total }}</td>
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
