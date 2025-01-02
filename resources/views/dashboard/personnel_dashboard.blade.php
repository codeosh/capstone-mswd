{{-- resources\views\dashboard\personnel_dashboard.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Dashboard - Page")

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col-md-6">
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

                    <!-- Start Date -->
                    <div class="form-floating">
                        <input type="date" id="filterMapStartDate" name="mapStartDate" class="form-control"
                            placeholder="Start Date" aria-label="Start Date" />
                        <label for="serviceStartDate">Start Date</label>
                    </div>

                    <!-- End Date -->
                    <div class="form-floating">
                        <input type="date" id="filterMapEndDate" name="mapEndDate" class="form-control"
                            placeholder="End Date" aria-label="End Date" />
                        <label for="serviceEndDate">End Date</label>
                    </div>
                </div>
            </div>

            <div class="text-muted" id="clock"></div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div id="map" style="height: 500px; width: 100%; margin-top: 20px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts Compiled --}}
<script src="{{asset('js/map.js')}}"></script>
<script src="{{asset('js/clock.js')}}"></script>
@endsection