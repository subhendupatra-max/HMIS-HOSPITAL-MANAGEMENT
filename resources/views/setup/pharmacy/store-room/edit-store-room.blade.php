@extends('layouts.layout')

@section('content')

<!-- INTERNAL Select2 css -->
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@can('edit medicine storeroom')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit StoreRoom</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-medicine-store-room-details') }}">
                @csrf

                <div class="">
                    <div class="form-group">
                        <label for="name" class="form-label">Store Room Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Store Room Name" value="{{ $editStoreRoom->name }}" required>
                        <input type="hidden" name="store_room_id" value="{{ $editStoreRoom->id }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control mb-4" id="address" name="address" placeholder="Store Room Address" rows="3">{{ $editStoreRoom->address }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control mb-4" id="desc" name="desc" placeholder="Store Room Description" rows="3">{{ $editStoreRoom->desc }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Store Room</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Store Room List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Store Room Name</th>
                                <th class="border-bottom-0">Store Room Address

                                </th>
                                @can('delete medicine storeroom')
                                <th class="border-bottom-0">Remove</th>
                                @endcan
                                @can('edit medicine storeroom')
                                <th class="border-bottom-0">Edit</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allStoreRoom as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                @can('delete medicine storeroom')
                                <td>
                                    <form action="{{ route('delete-medicine-store-room-details') }}" method="POST" id="delete">
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip-primary" data-placement="top" title="Remove  workshop" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" name="store_room_id" value="{{ $item->id }}">
                                    </form>
                                </td>
                                @endcan
                                @can('edit medicine storeroom')
                                <td>
                                    <a href="{{route('edit-medicine-store-room-details',['id'=>base64_encode($item->id)])}}" class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top" title="Edit workshop"><i class="fa fa-edit"></i></a>
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
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>
<!-- INTERNAL Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endsection