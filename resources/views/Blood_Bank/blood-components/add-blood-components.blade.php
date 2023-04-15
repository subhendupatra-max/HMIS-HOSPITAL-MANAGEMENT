@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Blood Components</div>
        </div>

        <form method="POST" action="{{route('save-blood-components-details')}}">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="blood_group_id" value="{{ $blood_groups_id->id }}" />

                        <div class="form-group col-md-3">
                            <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                            <select id="blood_group" class="form-control" name="blood_group">
                                <option value=" ">Select </option>
                                @foreach ($blood_groups as $item)
                                <option value="{{$item->id}}" {{ $item->id == $blood_groups_id->id ? 'selected' : " " }}> {{$item->blood_group_name}}</option>
                                @endforeach
                            </select>
                            @error('blood_group')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="bag" class="form-label">Bag <span class="text-danger">*</span></label>
                            <select id="bag" class="form-control" name="bag">
                                <option value=" ">Select </option>
                                @foreach ($getBag as $item)
                                <option value="{{$item->bag}}"> {{$item->bag}}</option>
                                @endforeach
                            </select>
                            @error('bag')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col">#<span class="text-danger">*</span></th>
                                    <th scope="col"> Components Name <span class="text-danger">*</span></th>
                                    <th scope="col">Bag<span class="text-danger">*</span></th>
                                    <th scope="col">Volume<span class="text-danger">*</span></th>
                                    <th scope="col">Unit<span class="text-danger">*</span></th>
                                    <th scope="col">Lot<span class="text-danger">*</span></th>
                                    <th scope="col">Institution<span class="text-danger">*</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $component_name as $components_name)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="componests_id[]" id="componests_id" value="{{$components_name->id}}" />
                                    </td>
                                    <td>{{ $components_name->component_name }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="bags[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="volumes[]" />
                                    </td>
                                    <td>
                                        <select id="unitTypes" class="form-control" name="unitTypes[]">
                                            <option value=" ">Select Unit Type</option>
                                            @foreach ($unit_types as $item)
                                            <option value="{{$item->id}}"> {{$item->blood_unit_types}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" name="lots[]" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="institution[]" />
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>


                </div>

                <div class="text-center">

                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                </div>
                <!-- End Table with stripped rows -->
            </div>


        </form>
    </div>
</div>

@endsection