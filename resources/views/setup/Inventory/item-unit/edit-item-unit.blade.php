@extends('layouts.layout')

@section('content')

@can('add item unit')
<div class="col-lg-12 col-xl-4 col-md-6 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Item Unit</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-inventory-item-unit') }}">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label for="role" class="form-label">Item Unit</label>
                        <input type="text" class="form-control" id="item_unit" name="item_unit" placeholder="Enter Item Unit" value="{{ $itemUnit->units }}" required>
                        @error('item_Unit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="item_unit_id" value="{{ $itemUnit->id }}">
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label">Base Unit</label>
                            <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" name="base_val" id="base_val">
                                <optgroup label="Base Unit">
                                    <option value="">--select--</option>
                                    @foreach ($allItemUnit as $item)
                                    <option value="{{ $item->units }}" {{ $item->units == $itemUnit->base_unit ? 'selected':''}}>
                                        {{ $item->units }}
                                    </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        @error('base_val')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="optional_value">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label">Operator</label>
                                <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" id="operator" name="operator" id="operator">
                                    <optgroup label="Mountain Time Zone">
                                        <option value="+" {{ $itemUnit->operator == '+'  ? 'selected':''}}>+</option>
                                        <option value="-" {{ $itemUnit->operator == '-'  ? 'selected':''}}>-</option>
                                        <option value="*" {{ $itemUnit->operator == '*'  ? 'selected':''}}>*</option>
                                        <option value="/" {{ $itemUnit->operator == '/'  ? 'selected':''}}>/</option>
                                    </optgroup>
                                </select>
                                @error('operator')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="form-label">Operation Value</label>
                            <input type="text" class="form-control" id="operation_value" name="operation_value" placeholder="Enter Operation Value" value="{{$itemUnit->operation_value}}">
                            @error('operation_value')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Item Unit</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-6 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Item Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Unit</th>
                                @can('delete item unit')
                                <th class="border-bottom-0">Remove Unit</th>
                                @endcan
                                @can('edit item unit')
                                <th class="border-bottom-0">Edit Unit</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allItemUnit as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->units }}</td>
                                @can('delete item unit')
                                <td>
                                    <form action="{{ route('delete-inventory-item-unit') }}" method="POST" id="delete">
                                        @csrf
                                        <button class="btn btn-danger" data-toggle="tooltip-primary" data-placement="top" title="Remove  Item unit" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" name="item_unit" value="{{ $item->id }}">
                                    </form>
                                </td>
                                @endcan
                                @can('edit item unit')
                                <td>
                                    <a href="{{ route('edit-inventory-item-unit',['id'=>base64_encode($item->id)]) }}" class="btn btn-warning" data-toggle="tooltip-primary" data-placement="top" title="Edit Item unit"><i class="fa fa-edit"></i></a>
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
<!-- Jquery js-->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".optional_value").addClass("d-none");
        $("#base_val").change(function(e) {

            var baseUnit = $("#base_val").val();
            console.log("df");
            if (baseUnit != "") {
                $(".optional_value").removeClass("d-none");

            } else {
                $(".optional_value").addClass("d-none");
            }

        });
    });
</script>
@endsection