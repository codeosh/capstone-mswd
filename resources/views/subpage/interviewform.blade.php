{{-- resources\views\subpage\interviewform.blade.php --}}
@extends('layouts.main_layout')

@section('title', "MSWDO - Interview Form - Page")

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title pt-2 fw-semibold">Interview Form</h5>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <strong>Reminder:</strong> Ensure to double check all information before submitting.
            </div>
        </div>

        <form id="interviewForm" autocomplete="off">
            @csrf
            <input type="hidden" id="beneficiaryID" name="beneficiaryID" value="{{ $beneficiary->id }}">
            <div class="row g-1 justify-content-end mb-3">
                <div class="col-md-2">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" id="caseDateInt" name="caseDate">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Case #</label>
                    <input type="text" class="form-control" id="caseNumInt" name="caseNum" placeholder="Enter Case #">
                </div>
            </div>

            <div class="border rounded p-3 mb-3">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Firstname</label>
                        <input type="text" class="form-control" placeholder="Enter First name" id="interviewFirstname"
                            name="firstname" value="{{ $beneficiary->firstname }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Middlename</label>
                        <input type="text" class="form-control" placeholder="Middle name" id="intakeMiddlename"
                            name="middlename" value="{{ $beneficiary->middlename }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Lastname</label>
                        <input type="text" class="form-control" placeholder="Enter Last name" id="intakeLastname"
                            name="lastname" value="{{ $beneficiary->lastname }}" required>
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
                    <div class="col-md-5">
                        <label class="form-label text-nowrap">Relation to child</label>
                        <input type="text" name="relationchild" id="intRelationChild" class="form-control"
                            placeholder="Relation to child">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Physician</label>
                        <input type="text" name="physician" id="intPhysician" class="form-control"
                            placeholder="Physician">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Social Worker</label>
                        <input type="text" name="socialworker" id="intSocialWorker" class="form-control"
                            placeholder="Social worker">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Historian</label>
                        <input type="text" name="historian" id="intHistorian" class="form-control"
                            placeholder="Historian">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 border p-3">
                        <label class="form-label">Interviewed before by</label>
                        <div class="d-flex gap-3 align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="NBI" name="Interviewed_before[]"
                                    value="NBI">
                                <label class="form-check-label" for="NBI">NBI</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="PNP" name="Interviewed_before[]"
                                    value="PNP">
                                <label class="form-check-label" for="PNP">PNP</label>
                            </div>

                            <div class="form-check d-flex align-items-center gap-2">
                                <label class="form-check-label mb-0" for="interviewOther">Other</label>
                                <input class="form-control flex-grow-1" type="text" id="interviewOther"
                                    name="intBeforeOther" placeholder="Specify other">
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="statement"
                                    name="Interviewed_before[]" value="Has Sstatement">
                                <label class="form-check-label" for="statement">has statement</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="none" name="Interviewed_before[]"
                                    value="None">
                                <label class="form-check-label" for="none">None</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 border p-3">
                        <label class="form-label">Deferring Interview?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Child" name="Deferring_Interview[]"
                                value="Child upset">
                            <label class="form-check-label" for="Child">Child upset</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Not_disclosing"
                                name="Deferring_Interview[]" value="Not disclosing">
                            <label class="form-check-label" for="Not_disclosing">Not disclosing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Previous_statement"
                                name="Deferring_Interview[]" value="Previous statement">
                            <label class="form-check-label" for="Previous_statement">Previous statement</label>
                        </div>

                        <div class="d-flex gap-3 align-items-center mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Deferring_NBI"
                                    name="Deferring_Interview[]" value="NBI">
                                <label class="form-check-label" for="Deferring_NBI">NBI</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Deferring PNP"
                                    name="Deferring_Interview[]" value="Deferring_PNP">
                                <label class="form-check-label" for="Deferring_PNP">PNP</label>
                            </div>

                            <div class="form-check d-flex align-items-center gap-2">
                                <label class="form-check-label mb-0" for="Deferring_Other">Other</label>
                                <input class="form-control flex-grow-1" type="text" id="Deferring_other"
                                    name="Deferring_other" placeholder="Specify other">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 border p-3">
                        <label class="form-label d-block mb-0">Other observers of interview:</label>
                        <small class="text-muted">Separate names with a comma (e.g., John Doe, Jane Smith)</small>
                        <textarea class="form-control mt-1" id="intOtherObserver" name="other_observer"
                            placeholder="Enter observer names here..." style="height: 150px; resize: none;"></textarea>
                    </div>
                </div>
            </div>

            <div class="border rounded p-3 mb-3">
                <h5 class="fw-semibold text-center text-light bg-dark mb-3">CHIEF COMPLAINT</h5>
                <div class="row">
                    <div class="col-md-4 border p-3">
                        <label class="form-label fw-bold">DISCLOSURE OF ABUSE</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Physical" name="disclosure_abuse[]"
                                value="Physical">
                            <label class="form-check-label" for="Physical">Physical</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Sexual" name="disclosure_abuse[]"
                                value="Sexual">
                            <label class="form-check-label" for="Sexual">Sexual</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Neglect" name="disclosure_abuse[]"
                                value="Neglect">
                            <label class="form-check-label" for="Neglect">Neglect</label>
                        </div>

                        <label class="form-label fw-bold mt-3">BEHAVIORAL CHANGES</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Depression" name="behavioral_change[]"
                                value="Depression">
                            <label class="form-check-label" for="Depression">Depression</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Blank-stares-withdrawal"
                                name="behavioral_change[]" value="Blank stares, withdrawal">
                            <label class="form-check-label" for="Blank-stares-withdrawal">Blank stares,
                                withdrawal</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Nightmares-sleep-disturbances"
                                name="behavioral_change[]" value="Nightmares, sleep disturbances">
                            <label class="form-check-label" for="Nightmares-sleep-disturbances">Nightmares, sleep
                                disturbances</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Loss-of-appetite"
                                name="behavioral_change[]" value="Loss of appetite">
                            <label class="form-check-label" for="Loss-of-appetite">Loss of appetite</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Suicide-attempt-ideation"
                                name="behavioral_change[]" value="Suicide attempt, ideation">
                            <label class="form-check-label" for="Suicide-attempt-ideation">Suicide attempt,
                                ideation</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Truancy-problems-at-school"
                                name="behavioral_change[]" value="Truancy, problems at school">
                            <label class="form-check-label" for="Truancy-problems-at-school">Truancy, problems at
                                school</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Anxiety-hyperactivity"
                                name="behavioral_change[]" value="Anxiety, hyperactivity">
                            <label class="form-check-label" for="Anxiety-hyperactivity">Anxiety, hyperactivity</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Running -away-from-home"
                                name="behavioral_change[]" value="Running away from home">
                            <label class="form-check-label" for="Running -away-from-home">Running away from home</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Aggression-anger"
                                name="behavioral_change[]" value="Aggression, anger">
                            <label class="form-check-label" for="Aggression-anger">Aggression, anger</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Self-mutilation"
                                name="behavioral_change[]" value="Self-mutilation">
                            <label class="form-check-label" for="Self-mutilation">Self-mutilation</label>
                        </div>


                        <div class="d-flex align-items-center gap-2">
                            <label class="form-check-label" for="Psychotic-episodes"
                                style="white-space: nowrap;">Psychotic
                                episodes</label>
                            <input class="form-control" type="text" id="Psychotic-episodes" name="psychotic_ep">
                        </div>


                    </div>

                    <div class="col-md-4 border p-3">
                        <label class="form-label fw-bold">PHYSICAL COMPLAINTS</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Bruises" name="physical_complaint[]"
                                value="Bruises">
                            <label class="form-check-label" for="Bruises">Bruises</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Burns" name="physical_complaint[]"
                                value="Burns">
                            <label class="form-check-label" for="Burns">Burns</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Fractures" name="physical_complaint[]"
                                value="Fractures">
                            <label class="form-check-label" for="Fractures">Fractures</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Cuts-Wounds-Lacerations"
                                name="physical_complaint[]" value="Cuts, Wounds, Lacerations">
                            <label class="form-check-label" for="Cuts-Wounds-Lacerations">Cuts, Wounds,
                                Lacerations</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Poisoning" name="physical_complaint[]"
                                value="Poisoning">
                            <label class="form-check-label" for="Poisoning">Poisoning</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Scars" name="physical_complaint[]"
                                value="Scars (healed injuries)">
                            <label class="form-check-label" for="Scars">Scars (healed injuries)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Unexpalined-injuries"
                                name="physical_complaint[]" value="Unexpalined injuries">
                            <label class="form-check-label" for="Unexpalined-injuries">Unexpalined injuries</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Dead-on-Arrival"
                                name="physical_complaint[]" value="Dead on Arrival">
                            <label class="form-check-label" for="Dead-on-Arrival">Dead on Arrival</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="injured-dying"
                                name="physical_complaint[]" value="Seriously injured/dying">
                            <label class="form-check-label" for="injured-dying">Seriously injured/dying</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Vaginal-bleeding"
                                name="physical_complaint[]" value="Vaginal bleeding">
                            <label class="form-check-label" for="Vaginal-bleeding">Vaginal bleeding</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Vaginal-penile"
                                name="physical_complaint[]" value="Vaginal/penile discharge">
                            <label class="form-check-label" for="Vaginal-penile">Vaginal/penile discharge</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Anogenital-pain"
                                name="physical_complaint[]" value="Anogenital pain">
                            <label class="form-check-label" for="Anogenital-pain">Anogenital pain</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Anogenital-injury"
                                name="Pphysical_complaint[]" value="Anogenital injury">
                            <label class="form-check-label" for="Anogenital-injury">Anogenital injury</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Sexual-knowledge"
                                name="physical_complaint[]" value="Sexual knowledge beyond age">
                            <label class="form-check-label" for="Sexual-knowledge">Sexual knowledge beyond age</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Sexualized-behavior"
                                name="physical_complaint[]" value="Sexualized behavior">
                            <label class="form-check-label" for="Sexualized-behavior">Sexualized behavior</label>
                        </div>
                    </div>

                    <div class="col-md-4 border p-3">
                        <label class="form-label fw-bold">NEGLECT</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Abandonement" name="neglect_complaint[]"
                                value="Abandonement">
                            <label class="form-check-label" for="Abandonement">Abandonement</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Dirty-unkempt"
                                name="neglect_complaint[]" value="Dirty, unkempt">
                            <label class="form-check-label" for="Dirty-unkempt">Dirty, unkempt</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Undernourished"
                                name="neglect_complaint[]" value="Undernourished">
                            <label class="form-check-label" for="Undernourished">Undernourished</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Untreated-medical-problems"
                                name="neglect_complaint[]" value="Untreated medical problems">
                            <label class="form-check-label" for="Untreated-medical-problems">Untreated medical
                                problems</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Failing-to-thrive"
                                name="neglect_complaint[]" value="Failing to thrive">
                            <label class="form-check-label" for="Failing-to-thrive">Failing to thrive</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Delayed-development"
                                name="neglect_complaint[]" value="Delayed development">
                            <label class="form-check-label" for="Delayed-development">Delayed development</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Lack-of-supervision"
                                name="neglect_complaint[]" value="Lack of supervision">
                            <label class="form-check-label" for="Lack-of-supervision">Lack of supervision</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Neglected-schooling"
                                name="neglect_complaint[]" value="Neglected schooling">
                            <label class="form-check-label" for="Neglected-schooling">Neglected schooling</label>
                        </div>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            <label class="form-check-label mb-0" for="NeglectOther">Other</label>
                            <input class="form-control flex-grow-1" type="text" id="NeglectOther" name="neglect_other"
                                placeholder="Specify other">
                        </div>


                        <div class="form-check mt-5">
                            <input class="form-check-input" type="checkbox" id="Witnessed-child-abuse"
                                name="neglect_complaint[]" value="Witnessed child abuse">
                            <label class="form-check-label" for="Witnessed-child-abuse">Witnessed child abuse</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Witnessed-physical-abuse"
                                name="neglect_complaint[]" value="Witnessed physical abuse">
                            <label class="form-check-label" for="Witnessed-physical-abuse">Witnessed physical
                                abuse</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Witnessed-sexual-abuse"
                                name="neglect_complaint[]" value="Witnessed sexual abuse">
                            <label class="form-check-label" for="Witnessed-sexual-abuse">Witnessed sexual abuse</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border rounded p-3 mb-3">
                <h5 class="fw-semibold text-center text-light bg-dark mb-3">HISTORY OF ABUSE</h5>
                <div class="row">
                    <div class="col-md-6 border p-3">
                        <label class="form-label fw-bold d-block text-center">INCIDENTS</label>
                        <div class="d-flex align-items-center justify-content-around gap-2">
                            <div class="form-check">
                                <input class="form-check-input radio_checkbox" data-group="group1" type="checkbox"
                                    id="Information-from-Historian" name="incident_from"
                                    value="Information from Historian">
                                <label class="form-check-label" for="Information-from-Historian">Information from
                                    Historian</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_checkbox" data-group="group1" type="checkbox"
                                    id="No-Information-Available" name="incident_from" value="No Information Available">
                                <label class="form-check-label" for="No-Information-Available">No Information
                                    Available</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Date of Most Recent
                                    Incident:</label>
                                <input class="form-control" type="date" name="date_recentIncident">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label fw-bold">Time:</label>
                                <input class="form-control" type="time" name="time_recentIncident">
                            </div>

                            <div class="col-md-12 d-flex align-items-center gap-3 mt-3">
                                <div class="d-flex flex-column flex-grow-1">
                                    <label class="form-label fw-bold">Other Chronological
                                        Clues:</label>
                                    <input type="text" name="other_recentIncident" class="form-control">
                                </div>

                                <div class="form-check d-flex align-items-center" style="margin-top: 32px;">
                                    <input type="checkbox" class="form-check-input me-2" id="most_unknown"
                                        name="other_recentIncident" value="Unknown" style="margin-top: 0;">
                                    <label for="most_unknown" class="form-check-label">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Date of First Abusive
                                    Incident:</label>
                                <input class="form-control" type="date" name="date_firstAbuse">
                            </div>

                            <div class="col-md-5">
                                <label for="time-incident" class="form-label fw-bold">Time:</label>
                                <input class="form-control" type="time" id="time-incident" name="time_firstAbuse">
                            </div>

                            <div class="col-md-12 d-flex align-items-center gap-3 mt-3">
                                <div class="d-flex flex-column flex-grow-1">
                                    <label class="form-label fw-bold">Other Chronological
                                        Clues:</label>
                                    <input type="text" name="other_firstAbuse" class="form-control">
                                </div>

                                <div class="form-check d-flex align-items-center" style="margin-top: 32px;">
                                    <input type="checkbox" class="form-check-input me-2" id="other_firstUnknown"
                                        name="other_firstAbuse" value="Unknown" style="margin-top: 0;">
                                    <label for="other_firstUnknown" class="form-check-label">Unknown</label>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="InformationUnknown"
                                name="other_incidentDetails[]" value="Unknown">
                            <label class="form-check-label" for="InformationUnknown">Unknown</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Single-episode-of-abuse"
                                name="other_incidentDetails[]" value="Single episode of abuse">
                            <label class="form-check-label" for="Single-episode-of-abuse">Single episode of
                                abuse</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Multiple-episode-over-short-time-period"
                                name="other_incidentDetails[]" value="Multiple episode over short time period">
                            <label class="form-check-label" for="Multiple-episode-over-short-time-period">Multiple
                                episode
                                over short time period</label>
                        </div>

                        <div class="d-flex m-0 align-items-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Chronic-abuse"
                                    name="other_incidentDetails[]" value="Chronic abuse (greater than 6 months)">
                                <label class="form-check-label" for="Chronic-abuse">Chronic abuse (greater than 6
                                    months)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Unknown-Episodes"
                                    name="other_incidentDetails[]" value="Unknown # of Episodes">
                                <label class="form-check-label" for="Unknown-Episodes">Unknown # of Episodes</label>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2 flex-wrap mt-3">
                            <label class="form-check-label">Estimated duration of Abuse: </label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input radio_checkbox" data-group="group2" type="checkbox"
                                        id="1-7Days" name="duration_abuse" value="1-7 days">
                                    <label class="form-check-label" for="1-7Days">1-7 days</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio_checkbox" data-group="group2" type="checkbox"
                                        id="2months" name="duration_abuse" value="1 wk - 2 months">
                                    <label class="form-check-label radio_checkbox" for="2months">1 wk - 2 months</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio_checkbox" data-group="group2" type="checkbox"
                                        id="6months" name="duration_abuse" value="2 - 6 months">
                                    <label class="form-check-label" for="6months">2 - 6 months</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio_checkbox" data-group="group2" type="checkbox"
                                        id="over6months" name="duration_abuse" value="2 - 6 months">
                                    <label class="form-check-label" for="over6months">> 6 months</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input radio_checkbox" data-group="group2" type="checkbox"
                                        id="durationAbuse" name="duration_abuse" value="Unknown">
                                    <label class="form-check-label" for="durationAbuse">Unknown</label>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-5">
                        <div class="row">
                            <div class="col d-flex align-items-center  justify-content-end gap-2">
                                <label for="interview_Witnessed">Witnessed?</label>
                                <input class="form-check-input radio_checkbox" data-group="group3" type="checkbox"
                                    id="interview_WitnessedYes" name="other_witnessed" value="Yes">
                                <label class="form-check-label" for="interview_WitnessedYes">Yes</label>
                                <input class="form-check-input radio_checkbox" data-group="group3" type="checkbox"
                                    id="interview_WitnessedNo" name="other_witnessed" value="No">
                                <label class="form-check-label" for="interview_WitnessedNo">No</label>
                            </div>
                        </div>
                        <div class="col mb-3 mt-3">
                            <div class="row-md-3 d-flex align-items-center gap-2 flex-wrap">
                                <label class="form-label fw-bold">Site of Abuse:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="interview_siteofAbuseUnknown"
                                        name="site_abuse[]" value="Unknown">
                                    <label class="form-check-label mb-0"
                                        for="interview_siteofAbuseUnknown">Unknown</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="interview_siteofAbuseChildHome"
                                        name="site_abuse[]" value="Child's home">
                                    <label class="form-check-label mb-0" for="interview_siteofAbuseChildHome">Child's
                                        home</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="interview_siteofAbuseSchool"
                                        name="site_abuse[]" value="School">
                                    <label class="form-check-label mb-0"
                                        for="interview_siteofAbuseSchool">School</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="interview_siteofAbusePerpetrators" name="site_abuse[]"
                                        value="Perpetrator's">
                                    <label class="form-check-label mb-0"
                                        for="interview_siteofAbusePerpetrators">Perpetrator's</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="interview_siteofAbusePublicplace" name="site_abuse[]" value="Public place">
                                    <label class="form-check-label mb-0" for="interview_siteofAbusePublicplace">Public
                                        place</label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-1 mt-3">
                                <label class="form-label mb-0">Witness: </label>
                                <input type="text" class="form-control" id="interview_Witness" name="incident_witness">
                                <label class="form-label mb-0">Relation to child: </label>
                                <input type="text" class="form-control" id="interview_RelationtoChild"
                                    name="incident_relationChild">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border p-3">
                        <label class="form-label fw-bold d-block text-center mb-2"
                            style="margin-top:1rem">DISCLOSURE</label>
                        <hr style="margin-top:2rem ">
                        <div class="row-md-3 d-flex align-items-center gap-3 flex-wrap">
                            <label class="form-label mb-0">Did the patient disclose? </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="interview_patientDiscloseYes"
                                    name="interview_disclosureHistory[]" value="Yes">
                                <label class="form-check-label mb-0" for="interview_patientDiscloseYes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="interview_patientDiscloseNo"
                                    name="interview_disclosureHistory[]" value="No">
                                <label class="form-check-label mb-0" for="interview_patientDiscloseNo">No</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="interview_patientDiscloseN/A"
                                    name="interview_disclosureHistory[]" value="N/A">
                                <label class="form-check-label mb-0" for="interview_patientDiscloseN/A">N/a</label>
                            </div>
                        </div>
                        <div class="row-md-3 d-flex align-items-center justify-content-center mt-3 gap-3">
                            <label class="form-label fw-bold text-center mb-0">If Yes. </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="interview_patientDiscloseifYesVoluntary" name="interview_VoluntaryHistory[]"
                                    value="Voluntary">
                                <label class="form-check-label mb-0"
                                    for="interview_patientDiscloseifYesVoluntary">Voluntary</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    id="interview_patientDiscloseifYesElicited" name="interview_VoluntaryHistory[]"
                                    value="Elicited">
                                <label class="form-check-label mb-0"
                                    for="interview_patientDiscloseifYesElicited">Elicited</label>
                            </div>
                        </div>

                        <div class="row-md-3 d-flex align-items-center mt-5  mb-3 gap-3">
                            <label class="form-label mb-0">Did the patient recant?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="interview_patientRecantYes"
                                    name="interview_recantHistory[]" value="Yes">
                                <label class="form-check-label mb-0" for="interview_patientRecantYes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="interview_patientRecantNo"
                                    name="interview_recantHistory[]" value="No">
                                <label class="form-check-label mb-0" for="interview_patientRecantNo">No</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="interview_patientRecantN/A"
                                    name="interview_recantHistory[]" value="N/A">
                                <label class="form-check-label mb-0" for="interview_patientRecantN/A">N/A</label>
                            </div>
                        </div>
                        <hr>
                        <div class="col mt-5">
                            <div class="row-md-3 d-flex align-items-center mb-3 gap-4">
                                <label class="form-label fw-bold mb-0">To whom did child disclose firsty? </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="interview_childDiscloseFemale"
                                        name="interview_disclosureHistory[]" value="Female">
                                    <label class="form-check-label mb-0"
                                        for="interview_childDiscloseFemale">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="interview_childDiscloseMale"
                                        name="interview_disclosureHistory[]" value="Male">
                                    <label class="form-check-label mb-0" for="interview_childDiscloseMale">Male</label>
                                </div>
                            </div>
                            <div class="col mt-5">
                                <label class="form-label fw-bold">Name:</label>
                                <div class="row-md-3 d-flex align-items-center mb-3 mt-3 gap-4 flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseMother" name="interview_disclosureHistory[]"
                                            value="Mother">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseMother">Mother</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseFather" name="interview_disclosureHistory[]"
                                            value="Father">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseFather">Father</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseFriend" name="interview_disclosureHistory[]"
                                            value="Friend">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseFriend">Friend</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDisclosePhysician" name="interview_disclosureHistory[]"
                                            value="Physician">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDisclosePhysician">Physician</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseSister" name="interview_disclosureHistory[]"
                                            value="Sister">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseSister">Sister</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseBrother" name="interview_disclosureHistory[]"
                                            value="Brother">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseBrother">Brother</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseNeighbor" name="interview_disclosureHistory[]"
                                            value="Neighbor">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseNeighbor">Neighbor</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseCousin" name="interview_disclosureHistory[]"
                                            value="Cousin">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseCousin">Cousin</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="interview_childDiscloseAunt"
                                            name="interview_disclosureHistory[]" value="Aunt">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseAunt">Aunt</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseUncle" name="interview_disclosureHistory[]"
                                            value="Uncle">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseUncle">Uncle</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseTeacher" name="interview_disclosureHistory[]"
                                            value="Teacher">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseTeacher">Teacher</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseSocialWorker"
                                            name="interview_disclosureHistory[]" value="Social Worker">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseSocialWorker">Social Worker</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseGrandmother" name="interview_disclosureHistory[]"
                                            value="Grandmother">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseGrandmother">Grandmother</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseGrandfather" name="interview_disclosureHistory[]"
                                            value="Grandfather">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseGrandfather">Grandfather</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="interview_childDiscloseClassmate" name="interview_disclosureHistory[]"
                                            value="Classmate">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseClassmate">Classmate</label>
                                    </div>

                                    <div class="d-flex align-items-center gap-2">
                                        <label class="form-check-label mb-0"
                                            for="interview_childDiscloseOther">Other</label>
                                        <input class="form-control form-grow-1" type="text"
                                            id="interview_childDiscloseOther" name="interview_disclosureHistory[]"
                                            style="width: auto;">
                                    </div>
                                </div>
                                <hr>
                                <label class="form-label" for="interview_childDiscloseDescribe">Describe circumstances
                                    surrounding the initial disclosure:</label>
                                <textarea class="form-control" id="interview_childDiscloseDescribe"
                                    name="interview_disclosureHistory[]"
                                    style="height: 150px; resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End border --}}



            {{-- ACTS DESCRIBED BY THE CHILD AND OR A HISTORIAN --}}
            <div class="border rounded p-3 mb-3">
                <h5 class="fw-semibold text-center text-light bg-dark mb-3">ACTS DESCRIBED BY THE CHILD AND/OR A
                    HISTORIAN
                </h5>
                <div class="col mt-4">
                    <div class="row-md-3 d-flex align-items-center justify-content-center mb-3 gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                id="interview_actsDescribeHistorianNodisclosure"
                                name="interview_actsDescribeHistorian[]" value="No disclosure by child">
                            <label class="form-check-label mb-0" for="interview_actsDescribeHistorianNodisclosure">No
                                disclosure by child</label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox"
                                id="interview_actsDescribeHistorianpreviousdisclosure"
                                name="interview_actsDescribeHistorian[]"
                                value="Relying on child's previous disclosure to">
                            <label class="form-check-label me-2 mb-0"
                                for="interview_actsDescribeHistorianpreviousdisclosure">
                                Relying on child's previous disclosure to
                            </label>
                            <input class="form-control w-auto" type="text" name="interview_actsDescribeHistorian[]">
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                id="interview_actsDescribeHistorianNoinformation"
                                name="interview_actsDescribeHistorian[]" value="Historian has no information">
                            <label class="form-check-label mb-0"
                                for="interview_actsDescribeHistorianNoinformation">Historian has no information</label>
                        </div>
                    </div>
                    {{-- end row --}}
                    <div class="d-flex align-items-center justify-content-center">
                        <small class="text-muted">Please Check the Appropriate Box</small>
                    </div>
                    <hr class="my-3">

                    <!-- Tabs for Sexual Abuse and Physical Abuse -->
                    <ul class="nav nav-tabs" id="abuseTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="sexual-abuse-tab" data-bs-toggle="tab" href="#sexual-abuse"
                                role="tab" aria-controls="sexual-abuse" aria-selected="true">Sexual Abuse</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="physical-abuse-tab" data-bs-toggle="tab" href="#physical-abuse"
                                role="tab" aria-controls="physical-abuse" aria-selected="false">Physical Abuse</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="abuseTabsContent">
                        <!-- Sexual Abuse Tab -->
                        <div class="tab-pane fade show active" id="sexual-abuse" role="tabpanel"
                            aria-labelledby="sexual-abuse-tab">
                            <div class="border rounded p-2 mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Described By</th>
                                            <th>Child</th>
                                            <th>Historian</th>
                                            <th>Sworn Statement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Genital Contact --}}
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <label class="form-label text-uppercase">Genital contact w/</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Penis/Vagina</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childPenisVagina" name="childDescribed[]" value="Penis/Vagina">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianPenisVagina" name="historianDescribed[]"
                                                    value="Penis/Vagina">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementPenisVagina"
                                                    name="swornStatement[Penis/Vagina]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Finger</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childFinger" name="childDescribed[]" value="Finger">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianFinger" name="historianDescribed[]" value="Finger">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementFinger"
                                                    name="swornStatement[Finger]" placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Foreign object</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childForeignObject" name="childDescribed[]"
                                                    value="Foreign object">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianForeignObject" name="historianDescribed[]"
                                                    value="Foreign object">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementForeignObject"
                                                    name="swornStatement[Foreign object]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Describe the object</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childDescribeObject" name="childDescribed[]"
                                                    value="Describe object">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianDescribeObject" name="historianDescribed[]"
                                                    value="Describe object">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementDescribeObject"
                                                    name="swornStatement[Describe object]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>

                                        {{-- Anal Contact --}}
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <label class="form-label text-uppercase">Anal contact w/</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Penis/Vagina</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalPenisVagina" name="childDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalPenisVagina" name="historianDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementAnalPenisVagina"
                                                    name="swornStatement[Anal Penis/Vagina]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Finger</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalFinger" name="childDescribed[]" value="Anal Finger">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalFinger" name="historianDescribed[]"
                                                    value="Anal Finger">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementAnalFinger"
                                                    name="swornStatement[Anal Finger]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Foreign object</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalForeignObject" name="childDescribed[]"
                                                    value="Anal Foreign object">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalForeignObject" name="historianDescribed[]"
                                                    value="Anal Foreign object">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementAnalForeignObject"
                                                    name="swornStatement[Anal Foreign object]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Describe the object</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalDescribeObject" name="childDescribed[]"
                                                    value="Anal Describe object">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalDescribeObject" name="historianDescribed[]"
                                                    value="Anal Describe object">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementAnalDescribeObject"
                                                    name="swornStatement[Anal Describe object]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>

                                        {{-- Oral copulation of genitals --}}
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <label class="form-label text-uppercase">Oral copulation of
                                                    genitals</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Of victim by assailant</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalPenisVagina" name="childDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalPenisVagina" name="historianDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementAnalPenisVagina"
                                                    name="swornStatement[Anal Penis/Vagina]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Of assailant by victim</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalFinger" name="childDescribed[]" value="Anal Finger">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalFinger" name="historianDescribed[]"
                                                    value="Anal Finger">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementAnalFinger"
                                                    name="swornStatement[Anal Finger]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>

                                        {{-- Masturbation --}}
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <label class="form-label text-uppercase">Masturbation</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Of assailant by self</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalPenisVagina" name="childDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalPenisVagina" name="historianDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementAnalPenisVagina"
                                                    name="swornStatement[Anal Penis/Vagina]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Of assailant by victim</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalFinger" name="childDescribed[]" value="Anal Finger">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalFinger" name="historianDescribed[]"
                                                    value="Anal Finger">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementAnalFinger"
                                                    name="swornStatement[Anal Finger]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>

                                        {{-- Ejaculation --}}
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <label class="form-label text-uppercase">Ejaculation</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Specify location</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childAnalPenisVagina" name="childDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianAnalPenisVagina" name="historianDescribed[]"
                                                    value="Anal Penis/Vagina">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementAnalPenisVagina"
                                                    name="swornStatement[Anal Penis/Vagina]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>

                                        {{-- Fondling --}}
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <label class="form-label text-uppercase">Fondling</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Specify location</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childSpecifyLocation" name="childDescribed[]"
                                                    value="Specify Location">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianSpecifyLocation" name="historianDescribed[]"
                                                    value="Specify Location">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementSpecifyLocation"
                                                    name="swornStatement[Specify Location]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Exhibitionism</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childExhibitionism" name="childDescribed[]"
                                                    value="Exhibitionism">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianExhibitionism" name="historianDescribed[]"
                                                    value="Exhibitionism">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementExhibitionism"
                                                    name="swornStatement[Exhibitionism]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Photos/Videos taken</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childPhotosVideos" name="childDescribed[]"
                                                    value="Photos/Videos taken">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianPhotosVideos" name="historianDescribed[]"
                                                    value="Photos/Videos taken">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementPhotosVideos"
                                                    name="swornStatement[Photos/Videos taken]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Force or weapon used</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childForceWeapon" name="childDescribed[]"
                                                    value="Force or weapon used">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianForceWeapon" name="historianDescribed[]"
                                                    value="Force or weapon used">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementForceWeapon"
                                                    name="swornStatement[Force or weapon used]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Describe force/weapon</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childDescribeForceWeapon" name="childDescribed[]"
                                                    value="Describe force/weapon">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianDescribeForceWeapon" name="historianDescribed[]"
                                                    value="Describe force/weapon">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementDescribeForceWeapon"
                                                    name="swornStatement[Describe force/weapon]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Verbal threats</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childVerbalThreats" name="childDescribed[]"
                                                    value="Verbal threats">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianVerbalThreats" name="historianDescribed[]"
                                                    value="Verbal threats">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementVerbalThreats"
                                                    name="swornStatement[Verbal threats]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Given substance to change
                                                    consciousness</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childGivenSubstance" name="childDescribed[]"
                                                    value="Given substance to change consciousness">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianGivenSubstance" name="historianDescribed[]"
                                                    value="Given substance to change consciousness">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementGivenSubstance"
                                                    name="swornStatement[Given substance to change consciousness]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Intoxicated/Drunk</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childIntoxicatedDrunk" name="childDescribed[]"
                                                    value="Intoxicated/Drunk">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianIntoxicatedDrunk" name="historianDescribed[]"
                                                    value="Intoxicated/Drunk">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementIntoxicatedDrunk"
                                                    name="swornStatement[Intoxicated/Drunk]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Unconscious/Asleep</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childUnconsciousAsleep" name="childDescribed[]"
                                                    value="Unconscious/Asleep">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianUnconsciousAsleep" name="historianDescribed[]"
                                                    value="Unconscious/Asleep">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="swornStatementUnconsciousAsleep"
                                                    name="swornStatement[Unconscious/Asleep]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Child is a sex worker</label></td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childSexWorker" name="childDescribed[]"
                                                    value="Child is a sex worker">
                                            </td>
                                            <td>
                                                <input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianSexWorker" name="historianDescribed[]"
                                                    value="Child is a sex worker">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="swornStatementSexWorker"
                                                    name="swornStatement[Child is a sex worker]"
                                                    placeholder="Enter sworn statement">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <label class="form-label">Describe other sexual abuse:</label>
                                                <textarea class="form-control" id="describeOtherSexualAbuse"
                                                    name="describeOtherSexualAbuse" placeholder="Enter description"
                                                    style="resize:none; overflow-y: auto; height:100px;"></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Physical Abuse Tab -->
                        <div class="tab-pane fade" id="physical-abuse" role="tabpanel"
                            aria-labelledby="physical-abuse-tab">
                            <div class="border rounded p-2 mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Described By</th>
                                            <th>Child</th>
                                            <th>Historian</th>
                                            <th>Sworn Statement</th>
                                            <th>Location of Injury</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Hit With -->
                                        <tr>
                                            <th colspan="5" class="text-center">
                                                <label class="form-label">Hit With</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Hand</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childHand" name="childDescribed[]" value="Hand"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianHand" name="historianDescribed[]" value="Hand"></td>
                                            <td><input type="text" class="form-control" id="swornStatementHand"
                                                    name="swornStatement[Hand]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryHand"
                                                    name="locationInjury[Hand]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Belt</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childBelt" name="childDescribed[]" value="Belt"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianBelt" name="historianDescribed[]" value="Belt"></td>
                                            <td><input type="text" class="form-control" id="swornStatementBelt"
                                                    name="swornStatement[Belt]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryBelt"
                                                    name="locationInjury[Belt]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Belt, Cord, or Stick</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childCordStick" name="childDescribed[]"
                                                    value="Belt, Cord, or Stick"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianCordStick" name="historianDescribed[]"
                                                    value="Belt, Cord, or Stick"></td>
                                            <td><input type="text" class="form-control" id="swornStatementCordStick"
                                                    name="swornStatement[Belt, Cord, or Stick]"
                                                    placeholder="Enter sworn statement"></td>
                                            <td><input type="text" class="form-control" id="locationInjuryCordStick"
                                                    name="locationInjury[Belt, Cord, or Stick]"
                                                    placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Knife or Blade</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childKnifeBlade" name="childDescribed[]" value="Knife or Blade">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianKnifeBlade" name="historianDescribed[]"
                                                    value="Knife or Blade"></td>
                                            <td><input type="text" class="form-control" id="swornStatementKnifeBlade"
                                                    name="swornStatement[Knife or Blade]"
                                                    placeholder="Enter sworn statement"></td>
                                            <td><input type="text" class="form-control" id="locationInjuryKnifeBlade"
                                                    name="locationInjury[Knife or Blade]" placeholder="Enter location">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Household Tool</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childTool" name="childDescribed[]" value="Household Tool"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianTool" name="historianDescribed[]"
                                                    value="Household Tool">
                                            </td>
                                            <td><input type="text" class="form-control" id="swornStatementTool"
                                                    name="swornStatement[Household Tool]"
                                                    placeholder="Enter sworn statement"></td>
                                            <td><input type="text" class="form-control" id="locationInjuryTool"
                                                    name="locationInjury[Household Tool]" placeholder="Enter location">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Other, Describe</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>

                                        <!-- Burned With -->
                                        <tr>
                                            <th colspan="5" class="text-center">
                                                <label class="form-label">Burned With</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Cigarette</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childHand" name="childDescribed[]" value="Hand"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianHand" name="historianDescribed[]" value="Hand"></td>
                                            <td><input type="text" class="form-control" id="swornStatementHand"
                                                    name="swornStatement[Hand]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryHand"
                                                    name="locationInjury[Hand]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Flat iron</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childBelt" name="childDescribed[]" value="Belt"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianBelt" name="historianDescribed[]" value="Belt"></td>
                                            <td><input type="text" class="form-control" id="swornStatementBelt"
                                                    name="swornStatement[Belt]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryBelt"
                                                    name="locationInjury[Belt]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Hot liquid</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childCordStick" name="childDescribed[]"
                                                    value="Belt, Cord, or Stick"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianCordStick" name="historianDescribed[]"
                                                    value="Belt, Cord, or Stick"></td>
                                            <td><input type="text" class="form-control" id="swornStatementCordStick"
                                                    name="swornStatement[Belt, Cord, or Stick]"
                                                    placeholder="Enter sworn statement"></td>
                                            <td><input type="text" class="form-control" id="locationInjuryCordStick"
                                                    name="locationInjury[Belt, Cord, or Stick]"
                                                    placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Other, Describe</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>

                                        <!-- Others -->
                                        <tr>
                                            <th colspan="5" class="text-center">
                                                <label class="form-label">Others</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Biting</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Pinching</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Kicking</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Pulling Hair</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Slapping Face</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Banging Head</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Violent shaking</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Dragged</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <label class="form-label">Describe other physical abuse:</label>
                                                <textarea class="form-control" id="describeOtherPhysicalAbuse"
                                                    name="describeOtherPhysicalAbuse" placeholder="Enter description"
                                                    style="resize:none; height:100px;"></textarea>
                                            </td>
                                        </tr>

                                        <!-- Neglect -->
                                        <tr>
                                            <th colspan="5" class="text-center">
                                                <label class="form-label">Neglect</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Underfied, unfied</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childHand" name="childDescribed[]" value="Hand"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianHand" name="historianDescribed[]" value="Hand"></td>
                                            <td><input type="text" class="form-control" id="swornStatementHand"
                                                    name="swornStatement[Hand]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryHand"
                                                    name="locationInjury[Hand]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Unattended med. Problems</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childBelt" name="childDescribed[]" value="Belt"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianBelt" name="historianDescribed[]" value="Belt"></td>
                                            <td><input type="text" class="form-control" id="swornStatementBelt"
                                                    name="swornStatement[Belt]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryBelt"
                                                    name="locationInjury[Belt]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Accidental toxic ingestion</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childCordStick" name="childDescribed[]"
                                                    value="Belt, Cord, or Stick"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianCordStick" name="historianDescribed[]"
                                                    value="Belt, Cord, or Stick"></td>
                                            <td><input type="text" class="form-control" id="swornStatementCordStick"
                                                    name="swornStatement[Belt, Cord, or Stick]"
                                                    placeholder="Enter sworn statement"></td>
                                            <td><input type="text" class="form-control" id="locationInjuryCordStick"
                                                    name="locationInjury[Belt, Cord, or Stick]"
                                                    placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Constantly unsupervised</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Neglected schooling</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Other</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>

                                        <!-- Emotional Abuse -->
                                        <tr>
                                            <th colspan="5" class="text-center">
                                                <label class="form-label">Emotional Abuse</label>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Insulting, cursing, belittling</label>
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childHand" name="childDescribed[]" value="Hand"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianHand" name="historianDescribed[]" value="Hand"></td>
                                            <td><input type="text" class="form-control" id="swornStatementHand"
                                                    name="swornStatement[Hand]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryHand"
                                                    name="locationInjury[Hand]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Threatening/Terrorizing</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childBelt" name="childDescribed[]" value="Belt"></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianBelt" name="historianDescribed[]" value="Belt"></td>
                                            <td><input type="text" class="form-control" id="swornStatementBelt"
                                                    name="swornStatement[Belt]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryBelt"
                                                    name="locationInjury[Belt]" placeholder="Enter location"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="form-label">Other</label></td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="childOther" name="childDescribed[]" value="Other">
                                            </td>
                                            <td><input class="form-check-input intcheckbox" type="checkbox"
                                                    id="historianOther" name="historianDescribed[]" value="Other"></td>
                                            <td><input type="text" class="form-control" id="swornStatementOther"
                                                    name="swornStatement[Other]" placeholder="Enter sworn statement">
                                            </td>
                                            <td><input type="text" class="form-control" id="locationInjuryOther"
                                                    name="locationInjury[Other]" placeholder="Enter location"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- End border --}}


                {{-- CHILD'S BEHAVIOR DURING THE INTERVIEW --}}
                <div class="border rounded p-3 mb-3 mt-3">
                    <h5 class="fw-semibold text-center text-light bg-dark mb-3">CHILD'S BEHAVIOR DURING THE INTERVIEW
                    </h5>
                    <!-- First Grid -->
                    <div class="row border rounded d-flex align-items-center justify-content-center p-3">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Behavior Characteristics</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="cooperative" name="behavior[]"
                                        value="Cooperative">
                                    <label class="form-check-label" for="cooperative">Cooperative</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="crying" name="behavior[]"
                                        value="Crying">
                                    <label class="form-check-label" for="crying">Crying</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="clingingToCaretaker"
                                        name="behavior[]" value="Clinging to caretaker">
                                    <label class="form-check-label" for="clingingToCaretaker">Clinging to
                                        caretaker</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="responsive" name="behavior[]"
                                        value="Responsive to most questions">
                                    <label class="form-check-label" for="responsive">Responsive to most
                                        questions</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="silentUnresponsive"
                                        name="behavior[]" value="Silent, unresponsive">
                                    <label class="form-check-label" for="silentUnresponsive">Silent,
                                        unresponsive</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="ableToNarrate" name="behavior[]"
                                        value="Able to narrate incident">
                                    <label class="form-check-label" for="ableToNarrate">Able to narrate incident</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="unableToNarrate"
                                        name="behavior[]" value="Unable to narrate incident">
                                    <label class="form-check-label" for="unableToNarrate">Unable to narrate
                                        incident</label>
                                </div>
                            </div>
                        </div>

                        <!-- Second Grid -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Affect and Symptoms</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="appropriateAffect"
                                        name="affect[]" value="Appropriate affect">
                                    <label class="form-check-label" for="appropriateAffect">Appropriate affect</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="depressedAffect" name="affect[]"
                                        value="Depressed affect">
                                    <label class="form-check-label" for="depressedAffect">Depressed affect</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="flatAffect" name="affect[]"
                                        value="Flat affect, blank stares">
                                    <label class="form-check-label" for="flatAffect">Flat affect, blank stares</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="psychoticSymptoms"
                                        name="affect[]" value="Psychotic symptoms">
                                    <label class="form-check-label" for="psychoticSymptoms">Psychotic symptoms</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="combativeHostile"
                                        name="affect[]" value="Combative, hostile">
                                    <label class="form-check-label" for="combativeHostile">Combative, hostile</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="hyperactiveAnxious"
                                        name="affect[]" value="Hyperactive, anxious">
                                    <label class="form-check-label" for="hyperactiveAnxious">Hyperactive,
                                        anxious</label>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" class="form-check-input" id="shortAttentionSpan"
                                        name="affect[]" value="Short attention span">
                                    <label class="form-check-label" for="shortAttentionSpan">Short attention
                                        span</label>
                                </div>
                            </div>
                        </div>

                        <!-- Third Grid -->
                        <div class="col-md-5 mb-3">
                            <label class="form-label">Additional Observations</label>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="childBehaviorDescription" class="form-label">Describe child's behavior
                                        and
                                        interaction with interviewer/caretaker</label>
                                    <textarea class="form-control" id="childBehaviorDescription"
                                        name="childBehaviorDescription" rows="3"
                                        style="resize:none; height:100px;"></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Caretaker present during the interview?</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="caretakerPresent"
                                                id="caretakerYes" value="Yes">
                                            <label class="form-check-label" for="caretakerYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="caretakerPresent"
                                                id="caretakerNo" value="No">
                                            <label class="form-check-label" for="caretakerNo">No</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        {{-- SUMMARY OF INTERVIEW --}}
                        <div class="mb-3">
                            <h5 class="fw-semibold text-center text-light bg-dark mb-3">SUMMARY OF INTERVIEW</h5>

                            <div class="border rounded p-3">

                                <p class="text-muted fst-italic">
                                    Write down what the child says, using his or her actual words whenever possible.
                                    Verbatim
                                    comments are often very revealing when assessing a child's disclosure.
                                </p>

                                <div class="mb-3">
                                    <label for="interviewSummary" class="form-label">Interview Summary</label>
                                    <textarea class="form-control" id="interviewSummary" name="interviewSummary"
                                        rows="5" placeholder="Enter summary of interview..."></textarea>
                                </div>

                            </div>
                        </div>

                        {{-- DEVELOPMENT SCREENING --}}
                        <div class="mb-3">
                            <h5 class="fw-semibold text-center text-light bg-dark mb-3">DEVELOPMENTAL SCREENING</h5>

                            <div class="border rounded p-4 ">

                                <!-- Checkbox for Further Development Assessment -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input intcheckbox me-2" type="checkbox"
                                        id="furtherDevelopmentAssessment" name="developmentAssessmentNeeded">
                                    <label class="form-check-label" for="furtherDevelopmentAssessment">
                                        Further Development assessment needed
                                    </label>
                                </div>
                                <hr>
                                <!-- Grid of Development Screening Options -->
                                <div class="row customFontSize">
                                    <label class="form-label fw-bold">Developmental Indicators</label>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="developmentDelay"
                                                name="developmentScreening[]"
                                                value="Probable Development delay (for age below 7)">
                                            <label class="form-check-label" for="developmentDelay">
                                                Probable Development delay (for age below 7)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="learningProblems"
                                                name="developmentScreening[]"
                                                value="Probable Learning problems (for school-aged)">
                                            <label class="form-check-label" for="learningProblems">
                                                Probable Learning problems (for school-aged)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="physicalDisabilities"
                                                name="developmentScreening[]" value="Physical disabilities">
                                            <label class="form-check-label" for="physicalDisabilities">
                                                Physical disabilities
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sensoryImpairment"
                                                name="developmentScreening[]" value="Sensory impairment">
                                            <label class="form-check-label" for="sensoryImpairment">
                                                Sensory impairment
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="neglectedSchooling"
                                                name="developmentScreening[]" value="Neglected schooling">
                                            <label class="form-check-label" for="neglectedSchooling">
                                                Neglected schooling
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="mentalRetardation"
                                                name="developmentScreening[]"
                                                value="Probable moderate to profound mental retardation">
                                            <label class="form-check-label" for="mentalRetardation">
                                                Probable moderate to profound mental retardation
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="row mt-2">
            <div class="col text-end">
                <button type="submit" class="btn btn-primary" form="interviewForm" id="interviewSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
@endsection