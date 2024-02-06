<?php
// Page Variables
$unavailable = 'not available'; 
?>
<x-app-layout>
    <div class="mt-6">
        {{-- Header Component Start --}}
        <x-componable.edit-header 
            title="Applicant Details"
            year="{{ $student_info->application_date }}"
            status="{{ $student_info->sponsor }} sponsored"
            backroute="applications.index"
            navigate="true"
            />
        {{-- Header Component End --}}
        <div class="mt-3 rounded-sm relative overflow-x-auto overflow-y bg-white">
            <table class="w-full text-left text-gray-700 dark:text-gray-400 edit-table">
                <thead class="text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6"></th>
                        <th scope="col" class="px-6"></th>
                    </tr>
                </thead>
                <tbody>
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
                        <th scope="col" class="px-6 py-2 text-gray-700">Sponsor</th>
                        <td>{{ $student_info->sponsor ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Accomodation Status</th>
                        <td class="bg-gray-100">{{ $student_info->accomodation_status ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Program Code</th>
                        <td>{{ $student_info->course_code ?? $unavailable ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Program</th>
                        <td>{{ $student_info->course_name ?? $unavailable ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Start Date</th>
                        <td class="bg-gray-100">{{ $student_info->start_date ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Email</th>
                        <td>{{ $student_info->email_address ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Cell</th>
                        <td class="bg-gray-100">{{ $student_info->phone ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Address</th>
                        <td>{{ $student_info->address ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Next of Kin Phone</th>
                        <td class="bg-gray-100">{{ $student_info->next_of_kin_phone ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Senior/High&nbsp;School</th>
                        <td>{{ $student_academic->senior_school ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">University/College</th>
                        <td class="bg-gray-100">{{ $student_academic->school ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Highest Qualification</th>
                        <td>{{ $student_academic->highest_qualification ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Qualifications</th>
                        <td class="bg-gray-100">{{ $student_academic->qualifications ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Employer</th>
                        <td>{{ $student_academic->employer ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Nature of Work</th>
                        <td class="bg-gray-100">{{ $student_academic->nature_of_work ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-5 text-gray-700">Documents</th>
                        <td><a href="{{ asset('storage/applicant_docs/'.$student_academic->documents) }}" class="underline cursor-pointer hover:text-blue-500">View Documents</a></td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 bg-gray-100 text-gray-700">Paper</th>
                        <td class="bg-gray-100">{{ $student_info->paper ?? $unavailable }}</td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-2 text-gray-700">Level of Entry</th>
                        <td>Level {{ $student_info->level_of_entry ?? $unavailable }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-6 space-x-3">
            <a href="#" class="px-3 py-1 border-2 hover:border-green-600 hover:bg-transparent bg-green-600 text-white hover:text-green-600 transition-all font-semibold rounded">Admit</a>
            <a href="#" class="px-3 py-1 border-2 hover:border-red-500 hover:bg-transparent bg-red-500 text-white hover:text-red-500 transition-all font-semibold rounded">Reject</a>
        </div>
        <div class="flex justify-center mt-2">
            <h1>OR</h1>
        </div>
        <div class="flex justify-center mt-2 space-x-3">
            <a href="#" class="text-orange-600 hover:text-purple-500 transition-all font-semibold underline">Push to Waitlist</a>
        </div>
    </div>
</x-app-layout>