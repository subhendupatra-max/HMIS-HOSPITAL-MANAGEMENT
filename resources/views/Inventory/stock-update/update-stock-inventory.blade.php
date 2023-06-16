@extends('layouts.layout')

@section('content')

@can('medicine rack')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Item Stock</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('save-update-inventory-stock') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">

                                <select class="form-control select2-show-search" id="stored_room" name="stored_room" required>
                                    <option value="">Select Store Room</option>
                                    @if ($store_room)
                                    @foreach ($store_room as $value)
                                    <option value="{{ $value->id }}">{{ $value->item_store_room }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label for="stored_room">Store Room <span class="text-danger">*</span></label>
                                @error('stored_room')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" name="unit" value="{{ $item_details->unit_id }}" />
                            
                            <div class="col-md-4 form-group">

                                <select class="form-control select2-show-search" name="item_catagory" id="item_catagory" required>
                                    <option value="{{ @$item_details->id }}">{{ @$item_details->fetch_catagory_name-> }}</option>
                                </select>
                                <label for="item_catagory">Item Catagory<span class="text-danger">*</span> </label>
                                @error('item_catagory')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <select name="medicine_name" required id="medicine_name" class="form-control select2-show-search">
                                    <option value="{{ @$item_details->id }}">{{ @$item_details->medicine_name }}</option>
                                </select>
                                <label for="batch_no">Medicine Name<span class="text-danger">*</span> </label>
                                @error('medicine_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">

                                <input type="text" id="batch_no" name="batch_no" value="{{ old('batch_no') }}" required />
                                <label for="batch_no">Batch No<span class="text-danger">*</span> </label>

                                @error('batch_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" required />
                                <label for="expiry_date">Expiry Date<span class="text-danger">*</span> </label>

                                @error('expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">

                                <input type="text" id="quantity" name="quantity" onkeyup="getAmount()" value="{{ old('quantity') }}" required />
                                <label for="quantity">Quantity<span class="text-danger">*</span> </label>

                                @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <input type="text" id="mrp" name="mrp" value="{{ old('mrp') }}" onkeyup="getSaleRate()" required />
                                <label for="mrp">MRP <span class="text-danger">*</span> </label>
                                @error('mrp')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="discount" name="discount" onkeyup="getSaleRate()" value="{{ old('discount') }}" required />
                                <label for="discount">Discount(%) <span class="text-danger">*</span> </label>
                                @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="sale_price" name="sale_price" value="{{ old('sale_price') }}" required />
                                <label for="sale_price">Sale Price<span class="text-danger">*</span> </label>
                                @error('sale_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="purchase_price" onkeyup="getAmount()" name="purchase_price" value="{{ old('purchase_price') }}" required />
                                <label for="purchase_price">Purchase Price/quantity<span class="text-danger">*</span> </label>

                                @error('purchase_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="igst" name="igst" onkeyup="getAmount()" value="0" required />
                                <label for="igst">IGST </label>
                                @error('igst')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="cgst" name="cgst" onkeyup="getAmount()" value="0" required />
                                <label for="cgst">CGST </label>
                                @error('cgst')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="sgst" name="sgst" onkeyup="getAmount()" value="0" required />
                                <label for="sgst">SGST </label>
                                @error('sgst')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="hidden" id="total_cgst" name="total_cgst" value="0" required />
                                <input type="hidden" id="total_sgst" name="total_sgst" value="0" required />
                                <input type="hidden" id="total_igst" name="total_igst" value="0" required />
                                <input type="text" id="amount" name="amount" value="{{ old('amount') }}" required />
                                <label for="amount">Amount<span class="text-danger">*</span> </label>

                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Medicine Stock </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

<script>
    function getSaleRate() {
        var mrp = $('#mrp').val();
        var discount = $('#discount').val();
        var sale_rate = parseFloat(parseFloat(mrp) - (parseFloat(mrp) * (parseFloat(discount) / 100))).toFixed(2);
        $('#sale_price').val(sale_rate);
    }

    function getAmount() {
        var sgst = $('#sgst').val();
        var cgst = $('#cgst').val();
        var igst = $('#igst').val();
        var purchase_price = $('#purchase_price').val();
        var quantity = $('#quantity').val();

        var total_qty_pri = (purchase_price * quantity);
        console.log(total_qty_pri);
        var total_cgst = (total_qty_pri * ((parseFloat(cgst)) / 100));
        var total_igst = (total_qty_pri * ((parseFloat(igst)) / 100));
        var total_sgst = (total_qty_pri * ((parseFloat(sgst)) / 100));
        var total_tax = parseFloat(total_sgst) + parseFloat(total_cgst) + parseFloat(total_igst);
        var total_amount = total_qty_pri + total_tax;

        $('#amount').val(total_amount);
        $('#total_igst').val(total_igst);
        $('#total_sgst').val(total_sgst);
        $('#total_cgst').val(total_cgst);
    }
</script>

@endsection