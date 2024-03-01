@php
use App\Models\StaffProfile;
$user_id = StaffProfile::where('email', $staff_info->email)->first();
// Page Variables
$unavailable = 'not available'; 
@endphp
<x-app-layout>
    <div class="mt-6">
        {{-- Header Component Start --}}
        <x-componable.edit-header
        title="Staff Member"
        year="For Year {{ date('Y'); }}"
        status="{{ $staff_info->approval }}"
        backroute="staff.index"
        navigate="true"
        />
        {{-- Header Component End --}}
        <div class="mt-3 rounded-sm relative overflow-x-auto overflow-y bg-white">
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6"></th>
                        <th scope="col" class="px-6"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Fullname</th>
                        <td>{{ $staff_info->fullname ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2  bg-gray-100 text-gray-700">Surname</th>
                        <td class="bg-gray-100">{{ $staff_info->surname ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Country of Origin</th>
                        <td>{{ $staff_info->country_of_origin ?? $unavailable }}</td>
                    </tr>
                    @if ($staff_info->omang != null)
                        <tr>
                            <th scope="col" class="px-6 py-2 text-gray-700">(National ID) Omang</th>
                            <td>{{ $staff_info->omang ?? $unavailable }}</td>
                        </tr>
                    @else
                        <tr>
                            <th scope="col" class="px-6 py-2 text-gray-700">(National ID) Passport Number</th>
                            <td>{{ $staff_info->passport_number ?? $unavailable }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Email</th>
                        <td>{{ $staff_info->email ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Phone Number</th>
                        <td>{{ $staff_info->phone ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Department</th>
                        <td>{{ $staff_info->course_code ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Role Being Requested</th>
                        <td>{{ $staff_info->role ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Profile Created At</th>
                        <td class="bg-gray-100">{{ $staff_info->created_at ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-5 text-gray-700"></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($staff_info->approval == 'pending')
            <div class="flex justify-center mt-6 space-x-3">
                <livewire:staff-user-approve id="{{ $user_id->id }}"/>
            </div>
        @else
            @if ($profile_user != null)
                <div class="flex justify-center mt-6 space-x-3">
                    @if ($profile_user->status == 'active')
                        <livewire:staff-user-deactivate id="{{ $user_id->id }}"/>
                    @endif
                    @if ($profile_user->status == 'deactivated' || $profile_user->status == 'suspended')
                        <livewire:staff-user-activate id="{{ $user_id->id }}"/>
                    @endif
                    @if ($profile_user->status == 'active' || $profile_user->status == 'deactivated')
                        <livewire:staff-user-suspend id="{{ $user_id->id }}"/>
                    @endif
                </div>
            @endif
        @endif
    </div>
</x-app-layout>