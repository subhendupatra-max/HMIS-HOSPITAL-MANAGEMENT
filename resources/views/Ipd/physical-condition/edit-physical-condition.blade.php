@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Edit Physical Condition
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

        <div class="card-body">
            <form action="{{ route('update-physical-condition-in-ipd') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $editIpdPhysicalDetails->id }}" />
                    <input type="hidden" name="ipd_id" value="{{ $editIpdPhysicalDetails->ipd_id }}" />

                    <div class="form-group col-md-4">
                        <label for="height" class="form-label">Height(cm)</label>
                        <input type="text" class="form-control" id="height" name="height" value="{{ $editIpdPhysicalDetails->height }}" />
                        @error('height')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="weight" class="form-label">Weight(kg)</label>
                        <input type="text" class="form-control" id="weight" name="weight" value="{{ $editIpdPhysicalDetails->weight }}" />
                        @error('weight')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="bp" class="form-label">BP</label>
                        <input type="text" class="form-control" id="bp" name="bp" value="{{ $editIpdPhysicalDetails->bp }}" />
                        @error('weight')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pulse" class="form-label">Pulse</label>
                        <input type="text" class="form-control" id="pulse" name="pulse" value="{{ $editIpdPhysicalDetails->pulse }}" />
                        @error('pulse')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="temperature" class="form-label">Temperature</label>
                        <input type="text" class="form-control" id="temperature" name="temperature" value="{{ $editIpdPhysicalDetails->temperature }}" />
                        @error('pulse')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="respiration" class="form-label">Respiration</label>
                        <input type="text" class="form-control" id="respiration" name="respiration" value="{{ $editIpdPhysicalDetails->respiration }}" />
                        @error('respiration')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Physical Condition</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection