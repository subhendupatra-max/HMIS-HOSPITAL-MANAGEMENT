@extends('layouts.layout')

@section('content')

@can('add medicine supplier')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Supplier</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-medicine-supplier-details') }}">
                @csrf
                <div class="">
                <input type="hidden" name="id" value="{{ $editSupplier->id }}" />
                    <div class="form-group">
                        <label for="supplier_name" class="form-label"> Supplier Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" value="{{ $editSupplier->supplier_name }}" required>
                        @error('supplier_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="supplier_contact" class="form-label">Supplier Contact <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" placeholder="Enter Supplier Contact" value="{{ $editSupplier->supplier_contact }}" required>
                        @error('supplier_contact')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_person_name" class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" placeholder="Enter Contact Person Name" value="{{ $editSupplier->contact_person_name }}" required>
                        @error('contact_person_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_person_phone" class="form-label">Contact Person Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone" placeholder="Enter Contact Person Phone" value="{{ $editSupplier->contact_person_phone }}" required>
                        @error('contact_person_phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="drug_license_number" class="form-label">Drug License Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="drug_license_number" name="drug_license_number" placeholder="Enter Drug License Number" value="{{ $editSupplier->drug_license_number }}" required>
                        @error('drug_license_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <textarea name="address"  class="form-control"> {{ $editSupplier->address }} </textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Supplier</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Supplier List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Supplier Name</th>
                                <th class="border-bottom-0">Supplier Contact</th>
                                <th class="border-bottom-0">Contact Person Name</th>
                                <th class="border-bottom-0">Contact Person Phone</th>
                                <th class="border-bottom-0">Drug License Number</th>
                                <th class="border-bottom-0">Address</th>
                                @can('edit medicine supplier','delete medicine supplier')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->supplier_name}}</td>
                                <td>{{ $item->supplier_contact}}</td>
                                <td>{{ $item->contact_person_name}}</td>
                                <td>{{ $item->contact_person_phone}}</td>
                                <td>{{ $item->drug_license_number}}</td>
                                <td>{{ $item->address}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit medicine supplier')
                                            <a class="dropdown-item" href="{{ route('edit-medicine-supplier-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine supplier')
                                            <a class="dropdown-item" href="{{ route('delete-medicine-supplier-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
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
@endsection