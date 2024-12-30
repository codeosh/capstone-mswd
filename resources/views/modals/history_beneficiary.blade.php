{{-- resources\views\modals\history_beneficiary.blade.php --}}
<div class="modal fade" id="historyBeneficiaryModal" tabindex="-1" aria-labelledby="historyBeneficiaryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyBeneficiaryModalLabel">
                    History Beneficiary
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="historyBeneficiaryId" name="beneficiary_id">
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

                <div class="table-responsive border shadow rounded" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped text-nowrap">
                        <thead class="text-center">
                            <tr>
                                <th>Service Type</th>
                                <th>Service Availed</th>
                                <th>Exp Date</th>
                                <th>Date Availed</th>
                                <th>Time Availed</th>
                            </tr>
                        </thead>
                        <tbody id="historyBeneficiaryTable" class="align-middle text-center">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>