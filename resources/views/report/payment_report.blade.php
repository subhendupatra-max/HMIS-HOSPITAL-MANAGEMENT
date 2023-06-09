@extends('layouts.layout')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Income Report</div>
            </div>
            @include('message.notification')
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-12 border-right">
                                <form method="POST" action="{{ route('fetch-payment-report') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="payment_mode">Payment Mode <span
                                                        class="text-danger">*</span></label>
                                                <select name="payment_mode" class="form-control select2-show-search"
                                                    id="payment_mode">
                                                    <option value="">Select Payment Mode....</option>
                                                    @foreach (Config::get('static.payment_mode_name') as $lang => $payment_mode_name)
                                                        <option value="{{ $payment_mode_name }}"
                                                            {{ @$payment_mode_name == @$all_search_data['payment_mode'] ? 'selected' : '' }}>
                                                            {{ $payment_mode_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('payment_mode')
                                                    <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="section"> Section <span class="text-danger">*</span></label>
                                                <select name="section" class="form-control select2-show-search"
                                                    id="section">
                                                    <option value="">Select Section....</option>
                                                    <option value="IPD"
                                                        {{ @$all_search_data['payment_mode'] == 'IPD' ? 'selected' : '' }}>
                                                        IPD</option>
                                                    <option value="OPD"
                                                        {{ @$all_search_data['payment_mode'] == 'OPD' ? 'selected' : '' }}>
                                                        OPD</option>
                                                    <option value="EMG"
                                                        {{ @$all_search_data['payment_mode'] == 'EMG' ? 'selected' : '' }}>
                                                        EMG</option>
                                                </select>
                                                @error('section')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4 newaddappon">
                                                <label for="collected_by">Collected By </label>
                                                <select name="collected_by" class="form-control select2-show-search"
                                                    id="collected_by">
                                                    <option value="">Select Collected By </option>
                                                    @foreach ($user as $key => $users)
                                                        <option value="{{ $users->id }}"
                                                            {{ @$all_search_data['collected_by'] == $users->id ? 'selected' : '' }}>
                                                            {{ $users->first_name }} {{ $users->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('collected_by')
                                                    <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>

                                            <div class="form-group col-md-4 addopdd">
                                                <label>From Date <span class="text-danger">*</span></label>
                                                <input type="datetime-local" name="from_date"
                                                    value="{{ date(@$all_search_data['from_date']) }}" required />
                                                @error('from_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4 addopdd ">
                                                <label>To Date <span class="text-danger">*</span></label>
                                                <input type="datetime-local" name="to_date"
                                                    value="{{ date(@$all_search_data['to_date']) }}" required />
                                                @error('to_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i
                                                class="fa fa-search"></i> Search</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example">
                            <thead>
                                <tr>
                                    <th scope="col"> Date</th>
                                    <th scope="col"> Mode</th>
                                    <th scope="col"> Received By</th>
                                    <th scope="col">Section</th>
                                    <th scope="col"> Amount(Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @if (@$payment_report[0]->id != null)
                                    @foreach ($payment_report as $value)
                                        <?php $i += intval($value->payment_amount); ?>
                                        <tr>
                                            <td>{{ date('d-m-Y h:i A', strtotime(@$value->payment_date)) }}</td>

                                            <td>{{ @$value->payment_mode }}</td>
                                            <td>{{ @$value->generated_by->first_name }}
                                                {{ @$value->generated_by->last_name }}</td>
                                            <td>
                                                {{ @$value->section }}
                                            </td>
                                            <td>{{ @$value->payment_amount }}</td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
           <div class="">
            <div class="container mt-5" style="margin-left: 57px;">
                <div class="d-flex justify-content-end">
                    <span class="bilpo_name">Total </span><span class="bilpo_value"> :
                        </span>
                        <span class="bilpo_name">{{ @$i }}</span>
                </div>
              
                

            </div>
           </div>
            </div>
        </div>
    </div>

@endsection
