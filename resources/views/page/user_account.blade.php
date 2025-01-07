@extends('layouts.main_layout')

@section('title', "MSWDO - Add User - Page")
@section('content')
    <div class="card shadow d-flex justify-center flex-column" style="height: 90vh;">
        <div class="card-header">
            <h5>User Account</h5>
        </div>
        <div class="card-body h-100 d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-3 border rounded p-3">
                <div class="input-group w-25">
                    <span class="input-group-text" id="search-icon">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="searchUserAccountInput" name="searchUserAccountInput"
                        placeholder="Search Accounts" aria-label="Search" aria-describedby="search-icon">
                </div>
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-secondary" style="display: flex; align-items: center; gap: 8px;"><i class="fas fa-file-alt"></i>Logs</button>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus"></i>Add User</button>
                </div>
            </div> 
            <div class="card">
                <!-- Table for User Accounts -->
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="bg-light shadow-sm text-center border p-2 rounded">
                                        Name
                                    </div>
                                </th>
                                <th>
                                    <div class="bg-light shadow-sm text-center border p-2 rounded">
                                        Role
                                    </div>
                                </th>
                                <th>
                                    <div class="bg-light shadow-sm text-center border p-2 rounded">
                                        Date Added
                                    </div>
                                </th>
                                <th>
                                    <div class="bg-light shadow-sm text-center border p-2 rounded">
                                        Actions
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="align-middle text-center">John Doe</td>
                                <td class="align-middle text-center">Admin</td>
                                <td class="align-middle text-center">January 08, 2025</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action buttons">
                                        <button type="button" class="btn btn-outline-success">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- More rows can be added dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       
        </div>
    </div>

{{-- Add User Modal --}}
@include('modals.create_user')
<script src="{{asset('js/addUser.js')}}"></script>
@endsection