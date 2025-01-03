{{-- resources\views\dashboard\personnel_dashboard.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Dashboard - Page")

@section('head')
<link rel="stylesheet" href="{{asset('css/mapstyle.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col-md-8">
                <div class="input-group">
                    <!-- Dropdown -->
                    <div class="form-floating">
                        <select id="selectMapFilterType" name="mapFilterType" class="form-select">
                            <option value="">Select Filter Type</option>
                            <option value="AICS">AICS</option>
                            <option value="VAW">VAW</option>
                            <option value="VAC">VAC</option>
                            <option value="CAR">CAR</option>
                            <option value="CICL">CICL</option>
                            <option value="Solo Parent">Solo Parent</option>
                        </select>
                        <label for="selectMapFilterType">Filter Type</label>
                    </div>
                    <div class="form-floating">
                        <select id="selectMonthFilter" name="selectMonthFilter" class="form-select">
                            <option value="">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <label for="selectMonthFilter">Month</label>
                    </div>
                    <div class="form-floating">
                        <select id="selectYearFilter" name="selectYearFilter" class="form-select">
                            <option value="">Select Year</option>
                        </select>
                        <label for="selectYearFilter">Year</label>
                    </div>

                    <button type="button" id="applyFilterButton" class="btn btn-primary">Filter</button>
                    <button type="button" id="clearFilterMapButton" class="btn btn-secondary">Clear</button>
                </div>
            </div>
            <div class="text-white shadow p-2 rounded bg-dark text-center" style="width: 150px;" id="clock"></div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" id="generateReportBtn" style="box-shadow: 0 0 10px rgba(0, 123, 255, 0.7);">
                Generate Report
            </button>
        </div>
        <div class="row">
            <div class="col-md-6 p-2">
                <div id="map" style="height: 520px; width: 100%;"></div>
            </div>

            <div class="col-md-6 shadow">
                <div id="barChart" style="width: 100%;"></div>
                <div id="lineChart" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" id="beneficiaryLogs"
                    style="box-shadow: 0 0 10px rgba(0, 123, 255, 0.7);">
                    Logs
                </a>
            </div>
            <div class="col-md-4 shadow p-3">
                <label for="pieChart" class="form-label">Beneficiary Demographics Overview:</label>
                <div class="border" id="pieChart" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="col-md-8 p-3">

                <h5>Beneficiary Logs</h5>
                @include('partials.beneficiary_logs')
            </div>
        </div>
    </div>
</div>

{{-- Scripts Compiled --}}
<script src="{{asset('js/mapchart.js')}}"></script>
<script src="{{asset('js/filterAnalytics.js')}}"></script>
<script src="{{asset('js/clock.js')}}"></script>
@endsection