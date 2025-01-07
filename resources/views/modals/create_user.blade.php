{{-- resources\views\modals\add_User.blade.php --}}

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addUserForm" autocomplete="off" class="needs-validation" novalidate>
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="alert alert-info" role="alert">
                                <strong>Reminder:</strong> Ensure to double check all information before submitting.
                            </div>
                        </div>
                        <div class="col-md-3 ms-auto">
                            <div class="form-floating">
                                <select id="roleSelect" name="selectedRole" class="form-select">
                                    <option value=""disabled selected>Select Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Personnel">Personnel</option>
                                </select>
                                <label for="roleSelect">Role</label>
                            </div>
                        </div>
                        
                    </div>

                    {{-- User Information Section --}}
                    
                    <div class="border rounded p-3 mb-3">
                        <input type="hidden" class="form-control" id="idnum" name="idnum" required>
                        <div class="row g-2 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="First name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="middlename" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="middlename" name="middlename"
                                    placeholder="Middle name">
                            </div>
                            <div class="col-md-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Last name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="suffix" class="form-label">Suffix</label>
                                <select class="form-select" id="suffix" name="suffix">
                                    <option value="">Select Suffix</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="sex" class="form-label">Sex</label>
                                <select name="sex" id="sex" class="form-select" required>
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="birthdate" class="form-label">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>

                            <div class="col-md-3">
                                <label for="childAge" class="form-label">Age</label>
                                <input name="age" id="childAge" class="form-control" readonly>
                            </div>

                            <div class="col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value=""disabled selected>Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="row g-2 align-items-center mb-3">
                            <div class="col-md-3">
                                <label for="streetname" class="form-label">Streetname</label>
                                <input type="text" class="form-control" id="streetname" name="streetname"
                                    placeholder="Street name">
                            </div>

                            <div class="col-md-3">
                                <label for="selectedBarangay" class="form-label">Barangay</label>
                                <div class="dropdown w-100">
                                    <button class="form-select w-100" type="button" id="barangayDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Barangay
                                    </button>
                                    <ul class="dropdown-menu w-100" aria-labelledby="barangayDropdown">
                                        <li class="p-2">
                                            <input type="text" class="form-control" id="barangaySearch"
                                                placeholder="Search Barangay..." autocomplete="off" />
                                        </li>
                                        <div id="barangayList" style="max-height: 200px; overflow-y: auto;">
                                            <li><a class="dropdown-item" href="#" data-value="Benit">Benit</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Buac Daku">Buac Daku</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Buac Gamay">Buac Gamay</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Cabadbaran">Cabadbaran</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Conception">Conception</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"
                                                    data-value="Consolacion">Consolacion</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Dagsa">Dagsa</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Hibod - Hibod">Hibod -
                                                    Hibod</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Hindangan">Hindangan</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Hipantag">Hipantag</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Javier">Javier</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Kahupian">Kahupian</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Kanangkaan">Kanangkaan</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Kauswagan">Kauswagan</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="La Purisima Conception">La
                                                    Purisima Conception</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Libas">Libas</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Lum-an">Lum-an</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Mabicay">Mabicay</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Mac">Mac</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Magatas">Magatas</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Mahayahay">Mahayahay</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Malinao">Malinao</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Maria Plana">Maria
                                                    Plana</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Milagroso">Milagroso</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Olisihan">Olisihan</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Pancho Villa">Pancho
                                                    Villa</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Pandan">Pandan</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Rizal">Rizal</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Salvacion">Salvacion</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="San Francisco Mabuhay">San
                                                    Francisco Mabuhay</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Isidro">San
                                                    Isidro</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Jose">San
                                                    Jose</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Juan">San
                                                    Juan</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Miguel">San
                                                    Miguel</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Pedro">San
                                                    Pedro</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Roque">San
                                                    Roque</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="San Vicente">San
                                                    Vicente</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Santa Maria">Santa
                                                    Maria</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Suba">Suba</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Tampoong">Tampoong</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-value="Zone I (Pob.)">Zone
                                                    1</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Zone II (Pob.)">Zone
                                                    2</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Zone III (Pob.)">Zone
                                                    3</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Zone IV (Pob.)">Zone
                                                    4</a></li>
                                            <li><a class="dropdown-item" href="#" data-value="Zone V (Pob.)">Zone
                                                    5</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <input type="hidden" id="selectedBarangay" name="barangay">
                            </div>

                            <div class="col-md-3">
                                <label for="municipality" class="form-label">Municipality</label>
                                <input type="text" name="municipality" id="municipality" class="form-control"
                                    value="Sogod" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" name="province" id="province" class="form-control"
                                    value="Southern Leyte" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                                    <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    {{-- Child Cases Section --}}
                    <div class="border rounded p-3 child-cases-section d-none">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Pantawid Beneficiary</label>
                                <select name="pantawid_beneficiary" id="pantawid_beneficiary" class="form-select"
                                    required>
                                    <option value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="offense_committed" class="form-label">Offense Committed</label>
                                <input type="text" class="form-control" id="offense_committed" name="offense_committed"
                                    placeholder="Offense Committed" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Case Status</label>
                                <select name="casestatus" id="casestatus" class="form-select" required>
                                    <option value="">Select Case Status</option>
                                    <option value="Undergoing Community-Based Intervention">Undergoing
                                        Community-Based
                                        Intervention</option>
                                    <option value="Undergoing Diversion Program">Undergoing
                                        Diversion Program</option>
                                    <option value="On After Care">On After Care</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" id="childremarks" name="childremarks" rows="3"
                                    placeholder="Enter any remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addUserForm">Add
                        User</button>
                </div>
            </div>

        </div>
    </div>
    <script src="{{asset('js/add_user.js')}}"></script>
</div>



