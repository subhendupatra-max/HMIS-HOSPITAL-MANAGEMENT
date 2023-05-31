@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Edit Prescription
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('emg.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('update-prescription-in-emg') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="emg_id" value="{{ $emgPrescriptionDetails->emg_id }}" />
                    <input type="hidden" name="section" value="{{ $emgPrescriptionDetails->section }}" />
                    <input type="hidden" name="patient_id" value="{{ $emgPrescriptionDetails->patient_id }}" />
                    <input type="hidden" name="case_id" value="{{ $emgPrescriptionDetails->case_id }}" />

                    <input type="hidden" name="id" value="{{ $emgPrescriptionDetails->id }}" />

                    <!-- <div class="border-bottom border-top mt-2"> -->
                    <!-- <h6>Medicine :</h6> -->
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">Medicine Catagory
                                    </th>
                                    <th scope="col" style="width: 28%">Medicine Name
                                    </th>
                                    <th scope="col" style="width: 20%">Dosage
                                    </th>
                                    <th scope="col" style="width: 20%">Dose Interval
                                    </th>
                                    <th scope="col" style="width: 20%">Dose Duration
                                    </th>
                                    <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm" onclick="addNewrow()" type="button"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="chargeTable">
                                @if($emgPrescriptionMedicineDetails[0]->medicine_category_id != null)
                                @foreach ($emgPrescriptionMedicineDetails as $key=>$value)
                                <script>
                                    getMedicine_name({
                                        {
                                            $value - > medicine_category_id
                                        }
                                    }, {
                                        {
                                            $key
                                        }
                                    }, {
                                        {
                                            $value - > medicine_id
                                        }
                                    }, '{{ $value->dose }}')
                                </script>

                                <tr id="row{{ $key }}">
                                    <td>
                                        <select class="form-control select2-show-search" onchange="getMedicine_name(this.value,{{ $key }},{{ $value->medicine_id }},{{ $value->dose }})" name="medicine_catagory_id[]" id="medicine_catagory_id{{ $key }}" required>
                                            <option value=" ">Select Medicine Category</option>
                                            @foreach ($medicine_catagory as $item)
                                            <option value="{{$item->id}}" {{ $item->id == @$value->medicine_category_id ? 'selected' : " "}}>{{$item->medicine_catagory_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="medicine_name[]" id="medicine_name{{ $key }}" class="form-control select2-show-search">
                                            <option value="">Select Medicine Name</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dose[]" id="dose{{ $key }}" class="form-control select2-show-search">
                                            <option value="">Select Dosage</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dose_interval[]" id="dose_interval{{ $key }}" class="form-control select2-show-search">
                                            <option value="">Select Dose Interval</option>
                                            @foreach ($DoseInterval as $item)
                                            <option value="{{$item->dose_interval}}" {{ $item->dose_interval == @$value->interval ? 'selected' : " "}}>{{$item->dose_interval}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="dose_duration[]" id="dose_duration{{ $key }}" class="form-control select2-show-search">
                                            <option value="">Select Dose Duration</option>
                                            @foreach ($DoseDuration as $item)
                                            <option value="{{$item->dose_duration}}" {{ $item->dose_duration == @$value->duration ? 'selected' : " "}}>{{$item->dose_duration}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="rowRemove({{ $key }})"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- </div> -->
                    <div class="col-md-12 mt-2 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border-bottom">
                                    <h6>Pathology Test :</h6>
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 98%">Test Name
                                                    </th>
                                                    <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm" onclick="addNewrowPathology()" type="button"><i class="fa fa-plus"></i></button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="addPathologyTable">
                                                @if($emgPrescriptionPathologyDetails[0]->test_id != null)
                                                @foreach ($emgPrescriptionPathologyDetails as $key=>$value)
                                                <tr id="rowpathology{{ $key }}">
                                                    <td>
                                                        <select class="form-control select2-show-search" name="pathology_test_id[]" id="pathology_test_id{{ $key }}" required>
                                                            <option value=" ">Select test</option>
                                                            @foreach ($pathology_test as $item)
                                                            <option value="{{$item->id}}" {{ $item->id == @$value->test_id ? 'selected' : " "}}>{{$item->test_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" type="button" onclick="rowRemovepathology({{ $key }})"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border-bottom">
                                    <h6>Radiology Test :</h6>
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 98%">Test Name
                                                    </th>
                                                    <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm" onclick="addNewrowradiology()" type="button"><i class="fa fa-plus"></i></button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="addRadiologyTable">
                                                @if($emgPrescriptionRadiologyDetails[0]->test_id != null)
                                                @foreach ($emgPrescriptionRadiologyDetails as $key=>$value)
                                                <tr id="rowradiology{{ $key }}">
                                                    <td>
                                                        <select class="form-control select2-show-search" name="radiology_test_id[]" id="radiology_test_id{{ $key }}" required>
                                                            <option value=" ">Select test</option>
                                                            @foreach ($radiology_test as $item)
                                                            <option value="{{$item->id}}" {{ $item->id == @$value->test_id ? 'selected' : " "}}>{{$item->test_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" type="button" onclick="rowRemoveradiology({{ $key }})"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row  mt-5 col-md-12">
                        <div class="form-group col-md-6">
                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="date" name="date" required @if(isset($emgPrescriptionDetails->prescription_date)) value="{{ date('Y-m-d h:m:s', strtotime($emgPrescriptionDetails->prescription_date))}}" @endif>
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="note" class="form-label">Note </label>
                            <input name="note" id="note" class="form-control" value="{{$emgPrescriptionDetails->note}}" />
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Prescription</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


<script>
    var i = $('#chargeTable tr').length;
    var j = $('#addPathologyTable tr').length;
    var k = $('#addRadiologyTable tr').length;

    function addNewrow() {
        var html = `<tr id="row${i}">
                        <td>
                            <select class="form-control select2-show-search" onchange="getMedicine_name(this.value,${i})"  name="medicine_catagory_id[]" id="medicine_catagory_id${i}" required>
                                    <option value=" ">Select Medicine Category</option>
                                    @foreach ($medicine_catagory as $item)
                                    <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="medicine_name[]" id="medicine_name${i}" class="form-control select2-show-search">
                                <option value="">Select Medicine Name</option>
                            </select>
                        </td>
                        <td>
                            <select name="dose[]" id="dose${i}" class="form-control select2-show-search">
                                <option value="">Select Dosage</option>
                            </select>
                        </td>
                        <td>
                            <select name="dose_interval[]" id="dose_interval${i}" class="form-control select2-show-search">
                                <option value="">Select Dose Interval</option>
                                @foreach ($DoseInterval as $item)
                                    <option value="{{$item->dose_interval}}">{{$item->dose_interval}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="dose_duration[]" id="dose_duration${i}" class="form-control select2-show-search">
                                <option value="">Select Dose Duration</option>
                                @foreach ($DoseDuration as $item)
                                    <option value="{{$item->dose_duration}}">{{$item->dose_duration}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemove(${i})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    </tr>`;
        $('#chargeTable').append(html);
        i = i + 1;

    }

    function rowRemove(row_id) {
        $(`#row${row_id}`).remove();
    }

    function addNewrowPathology() {
        var html = `<tr id="rowpathology${j}">
                        <td>
                            <select class="form-control select2-show-search" name="pathology_test_id[]" id="pathology_test_id${j}" required>
                                    <option value=" ">Select test</option>
                                    @foreach ($pathology_test as $item)
                                    <option value="{{$item->id}}">{{$item->test_name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemovepathology(${j})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    `;
        $('#addPathologyTable').append(html);
        j = j + 1;
    }

    function rowRemovepathology(row_id) {
        $(`#rowpathology${row_id}`).remove();
    }

    function addNewrowradiology() {
        var html = `<tr id="rowradiology${k}">
                        <td>
                            <select class="form-control select2-show-search" name="radiology_test_id[]" id="radiology_test_id${k}" required>
                                    <option value=" ">Select test</option>
                                    @foreach ($radiology_test as $item)
                                    <option value="{{$item->id}}">{{$item->test_name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemoveradiology(${k})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`;
        $('#addRadiologyTable').append(html);
        j = j + 1;
    }

    function rowRemoveradiology(row_id) {
        $(`#rowradiology${row_id}`).remove();
    }
</script>

<script>
    function hide(val) {
        if (val == 'Refferal') {
            $('#referral_hospital').removeAttr('style', true);
        } else {
            $('#referral_hospital').attr('style', 'display:none !important', true);

        }
    }
</script>


@endsection