{{-- resources\views\page\beneficiary_logs.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Beneficiary Logs - Page")

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mt-1">Beneficiary Logs</h5>
    </div>
    <div class="card-body p-3">
        @include('partials.beneficiary_logs')
    </div>
</div>
@endsection