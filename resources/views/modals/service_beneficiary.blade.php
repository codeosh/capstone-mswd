{{-- resources\views\modals\service_beneficiary.blade.php --}}
<div class="modal fade" id="serviceBeneficiaryModal" tabindex="-1" aria-labelledby="serviceBeneficiaryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceBeneficiaryModalLabel">
                    Service Beneficiary
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>

            <div class="modal-body">
                <form id="addServiceForm">
                    @csrf
                    <input type="hidden" id="serviceBeneficiaryId" name="beneficiary_id">
                    <div class="row">
                        <!-- Service Type Selector -->
                        <div class="col-md-6">
                            <label for="serviceTypeSelect" class="form-label">Select Service Type</label>
                            <select id="serviceTypeSelect" name="serviceType" class="form-select">
                                <option value="">Select Service Type</option>
                                <option value="AICS">AICS</option>
                                <option value="VAW">Woman</option>
                                <option value="VAC">Youth and Children</option>
                                <option value="CAR">CAR</option>
                                <option value="CICL">CICL</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Select Service Availed</label>
                            <div class="dropdown">
                                <button class="btn border dropdown-toggle w-100" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Service
                                </button>
                                <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton"
                                    style="max-height: 300px; overflow-y: auto; width: 100%;">
                                    <div class="input-group mb-3">
                                        <input type="text" id="dropdownSearch" class="form-control"
                                            placeholder="Search..." aria-label="Search" aria-describedby="search-addon">
                                    </div>
                                    <li><a class="dropdown-item" href="#" data-value="Burial Assistance">Burial
                                            Assistance</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Counseling">Counseling</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Financial Assistance">Financial
                                            Assistance</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Food Assistance">Food
                                            Assistance</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Hospital Bill">Hospital Bill</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#" data-value="Medicine Assistance">Medicine
                                            Assistance</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Shelter Assistance">Shelter
                                            Assistance</a></li>
                                </ul>
                            </div>
                            <input type="hidden" id="selectedService" name="selectedService" value="">
                        </div>
                    </div>
                </form>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="addServiceForm">Add Services</button>
                </div>
            </div>
        </div>
    </div>
</div>