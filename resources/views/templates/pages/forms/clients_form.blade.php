@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script> --}}
@endsection

@section('content')
    @if ($error = session('error'))
        <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($success = session('success'))
        <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
            {{ $success }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <div class="row">
        <!-- Form Separator -->
        <div class="col">
            <div class="card mb-4">
                <form class="card-body" method="POST"
                    action="{{ isset($client) ? route('client.edit.submit') : route('client.add.submit') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="col-sm-3 col-form-label" for="multicol-username">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="multicol-username" class="form-control" placeholder="Name"
                                    name="name" value="{{ isset($client) ? $client->name : '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-3 col-form-label" for="multicol-username">Amount</label>
                            <div class="col-sm-9">
                                <input type="number" id="multicol-username" class="form-control" placeholder="Amount"
                                    name="amount" value="{{ isset($client) ? $client->amount : '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-sm-3 col-form-label" for="multicol-username">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" id="multicol-username" class="form-control" placeholder="Phone"
                                    name="phone" value="{{ isset($client) ? $client->phone : '' }}"
                                    {{ isset($client) ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-sm-3 col-form-label" for="multicol-username">Enquiry Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="basic-default-country" name="enq_status" required="">
                                    <option {{ isset($client) && $client->enq_status == 'Pending' ? 'selected' : '' }}
                                        value="Pending">Pending</option>
                                    <option {{ isset($client) && $client->enq_status == 'Completed' ? 'selected' : '' }}
                                        value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label" for="multicol-username">File Submited or not</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="basic-default-country" name="file_submitted" required="">
                                    <option {{ isset($client) && $client->file_submitted == 'Yes' ? 'selected' : '' }}
                                        value="Yes">Yes</option>
                                    <option {{ isset($client) && $client->file_submitted == 'No' ? 'selected' : '' }}
                                        value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label" for="multicol-username">Country</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="basic-default-country" name="country_id" required="">
                                    @foreach ($countries as $country)
                                        <option
                                            {{ isset($client) && $client->country_id == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="col-sm-12 col-form-label" for="multicol-username">Address</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" placeholder="Address" rows="3" required name="address">{{ isset($client) ? $client->address : '' }}</textarea>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="row justify-content-start">
                                <div class="col-sm-9">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($client) ? 'Update' : 'Submit' }}</button>
                                    <button class="btn btn-label-secondary waves-effect"><a
                                            href="{{ route('client.list') }}">Cancel</a></button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
