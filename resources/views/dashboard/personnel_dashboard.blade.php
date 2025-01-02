{{-- resources\views\dashboard\personnel_dashboard.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Dashboard - Page")

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <div class="form-floating">
                    <select name="filterServiceMap" id="filterServiceMap" class="form-select w-100">
                        <option value="">Select Filter Type</option>
                        <option value="AICS">AICS</option>
                        <option value="VAW">VAW</option>
                        <option value="VAC">VAC</option>
                        <option value="CAR">CAR</option>
                        <option value="CICL">CICL</option>
                        <option value="Solo Parent">Solo Parent</option>
                    </select>
                    <label for="filterServiceMap">Filter Type:</label>
                </div>
            </div>
            <div class="text-muted" id="clock"></div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <div id="map" style="height: 500px; width: 100%; margin-top: 20px;"></div>
    </div>
</div>

{{-- Scripts Compiled --}}
<script src="{{asset('js/map.js')}}"></script>
<script src="{{asset('js/clock.js')}}"></script>
@endsection