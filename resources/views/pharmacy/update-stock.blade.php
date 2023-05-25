@extends('layouts.layout')

@section('content')

@can('medicine rack')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Medicine Stock</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('save-update-medicine-stock') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">
                               
                                <select class="form-control select2-show-search" id="stored_room" name="stored_room" required>
                                    <option value="">Select Store Room</option>
                                    @if ($store_room)
                                    @foreach ($store_room as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label for="stored_room">Store Room <span class="text-danger">*</span></label>
                                @error('stored_room')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" name="unit" value="{{ $medicine_details->unit }}" />
                            <div class="col-md-4 form-group">
                             

                                <select class="form-control select2-show-search" name="medicine_category" id="medicine_category" required>
                                        <option value="{{ @$medicine_details->id }}">{{ @$medicine_details->catagory_name->medicine_catagory_name }}</option>
                                </select>
                                <label for="medicine_category">Medicine Catagory<span class="text-danger">*</span> </label>
                                @error('medicine_category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <select name="medicine_name" required id="medicine_name"
                                class="form-control select2-show-search">
                                <option value="{{ @$medicine_details->id }}">{{ @$medicine_details->medicine_name }}</option>
                            </select>
                            <label for="batch_no">Medicine Name<span class="text-danger">*</span> </label>
                                @error('medicine_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">

                                <input type="text" id="batch_no"  name="batch_no" value="{{ old('batch_no') }}" required />
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

                                <input type="text" id="quantity"  name="quantity" onkeyup="getAmount(this.value)" value="{{ old('quantity') }}" required />
                                <label for="quantity">Quantity<span class="text-danger">*</span> </label>

                                @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <input type="text" id="mrp" name="mrp" value="{{ old('mrp') }}" required />
                                <label for="mrp">MRP <span class="text-danger">*</span> </label>
                                @error('mrp')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="sale_price"  name="sale_price" value="{{ old('sale_price') }}" required />
                                <label for="sale_price">Sale Price<span class="text-danger">*</span> </label>
                                @error('sale_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="purchase_price" onkeyup="getAmount(this.value)" name="purchase_price" value="{{ old('purchase_price') }}" required />
                                <label for="purchase_price">Purchase Price<span class="text-danger">*</span> </label>

                                @error('purchase_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="igst" name="igst" onkeyup="getAmount(this.value)" value="0" required />
                                <label for="igst">IGST </label>
                                @error('igst')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" id="cgst" name="cgst" onkeyup="getAmount(this.value)" value="0" required />
                                <label for="cgst">CGST  </label>
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
        //  function getAmount()
        //  {
        //     var sgst = $('#sgst').val();
        //     var cgst = $('#cgst').val();
        //     var igst = $('#igst').val();
        //     var purchase_price = $('#purchase_price').val();
        //     var quantity = $('#quantity').val();



        //  }
</script>

@endsection