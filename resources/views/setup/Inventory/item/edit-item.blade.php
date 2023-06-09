@extends('layouts.layout')
@section('content')

<script>
    var i = 1;

    function addattr() {

        var html = '<tr id="row' + i + '"><td><select class="form-control" name="item_attribute[]"><option>Select One</option> @if(isset($item_attribute)) @foreach($item_attribute as $value)<option value="{{$value->attribute_name}}">{{$value->attribute_name}}</option> @endforeach @endif</select></td><td><input type="text" class="form-control" name="attribute_value[]"></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-remove"></i></button></td></tr>';

        console.log(html);
        $('#dynamicTable').append(html);
        i = i + 1;

    }

    function remove(i) {
        $('#row' + i).remove();
    }
</script>

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Item</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="{{route('update-Inventory-item')}}">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <input type="hidden" name="id" value="{{$item->id}}" />
                            <div class="col-md-4 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Item Type<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="item_type_id" class="form-control">
                                            <option>Select One</option>
                                            @if(isset($item_type))
                                            @foreach($item_type as $value)
                                            <option value="{{$value->id}}" {{ $value->id == $item->item_type_id ? 'selected' : '' }}>{{$value->item_type_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('item_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Item Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$item->item_name}}" id="item_name" name="item_name" placeholder="Enter Item Name">
                                    </div>
                                    @error('item_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Part No.<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$item->part_no}}" id="part_no" name="part_no" required placeholder="Enter Part No">
                                    </div>
                                    @error('part_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Item Category<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="item_categoris[]" required class="form-control select2" multiple>
                                            <option value="" disabled>Select One</option>
                                            @if(isset($item_category))
                                            @foreach($item_category as $value)
                                            <option value="{{$value->id}}" <?php for ($i = 0; $i < (count($cate) - 1); $i++) {
                                                                                if ($cate[$i] == $value->id) {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>>{{$value->item_catagory_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('item_categoris')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4 mb-3 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Item Unit<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select id="unit" name="unit" class="form-control select2">
                                            <option>Select One</option>
                                            @if(isset($units))
                                            @foreach($units as $value)
                                            <option value="{{$value->id}}" {{ $value->id == $item->unit_id ? 'selected' : '' }}>{{$value->units}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Loworder Level<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$item->loworder_level}}" id="loworder_level" name="loworder_level" placeholder="Enter Loworder Level">
                                    </div>
                                    @error('loworder_level')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Brand<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="brand_id" class="form-control select2">
                                            <option value="" selected>---Select---</option>
                                            @foreach ($brand as $value)
                                            <option value="{{  $value->id }}" {{ $value->id == $item->brand_id ? 'selected' : '' }}>{{ $value->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('brand_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Manufacturer<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <select name="manufacturer" class="form-control select2">
                                            <option value="">---Select---</option>
                                            @foreach ($manufacturer as $value)
                                            <option value="{{  $value->id }}" {{ $value->id == $item->manufacturer ? 'selected' : '' }}>{{ $value->manufacture_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('manufacturer')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-2 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Stored<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <textarea name="stored" class="form-control">{{ @$item->stored }}</textarea>
                                    </div>
                                    @error('stored')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Uses<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <textarea name="uses" class="form-control">{{ @$item->uses }}</textarea>
                                    </div>
                                    @error('uses')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">Product Code<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$item->product_code}}" readonly name="product_code" placeholder="Generate Product code">
                                    </div>
                                    @error('product_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 itemeditinventory">
                                <div class="input-group">
                                    <label class="form-label">HSN or SAC No<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$item->hsn_or_sac_no}}" id="hsn_or_sac_no" name="hsn_or_sac_no" placeholder="Enter HSN or SAC No">
                                    </div>
                                    @error('hsn_or_sac_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 itemeditinventorythree">
                                <label class="form-label">Item Picture <span class="text-danger">*</span> (245px x 48px)(File size must be less then 5mb)</label>
                                <input type="file" name="item_pic" onchange="readURL(this);">
                                <img id="blah" width="50px" height="30px" alt="your image" />
                                @error('item_pic')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <table class="table table-bordered" id="dynamicTable">
                                <tr>
                                    <th>Attribute Name</th>
                                    <th>Value</th>
                                    <th><button type="button" onclick="addattr()" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                                </tr>
                                <?php
                                if (!empty($item_description)) {
                                    $i = 1;
                                    foreach ($item_description as $values) {
                                ?>
                                        <tr id="row<?php echo $i; ?>">
                                            <td>
                                                <select class="form-control" name="item_attribute[]">
                                                    <option value="">Select One</option>
                                                    @if(isset($item_attribute))
                                                    @foreach($item_attribute as $value)
                                                    <option <?php if ($value->attribute_name == $values->attribute_name) {
                                                                echo "Selected";
                                                            } ?> value="{{$value->attribute_name}}">{{$value->attribute_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="attribute_value[]" value="{{$values->attribute_value}}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" onclick="remove(<?php echo $i; ?>)"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>

                                <?php $i++;
                                    }
                                } ?>

                            </table>


                            <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    function genrate_random_number() {
        var gen = Math.floor(Math.random() * 900000) + 100000;
        $('#gjhjtihjitji').val(gen);

    }
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection