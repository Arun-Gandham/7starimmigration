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


    <div class="d-flex justify-content-between">
        <h4 class="py-3 mb-3">
            <span class="text-muted fw-light">Clients /</span> List
        </h4>
        <a href="{{ route('client.add') }}"><button class="btn btn-primary mt-2" style="padding: 15px;height: 30px;"><i
                    class="fa-solid fa-plus"></i>
                Add</button></a>
    </div>
    
    <div class="card mb-4">
                <form class="card-body" method="GET" id="filterForm">
                    <div class="row">
                        <div class="col-md-5  col-sm-12">
                            <div class="col-sm-9">
                                <span>Employee: </span><select class="form-select" id="basic-default-country" name="emp">
                                <option value="">Select Employee</option>
                                    @foreach ($emps as $emp)
                                        <option
                                            {{ isset($empParam) && $empParam == $emp->id ? 'selected' : '' }}
                                            value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 ">
                            <div class="col-sm-9">
                            <span>Country: </span><select class="form-select" id="basic-default-country" name="cnt">
                                <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option
                                            {{ isset($cntParam) && $cntParam == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12 mt-sm-2">
                            <div class="d-flex align-items-end h-100 justify-content-md-end">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($client) ? 'Update' : 'Submit' }}</button>
                                    <button class="btn btn-label-secondary waves-effect"><a
                                            href="{{ route('admin.client.list') }}">Reset</a></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="data-table" class="datatables-basic table">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Employe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var searchParams = new URLSearchParams(window.location.search);

            // Get the value of the 'cnt' query parameter, or an empty string if it doesn't exist
            var cntParam = searchParams.get('cnt') || '';

            // Get the value of the 'emp' query parameter, or an empty string if it doesn't exist
            var empParam = searchParams.get('emp') || '';
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.client.list.datatbles') }}'+ '?cnt=' + cntParam + '&emp=' + empParam,
                
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'emp'
                    },
                    {
                        data: 'actions'
                    }
                ]
            });
        });

        document.getElementById('filterForm').addEventListener('submit', function(event) {
            var form = this;
            var inputs = form.querySelectorAll('select');
            inputs.forEach(function(input) {
                if (input.value === '') {
                    input.disabled = true; // Disable empty inputs to exclude them from GET parameters
                }
            });
        });
    </script>
@endsection
