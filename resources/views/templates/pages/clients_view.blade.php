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
                    <div class="col-sm-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Client Name :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->name : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Amount :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->amount : '' }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Phone :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->phone : '' }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username"><b>Enquiry Status :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->enq_status : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 col-form-label" for="multicol-username"><b>File Submited or not :</b></label>
                        <div class="col-sm-9">
                            {{ isset($client) ? $client->file_submitted : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label" for="multicol-username"><b>Country :</b></label>
                        <div class="col-sm-12">
                            {{ isset($client) && isset($client->country->name) ? $client->country->name : '-' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label" for="multicol-username"><b>Paid Amount :</b></label>
                        <div class="col-sm-12">
                            {{ isset($client) ? $client->getPaymentSum() : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label" for="multicol-username"><b>Pending Amount :</b></label>
                        <div class="col-sm-12">
                            {{ isset($client) ? ($client->amount - $client->getPaymentSum() < 0 ? 0 : $client->amount - $client->getPaymentSum()) : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label" for="multicol-username"><b>Date :</b></label>
                        <div class="col-sm-12">
                            @php
                                $dateString = $client->created_at;
                                $date = new DateTime($dateString);
                                echo $date->format('jS F Y, g:i A');
                            @endphp
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label" for="multicol-username"><b>Address :</b></label>
                        <div class="col-sm-12">
                            {{ isset($client) ? $client->address : '' }}
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4">
                        @if (count($historys))
                            <a href="{{ route('invoice') }}"><button type="button"
                                    class="btn btn-success me-sm-2 me-1 waves-effect waves-light"><i
                                        class="fa-solid fa-download"></i> &nbsp; Invoice</button></a>
                        @endif
                        <a href="{{ route('client.edit', $client->id) }}"><button type="button"
                                class="btn btn-secondary me-sm-2 me-1 waves-effect waves-dark"><i class="fa fa-pen"></i>
                                &nbsp;
                                Edit</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#history" aria-controls="navs-pills-top-profile"
                                aria-selected="false">Payment History</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#add-payment" aria-controls="navs-pills-top-home" aria-selected="true">Add
                                Payment</button>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="add-payment" role="tabpanel">
                            <form class="card-body" method="POST" action="{{ route('payment.add.submit') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="col-sm-3 col-form-label" for="multicol-username">Amount</label>
                                        <div class="col-sm-12">
                                            <input type="number" id="multicol-username" class="form-control"
                                                placeholder="Amount" name="amount" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-sm-12 col-form-label" for="multicol-username">Note</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" placeholder="Address" rows="3" name="note"></textarea>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <div class="row justify-content-start">
                                            <div class="col-sm-9">
                                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">Submit</button>
                                                <button class="btn btn-label-secondary waves-effect"><a
                                                        href="{{ route('client.list') }}">Cancel</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>





                        </div>
                        <div class="tab-pane fade show active" id="history" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                @if (count($historys))
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($historys as $history)
                                                <tr>
                                                    <td>
                                                        {{ $history->amount }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $dateString = $history->created_at; // Example date and time
                                                            $date = new DateTime($dateString);
                                                            $formattedDateTime = $date->format('jS F Y, g:i A');
                                                            echo $formattedDateTime;
                                                        @endphp
                                                    </td>
                                                    <td>

                                                        {{ $history->note ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h2>No payment history</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
