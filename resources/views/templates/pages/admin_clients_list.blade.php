@extends('layouts/layoutMaster')

@section('title', 'Client Data Sheet')

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
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
    <style>
        .custom-excel-button {
            background-color: #007bff; /* Blue */
            color: white;
            border: none;
            height:2.3rem;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 8px;
        }

        .custom-excel-button:hover {
            background-color: #0056b3; /* Darker blue */
        }
    </style>
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
        <div class="card-datatable table-responsive p-3">
            <table id="data-table" class="datatables-basic table">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Phone</th>
                        <th>Amount</th>
                        <th>Paid Till Date</th>
                        <th>Country</th>
                        <th>Employee Name</th>
                        <th class="hidden">Employee Number</th>
                        <th class="hidden">Address</th>
                        <th class="hidden">Comment</th>
                        <th class="hidden">Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var searchParams = new URLSearchParams(window.location.search);

            // Get the value of the 'cnt' query parameter, or an empty string if it doesn't exist
            var cntParam = searchParams.get('cnt') || '';

            // Get the value of the 'emp' query parameter, or an empty string if it doesn't exist
            var empParam = searchParams.get('emp') || '';
            $('#data-table').DataTable({
                dom: '<"top d-flex justify-content-between"Blf>rt<"bottom"ip><"clear">',
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.client.list.datatbles') }}'+ '?cnt=' + cntParam + '&emp=' + empParam,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
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
                        data: 'paid_amt'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'emp'
                    },
                    {
                        data: 'emp_number'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'comment'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'actions'
                    }
                ],
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5,6,7,8,9] // Include the indices of the columns to be exported
                        },
                        className: 'custom-excel-button',
                        filename: function() {
                            var date = new Date();
                            return 'ClientData_' + date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + '_' + date.getHours() + '-' + date.getMinutes() + '-' + date.getSeconds();
                        },
                    },
                    // {
                    //     extend: 'pdf',
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4]
                    //     },
                    //     filename: function() {
                    //         var date = new Date();
                    //         return 'ClientData_' + date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + '_' + date.getHours() + '-' + date.getMinutes() + '-' + date.getSeconds();
                    //     },
                    //     header: false
                    // },
                    // {
                    //     extend: 'print',
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4]
                    //     },
                    //     header: false
                    // }
                ],
                columnDefs: [
                    {
                        targets: [3,-2,-3,-4], // Hide last two columns by index
                        visible: false
                    },
                    {
                        targets: [9], // Target the date column
                        render: function(data, type, row) {
                            // Format the date as needed (e.g., 'YYYY-MM-DD')
                            return moment(data).format('DD-MM-YYYY');
                        }
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
