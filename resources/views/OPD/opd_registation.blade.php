@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD Registation</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient')}}"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    {{-- ================== add new patient ====================== --}}

                    {{-- ================== Search patient ====================== --}}
                    <div class="options px-5 pt-5  border-bottom pb-3">
                        <div class="widget-user-image mx-auto mt-1"><img alt="User Avatar" class="rounded-circle" src="{{ asset('public/patient_image/patient_icon.png') }}" style="height: 100px;width: 117px;"></div>
                        <div class="card-body text-center">
                            <div class="pro-user">
                                <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                    {{ $patient_details->prefix }} {{ $patient_details->first_name }}
                                    {{ $patient_details->middle_name }} {{ $patient_details->last_name }}
                                </h4>
                                <h6 class="pro-user-desc textlink">
                                    {{ $patient_details->patient_prefix }}{{ $patient_details->id }}
                                </h6>

                                @can('edit patient')
                                <a href="{{ route('edit-patient-details', base64_encode($patient_id)) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                @endcan
                            </div>
                        </div>

                    </div>
                    {{-- ================== Search patient ====================== --}}

                    @if(isset($patient_details_information))
                    {{-- ================== patient Details ====================== --}}
                    @error('patientId')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="options px-5  pb-3">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->year }}y
                                                {{ @$patient_details_information->month }}m
                                                {{ @$patient_details_information->day }}d
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->guardian_name_realation }}
                                                {{ @$patient_details_information->guardian_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->blood_group }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5">{{@$patient_details_information->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient Details ====================== --}}
                    @endif
                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="{{route('save-blood-issue-details')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{@$patient_details_information->id}}" />
                                <input type="hidden" name="blood_group_id" value="{{ $blood_groups_id->id }}" />
                                <input type="hidden" name="blood_id" value="{{$blood_id}}" />
                                <div class="form-group col-md-3">
                                    <label for="issue_date" class="form-label">Issue Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="issue_date" value="{{ old('issue_date') }}" name="issue_date">
                                    <small class="text-danger">{{ $errors->first('issue_date') }}</small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="doctor" class="form-label">Hospital Doctor <span class="text-danger">*</span></label>
                                    <select id="doctor" class="form-control" name="doctor">
                                        <option value=" ">Select </option>
                                        @foreach ($doctor as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="reference_name" class="form-label">Reference Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="reference_name" value="{{ old('reference_name') }}" name="reference_name">
                                    <small class="text-danger">{{ $errors->first('reference_name') }}</small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="technician" class="form-label">Technician <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="technician" value="{{ old('technician') }}" name="technician">
                                    <small class="text-danger">{{ $errors->first('technician') }}</small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                                    <select id="blood_group" class="form-control" name="blood_group">
                                        <option value=" ">Select </option>
                                        @foreach ($blood_groups as $item)
                                        <option value="{{$item->id}}" {{ $item->id == $blood_details->blood_group_id ? 'selected' : " " }}> {{$item->blood_group_name}}</option>
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
                                        <option value="{{$item->bag}}" {{ $item->bag == $blood_details->bag ? 'selected' : " " }}> {{$item->bag}}</option>
                                        @endforeach
                                    </select>
                                    @error('bag')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="charge_category" class="form-label">Charges Catagory <span class="text-danger">*</span></label>
                                    <select id="charge_category" class="form-control select2-show-search" name="charge_category" onchange="getCatagory(this.value)">
                                        <option value=" ">Select Catagory</option>
                                        @foreach ($catagory as $item)
                                        <option value="{{$item->id}}">{{$item->charges_catagories_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('charge_category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="charge_name" class="form-label">Charge Name<span class="text-danger">*</span></label>
                                    <select name="charge_name" class="form-control select2-show-search" id="charge_name">
                                        <option value="">Select Charge Name...</option>
                                    </select>
                                    <small class="text-danger">{{ $errors->first('charge_name') }}</small>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="standard_charges" class="form-label"> Standard Charges<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" onkeyup="getStandardCharges()" id="standard_charges" name="standard_charges" value=" ">
                                    <small class="text-danger">{{ $errors->first('standard_charges') }}</small>
                                </div>

                            </div>
                        </div>
                        <input type="hidden" name="patientId" value="{{ @$patient_details_information->id }}" />
                        <div class="options px-5 pt-5  border-bottom pb-3">
                            <div class="container mt-5">
                                <div class="d-flex justify-content-end">
                                    <span class="biltext">Total</span>
                                    <input type="text" readonly class="form-control myfld" id="total" name="total">
                                </div>

                                <div class="d-flex justify-content-end">
                                    <input type="text" name="getdiscount" onkeyup="discountCalculate()" placeholder="Enter Discount" class="form-control myfld2" id="getdiscount">
                                    <input type="text" class="form-control myfld1" id="calculateDiscount" name="discount">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="text" name="taxfeildid" placeholder="Enter Tax" onkeyup="calculateTax()" class="form-control myfld2" id="taxfeildid">
                                    <input type="text" class="form-control myfld1" id="taxid" name="taxid">
                                </div>

                                <div class="d-flex justify-content-end thrdarea">
                                    <span class="biltext">Net Amount</span>
                                    <input type="text" class="form-control myfld" id="net_amount" name="net_amount" readonly>
                                </div>

                                <div class="d-flex justify-content-end thrdarea">

                                    <select id="payment_mode" class="form-control myfld2" name="payment_mode">
                                        <option value="">Select Payment Amount</option>
                                        @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                                        <option value="{{$item}}"> {{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_mode')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <input type="text" class="form-control myfld1" id="payment_amount" name="payment_amount" placeholder="Enter Payment Amount" readonly>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Blood Qty</label>
                                            <input type="text" name="blood_qty" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 d-block">
                                            <label class="form-label">Note</label>
                                            <textarea name="note" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="btn-list p-3">

                            <button class="btn btn-primary btn-sm float-right " type="button" onclick="gettotal()"><i class="fa fa-calculator"></i> Calculate</button>
                            <button class="btn btn-primary btn-sm float-right mr-2" type="submit" name="save"><i class="fa fa-file"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection