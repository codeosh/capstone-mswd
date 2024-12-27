{{-- resources\views\subpage\intakeform.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Intake Form - Page")

@section('content')

<div class="card ">
    <div class="card-header">
        <h5 class="card-title pt-2 fw-semibold">Intake Form</h5>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <strong>Reminder:</strong> Ensure to double check all information before submitting.
            </div>
        </div>

        <form id="intakeForm" autocomplete="off">
            @csrf
            <input type="hidden" id="beneficiaryID" name="beneficiaryID" value="{{ $beneficiary->id }}">
            <div class="row g-1 justify-content-end mb-3">
                <div class="col-md-2">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" id="caseDate" name="caseDate">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Case #</label>
                    <input type="text" class="form-control" id="caseNum" name="caseNum" placeholder="Enter Case #">
                </div>
            </div>
            <div class="border rounded p-3 mb-3">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Firstname</label>
                        <input type="text" class="form-control" placeholder="Enter First name" id="intakeFirstname"
                            name="firstname" value="{{ $beneficiary->firstname }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Middlename</label>
                        <input type="text" class="form-control" placeholder="Middle name" id="intakeMiddlename"
                            name="middlename" value="{{ $beneficiary->middlename }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Lastname</label>
                        <input type="text" class="form-control" placeholder="Enter Last name" id="intakeLastname"
                            name="lastname" value="{{ $beneficiary->lastname }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Suffix</label>
                        <input type="text" class="form-control" name="suffix" id="intakeSuffix"
                            value="{{ $beneficiary->suffix}}" placeholder="Suffix" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Sex</label>
                        <input type="text" class="form-control" name="sex" id="intakesex" value="{{ $beneficiary->sex}}"
                            readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                            value="{{ $beneficiary->birthdate }}" readonly>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Age</label>
                        <input name="age" id="age" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-nowrap">Informant Relation to child</label>
                        <input type="text" name="informantrelation" id="intakeInformantRelation" class="form-control"
                            placeholder="Relation to child">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Social Worker</label>
                        <input type="text" name="socialworker" id="intakeSocialWorker" class="form-control"
                            placeholder="Social worker">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 border p-3">
                        <label class="form-label">Primary complaint</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakePhysical"
                                name="primary_complaint[]" value="Physical Abuse">
                            <label class="form-check-label" for="intakePhysical">Physical abuse</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakeSexual" name="primary_complaint[]"
                                value="Sexual Abuse">
                            <label class="form-check-label" for="intakeSexual">Sexual abuse</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakeNeglect"
                                name="primary_complaint[]" value="Neglect">
                            <label class="form-check-label" for="intakeNeglect">Neglect</label>
                        </div>
                    </div>

                    <div class="col-md-4 border p-3">
                        <label class="form-label">Service sought</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakeFulleval" name="service_sought[]"
                                value="Full Eval">
                            <label class="form-check-label" for="intakeFulleval">Full eval</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakePhysicalexam"
                                name="service_sought[]" value="Physical Exam">
                            <label class="form-check-label" for="intakePhysicalexam">Physical exam</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakeInterview" name="service_sought[]"
                                value="Interview">
                            <label class="form-check-label" for="intakeInterview">Interview</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="intakePsyceval" name="service_sought[]"
                                value="Psychiatric Eval">
                            <label class="form-check-label" for="intakePsyceval">Psychiatric eval</label>
                        </div>
                    </div>

                    <div class="col-md-4 border p-3">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Referral from</label>
                                <div class="d-flex gap-3 flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakePediaER"
                                            name="referral_from[]" value="Pedia ER">
                                        <label class="form-check-label" for="intakePediaER">Pedia ER</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakePediaOPD"
                                            name="referral_from[]" value="Physical Exam">
                                        <label class="form-check-label" for="intakePediaOPD">Pedia OPD</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakeSurgeryTrauma"
                                            name="referral_from[]" value="Surgery/Trauma">
                                        <label class="form-check-label" for="intakeSurgeryTrauma">Surgery/Trauma</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakePsychiatry"
                                            name="referral_from[]" value="Psychiatry">
                                        <label class="form-check-label" for="intakePsychiatry">Psychiatry</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakeOBGyn"
                                            name="referral_from[]" value="OB-Gyn">
                                        <label class="form-check-label" for="intakeOBGyn">OB-Gyn</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakeOrtho"
                                            name="referral_from[]" value="Ortho">
                                        <label class="form-check-label" for="intakeOrtho">Ortho</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center gap-2">
                                        <label class="form-check-label mb-0" for="intakeOther">Other</label>
                                        <input class="form-control flex-grow-1" type="text" id="intakeOther"
                                            name="referral_from_other" placeholder="Specify other referral">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 border p-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="inpatientCheckbox"
                                    name="referral_type">
                                <label class="form-check-label" for="inpatientCheckbox">Inpatient</label>
                            </div>
                            <div id="inpatientOptions" class="mt-3" style="display: none;">
                                <div class="alert alert-info" role="alert">
                                    <strong>Note:</strong> If inpatient, which ward referred?
                                </div>
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakePedia"
                                            name="inpatient_ward[]" value="Pedia">
                                        <label class="form-check-label" for="intakePedia">Pedia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakeSurgery"
                                            name="inpatient_ward[]" value="Surgery">
                                        <label class="form-check-label" for="intakeSurgery">Surgery</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakeInpOrtho"
                                            name="inpatient_ward[]" value="Ortho">
                                        <label class="form-check-label" for="intakeInpOrtho">Ortho</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakePsych"
                                            name="inpatient_ward[]" value="Psych">
                                        <label class="form-check-label" for="intakePsych">Psych</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="intakeENT"
                                            name="inpatient_ward[]" value="ENT">
                                        <label class="form-check-label" for="intakeENT">ENT</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center gap-2">
                                        <label class="form-check-label mb-0" for="intakeOther">Other</label>
                                        <input class="form-control flex-grow-1" type="text" id="intakeOtherINP"
                                            name="inpatient_ward_other" placeholder="Specify other">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- End of Border --}}

            <div class="border rounded p-3 mb-3">
                <h5 class="fw-semibold text-center text-light bg-dark mb-3">PATIENT'S ADDRESS & PRESENT LOCATION</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Mother's address and Telephone</span>
                            <input type="text" class="form-control" id="motherAddress" name="motherAddress"
                                placeholder="Mother's Address">
                            <input type="text" class="form-control" placeholder="Permanent Telephone"
                                id="intakeMotherTelephone" name="motherTelephone">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Directions to address</span>
                            <input type="text" aria-label="Mother's Directions" class="form-control"
                                placeholder="Direction address" id="intakeMotherDirection"
                                name="motheraddressdirection">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Present address and Telephone</span>
                            <input type="text" class="form-control" id="intakePresentStreetname" name="presentAddress"
                                value="{{ $beneficiary->address->streetname}} {{ $beneficiary->address->barangay}} {{ $beneficiary->address->municipality}} {{ $beneficiary->address->province}}"
                                placeholder="Present Address">
                            {{-- <select type="text" class="form-select" id="intakePresentBarangay" name="barangay">
                                <option value="">Select Barangay</option>
                                <option value="Benit">Benit</option>
                                <option value="Buac Daku">Buac Daku</option>
                                <option value="Buac Gamay">Buac Gamay</option>
                                <option value="Cabadbaran">Cabadbaran</option>
                                <option value="Conception">Conception</option>
                                <option value="Consolacion">Consolacion</option>
                                <option value="Dagsa">Dagsa</option>
                                <option value="Hibod - Hibod">Hibod - Hibod</option>
                                <option value="Hindangan">Hindangan</option>
                                <option value="Hipantag">Hipantag</option>
                                <option value="Javier">Javier</option>
                                <option value="Kahupian">Kahupian</option>
                                <option value="Kanangkaan">Kanangkaan</option>
                                <option value="Kauswagan">Kauswagan</option>
                                <option value="La Purisima Conception">La Purisima Conception</option>
                                <option value="Libas">Libas</option>
                                <option value="Lum-an">Lum-an</option>
                                <option value="Mabicay">Mabicay</option>
                                <option value="Mac">Mac</option>
                                <option value="Magatas">Magatas</option>
                                <option value="Mahayahay">Mahayahay</option>
                                <option value="Malinao">Malinao</option>
                                <option value="Maria Plana">Maria Plana</option>
                                <option value="Milagroso">Milagroso</option>
                                <option value="Olisihan">Olisihan</option>
                                <option value="Pancho Villa">Pancho Villa</option>
                                <option value="Pandan">Pandan</option>
                                <option value="Rizal">Rizal</option>
                                <option value="Salvacion">Salvacion</option>
                                <option value="San Francisco Mabuhay">San Francisco Mabuhay</option>
                                <option value="San Isidro">San Isidro</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Miguel">San Miguel</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="San Roque">San Roque</option>
                                <option value="San Vicente">San Vicente</option>
                                <option value="Santa Maria">Santa Maria</option>
                                <option value="Suba">Suba</option>
                                <option value="Tampoong">Tampoong</option>
                                <option value="Zone I (Pob.)">Zone I</option>
                                <option value="Zone II (Pob.)">Zone II</option>
                                <option value="Zone III (Pob.)">Zone III</option>
                                <option value="Zone IV (Pob.)">Zone IV</option>
                                <option value="Zone V (Pob.)">Zone V</option>
                            </select> --}}
                            <input type="text" aria-label="Telephone" class="form-control"
                                placeholder="Present Telephone" id="intakePresentTelephone" name="presentTelphone">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Directions to address</span>
                            <input type="text" aria-label="Present Directions" class="form-control"
                                placeholder="Direction address" id="intakePresentDirection"
                                name="presentaddressdirection">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="ps-1">
                            <label class="form-label">Present caretaker</label>
                            <input type="text" class="form-control" placeholder="Present caretaker"
                                id="intakePresentCaretaker" name="presentcaretaker">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Child's legal status</label>
                        <select name="legalstatus" id="intakeLegalStatus" class="form-select">
                            <option value="">Select legal status</option>
                            <option value="Legitimate">Legitimate</option>
                            <option value="Illegitimate">Illegitimate</option>
                            <option value="Adopted">Adopted</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Relation to child</label>
                        <input type="text" class="form-control" placeholder="Relation to child" id="intakeRelationChild"
                            name="patientRelationChild">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Enrolled in School?</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schoolStatus" id="intakeYes"
                                    value="Yes">
                                <label class="form-check-label" for="intakeYes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schoolStatus" id="intakeNo"
                                    value="No">
                                <label class="form-check-label" for="intakeNo">
                                    No
                                </label>
                            </div>
                        </div>

                        <div id="atInputDiv" class="mt-2" style="display: none;">
                            <div class="d-flex align-items-center">
                                <label class="form-label mb-0" for="atInput" style="min-width: 50px;">At:</label>
                                <input type="text" class="form-control ms-2" id="atInput" name="intakeSchool"
                                    placeholder="Enter location">
                                <input type="text" class="form-control ms-2" id="atInput" name="intakeEducationalLvl"
                                    placeholder="Educational level">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Family contact</label>
                        <input type="text" class="form-control" id="intakeFamilyContact" name="familyContact"
                            placeholder="Family Contact">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Family address</label>
                        <input type="text" class="form-control" id="intakeFamilyAddress" name="familyAddress"
                            placeholder="Family Address">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Contact Relation to child</label>
                        <input type="text" class="form-control" id="intakeContactRelationChild"
                            name="contactRelationChild" placeholder="Contact Relation to Child">
                    </div>
                </div>
            </div> {{-- End of Border --}}

            <div class="border rounded p-3 mb-3">
                <h5 class="fw-semibold text-center text-light bg-dark mb-3">FAMILY COMPOSITION</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 9%;">Relation to child</th>
                            <th class="text-center" style="width: 9%;">Name</th>
                            <th class="text-center" style="width: 9%;">Lives w/ child?</th>
                            <th class="text-center" style="width: 9%;">Age/Gender?</th>
                            <th class="text-center" style="width: 9%;">Civil Status</th>
                            <th class="text-center" style="width: 9%;">Employed?</th>
                            <th class="text-center" style="width: 9%;">Occupation</th>
                            <th class="text-center" style="width: 9%;">Education</th>
                            <th class="text-center" style="width: 9%;">Weekly Income</th>
                            <th class="text-center" style="width: 9%;">School Company</th>
                            <th class="text-center" style="width: 9%;">Contact Information</th>
                        </tr>
                    </thead>
                    <tbody id="familyCompositionTable">
                        <tr>
                            <td><input type="text" class="form-control" name="family[0][relation]"
                                    placeholder="Relation to child"></td>
                            <td><input type="text" class="form-control" name="family[0][name]" placeholder="Name"></td>
                            <td><input type="text" class="form-control" name="family[0][lives_with_child]"
                                    placeholder="Lives w/ child?"></td>
                            <td><input type="text" class="form-control" name="family[0][age_gender]"
                                    placeholder="Age/Gender?"></td>
                            <td><input type="text" class="form-control" name="family[0][civil_status]"
                                    placeholder="Civil Status"></td>
                            <td><input type="text" class="form-control" name="family[0][employed]"
                                    placeholder="Employed?"></td>
                            <td><input type="text" class="form-control" name="family[0][occupation]"
                                    placeholder="Occupation"></td>
                            <td><input type="text" class="form-control" name="family[0][education]"
                                    placeholder="Education"></td>
                            <td><input type="text" class="form-control" name="family[0][weekly_income]"
                                    placeholder="Weekly Income"></td>
                            <td><input type="text" class="form-control" name="family[0][school_company]"
                                    placeholder="School Company"></td>
                            <td><input type="text" class="form-control" name="family[0][contact_info]"
                                    placeholder="Contact Information"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="button" id="addRow" class="btn btn-success mb-2">Add Row</button>
                    <button type="button" id="removeRow" class="btn btn-danger mb-2">Remove Row</button>
                </div>

                <div class="border rounded p-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Socio-economic Status</label>
                            <select name="socioEconomic" id="intakeSocioEconomic" class="form-select">
                                <option value="">Select Option</option>
                                <option value="Low">Low</option>
                                <option value="Middle">Middle</option>
                                <option value="Upper">Upper</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label"># of Children</label>
                            <input type="text" class="form-control" id="intakeChildrenNum" name="childrenNum"
                                placeholder="# of Children">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label"># of Individual family members</label>
                            <input type="text" class="form-control" id="intakeFamilyMembers" name="numberFamilyMembers"
                                placeholder="# of Family Members">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-nowrap"># of families in household</label>
                            <input type="text" class="form-control" id="intakeFamilyHousehold"
                                name="numberFamilyHousehold" placeholder="# of Family Household">
                        </div>
                    </div>
                </div>
            </div>{{-- End of Border --}}

            <div class="border rounded p-3">
                <h5 class="fw-semibold text-center text-light bg-dark mb-3">FOR INCEST CASES ONLY</h5>
                <table class="table table-bordered">
                    <tr>
                        <td class="fw-semibold" style="width: 20%;">Regular sleeping arrangement</td>
                        <td>
                            <div class="d-flex gap-3 flex-wrap align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="At home" id="intakeAtHome"
                                        name="regular_sleep[]">
                                    <label class="form-check-label" for="intakeAtHome">At home</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="On the street"
                                        id="intakeOnStreet" name="regular_sleep[]">
                                    <label class="form-check-label" for="intakeOnStreet">On the street</label>
                                </div>
                                <div class="form-label mb-0">In a shelter:</div>
                                <input type="text" class="form-control" id="intakeInShelter" name="regular_shelter"
                                    placeholder="In a shelter" style="width:200px; height: 30px;">
                                <div class="form-label mb-0">Other:</div>
                                <input type="text" class="form-control" id="intakeIncOther" name="regular_other"
                                    placeholder="Other" style="width:200px; height: 30px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-semibold" style="width: 20%;">Same bed/mat with</td>
                        <td>
                            <div class="d-flex gap-3 flex-wrap align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Adult male"
                                        id="intakeAdultMale" name="same_bed[]">
                                    <label class="form-check-label" for="intakeAdultMale">Adult male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Adult female"
                                        id="intakeAdultFemale" name="same_bed[]">
                                    <label class="form-check-label" for="intakeAdultFemale">Adult female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Male child(ren)"
                                        id="intakeMaleChildren" name="same_bed[]">
                                    <label class="form-check-label" for="intakeMaleChildren">Male child(ren)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Female child(ren)"
                                        id="intakeFemaleChildren" name="same_bed[]">
                                    <label class="form-check-label" for="intakeFemaleChildren">Female child(ren)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Alone" id="intakeBedAlone"
                                        name="same_bed[]">
                                    <label class="form-check-label" for="intakeBedAlone">Alone</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-semibold" style="width: 20%;">Same room with</td>
                        <td>
                            <div class="d-flex gap-3 flex-wrap align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Adult male"
                                        id="intakeAdultMaleRoom" name="same_room[]">
                                    <label class="form-check-label" for="intakeAdultMaleRoom">Adult male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Adult female"
                                        id="intakeAdultFemaleRoom" name="same_room[]">
                                    <label class="form-check-label" for="intakeAdultFemaleRoom">Adult female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Male child(ren)"
                                        id="intakeMaleChildrenRoom" name="same_room[]">
                                    <label class="form-check-label" for="intakeMaleChildrenRoom">Male child(ren)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Female child(ren)"
                                        id="intakeFemaleChildrenRoom" name="same_room[]">
                                    <label class="form-check-label" for="intakeFemaleChildrenRoom">Female
                                        child(ren)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Alone" id="intakeRoomAlone"
                                        name="same_room[]">
                                    <label class="form-check-label" for="intakeRoomAlone">Alone</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>{{-- End of Border --}}

            <div class="border rounded p-3 mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center bg-dark text-white">LIVING ARRANGEMENT AT TIME OF ABUSE</th>
                            <th class="text-center bg-dark text-white">LIVING ARRANGEMENT AT PRESENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row ps-2 pe-2">
                                    <div class="col-md-6 border">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="Street child"
                                                id="intakeStreetChild" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeStreetChild">Street child</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Street family"
                                                id="intakeStreetFamily" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeStreetFamily">Street
                                                family</label>
                                        </div>

                                        <div class="d-flex flex-column mb-1">
                                            <label class="form-label mb-0">NGO shelter</label>
                                            <input type="text" class="form-control" id="intakeNGOShelter"
                                                name="ngoShelterAbuse" style="height: 30px;">
                                        </div>

                                        <div class="d-flex flex-column mb-2">
                                            <label class="form-label mb-0">Govt agency</label>
                                            <input type="text" class="form-control" id="intakeGovtAgency"
                                                name="govtAgencyAbuse" style="height: 30px;">
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Unknown"
                                                id="intakeAbuseUnknown" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeAbuseUnknown">Unkown</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 border">
                                        <div class="form-check mt-3 mb-3">
                                            <input class="form-check-input" type="checkbox" value="Single parent"
                                                id="intakeSingleParent" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeSingleParent">Single
                                                parent</label>
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Immediate family"
                                                id="intakeImmediateFamily" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeImmediateFamily">Immediate
                                                family</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Extended family"
                                                id="intakeExtendedFamily" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeExtendedFamily">Extended
                                                family</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Relatives"
                                                id="intakeRelatives" name="arrangement_abuse[]">
                                            <label class="form-check-label" for="intakeRelatives">Relatives</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Non-relatives"
                                                id="intakeNonRelatives" name="arrangement_abuse[]">
                                            <label class="form-check-label"
                                                for="intakeNonRelatives">Non-relatives</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row ps-2 pe-2">
                                    <div class="col-md-6 border">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value="Street child"
                                                id="intakeStreetChildPresent" name="arrangement_present[]">
                                            <label class="form-check-label" for="intakeStreetChildPresent">Street
                                                child</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Street family"
                                                id="intakeStreetFamilyPresent" name="arrangement_present[]">
                                            <label class="form-check-label" for="intakeStreetFamilyPresent">Street
                                                family</label>
                                        </div>

                                        <div class="d-flex flex-column mb-1">
                                            <label class="form-label mb-0">NGO shelter</label>
                                            <input type="text" class="form-control" id="intakeNGOShelterPresent"
                                                name="ngoShelterPresent" style="height: 30px;">
                                        </div>

                                        <div class="d-flex flex-column mb-2">
                                            <label class="form-label mb-0">Govt agency</label>
                                            <input type="text" class="form-control" id="intakeGovtAgencyPresent"
                                                name="govtAgencyPresent" style="height: 30px;">
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Unknown"
                                                id="intakeAbuseUnknownPresent" name="arrangement_present[]">
                                            <label class="form-check-label"
                                                for="intakeAbuseUnknownPresent">Unkown</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 border">
                                        <div class="form-check mt-3 mb-3">
                                            <input class="form-check-input" type="checkbox" value="Single parent"
                                                id="intakeSingleParentPresent" name="arrangement_present[]">
                                            <label class="form-check-label" for="intakeSingleParentPresent">Single
                                                parent</label>
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Immediate family"
                                                id="intakeImmediateFamilyPresent" name="arrangement_present[]">
                                            <label class="form-check-label" for="intakeImmediateFamilyPresent">Immediate
                                                family</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Extended family"
                                                id="intakeExtendedFamilyPresent" name="arrangement_present[]">
                                            <label class="form-check-label" for="intakeExtendedFamilyPresent">Extended
                                                family</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Relatives"
                                                id="intakeRelativesPresent" name="arrangement_present[]">
                                            <label class="form-check-label"
                                                for="intakeRelativesPresent">Relatives</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Non-relatives"
                                                id="intakeNonRelativesPresent" name="arrangement_present[]">
                                            <label class="form-check-label"
                                                for="intakeNonRelativesPresent">Non-relatives</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>{{-- End of Border --}}

            <div class="border rounded p-3 mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Other Information</label>
                            <textarea class="form-control" name="otherInformation" id="intakeOtherInformation" rows="3"
                                placeholder="Other information"></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="card-footer">
        <div class="row mt-2">
            <div class="col text-end">
                <button type="submit" class="btn btn-primary" form="intakeForm" id="intakeSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
@endsection