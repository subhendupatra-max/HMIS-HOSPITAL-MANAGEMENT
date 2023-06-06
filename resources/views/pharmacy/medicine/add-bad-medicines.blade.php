@extends('layouts.layout')

@section('content')

@can('medicine rack')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Bad Medicine</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('save-bad-medicine') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <input name="med_id" value="{{ $medicine_id }}" type="hidden" />
                            <div class="col-md-4 form-group">
                                <select class="form-control select2-show-search" onchange="getDetails(this.value)" id="batch_no" name="batch_no" required>
                                    <option value="">Select Batch No</option>
                                    @if ($medicine__batchno_stock)
                                    @foreach ($medicine__batchno_stock as $value)
                                    <option value="{{ $value->batch_no }}">{{ $value->batch_no }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label for="batch_no">Batch No<span class="text-danger">*</span></label>
                                @error('batch_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <span id="expiry_date"></span>
                                <label for="expiry_date">Expiry Date<span class="text-danger">*</span> </label>
                            </div>

                         

                            <div class="col-md-4 form-group">
                                <input type="text" id="qty" name="qty" required />
                                <label for="qty">Quantity<span class="text-danger">*</span> </label>

                                @error('qty')
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

    function getDetails(batch_no_) {
        //  alert(batch_no);
        $.ajax({
            url: "{{ route('find-expiry-date-by-batch-no') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                batch_no: batch_no_,
            },
            success: function(response) {
                console.log(response);

                $('#expiry_date').text(response.exp_date);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

@endsection