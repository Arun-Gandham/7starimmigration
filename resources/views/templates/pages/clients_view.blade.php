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
                <div class="row mb-3 p-4">
                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Client Name :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->name : '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Amount :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->amount : '' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Phone :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->phone : '' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Enquiry Status :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->enq_status : '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-6 col-form-label" for="multicol-username"><b>File Submited or not :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->file_submitted : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label" for="multicol-username"><b>Address :</b></label>
                        <div class="col-sm-12">
                            {{ isset($client) ? $client->address : '' }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endsection
