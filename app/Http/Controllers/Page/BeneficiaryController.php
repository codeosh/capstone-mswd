<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BeneficiaryController extends Controller
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
                'table' => view('partials.beneficiary_table', compact('beneficiaries'))->render(),
                'hidePagination' => $hidePagination,
            ]);
        }

        return view('page.beneficiary_page', compact('beneficiaries', 'currentPage', 'lastPage', 'hidePagination'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'sex' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'status' => 'required|string|max:255',
            'streetname' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'selectedServiceType' => 'nullable|string|max:255',
        ]);
        if (
            $request->status === 'Child or Youth' &&
            in_array($request->selectedServiceType, ['CAR', 'CICL'])
        ) {
            $validatedChildCases = $request->validate([
                'pantawid_beneficiary' => 'required|string|max:255',
                'offense_committed' => 'required|string|max:255',
                'casestatus' => 'required|string|max:255',
                'childremarks' => 'nullable|string|max:255',
            ]);
        } else {
            $validatedChildCases = [];
        }

        try {
            DB::beginTransaction();

            // Generate ID number
            $lastBeneficiary = Beneficiary::orderBy('id_num', 'desc')->first();
            if ($lastBeneficiary) {
                $lastIdNumber = intval($lastBeneficiary->id_num);
                $newIdNumber = str_pad($lastIdNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newIdNumber = '001';
            }
            $validatedData['idnum'] = $newIdNumber;

            // Prevent Duplicate Beneficiary
            $existingBeneficiary = Beneficiary::where('firstname', $validatedData['firstname'])
                ->where('lastname', $validatedData['lastname'])
                ->where('suffix', $validatedData['suffix'] ?? null)
                ->first();

            if ($existingBeneficiary) {
                return response()->json([
                    'success' => false,
                    'message' => 'Beneficiary already exist.',
                ], 409);
            }

            if ($validatedData['status'] == 'Senior Citizen') {
                $birthdate = \Carbon\Carbon::parse($validatedData['birthdate']);
                $age = $birthdate->age;

                if ($age < 60) {
                    return response()->json([
                        'success' => false,
                        'message' => 'To be a Senior Citizen, the age must be 60 years or older.',
                    ], 400);
                }
            }

            if ($validatedData['status'] == 'Child or Youth') {
                $birthdate = \Carbon\Carbon::parse($validatedData['birthdate']);
                $age = $birthdate->age;
                if ($age < 5 || $age > 18) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Child or Youth is only for beneficiaries aged 5 to 18.',
                    ], 403);
                }
            }

            $beneficiary = Beneficiary::create([
                'firstname' => ucwords(strtolower($validatedData['firstname'])),
                'middlename' => ucwords(strtolower($validatedData['middlename'])),
                'lastname' => ucwords(strtolower($validatedData['lastname'])),
                'sex' => $validatedData['sex'],
                'birthdate' => $validatedData['birthdate'],
                'status' => $validatedData['status'],
                'category' => ucwords(strtolower($validatedData['category'])),
                'remarks' => ucwords(strtolower($validatedData['remarks'])),
                'id_num' => $validatedData['idnum'],
                'user_id' => Auth::id(),
            ]);

            $beneficiary->address()->create([
                'streetname' => ucwords(strtolower($validatedData['streetname'])),
                'barangay' => $validatedData['barangay'],
                'municipality' => $validatedData['municipality'],
                'province' => $validatedData['province'],
            ]);

            if (
                $validatedData['status'] === 'Child or Youth' &&
                in_array($validatedData['selectedServiceType'], ['CAR', 'CICL'])
            ) {
                $beneficiary->services()->create([
                    'service_name' => $validatedData['selectedServiceType'],
                ]);

                $beneficiary->childcases()->create([
                    'pantawid_beneficiary' => ucwords(strtolower($validatedChildCases['pantawid_beneficiary'])),
                    'offense_committed' => ucwords(strtolower($validatedChildCases['offense_committed'])),
                    'status' => ucwords(strtolower($validatedChildCases['casestatus'])),
                    'remarks' => ucwords(strtolower($validatedChildCases['childremarks'] ?? '')),
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Beneficiary added successfully!']);
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

    public function show($id)
    {
        try {
            $beneficiary = Beneficiary::with('address', 'services', 'childcases')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $beneficiary,
            ]);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => 'Beneficiary not found.',
                'error_details' => $error->getMessage(),
            ], 404);
        }
    }

    public function getFilteredServices($id, Request $request)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        $query = $beneficiary->services();

        if ($request->filled('serviceType')) {
            $query->where('service_name', $request->input('serviceType'));
        }

        if ($request->filled('startDate')) {
            $query->whereDate('created_at', '>=', $request->input('startDate'));
        }

        if ($request->filled('endDate')) {
            $query->whereDate('created_at', '<=', $request->input('endDate'));
        }

        $services = $query->get();

        return response()->json([
            'success' => true,
            'data' => ['services' => $services]
        ]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'sex' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'streetname' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
        ]);

        $existingBeneficiary = Beneficiary::where('firstname', $validatedData['firstname'])
            ->where('lastname', $validatedData['lastname'])
            ->where('suffix', $validatedData['suffix'] ?? null)
            ->where('id', '!=', $id)
            ->first();

        if ($existingBeneficiary) {
            return response()->json([
                'success' => false,
                'message' => 'A beneficiary with the same firstname and lastname already exists.',
            ], 400);
        }

        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->firstname = ucwords(strtolower($validatedData['firstname']));
        $beneficiary->middlename = $validatedData['middlename'];
        $beneficiary->lastname = ucwords(strtolower($validatedData['lastname']));
        $beneficiary->suffix = $validatedData['suffix'] ? ucwords(strtolower($validatedData['suffix'])) : null;
        $beneficiary->birthdate = $validatedData['birthdate'] = Carbon::parse($validatedData['birthdate'])->format('Y-m-d');
        $beneficiarySaved = $beneficiary->save();

        $address = $beneficiary->address;
        if ($address) {
            $address->streetname = ucwords(strtolower($validatedData['streetname']));
            $address->barangay = $validatedData['barangay'];
            $addressSaved = $address ? $address->save() : true;
        }

        if (!$beneficiarySaved || !$addressSaved) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update beneficiary details.',
            ], 500);
        }

        return response()->json(['success' => true, 'message' => 'Beneficiary updated successfully!']);
    }

    public function addService(Request $request)
    {
        $validatedData = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'serviceType' => 'required|string|max:255',
            'selectedService' => 'required|string|max:255',
        ]);

        try {
            $beneficiary = Beneficiary::findOrFail($validatedData['beneficiary_id']);

            if (in_array($validatedData['serviceType'], ['VAW', 'VAC'])) {
                $existingService = $beneficiary->services()->where('service_name', $validatedData['serviceType'])
                    ->where('service_availed', $validatedData['selectedService'])
                    ->whereDate(
                        'created_at',
                        now()->toDateString()
                    )
                    ->first();

                if ($existingService) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This service has already been availed today.',
                    ], 403);
                }
            }

            // Ensure VAW is only available to females
            if ($validatedData['serviceType'] === 'VAW' && strtolower($beneficiary->sex) !== 'female') {
                return response()->json([
                    'success' => false,
                    'message' => 'The "VAW" is only available for Female beneficiaries.',
                ], 403);
            }

            // VAC service eligibility check
            if ($validatedData['serviceType'] === 'VAC') {
                if (!$beneficiary->birthdate) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Birthdate is required to determine eligibility for VAC service.',
                    ], 400);
                }
                $age = Carbon::parse($beneficiary->birthdate)->age;

                if ($age < 5 || $age > 18) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The "VAC" service is available only for beneficiaries aged 5 to 18.',
                    ], 403);
                }
            }

            // Handle AICS service restriction (3-month gap)
            if ($validatedData['serviceType'] === 'AICS') {
                $lastService = $beneficiary->services()->where('service_name', 'AICS')->latest()->first();

                if ($lastService && $lastService->due_date && Carbon::parse($lastService->due_date)->isFuture()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The "AICS" service is available only after 3 months.',
                    ], 403);
                }

                $dueDate = now()->addMonths(3);
            } else {
                $dueDate = null;
            }

            // Add the service
            $beneficiary->services()->create([
                'service_name' => $validatedData['serviceType'],
                'service_availed' => $validatedData['selectedService'],
                'due_date' => $dueDate,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Service added successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the service.',
                'error_details' => $e->getMessage(),
            ], 500);
        }
    }
}
