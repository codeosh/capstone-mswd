{{-- resources\views\page\beneficiary_page.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Beneficiary - Page")

@section('content')
<div class="card shadow d-flex flex-column" style="height: 80vh;">
    <div class="card-header">
        <h5>Beneficiary List</h5>
    </div>
    <div class="card-body h-100 d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center mb-3 border rounded p-3">
            <div class="input-group w-25">
                <span class="input-group-text" id="search-icon">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control" id="searchBeneficiaryInput" name="searchBeneficiaryInput"
                    placeholder="Search Beneficiaries" aria-label="Search" aria-describedby="search-icon">
            </div>

            <div class="btn-group text-nowrap" role="group" aria-label="Beneficiary actions">
                <a href="{{route('beneficiary.logs')}}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-book"></i> Logs
                </a>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBeneficiaryModal">
                    <i class="fas fa-plus"></i> Add Beneficiary
                </button>
            </div>
        </div>

        {{-- Beneficiary List Table --}}
        <div id="beneficiaryTableContainer" class="table-responsive border shadow rounded">
            @include('partials.beneficiary_table', ['beneficiaries' => $beneficiaries])
        </div>

        {{-- Pagination --}}
        @if(!$hidePagination)
        <div class="mt-auto">
            <nav aria-label="Beneficiaries Pagination" class="mt-3">
                <ul class="pagination justify-content-center">
                    {{-- Previous Button --}}
                    <li class="page-item {{ $beneficiaries->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $beneficiaries->previousPageUrl() }}" tabindex="-1"
                            aria-disabled="true">Prev</a>
                    </li>

                    {{-- Always show the first page --}}
                    <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                        <a class="page-link" href="{{ $beneficiaries->url(1) }}">1</a>
                    </li>

                    {{-- Show ellipsis if there are skipped pages before current --}}
                    @if ($currentPage > 3)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                    @endif

                    {{-- Show current and surrounding pages --}}
                    @for ($page = max(2, $currentPage - 2); $page <= min($lastPage - 1, $currentPage + 2); $page++) <li
                        class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $beneficiaries->url($page) }}">{{ $page }}</a>
                        </li>
                        @endfor

                        {{-- Show ellipsis if there are skipped pages after current --}}
                        @if ($currentPage < $lastPage - 2) <li class="page-item disabled">
                            <span class="page-link">...</span>
                            </li>
                            @endif

                            {{-- Always show the last page --}}
                            @if ($lastPage > 1)
                            <li class="page-item {{ $currentPage == $lastPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ $beneficiaries->url($lastPage) }}">{{ $lastPage }}</a>
                            </li>
                            @endif

                            {{-- Next Button --}}
                            <li class="page-item {{ $beneficiaries->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $beneficiaries->nextPageUrl() }}">Next</a>
                            </li>
                </ul>
            </nav>
        </div>
        @endif

    </div>
</div>

{{-- Modal Section --}}
<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>

{{-- Add Beneficiary Modal --}}
@include('modals.add_beneficiary')

{{-- Profile Beneficiary Modal --}}
@include('modals.profile_beneficiary')

{{-- Service Beneficiary Modal --}}
@include('modals.service_beneficiary')

{{-- History Beneficiary Modal --}}
@include('modals.history_beneficiary')
@endsection