{{-- resources\views\partials\report_table.blade.php --}}
<div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center" id="idnumber">ID Number</th>
                <th class="text-center" id="fullName">Full Name</th>
                <th class="text-center">Barangay</th>
                <th class="text-center" id="sexHeader">Sex</th>
                <th class="text-center" id="birthdateHeader">Birthdate</th>
                <th class="text-center">Age</th>
                <th class="text-center" id="statusHeader">Status</th>
                <th class="text-center d-none" id="categoryHeader">Category</th>
                <th class="text-center d-none" id="remarksHeader">Remarks</th>
                {{-- for child cases column --}}
                <th class="text-center d-none" id="pantawidBeneficiary">Pantawid Beneficiary</th>
                <th class="text-center d-none" id="offenseCommited">Offense Committed</th>
                <th class="text-center d-none" id="childCasesStatus">Status</th>
                <th class="text-center d-none" id="childCasesRemarks">Remarks</th>
            </tr>
        </thead>
        <tbody class="reportTableContainer">
            @forelse ($beneficiaries as $beneficiary)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $beneficiary->id_num }}</td>
                <td>
                    {{ $beneficiary->firstname }}
                    {{ $beneficiary->middlename }}
                    {{ $beneficiary->lastname }}
                    {{ $beneficiary->suffix }}
                </td>
                <td>{{ $beneficiary->address->barangay}}</td>
                <td>{{ $beneficiary->sex }}</td>
                <td>{{ \Carbon\Carbon::parse($beneficiary->birthdate)->format('F d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($beneficiary->birthdate)->age }}</td>
                <td>{{ $beneficiary->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No beneficiaries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>