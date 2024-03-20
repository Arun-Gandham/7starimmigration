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
                    <div class="row mb-3 p-3">
                        <div class="col-md-6">
                            <label class="col-sm-3 col-form-label" for="multicol-username">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="multicol-username" class="form-control" placeholder="User Name"
                                    name="username" value="{{ isset($user) ? $user->name : '' }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-sm-3 col-form-label" for="multicol-username">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" id="multicol-username" class="form-control" placeholder="Phone"
                                    name="phone" value="{{ isset($user) ? $user->phone : '' }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="defaultSelect" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="role" disabled>
                                    <option value="Admin">
                                        Admin</option>
                                    <option selected value="Emp">
                                        Employee</option>
                                </select>
                            </div>
                        </div>
            </div>
            
        </div>
        <div class="card mt-4">
            <div class="card-datatable table-responsive pt-0">
                <table id="data-table" class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.employee.client.list.datatbles',$user->id) }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'actions'
                    }
                ]
            });
        });
    </script>
@endsection
