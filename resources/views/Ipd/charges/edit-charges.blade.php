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
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('add-new-charges-ipd') }}">
            @csrf
            <input type="hidden" name="case_id" value="{{ $ipd_details->case_id }}" />
            <input type="hidden" name="section" value="IPD" />
            <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
            <input type="hidden" name="patient_id" value="{{ $ipd_details->patient_id }}" />
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
                <script type="text/javascript">
                    function getSub_cate_by_cate(charge_catagory = null,charge_sub_category = null) {
                        $('#charge_sub_category').html('<option value="">Select One..</option>');
                        var div_data = '';
                        var sel = '';
                        $.ajax({
                            url: "{{ route('get-subcategory-by-category') }}",
                            type: "post",
                            data: {
                                categoryId: charge_catagory,
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: 'json',
                            success: function(res) {
                                $.each(res, function(i, obj) {
                                    if(obj.sub_category_id == charge_sub_category){
                                        sel = 'selected';
                                    }
                                    else{
                                        sel = '';
                                    }
                                    div_data += `<option value="${obj.sub_category_id}" ${sel}>${obj.sub_category_name}</option>`;
                                });
                                $('#charge_sub_category').append(div_data);
                               
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
                <div class="border-bottom border-top">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                 
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
                <script>
                    function get_charges_name(charge_sub_category = null,charge_category = null,charges_name="") {
                        $('#charge_name').html('<option value="">Select One..</option>');
                        var div_data = '';
                        sel = ''
                        $.ajax({
                            url: "{{ route('get-charge-name') }}",
                            type: "post",
                            data: {
                                chargeCategory: charge_category,
                                chargeSubCategory: charge_sub_category,
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: 'json',
                            success: function(res) {
                                $.each(res, function(i, obj) {
                                    if(charges_name == obj.charge_id){
                                        sel = 'selected';
                                    }
                                    else{
                                        sel = '';
                                    }
                                    div_data += `<option value="${obj.charge_id}" ${sel}>${obj.charges_name}</option>`;
                                });
                                $('#charge_name').append(div_data);
                            }
                        });
                     
                
                    }
                                getSub_cate_by_cate({{ $patient_charge_details->charge_category }},{{ $patient_charge_details->charge_sub_category }});
                                get_charges_name({{ $patient_charge_details->charge_sub_category }},{{ $patient_charge_details->charge_category }},{{ $patient_charge_details->charge_name }});
                              
                            </script>
                            <tbody id="chargeTable">
                                <tr id="row">
                              
                                    <td>
                                <select class="form-control select2-show-search" onchange="getSub_cate_by_cate(this.value)" name="charge_category" id="charge_category">
                                            <option value="">Select One..</option>
                                            @foreach ($charge_category as $value)
                                            <option value="{{ $value->id }}" {{ $value->id == $patient_charge_details->charge_category ? 'selected':'' }}>{{ $value->charges_catagories_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" name="charge_sub_category" id="charge_sub_category" onchange="get_charges_name(this.value,{{ $patient_charge_details->charge_category }},{{ $patient_charge_details->charge_name }})">
                                            <option value="">Select One..</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select2-show-search" onchange="getcharges(this.value)" name="charge_name" id="charge_name">
                                            <option value="">Select One..</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input class="form-control" onkeyup="getamountwithtax()" name="standard_charges" id="standard_charges" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="1" onkeyup="getamountwithtax()" name="qty" id="qty" />
                                    </td>
                                    <td>
                                        <input class="form-control" value="0" onkeyup="getamountwithtax()" name="tax" id="tax" />
                                    </td>
                                    <td>
                                        <input class="form-control" name="amount" id="amount" />
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
    function gettotal() {
        var no_of_row = $('#chargeTable tr').length;
        console.log('aaa=>', no_of_row);

        var t = 0;
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        $('#total_am').val(t);
    }
    function getcharges(charge_name=null) {
                        $('#standard_charges').empty();
                alert(charge_name);
                        $.ajax({
                            url: "{{ route('get-charge-amount') }}",
                            type: "post",
                            data: {
                                chargeName: charge_name,
                                ipd_id: {{ $ipd_details->id }},
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: 'json',
                            success: function(res) {
                                $('#standard_charges').val(res.charge_amount);
                            }
                        });
                    }
</script>
@endsection