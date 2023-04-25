@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Medicine</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-medicine-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        {{-- <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" placeholder="Enter Medicine Number" required> --}}
                        <input type="text" id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" required />
                        <label for="medicine_name">Medicine Name<span class="text-danger">*</span> </label>
                        @error('medicine_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        {{-- <label for="medicine_catagory" class="form-label">Medicine Category <span class="text-danger">*</span></label> --}}
                        <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('medicine_catagory') }}" name="medicine_catagory" id="medicine_catagory" required>
                            <optgroup>
                                <option value=" ">Select Medicine Catagory<span class="text-danger">*</span> </option>
                                @foreach ($medicine_catagory as $item)
                                <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('medicine_catagory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        {{-- <label for="medicine_company" class="form-label">Medicine Company </label>
                        <input type="text" class="form-control" id="medicine_company" name="medicine_company" value="{{ old('medicine_company') }}" placeholder="Enter Medicine Company "> --}}
                        <input type="text" id="medicine_company" name="medicine_company"  value="{{ old('medicine_company') }}" required />
                        <label for="medicine_company">Medicine Company </label>
                        @error('medicine_company')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        {{-- <label for="medicine_composition" class="form-label">Medicine Composition </label>
                        <input type="text" class="form-control" id="medicine_composition" name="medicine_composition" value="{{ old('medicine_composition') }}" placeholder="Enter Medicine Composition"> --}}
                        <input type="text" id="medicine_composition" name="medicine_composition" value="{{ old('medicine_composition') }}"  required />
                        <label for="medicine_company">Medicine Composition  </label>
                        @error('medicine_composition')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        {{-- <label for="medicine_group" class="form-label">Medicine Group </label>
                        <input type="text" class="form-control" id="medicine_group" name="medicine_group" value="{{ old('medicine_group') }}" placeholder="Enter Medicine Group"> --}}
                        <input type="text" id="medicine_group" name="medicine_group" value="{{ old('medicine_group') }}"  required />
                        <label for="medicine_company">Medicine Group</label>
                        @error('medicine_group')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                  <div class="form-group col-md-3">
                        {{-- <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}" placeholder="Enter Unit "> --}}
                        <input type="text" id="unit" name="unit" value="{{ old('unit') }}"  required />
                        <label for="medicine_company">Unit<span class="text-danger">*</span></label>
                        @error('unit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        {{-- <label for="min_level" class="form-label">Low Level <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="min_level" name="min_level" value="{{ old('min_level') }}" placeholder="Enter Min Level"> --}}
                        <input type="text" id="min_level" name="min_level" value="{{ old('min_level') }}"  required />
                        <label for="min_level">Enter Min Level<span class="text-danger">*</span></label>
                        @error('min_level')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="form-group col-md-3">
                        <label for="re_order_level" class="form-label">Re-Order Level </label>
                        <input type="text" class="form-control" id="re_order_level" name="re_order_level" value="{{ old('re_order_level') }}" placeholder="Enter Min Level">
                        @error('re_order_level')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="form-group col-md-3">
                        {{-- <label for="tax" class="form-label">Tax</label>
                        <input type="text" class="form-control" id="tax" name="tax" value="{{ old('tax') }}" placeholder="Enter Tax"> --}}
                        <input type="text" id="tax" name="tax" value="{{ old('tax') }}"  required />
                        <label for="tax">Tax</label>
                        @error('tax')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-3">
                        {{-- <label for="note" class="form-label"> Note </label>
                        <textarea name="note" class="form-control"> </textarea> --}}
                        <input type="text" id="note" name="note"  required />
                        <label for="note">Note</label>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {{-- <label for="medicine_photo" class="form-label">Medicine Photo </label>
                        <input type="file" id="medicine_photo" name="medicine_photo" value="{{ old('medicine_photo') }}"> --}}
                        <input type="file" id="medicine_photo" name="medicine_photo" value="{{ old('medicine_photo') }}"  required />
                        <label for="medicine_photo">Medicine Photo</label>
                        @error('medicine_photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="hr_line" />

                    <!-- <div class="form-group col-md-6">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Box/Strip<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 40%">Strip/Box<span class="text-danger">*</span></th>
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> -->

                    <div class="form-group col-md-4 mb-2">
                        <table class="table card-table table-vcenter text-nowrap" id="simiarmedicine">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Similar Medicine<span class="text-danger">*</span></th>
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrowSimiliarMedicine()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <hr class="hr_line">

                    {{-- <div class="form-group col-md-8">
                        <table class="table card-table table-vcenter text-nowrap" id="baseUnit">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Base Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Value<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrowBaseUnit()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> --}}

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Medicine </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<!-- <script>
    var i = 1;

    function addnewrow() {
        var html = `
                        <tr id="rowid${i}">
                        <td>
                        <input type="text" class="form-control" name="medicine_box_per_strips[]" id="boxStrips${i}" />
                        </td>
                        <td>
                        <input type="text" class="form-control" name="medicine_strips_per_box[]" id="stripsBox${i}" />
                        </td>

                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>`;

        $('#subhendu').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script> -->



<script>
    var i = 1;

    function addnewrowSimiliarMedicine() {
        var html = `
                        <tr id="rowid${i}">
                        <td>
                        <select id="similiar_medicine_name${i}" class="form-control select2-show-search"
                        name="similiar_medicine_name[]">
                        <option value="">Select Medicine Name</option>
                        @foreach ($similarMedicine as $item)
                        <option value="{{ $item->id }}">{{ $item->medicine_name }}</option>
                        @endforeach
                        </select>
                        </td>

                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>`;

        $('#simiarmedicine').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>

<script>
    var p = 1;

    function addnewrowBaseUnit() {
        var html = `
                        <tr id="tabletrid${p}">
                        <td>
                        <select id="medicine_base_unit${p}" class="form-control select2-show-search"
                        name="medicine_base_unit[]">
                        <option value="">Select Base Unit</option>
                        @foreach ($baseUnit as $item)
                        <option value="{{ $item->id }}">{{ $item->medicine_unit_name }}</option>
                        @endforeach
                        </select>
                        </td>

                        <td>
                        <select id="medicine_unit${p}" class="form-control select2-show-search"
                        name="medicine_unit[]">
                        <option value="">Select Base Unit</option>
                        @foreach ($baseUnit as $item)
                        <option value="{{ $item->id }}">{{ $item->medicine_unit_name }}</option>
                        @endforeach
                        </select>
                        </td>

                        <td>
                        <input type="text" class="form-control" name="value[]" id="value${p}" />
                        </td>

                        <td>
                        <button type="button" class="btn btn-danger" onclick="removeBaseUnitrow(${p})"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>`;

        $('#baseUnit').append(html);
        p = p + 1;

    }

    function removeBaseUnitrow(i) {
        $('#tabletrid' + i).empty();
    }
</script>

@endsection
