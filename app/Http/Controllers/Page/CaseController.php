<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $beneficiaries = Beneficiary::with('address')
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('firstname', 'like', '%' . $searchQuery . '%')
                        ->orWhere('lastname', 'like', '%' . $searchQuery . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $currentPage = $beneficiaries->currentPage();
        $lastPage = $beneficiaries->lastPage();

        $hidePagination = $searchQuery ? true : false;

        if ($request->ajax()) {
            return response()->json([
                'table' => view('partials.case_management_table', compact('beneficiaries'))->render(),
                'hidePagination' => $hidePagination,
            ]);
        }

        return view('page.case_management', compact('beneficiaries', 'currentPage', 'lastPage', 'hidePagination'));
    }

    public function intakeform(Request $request)
    {
        $beneficiaryID = $request->query('beneficiaryID');
        $beneficiary = Beneficiary::findOrFail($beneficiaryID);

        return view('subpage.intakeform', compact('beneficiary'));
    }

    public function interviewform(Request $request)
    {
        $beneficiaryID = $request->query('beneficiaryID');
        $beneficiary = Beneficiary::findOrFail($beneficiaryID);

        return view('subpage.interviewform', compact('beneficiary'));
    }

    public function intakestore(Request $request)
    {
        $validatedData = $request->validate([
            // First Section
            'beneficiaryID' => 'required|exists:beneficiaries,id',
            'caseDate' => 'required|date',
            'caseNum' => 'nullable|integer',
            'informantrelation' => 'nullable|string|max:255',
            'socialworker' => 'nullable|string|max:255',
            'primary_complaint' => 'nullable|array',
            'primary_complaint.*' => 'nullable|string',
            'service_sought' => 'nullable|array',
            'service_sought.*' => 'nullable|string',
            'referral_from' => 'nullable|array',
            'referral_from.*' => 'nullable|string',
            'inpatient_ward' => 'nullable|array',
            'inpatient_ward.*' => 'nullable|string',
            'inpatient_ward_other' => 'nullable|string|max:255',
            'referral_from_other' => 'nullable|string|max:255',
            'referral_type' => 'nullable|string|max:255',
            'otherInformation' => 'nullable|string|max:255',
            // Second Section
            'motherAddress' => 'nullable|string|max:255',
            'motheraddressdirection' => 'nullable|string|max:255',
            'presentaddressdirection' => 'nullable|string|max:255',
            'motherTelephone' => 'nullable|string|max:255',
            'presentTelphone' => 'nullable|string|max:255',
            'presentcaretaker' => 'nullable|string|max:255',
            'legalstatus' => 'nullable|string|max:255',
            'patientRelationChild' => 'nullable|string|max:255',
            'intakeSchool' => 'nullable|string|max:255',
            'schoolStatus' => 'nullable|string|max:255',
            'intakeEducationalLvl' => 'nullable|string|max:255',
            'familyContact' => 'nullable|string|max:255',
            'familyAddress' => 'nullable|string|max:255',
            'contactRelationChild' => 'nullable|string|max:255',
            // Third Section
            'family' => 'nullable|array',
            'family.*.relation' => 'nullable|string',
            'family.*.name' => 'nullable|string',
            'family.*.lives_with_child' => 'nullable|string',
            'family.*.age_gender' => 'nullable|string',
            'family.*.civil_status' => 'nullable|string',
            'family.*.employed' => 'nullable|string',
            'family.*.occupation' => 'nullable|string',
            'family.*.education' => 'nullable|string',
            'family.*.weekly_income' => 'nullable|string',
            'family.*.school_company' => 'nullable|string',
            'family.*.contact_info' => 'nullable|string',
            'socioEconomic' => 'nullable|string|max:255',
            'childrenNum' => 'nullable|string|max:255',
            'numberFamilyMembers' => 'nullable|string|max:255',
            'numberFamilyHousehold' => 'nullable|string|max:255',
            // Fourth Section
            'regular_sleep' => 'nullable|array',
            'regular_sleep.*' => 'nullable|string',
            'regular_shelter' => 'nullable|string||max:255',
            'regular_other' => 'nullable|string||max:255',
            'same_bed' => 'nullable|array',
            'same_bed.*' => 'nullable|string',
            'same_room' => 'nullable|array',
            'same_room.*' => 'nullable|string',
            // Fifth Section
            'arrangement_abuse' => 'nullable|array',
            'arrangement_abuse.*' => 'nullable|string',
            'ngoShelterAbuse' => 'nullable|string|max:255',
            'govtAgencyAbuse' => 'nullable|string|max:255',
            'arrangement_present' => 'nullable|array',
            'arrangement_present.*' => 'nullable|string',
            'ngoShelterPresent' => 'nullable|string|max:255',
            'govtAgencyPresent' => 'nullable|string|max:255',
        ]);
        try {
            DB::beginTransaction();

            $beneficiary = Beneficiary::findOrFail($validatedData['beneficiaryID']);

            $intakeForm = $beneficiary->intakeForms()->create([
                'intake_date' => $validatedData['caseDate'],
                'case_num' => $validatedData['caseNum'],
                'relation_child' => ucwords(strtolower($validatedData['informantrelation'])),
                'social_worker' => ucwords(strtolower($validatedData['socialworker'])),
                'other_information' => $validatedData['otherInformation'],
            ]);

            $intakeForm->patientsAdress()->create([
                'mother_address' => ucwords(strtolower($validatedData['motherAddress'])),
                'mother_direction' => ucwords(strtolower($validatedData['motheraddressdirection'])),
                'present_direction' => ucwords(strtolower($validatedData['presentaddressdirection'])),
                'mother_telephone' => ucwords(strtolower($validatedData['motherTelephone'])),
                'present_telephone' => ucwords(strtolower($validatedData['presentTelphone'])),
                'present_caretaker' => ucwords(strtolower($validatedData['presentcaretaker'])),
                'legal_status' => ucwords(strtolower($validatedData['legalstatus'])),
                'relation_child' => ucwords(strtolower($validatedData['patientRelationChild'])),
                'enrolled_school' => $validatedData['schoolStatus'] === 'Yes'
                    ? ucwords(strtolower($validatedData['intakeSchool']))
                    : 'No',
                'educational_level' => ucwords(strtolower($validatedData['intakeEducationalLvl'])),
                'family_contact' => ucwords(strtolower($validatedData['familyContact'])),
                'family_address' => ucwords(strtolower($validatedData['familyAddress'])),
                'contact_relationchild' => ucwords(strtolower($validatedData['contactRelationChild'])),
            ]);


            // Store Primary Complaints
            if (!empty($validatedData['primary_complaint'])) {
                foreach ($validatedData['primary_complaint'] as $complaint) {
                    $intakeForm->primaryComplaints()->create([
                        'primary_complaint' => $complaint,
                    ]);
                }
            }

            // Store Service Sought
            if (!empty($validatedData['service_sought'])) {
                foreach ($validatedData['service_sought'] as $servicesought) {
                    $intakeForm->serviceSoughts()->create([
                        'service_sought' => $servicesought,
                    ]);
                }
            }

            // Store Referral From
            if (!empty($validatedData['referral_from'])) {
                foreach ($validatedData['referral_from'] as $referralfrom) {
                    $intakeForm->referralsFrom()->create([
                        'referral_from' => $referralfrom,
                    ]);
                }
            }
            if (!empty($validatedData['referral_from_other'])) {
                $intakeForm->referralsFrom()->create([
                    'referral_from_other' => ucwords(strtolower($validatedData['referral_from_other'])),
                ]);
            }

            // Store Inpatient From
            if (!empty($validatedData['referral_type'])) {
                if (!empty($validatedData['inpatient_ward'])) {
                    foreach ($validatedData['inpatient_ward'] as $inpatientWard) {
                        $intakeForm->inpatientsFrom()->create([
                            'type' => 'Inpatient',
                            'inpatient_from' => $inpatientWard,
                        ]);
                    }
                }
            }
            if (!empty($validatedData['inpatient_ward_other'])) {
                $intakeForm->inpatientsFrom()->create([
                    'inpatient_other' => ucwords(strtolower($validatedData['inpatient_ward_other'])),
                ]);
            }

            // Store Family Composition
            foreach ($validatedData['family'] as $familyMember) {
                $intakeForm->familyComposition()->create([
                    'composition_relation' => ucwords(strtolower($familyMember['relation'] ?? '')),
                    'composition_name' => ucwords(strtolower($familyMember['name'] ?? '')),
                    'composition_live' => ucwords(strtolower($familyMember['lives_with_child'] ?? '')),
                    'composition_agegender' => ucwords(strtolower($familyMember['age_gender'] ?? '')),
                    'composition_civilstatus' => ucwords(strtolower($familyMember['civil_status'] ?? '')),
                    'composition_employed' => ucwords(strtolower($familyMember['employed'] ?? '')),
                    'composition_occupation' => ucwords(strtolower($familyMember['occupation'] ?? '')),
                    'composition_education' => ucwords(strtolower($familyMember['education'] ?? '')),
                    'composition_income' => ucwords(strtolower($familyMember['weekly_income'] ?? '')),
                    'composition_school' => ucwords(strtolower($familyMember['school_company'] ?? '')),
                    'composition_contact' => $familyMember['contact_info'] ?? '',
                    'socio_economic' => ucwords(strtolower($validatedData['socioEconomic'] ?? '')),
                    'children_num' => ucwords(strtolower($validatedData['childrenNum'] ?? '')),
                    'family_members' => ucwords(strtolower($validatedData['numberFamilyMembers'] ?? '')),
                    'family_household' => ucwords(strtolower($validatedData['numberFamilyHousehold'] ?? '')),
                ]);
            }

            // Store Incest Only
            if (!empty($validatedData['regular_sleep'])) {
                foreach ($validatedData['regular_sleep'] as $regularSleep) {
                    $intakeForm->incestCases()->create([
                        'regular_arrangement' => $regularSleep,
                        'regular_shelter' => ucwords(strtolower($validatedData['regular_shelter'])),
                    ]);
                }
            }
            if (!empty($validatedData['same_bed'])) {
                foreach ($validatedData['same_bed'] as $sameBed) {
                    $intakeForm->incestCases()->create([
                        'same_bed' => $sameBed,
                    ]);
                }
            }
            if (!empty($validatedData['same_room'])) {
                foreach ($validatedData['same_room'] as $sameRoom) {
                    $intakeForm->incestCases()->create([
                        'same_room' => $sameRoom,
                    ]);
                }
            }
            if (!empty($validatedData['regular_other'])) {
                $intakeForm->incestCases()->create([
                    'regular_other' => ucwords(strtolower($validatedData['regular_other'])),
                ]);
            }

            // Store For Incest Cases Only
            if (!empty($validatedData['arrangement_abuse'])) {
                foreach ($validatedData['arrangement_abuse'] as $arrangeAbuse) {
                    $intakeForm->livingTimeAbuse()->create([
                        'living_arrangement' => $arrangeAbuse,
                    ]);
                }
            }
            if (!empty($validatedData['ngoShelterAbuse'] || !empty($validatedData['govtAgencyAbuse']))) {
                $intakeForm->livingTimeAbuse()->create([
                    'ngo_shelter' => ucwords(strtolower($validatedData['ngoShelterAbuse'])),
                    'govt_agency' => ucwords(strtolower($validatedData['govtAgencyAbuse'])),
                ]);
            }

            if (!empty($validatedData['arrangement_present'])) {
                foreach ($validatedData['arrangement_present'] as $arrangePresent) {
                    $intakeForm->livingAtPresent()->create([
                        'living_arrangement' => $arrangePresent,
                    ]);
                }
            }
            if (!empty($validatedData['ngoShelterPresent']) || !empty($validatedData['govtAgencyPresent'])) {
                $intakeForm->livingAtPresent()->create([
                    'ngo_shelter' => ucwords(strtolower($validatedData['ngoShelterPresent'])),
                    'govt_agency' => ucwords(strtolower($validatedData['govtAgencyPresent'])),
                ]);
            }


            DB::commit();
            return response()->json(['success' => true, 'message' => 'Intake case added successfully!']);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the beneficiary.',
                'error_details' => $error->getMessage(),
                'stack_trace' => $error->getTraceAsString(),
                'request_data' => $request->all(),
            ], 500);
        }
    }

    public function interviewstore(Request $request)
    {
        $validatedData = $request->validate([
            // First Section
            'beneficiaryID' => 'required|exists:beneficiaries,id',
            'caseDate' => 'required|date',
            'caseNum' => 'nullable|integer',
            'relationchild' => 'nullable|string|max:255',
            'physician' => 'nullable|string|max:255',
            'socialworker' => 'nullable|string|max:255',
            'historian' => 'nullable|string|max:255',
            'other_observer' => 'nullable|string|max:255',
            'Interviewed_before' => 'nullable|array',
            'Interviewed_before.*' => 'nullable|string',
            'intBeforeOther' => 'nullable|string|max:255',
            'Deferring_Interview' => 'nullable|array',
            'Deferring_Interview.*' => 'nullable|string',
            'Deferring_other' => 'nullable|string|max:255',
            // Second Section
            'disclosure_abuse' => 'nullable|array',
            'disclosure_abuse.*' => 'nullable|string',
            'behavioral_change' => 'nullable|array',
            'behavioral_change.*' => 'nullable|string',
            'psychotic_ep' => 'nullable|string|max:255',
            'physical_complaint' => 'nullable|array',
            'physical_complaint.*' => 'nullable|string',
            'neglect_complaint' => 'nullable|array',
            'neglect_complaint.*' => 'nullable|string',
            'neglect_other' => 'nullable|string|max:255',
            // Third Section
            'incident_from' => 'nullable|string|max:255',
            'date_recentIncident' => 'nullable|date',
            'time_recentIncident' => 'nullable|date_format:H:i',
            'other_recentIncident' => 'nullable|string|max:255',
            'date_firstAbuse' => 'nullable|date',
            'time_firstAbuse' => 'nullable|date_format:H:i',
            'other_firstAbuse' => 'nullable|string|max:255',
        ]);
        try {
            DB::beginTransaction();

            $otherObservers = $validatedData['other_observer']
                ? array_map('trim', explode(',', $validatedData['other_observer']))
                : null;

            if ($otherObservers) {
                foreach ($otherObservers as $observer) {
                    if (strlen($observer) > 255) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Each observer name too long.',
                        ], 422);
                    }
                }
            }

            $beneficiary = Beneficiary::findOrFail($validatedData['beneficiaryID']);

            $interviewForms = $beneficiary->interviewForms()->create([
                'interview_date' => $validatedData['caseDate'],
                'case_num' => $validatedData['caseNum'],
                'relation_child' => ucwords(strtolower($validatedData['relationchild'])),
                'physician' => ucwords(strtolower($validatedData['physician'])),
                'social_worker' => ucwords(strtolower($validatedData['socialworker'])),
                'historian' => ucwords(strtolower($validatedData['historian'])),
                'other_observer' => $otherObservers ? json_encode($otherObservers) : null,
            ]);

            $interviewForms->incidents()->create([
                'info_from' => $validatedData['incident_from'],
                'date_recent_incident' => $validatedData['date_recentIncident'] ?? null,
                'time_recent_incident' => $validatedData['time_recentIncident'] ?? null,
                'other_recent_clues' => $validatedData['other_recentIncident'],
                'date_first_abuse' => $validatedData['date_firstAbuse'] ?? null,
                'time_first_abuse' => $validatedData['time_firstAbuse'] ?? null,
                'other_first_abuse' => $validatedData['other_firstAbuse'],
            ]);

            $relationFieldMapping = [
                'interviewedBefore' => [
                    'Interviewed_before' => 'interview_before',
                ],
                'deferringInterview' => [
                    'Deferring_Interview' => 'deferring_interview',
                ],
                'disclosureAbuse' => [
                    'disclosure_abuse' => 'abuse_type',
                ],
                'behaveioralChange' => [
                    'behavioral_change' => 'behavioral_type',
                ],
                'physicalComplaint' => [
                    'physical_complaint' => 'physical_complaint',
                ],
                'neglectComplaint' => [
                    'neglect_complaint' => 'neglect_complaint',
                ],
            ];
            foreach ($relationFieldMapping as $relation => $fieldMapping) {
                foreach ($fieldMapping as $checkboxField => $fieldColumn) {
                    if (!empty($validatedData[$checkboxField])) {
                        foreach ((array)$validatedData[$checkboxField] as $fieldValue) {
                            $interviewForms->{$relation}()->create([
                                $fieldColumn => $fieldValue,
                            ]);
                        }
                    }
                }
            }

            $textFieldMapping = [
                'interviewedBefore' => [
                    'field' => 'intBeforeOther',
                    'column' => 'other',
                ],
                'deferringInterview' => [
                    'field' => 'Deferring_other',
                    'column' => 'deferring_other',
                ],
                'disclosureAbuse' => [
                    'field' => 'psychotic_ep',
                    'column' => 'psychotic_episode',
                ],
                'neglectComplaint' => [
                    'field' => 'neglect_other',
                    'column' => 'neglect_other',
                ],
            ];
            foreach ($textFieldMapping as $relation => $mapping) {
                if (!empty($validatedData[$mapping['field']])) {
                    $interviewForms->{$relation}()->create([
                        $mapping['column'] => $validatedData[$mapping['field']],
                    ]);
                }
            }




            DB::commit();
            return response()->json(['success' => true, 'message' => 'Interview case added successfully!']);
        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the beneficiary.',
                'error_details' => $error->getMessage(),
                'stack_trace' => $error->getTraceAsString(),
                'request_data' => $request->all(),
            ], 500);
        }
    }
}
