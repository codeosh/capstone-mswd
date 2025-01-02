{{-- resources\views\page\generate_report.blade.php --}}
@extends('layouts.main_layout')
@section('title', "MSWDO - Generate Reports - Page")

@section('content')
<div class="card" style="height: 90vh;">
    <div class="card-header">
        <h5 class="mt-1">Generate Reports</h5>
    </div>
    <div class="card-body" style="overflow-x:hidden;overflow-y:auto;">
        <div class="row mb-3">
            <div class="col-md-6">
                <small class="text-muted">Filtering:</small>
                <div class="input-group">
                    <!-- Dropdown -->
                    <div class="form-floating">
                        <select id="selectReportFilterType" name="reportFilterType" class="form-select">
                            <option value="">Select Filter Type</option>
                            <option value="AICS">AICS</option>
                            <option value="VAW">VAW</option>
                            <option value="VAC">VAC</option>
                            <option value="CAR">CAR</option>
                            <option value="CICL">CICL</option>
                            <option value="Solo Parent">Solo Parent</option>
                        </select>
                        <label for="selectReportFilterType">Filter Type</label>
                    </div>

                    <!-- Start Date -->
                    <div class="form-floating">
                        <input type="date" id="filterReportStartDate" name="startDate" class="form-control"
                            placeholder="Start Date" aria-label="Start Date" />
                        <label for="serviceStartDate">Start Date</label>
                    </div>

                    <!-- End Date -->
                    <div class="form-floating">
                        <input type="date" id="filterReportEndDate" name="endDate" class="form-control"
                            placeholder="End Date" aria-label="End Date" />
                        <label for="serviceEndDate">End Date</label>
                    </div>

                    <button type="button" id="filterButtonReport" class="btn btn-primary">Filter</button>
                    <button type="button" id="clearButtonReport" class="btn btn-secondary">Clear</button>
                </div>
            </div>

            <div class="col-md-6">
                <small class="text-muted">Edit Print:</small>
                <div class="input-group">
                    <!-- Report Title -->
                    <div class="form-floating">
                        <input type="text" id="reportTitle" name="reportTitle" class="form-control"
                            autocomplete="off" />
                        <label for="reportTitle">Report Title</label>
                    </div>

                    <!-- Email Address -->
                    <div class="form-floating">
                        <input type="email" id="officeEmail" name="officeEmail" class="form-control"
                            autocomplete="off" />
                        <label for="officeEmail">Email Address</label>
                    </div>

                    <!-- Office Cell Number -->
                    <div class="form-floating">
                        <input type="text" id="officeCell" name="officeCell" class="form-control" autocomplete="off" />
                        <label for="officeCell">Office Cell Number</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <div class="d-flex gap-2 align-items-center mb-3">
                    <label for="rowsPerPage" class="me-2">Rows:</label>
                    <select id="rowsPerPage" class="form-select d-inline-block" style="width: auto;">
                        <option value="10" {{ request('perPage')==10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage')==25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage')==50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage')==100 ? 'selected' : '' }}>100</option>
                        <option value="200" {{ request('perPage')==200 ? 'selected' : '' }}>200</option>
                        <option value="500" {{ request('perPage')==500 ? 'selected' : '' }}>500</option>
                    </select>
                    <button type="button" id="printButtonReport" class="btn btn-primary">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>

        @include('partials.report_table', ['beneficiaries' => $beneficiaries])
    </div>
</div>
<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
@endsection