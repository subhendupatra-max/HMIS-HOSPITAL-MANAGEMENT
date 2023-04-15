@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Item Attribute</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST"  action="{{route('update-Inventory-item-attribute')}}">
               
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <input type="hidden" name="id" value="{{$editItemAttribute->id}}" />
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="form-label">Attribute Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="attribute_name" value="{{$editItemAttribute->attribute_name}}" name="attribute_name" placeholder="Enter Attribute Name">
                                    </div>
                                    @error('attribute_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="form-label">Attribute Label Name<span class="required"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="attribute_label_name" name="attribute_label_name" value="{{$editItemAttribute->attribute_label_name}}" placeholder="Enter Attribute Label Name">
                                    </div>
                                    @error('attribute_label_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

@endsection