@extends('layouts.layout')
@section('content')

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        <h4 class="card-title">Payment List</h4>
                    </div>
                    @can('OPD registation')
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <a class="btn btn-primary btn-sm" data-target="#modaldemo2" data-toggle="modal" href="#"><i class="fa fa-plus"></i> Add New Payment</a>
                        </div>
                    </div>
                    @endcan
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
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Payment Amount</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Transection Id</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($payment_list))
                            @foreach ($payment_list as $value)

                            @endforeach
                        @endif
                    </tbody>
                </table>
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
