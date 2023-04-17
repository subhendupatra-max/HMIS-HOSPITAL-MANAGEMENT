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
                                <th scope="col" style="width: 15%">Charge Category <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 13%">Charge Subcategory <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 20%">Charge Name <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 10%">Standard Charges <span class="text-danger">*</span>
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
                                <select class="form-control select2-show-search" onchange="getChargeCategory(this.value)" name="charge_type[]" id="charge_type${i}">
                                    <option value="">Select One..</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Package">Package</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" onchange="getChargeCategory(this.value)" name="charge_type[]" id="charge_type${i}">
                                    <option value=" ">Select type </option>
                                    @foreach (Config::get('static.charges_type') as $lang => $charges_type)
                                        <option value="{{ $charges_type }}" > {{ $charges_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_category[]" id="charge_category${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_sub_category[]" id="charge_sub_category${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2-show-search" name="charge_name[]" id="charge_sub_category${i}">
                                    <option value="">Select One..</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" name="tax[]" id="tax${i}" />
                            </td>
                            <td>
                                <input class="form-control" name="standard_charges[]" id="standard_charges${i}" />
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

        function getChargeCategory(charge_type) {
            $.ajax({
                url: "{{ route('get-charge-category') }}",
                type: "post",
                data: {
                    charge_type: charge_type,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $.each(res, function(i, obj) {
                        div_data += "<option value=" + obj.item_id + ">" + obj.item_name + "(" + obj
                            .item_description + ") </option>";
                        unit = obj.units;
                    });

                    $('#item' + rowno).append(div_data);
                    $('#unit' + rowno).val(unit);
                }
            });
        }
    </script>
@endsection
