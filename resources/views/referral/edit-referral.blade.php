@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Referral Person </h4>
        </div>
        <!-- ================== message============================== -->
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <!-- ================== message============================== -->

        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                action="{{ route('update-referral') }}">
                @csrf
                <input type="hidden" name="refferal_id" value="{{ @$referral->id }}"/>
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 newaddappon">
                                    <input type="text" name="referral_name"
                                        id="referral_name" required="" value="{{ @$referral->referral_name }}">
                                    <label for="referral_name">Referral Name <span class="text-danger">*</span></label>
                                    @error('referral_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 newaddappon">

                                    <input type="text" value="{{ @$referral->phone_no }}"  name="phone_no" id="phone_no"
                                        required="">
                                    <label for="phone_no">Enter Phone No<span class="text-danger">*</span></label>
                                    @error('phone_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 newaddappon">

                                    <input type="text" value="{{ @$referral->address }}"  name="address" id="address"
                                        required="">
                                    <label for="address">Address<span class="text-danger">*</span></label>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 newaddappon">

                                    <input type="text" value="{{ @$referral->standard_commission }}"
                                        name="standard_commission" id="standard_commission" required="">
                                    <label for="standard_commission">Standard Commission (%)<span
                                            class="text-danger">*</span></label>
                                    @error('standard_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-6 text-right">
                                    <div class="d-block mt-3">
                                        @can('')
                                        <a href="#" onclick="getall_data()" class="btn btn-warning btn-sm"> Apply To All</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->opd_commission }}" name="opd_commission"
                                        id="opd_commission" required="">
                                    <label for="opd_commission">OPD Commission (%)<span class="text-danger">*</span></label>
                                    @error('opd_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->emg_commission }}"name="emg_commission" id="emg_commission"
                                        required="">
                                    <label for="emg_commission">EMG Commission (%)<span class="text-danger">*</span></label>
                                    @error('emg_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->ipd_commission }}" name="ipd_commission" id="ipd_commission"
                                        required="">
                                    <label for="ipd_commission">IPD Commission (%)<span class="text-danger">*</span></label>
                                    @error('ipd_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->pharmacy_commission }}"
                                        name="pharmacy_commission" id="pharmacy_commission" required="">
                                    <label for="pharmacy_commission">Pharmacy Commission (%)<span
                                            class="text-danger">*</span></label>
                                    @error('pharmacy_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->pathology_commission }}"
                                        name="pathology_commission" id="pathology_commission" required="">
                                    <label for="pathology_commission">Pathology Commission (%)<span
                                            class="text-danger">*</span></label>
                                    @error('pathology_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->radiology_commission }}"
                                        name="radiology_commission" id="radiology_commission" required="">
                                    <label for="radiology_commission">Radiology Commission (%)<span
                                            class="text-danger">*</span></label>
                                    @error('radiology_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->blood_bank_commission }}"
                                        name="blood_bank_commission" id="blood_bank_commission" required="">
                                    <label for="blood_bank_commission">Blood Bank Commission (%)<span
                                            class="text-danger">*</span></label>
                                    @error('blood_bank_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 newaddappon">
                                    <input type="text" value="{{ @$referral->ambulance_commission }}"
                                        name="ambulance_commission" id="ambulance_commission" required="">
                                    <label for="ambulance_commission">Ambulance Commission (%)<span
                                            class="text-danger">*</span></label>
                                    @error('ambulance_commission')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update
                                Referral</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function getall_data() {
        let value = $('#standard_commission').val();
        $('#opd_commission').val(value);
        $('#emg_commission').val(value);
        $('#ipd_commission').val(value);
        $('#pharmacy_commission').val(value);
        $('#pathology_commission').val(value);
        $('#radiology_commission').val(value);
        $('#blood_bank_commission').val(value);
        $('#ambulance_commission').val(value);
    }
</script>



<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection