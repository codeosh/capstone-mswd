{{-- resources\views\modals\profile_beneficiary.blade.php --}}
<div class="modal fade" id="profileBeneficiaryModal" tabindex="-1" aria-labelledby="profileBeneficiaryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileBeneficiaryModalLabel">
                    Profile Beneficiary
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <div id="editNote" class="alert alert-info d-none mb-3">
                    <strong>Note:</strong> Fields highlighted are now editable. Make changes and click "Save
                    Changes" to
                    update.
                </div>
                <form id="profileBeneficiaryForm" autocomplete="off">
                    @csrf
                    <input type="hidden" id="profileBeneficiaryId" name="beneficiary_id">

                    {{-- First Row --}}
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-md-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="profileFirstname" name="firstname"
                                placeholder="First name" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="profileMiddlename" name="middlename"
                                placeholder="Middle name" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="profileLastname" name="lastname"
                                placeholder="Last name" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input class="form-control" id="profileSuffix" name="suffix" placeholder="Suffix" readonly>
                        </div>
                    </div>

                    {{-- Second Row --}}
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-md-3">
                            <label for="sex" class="form-label">Sex</label>
                            <input type="text" class="form-control" id="profileSex" name="sex" placeholder="Sex"
                                readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="text" class="form-control" id="profileBirthdate" name="birthdate"
                                placeholder="Birthdate" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="profileStatus" name="status"
                                placeholder="Status" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="category" class="form-label">Category</label>
                            <input class="form-control" id="profileCategory" name="category" placeholder="Category"
                                readonly>
                        </div>
                    </div>

                    {{-- Third Row --}}
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-md-3">
                            <label for="streetname" class="form-label">Streetname</label>
                            <input type="text" class="form-control" id="profileStreetname" name="streetname" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="profileBarangay" name="barangay"
                                placeholder="Barangay" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="municipality" class="form-label">Municipality</label>
                            <input type="text" class="form-control" id="profileMunicipality" name="municipality"
                                readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="province" class="form-label">Province</label>
                            <input class="form-control" id="profileProvince" name="province" readonly>
                        </div>

                    </div>

                    {{-- Fourth Row --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="profileRemarks" name="remarks"
                                placeholder="Remarks">
                        </div>
                    </div>

                    <div class="d-none" id="profileChildCaseContainer">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Pantawid Beneficiary</label>
                                <input type="text" class="form-control" placeholder="Pantawid Beneficiary" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Offense Committed</label>
                                <input type="text" class="form-control" placeholder="Offense Committed" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Case Status</label>
                                <input type="text" class="form-control" placeholder="Case Status" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" id="childremarks" name="childremarks" rows="3"
                                    placeholder="Any Remarks" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="editProfileBtn" class="btn btn-primary">Edit</button>
                        <button type="submit" id="saveProfileBtn" class="btn btn-primary d-none">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>