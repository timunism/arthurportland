<?php
// Page Variables
$unavailable = 'not available'; 
?>
<x-app-layout>
    <div class="mt-6">
        {{-- Header Component Start --}}
        <x-componable.edit-header
        title="DTEF Result"
        year="For the Year {{ $student_info->year_of_study }} | Semester {{ 1 }}"
        status="{{ $student_info->student_status }}"
        backroute="dtef.results"
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
                        <th scope="col" class="px-6 py-2 text-gray-700">TR Number</th>
                        <td>{{ $student_info->tr_number ?? $unavailable }}</td>
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
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Year of Study</th>
                        <td class="bg-gray-100">{{ intval(date('Y'))-$student_info->year_of_study ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Current Semester</th>
                        <td class="bg-gray-100">{{ 1 ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Modules</th>
                        <td>{{ $student_info->subjects_enrolled ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Results</th>
                        <td>{{ $results->result ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Sponsorship Status</th>
                        <td>{{ $student_info->sponsorship_status ?? $unavailable ?? $unavailable }}</td>
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