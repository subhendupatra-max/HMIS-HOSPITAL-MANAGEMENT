@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-4 card-title">
                        Add Billing
                    </div>
                    <div class="col-md-8 text-right">
                        <div class="d-block">
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" style="">
                                @include('OPD.include.menu')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%"> # <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 10%">Charge Type <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 15%">Category <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 13%">Subcategory <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 20%">Charge Name <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 10%">Charges <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 10%">Tax <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 10%">Amount <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm"
                                        onclick="addNewrow()"><i class="fa fa-plus"></i></button></th>
                            </tr>
                        </thead>
                        <tbody id="chargeTable">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script type="text/javascript">
        var i = 1;

        function addNewrow() {
            var html = `<tr id="row${i}">
                            <td>
                                <select class="form-control select2-show-search" onchange="getChargeCategory(${i})" name="charge_set[]" id="charge_set${i}">
                                    <option value="">Select One..</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Package">Package</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_type[]" id="charge_type${i}">
                                    <option value=" ">Select type </option>
                                    @foreach (Config::get('static.charges_type') as $lang => $charges_type)
                                        <option value="{{ $charges_type }}" > {{ $charges_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" onchange="getSub_cate_by_cate(${i})" name="charge_category[]" id="charge_category${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_sub_category[]" id="charge_sub_category${i}" onchange="get_charges_name(${i})" >
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" onchange=getcharges(${i}) name="charge_name[]" id="charge_name${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>

                            <td>
                                <input class="form-control" onkeyup="getamountwithtax(${i})" name="standard_charges[]" id="standard_charges${i}" />
                            </td>
                            <td>
                                <input class="form-control"  onkeyup="getamountwithtax(${i})"  name="tax[]" id="tax${i}" />
                            </td>
                            <td>
                                <input class="form-control" name="amount[]" id="amount${i}" />
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm"
                                        onclick="rowRemove(${i})"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>`;
            $('#chargeTable').append(html);
            i = i + 1;
        }

        function rowRemove(row_id) {
            $(`#row${row_id}`).remove();
        }

        function getChargeCategory(row_id) {
            let charge_set = $('#charge_set' + row_id).val();
            $('#charge_category' + row_id).empty();
            var div_data = '<option value="">Select One..</option>';
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
                        div_data += `<option value="${obj.category_id}">${obj.category_name}</option>`;
                    });
                    $('#charge_category' + row_id).append(div_data);
                }
            });
        }

        function getSub_cate_by_cate(row_id) {
            $('#charge_sub_category' + row_id).empty();
            let category_id = $('#charge_category' + row_id).val();
            let charge_set = $('#charge_set' + row_id).val();
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
                    $('#charge_sub_category' + row_id).append(div_data);
                }
            });
        }

        function get_charges_name(row_id) {
            let charge_set = $('#charge_set' + row_id).val();
            let charge_type = $('#charge_type' + row_id).val();
            let charge_category = $('#charge_category' + row_id).val();
            let charge_sub_category = $('#charge_sub_category' + row_id).val();
            $('#charge_name' + row_id).empty();
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
                    $('#charge_name' + row_id).append(div_data);
                }
            });
        }

        function getcharges(row_id) {
            let charge_name = $('#charge_name' + row_id).val();
            let charge_set = $('#charge_set' + row_id).val();
            $('#standard_charges' + row_id).empty();

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
                    $('#standard_charges' + row_id).val(res.charge_amount);
                }
            });
        }

        function getamountwithtax(row_id)
        {
            let standard_charges = $('#standard_charges' + row_id).val();
            let tax = $('#tax' + row_id).val();
            let amount = parseFloat(standard_charges) + (parseFloat(standard_charges)*(parseFloat(tax)/100));
            let amount_ = parseFloat(amount).toFixed(2);
            $('#amount' + row_id).val(amount_);
        }

    </script>
@endsection
