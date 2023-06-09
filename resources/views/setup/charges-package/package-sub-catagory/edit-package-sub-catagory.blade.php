@extends('layouts.layout')

@section('content')

@can('edit package sub catagory')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Charges Package Sub Catagory</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-charges-package-sub-catagory-details') }}">
                @csrf
                <div class="">
                    <input type="hidden" name="id" value="{{ $editSubCatagory->id }}" />
                    <div class="form-group">
                        <label for="charges_package_catagory_id" class="medicinelabel">Charges Package Catagory <span class="text-danger">*</span></label>
                        <select id="charges_package_catagory_id" class="form-control" name="charges_package_catagory_id">
                            <option value=" ">Select Charges Catagory </option>
                            @foreach ($catagory as $item)
                            <option value="{{$item->id}}" {{ $item->id == $editSubCatagory->charges_package_catagory_id ? 'selected' : " " }}>{{$item->charges_package_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charges_package_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="subcatagoryedit">
                        <label for="charges_package_sub_catagory_name" class="packagesublabel">Charges Package Sub Catagory Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="charges_package_sub_catagory_name" name="charges_package_sub_catagory_name" value="{{ $editSubCatagory->charges_package_sub_catagory_name }}" required>
                        @error('charges_package_sub_catagory_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Sub Catagory</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Charges Package Sub Catagory List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Sub Catagory Name</th>
                                @can('edit package sub catagory','delete package sub catagory')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subCatagory as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ @$item->chargesPackageCatagoryName->charges_package_catagories_name}}</td>
                                <td>{{ $item->charges_package_sub_catagory_name}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit package sub catagory')
                                            <a class="dropdown-item" href="{{ route('edit-charges-package-sub-catagory-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete package sub catagory')
                                            <a class="dropdown-item" href="{{ route('delete-charges-package-sub-catagory-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
