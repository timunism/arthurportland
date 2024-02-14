<?php
// Page Variables
$unavailable = 'not available'; 
?>
<x-app-layout>
    <div class="mt-6">
        {{-- Header Component Start --}}
        <x-componable.edit-header
        title="DTEF Sponsored"
        year="2023/2024"
        status="active"
        backroute="dtef.registrations"
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
                        <th scope="col" class="px-6 py-2 text-gray-700">Student ID</th>
                        <td>{{ $student_info->student_id ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2  bg-gray-100 text-gray-700">Name</th>
                        <td class="bg-gray-100">{{ $student_info->fullname ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Surname</th>
                        <td>{{ $student_info->surname ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Omang / Passport No.</th>
                        <td class="bg-gray-100">{{ $student_info->national_id ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Date Of Birth</th>
                        @if ($student_info->date_of_birth != '0000-00-00')
                            <td>{{ $student_info->date_of_birth}}</td>
                        @else
                            <td>{{ $unavailable }}</td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Gender</th>
                        <td class="bg-gray-100">{{ $student_info->gender ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Sponsorship Status</th>
                        <td>{{ $student_info->sponsorship_status ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Accomodation Status</th>
                        <td class="bg-gray-100">{{ $student_info->accomodation_status ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Program Code</th>
                        <td>{{ $student_info->program_code ?? $unavailable ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Subjects Enrolled</th>
                        <td>{{ $student_info->subjects_enrolled ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Year of Study</th>
                        <td class="bg-gray-100">{{ $student_info->year_of_study?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Email</th>
                        <td>{{ $student_info->email ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Cell</th>
                        <td class="bg-gray-100">{{ $student_info->contact?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-5 text-gray-700"></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>