@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    update Charges
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
        </div>s
        <form method="post" action="{{ route('add-new-charges-emg') }}">
            @csrf
            <input type="hidden" name="case_id" value="{{ $emg_patient_details->case_id }}" />
            <input type="hidden" name="section" value="EMG" />
            <input type="hidden" name="emg_id" value="{{ $emg_patient_details->id }}" />
            <input type="hidden" name="patient_id" value="{{ $emg_patient_details->patient_id }}" />
            <div class="card-body">
                <div class="col-md-12 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label"> Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" required class="form-control" name="date" value="{{ date('Y-m-d H:i',strtotime($patient_charge_details->charges_date)) }}" />
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border-bottom border-top">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%"> # <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Charge Type <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Category <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 13%">Subcategory <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 15%">Charge Name <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Charge <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Qty <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Tax <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Amount <span class="text-danger">*</span></th>

                                </tr>
                            </thead>
                            <tbody id="chargeTable">
                                <tr id="row">
                                    <td>
                                        <select class="form-control select2-show-search" onchange="getChargeCategory({{ $patient_charge_details->charge_category }})" name="charge_set[]" id="charge_set">
                                            <option value="" disable>Select One..</option>
                                            <option value="Normal" {{ $patient_charge_details->charge_set == 'Normal' ? 'selected':'' }}>Normal</option>
                                            <option value="Package" {{ $patient_charge_details->charge_set == 'Package' ? 'selected':'' }}>Package</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" name="charge_type[]" id="charge_type" onchange="getchargetype_details()">
                                            <option value=" " selected disable>Select One... </option>
                                            @foreach (Config::get('static.charges_type') as $lang => $charges_type)
                                            <option value="{{ $charges_type }}" {{ $patient_charge_details->charge_type == $charges_type ? 'selected':'' }}> {{ $charges_type }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" onchange="getSub_cate_by_cate()" name="charge_category[]" id="charge_category">
                                            <option value="">Select One..</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" name="charge_sub_category[]" id="charge_sub_category" onchange="get_charges_name()">
                                            <option value="">Select One..</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" onchange="getcharges()" name="charge_name[]" id="charge_name">
                                            <option value="">Select One..</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input class="form-control" onkeyup="getamountwithtax()" name="standard_charges[]" id="standard_charges" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="1" onkeyup="getamountwithtax()" name="qty[]" id="qty" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="0" onkeyup="getamountwithtax()" name="tax[]" id="tax" />
                                    </td>
                                    <td>
                                        <input class="form-control" name="amount[]" id="amount" />
                                    </td>
                                    {{-- <td>
                                            <button class="btn btn-danger btn-sm"  type="button"
                                                    onclick="rowRemove()"><i class="fa fa-times"></i></button>
                                        </td> --}}
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="btn-list p-3">
                    <button class="btn btn-primary btn-sm float-right mr-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Update</button>

                </div>
            </div>
        </form>
    </div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript">
    function getchargetype_details() {}

    function getChargeCategory(charge_category = null) {
        // alert(charge_category);
        let charge_set = $('#charge_set').val();
        var div_data = '<option value="" >Select One..</option>';
        $.ajax({
            url: "{{ route('get-category') }}",
            type: "post",
            data: {
                chargeSet: charge_set,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(i, obj) {
                    let sel = (obj.category_id == charge_category ? 'selected' : '');
                    div_data += `<option value="${obj.category_id}" ${sel} >${obj.category_name}</option>`;
                });
                $('#charge_category').append(div_data);
            }
        });
        getSub_cate_by_cate();
    }

    function getSub_cate_by_cate() {

        let category_id = $('#charge_category').val();
        let charge_set = $('#charge_set').val();

        var div_data = '<option value="">Select One..</option>';
        $.ajax({
            url: "{{ route('get-subcategory-by-category') }}",
            type: "post",
            data: {
                categoryId: category_id,
                chargeSet: charge_set,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(i, obj) {
                    div_data +=
                        `<option value="${obj.sub_category_id}">${obj.sub_category_name}</option>`;
                });
                $('#charge_sub_category').append(div_data);
            }
        });
    }

    function get_charges_name() {

        let charge_set = $('#charge_set').val();
        let charge_type = $('#charge_type').val();
        let charge_category = $('#charge_category').val();
        let charge_sub_category = $('#charge_sub_category').val();
        $('#charge_name').empty();
        var div_data = '<option value="">Select One..</option>';
        $.ajax({
            url: "{{ route('get-charge-name') }}",
            type: "post",
            data: {
                chargeSet: charge_set,
                chargeType: charge_type,
                chargeCategory: charge_category,
                chargeSubCategory: charge_sub_category,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(i, obj) {
                    div_data += `<option value="${obj.charge_id}">${obj.charges_name}</option>`;
                });
                $('#charge_name').append(div_data);
            }
        });

    }

    function getcharges() {

        let charge_name = $('#charge_name').val();
        let charge_set = $('#charge_set').val();
        $('#standard_charges').empty();

        $.ajax({
            url: "{{ route('get-charge-amount') }}",
            type: "post",
            data: {
                chargeName: charge_name,
                chargeSet: charge_set,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                $('#standard_charges').val(res.charge_amount);
            }
        });
    }

    function getamountwithtax(row_id) {

        let standard_chargesss = $('#standard_charges').val();
        let tax = $('#tax').val();
        let qty = $('#qty').val();
        var standard_charges = parseFloat(standard_chargesss) * qty;
        let amount = parseFloat(standard_charges) + (parseFloat(standard_charges) * (parseFloat(tax) / 100));
        let amount_ = parseFloat(amount).toFixed(2);
        $('#amount').val(amount_);
        gettotal(row_id);
    }
</script>
<script type="text/javascript">
    function gettotal() {
        var no_of_row = $('#chargeTable tr').length;
        console.log('aaa=>', no_of_row);

        var t = 0;
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        $('#total_am').val(t);
    }
</script>
@endsection