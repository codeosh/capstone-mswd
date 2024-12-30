{{-- resources\views\page\generate_report.blade.php --}}
@extends('layouts.main_layout')
@section('title', "MSWDO - Generate Reports - Page")

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mt-1">Generate Reports</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-8">
                <label for="filterInputs" class="form-label">Filter Services</label>
                <div class="input-group">
                    <!-- Dropdown -->
                    <div class="form-floating">
                        <select id="serviceTypeSelect" name="selectedServiceType" class="form-select">
                            <option value="">Select Service Type</option>
                            <option value="AICS">AICS</option>
                            <option value="VAW">VAW</option>
                            <option value="VAC">VAC</option>
                            <option value="CAR">CAR</option>
                            <option value="CICL">CICL</option>
                        </select>
                        <label for="serviceTypeSelect">Service Type</label>
                    </div>

                    <!-- Start Date -->
                    <div class="form-floating">
                        <input type="date" id="serviceStartDate" name="startDate" class="form-control"
                            placeholder="Start Date" aria-label="Start Date" />
                        <label for="serviceStartDate">Start Date</label>
                    </div>

                    <!-- End Date -->
                    <div class="form-floating">
                        <input type="date" id="serviceEndDate" name="endDate" class="form-control"
                            placeholder="End Date" aria-label="End Date" />
                        <label for="serviceEndDate">End Date</label>
                    </div>

                    <!-- Button -->
                    <div class="input-group-text">
                        <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.report_table', ['beneficiaries' => $beneficiaries])
    </div>
</div>
@endsection