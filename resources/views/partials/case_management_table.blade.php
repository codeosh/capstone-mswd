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
                    Address
                </div>
            </th>
            <th>
                <div class="bg-light shadow-sm text-center border p-2 rounded">
                    Status
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
        @forelse($beneficiaries as $beneficiary)
        <tr>
            <td class="align-middle text-center">
                {{ $beneficiary->firstname }} {{ $beneficiary->middlename }} {{ $beneficiary->lastname }} {{
                $beneficiary->suffix }}
            </td>
            <td class="align-middle text-center">
                @if($beneficiary->address)
                {{ $beneficiary->address->streetname ? $beneficiary->address->streetname . ', ' : '' }}
                {{ $beneficiary->address->barangay ? $beneficiary->address->barangay . ', ' : '' }}
                {{ $beneficiary->address->municipality ? $beneficiary->address->municipality . ', ' : '' }}
                {{ $beneficiary->address->province }}
                @else
                No Address
                @endif
            </td>
            <td class="align-middle text-center">
                {{ $beneficiary->status }}
            </td>
            <td class="align-middle text-center">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-success profile-button"
                        data-id="{{ $beneficiary->id }}">
                        <i class="fas fa-edit"></i> Profile
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary intake-button"
                        data-id="{{ $beneficiary->id }}">
                        Intake Form
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary interview-button"
                        data-id="{{ $beneficiary->id }}">
                        Interview Form
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No beneficiaries found.</td>
        </tr>
        @endforelse
    </tbody>
</table>