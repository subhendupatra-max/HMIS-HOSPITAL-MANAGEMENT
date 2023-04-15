@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Vendor List
                </div>
                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('add medicine vendor')
                        <a href="{{ route('add-medicine-vendor-details') }}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Add New Vendor </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>


        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Details</th>
                                <th class="border-bottom-0">Status</th>


                                @can('delete role')
                                <th class="border-bottom-0">Remove</th>
                                @endcan
                                @can('edit role')
                                <th class="border-bottom-0">Edit</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->vendor_name }}</td>
                                <td>{{ $item->vendor_address }}</td>

                                <td>
                                    <a href="#" class="btn btn-info" data-toggle="tooltip-primary" data-bs-placement="top" title="PnNo - {{$item->pnno}}  Email - {{$item->email}} Contact Person - {{$item->contact_name}}"><i class="fa fa-eye"></i></a>

                                </td>


                                <td>@if($item->is_active == '1')

                                    <a href="{{route('vendorStatusAction',$item->id)}}" class="btn btn-success btn-sm">Active</a>

                                    @else

                                    <a href="{{route('vendorStatusAction',$item->id)}}" class="btn btn-danger btn-sm">Deactive</a>

                                </td>
                                @endif

                                @can('delete role')
                                <td>
                                    <form action="{{ route('delete-medicine-vendor-details') }}" method="POST" id="delete">
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip-primary" data-placement="top" title="Remove Vendor" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" name="vendorId" value="{{ $item->id }}">
                                    </form>
                                </td>
                                @endcan
                                @can('edit role')
                                <td>
                                    <a href="{{ route('edit-medicine-vendor-details',['id'=>base64_encode($item->id)]) }}" class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top" title="Edit Vendor Details"><i class="fa fa-edit"></i></a>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endsection