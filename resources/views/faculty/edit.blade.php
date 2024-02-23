<?php
use App\Models\FacultyProfile;
$user_id = FacultyProfile::where('email', $faculty_info->email)->first();
// Page Variables
$unavailable = 'not available'; 
?>
<x-app-layout>
    <div class="mt-6">
        {{-- Header Component Start --}}
        <x-componable.edit-header
        title="Faculty Member"
        year="For Year {{ date('Y'); }}"
        status="{{ $faculty_info->approval }}"
        backroute="faculty.index"
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
                        <td>{{ $faculty_info->fullname ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2  bg-gray-100 text-gray-700">Surname</th>
                        <td class="bg-gray-100">{{ $faculty_info->surname ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Omang</th>
                        <td>{{ $faculty_info->omang ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Email</th>
                        <td>{{ $faculty_info->email ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Phone Number</th>
                        <td>{{ $faculty_info->phone ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Department</th>
                        <td>{{ $faculty_info->course_code ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Role Being Requested</th>
                        <td>{{ $faculty_info->role ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Profile Created At</th>
                        <td class="bg-gray-100">{{ $faculty_info->created_at ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-5 text-gray-700"></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($faculty_info->approval == 'pending')
            <div class="flex justify-center mt-6 space-x-3">
                <livewire:faculty-user-approve id="{{ $user_id->id }}"/>
            </div>
        @else
            @if ($profile_user != null)
                <div class="flex justify-center mt-6 space-x-3">
                    @if ($profile_user->status == 'active')
                        <livewire:faculty-user-deactivate id="{{ $user_id->id }}"/>
                    @endif
                    @if ($profile_user->status == 'deactivated' || $profile_user->status == 'suspended')
                        <livewire:faculty-user-activate id="{{ $user_id->id }}"/>
                    @endif
                    @if ($profile_user->status == 'active' || $profile_user->status == 'deactivated')
                        <livewire:faculty-user-suspend id="{{ $user_id->id }}"/>
                    @endif
                </div>
            @endif
        @endif
    </div>
</x-app-layout>