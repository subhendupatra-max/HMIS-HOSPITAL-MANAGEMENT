@extends('layouts.layout')

@section('content')

@can('add medicine supplier')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Supplier</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-medicine-supplier-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        {{--  <label for="supplier_name" class="form-label"> Supplier Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" value="{{ old('supplier_name')}}" required>  --}}
                        <input type="text"  id="supplier_name" name="supplier_name"value="{{ old('supplier_name')}}" >
                        <label  class="suppilerinput"for="supplier_name">Enter Supplier Name <span class="text-danger">*</span></label>
                        @error('supplier_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        {{--  <label for="supplier_contact" class="form-label">Supplier Contact <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" placeholder="Enter Supplier Contact" value="{{ old('supplier_contact')}}" required>  --}}
                        <input type="text"  id="supplier_contact" name="supplier_contact"value="{{ old('supplier_contact')}}"  >
                        <label  class="suppilerinputone"for="supplier_contact">Enter Supplier Contact <span class="text-danger">*</span></label>
                        @error('supplier_contact')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        {{--  <label for="contact_person_name" class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" placeholder="Enter Contact Person Name" value="{{ old('contact_person_name')}}" required>  --}}
                        <input type="text"  id="contact_person_name" name="contact_person_name"value="{{ old('contact_person_name')}}"  >
                        <label  class="suppilerinputtwo"for="contact_person_name">Enter Contact Person Name <span class="text-danger">*</span></label>
                        @error('contact_person_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        {{--  <label for="contact_person_phone" class="form-label">Contact Person Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone" placeholder="Enter Contact Person Phone" value="{{ old('contact_person_phone')}}" required>  --}}
                        <input type="text"  id="contact_person_phone" name="contact_person_phone"value="{{ old('contact_person_phone')}}"   >
                        <label  class="suppilerinputthree"for="contact_person_phone">Enter Contact Person  Phone<span class="text-danger">*</span></label>
                        @error('contact_person_phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        {{--  <label for="drug_license_number" class="form-label">Drug License Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="drug_license_number" name="drug_license_number" placeholder="Enter Drug License Number" value="{{ old('drug_license_number')}}" required>  --}}
                        <input type="text"  id="drug_license_number" name="drug_license_number"value="{{ old('drug_license_number')}}"  >
                        <label  class="suppilerinputfour"for="drug_license_number">Enter Drug License Number<span class="text-danger">*</span></label>
                        @error('drug_license_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="supplieredit">
                        {{--  <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <textarea name="address"  class="form-control"> </textarea>  --}}
                        <input type="text"  id="address" name="address" >
                        <label  class="suppilerinputfive"for="address">Address<span class="text-danger">*</span></label>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
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
