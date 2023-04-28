@extends('layouts.layout')

@section('content')

@can('add medicine dosage')
<div class="col-lg-12 col-xl-5 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Medicine Dosage</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-medicine-dosage-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="medicine_catagory_id" class="medicinelabel"> Medicine Catagory <span class="text-danger">*</span></label>
                        <select name="medicine_catagory_id" class="form-control select2-show-search" id="medicine_catagory_id">

                            <option value="">Select Catagory Name ... </option>
                            @foreach($catagory as $items)
                            <option value="{{$items->id}}" {{ $items->id == $id ? 'selected' : " " }}>{!! $items->medicine_catagory_name !!}</option>
                            @endforeach
                        </select>
                        @error('medicine_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Dose<span class="text-danger">*</span></th>
                                <th scope="col">Unit <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 2%">

                                </th>
                            </tr>
                        </thead>
                        <tbody id="subhendu">
                            @if ($editDosage)
                            @foreach ($editDosage as $value)

                            <tr id="rowid0">
                                <td>
                                    <input type="text" id="dose" name="dose[]" value="{{ @$value->dose }}" required>
                                </td>
                                <td>
                                    <select name="medicine_unit_id[]" class="form-control select2-show-search" id="medicine_unit_id">
                                        <option value="">Select Unit Name ... </option>
                                        @foreach($unit as $items)
                                        <option value="{{$items->id}}"  {{ $items->id == $value->medicine_unit_id ? 'selected' : " " }}>{!! $items->medicine_unit_name !!}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            <!-- dynamic row -->
                        </tbody>
                    </table>


                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Dosage</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-7 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title"></div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0"> Medicine Catagory</th>
                                <th class="border-bottom-0"> Unit</th>
                                <th class="border-bottom-0"> Dose</th>
                                @can('edit medicine dosage','delete medicine dosage')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosage as $item)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ @$item->catagory_name->medicine_catagory_name}}</td>
                                <td>{{ @$item->unit_name->medicine_unit_name}}</td>
                                <td>{{ @$item->dose}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit medicine dosage')
                                            <a class="dropdown-item" href="{{ route('edit-medicine-dosage-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine dosage')
                                            <a class="dropdown-item" href="{{ route('delete-medicine-dosage-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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

<script>
    var rowid = 1;

    function addnewrow() {

        var html = ` <tr id="rowid${rowid}">
                                <td><input type="text" class="form-control" id="dose" name="dose[]" value="" required></td>
                                <td>
                                <select name="medicine_unit_id[]" class="form-control select2-show-search" id="medicine_unit_id">
                                        <option value="">Select Unit Name ... </option>
                                        @foreach($unit as $items)
                                        <option value="{{$items->id}}">{!! $items->medicine_unit_name !!}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger" onclick="removerow(${rowid})"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;
        $('#subhendu').append(html);
        rowid = rowid + 1;
    }

    function removerow(rowid) {
        $('#rowid' + rowid).empty();
    }
</script>
@endsection
