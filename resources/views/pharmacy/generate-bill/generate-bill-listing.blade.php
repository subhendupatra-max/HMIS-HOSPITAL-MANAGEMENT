@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                Pharmacy Bill
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">
                        @can('add pharmacy bill')
                        <a href="{{ route('generate-medicine-bill') }}" class="btn btn-primary btn-sm"><i class="fa fa-file-invoice-dollar"></i> Generate Bill</a>
                        @endcan

                        @can('medicine stock')
                        <a href="{{ route('all-medicine-stock') }}" class="btn btn-primary btn-sm"><i class="fa fa-capsules"></i> Medicine Stock</a>
                        @endcan

                        @can('medicine')
                        <a href="{{ route('all-medicine-listing') }}" class="btn btn-primary btn-sm"><i class="fa fa-pills"></i></i> Medicines</a>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Bill No</th>
                                <th class="border-bottom-0">Case Id </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Patient Name </th>
                                <th class="border-bottom-0">Amount</th>
                                @can('edit medicine','delete medicine')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>
 @endsection
