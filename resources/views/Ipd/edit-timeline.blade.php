@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Edit Timeline
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
            <form action="{{ route('update-timeline-lisitng-in-ipd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                    <input type="hidden" name="id" value="{{ $editTimelineIpd->id }}" />
                    <div class="form-group col-md-6">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$editTimelineIpd->title}}" required>
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="date" class="form-label">Date </label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required @if(isset($editTimelineIpd->date)) value="{{ date('Y-m-d h:m:s',strtotime($editTimelineIpd->date))}}" @endif>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control"> {{ $editTimelineIpd->description }} </textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="attach_document" class="form-label">Attach Document </label>
                        <input type="file" id="attach_document" name="attach_document">
                        @error('attach_document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Timeline</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>


@endsection