<?php 
/* Dynamic Numbering System for Paginated Tables */
$current_page = $students->currentPage;
$initial_count = 1;

// We start counting from 1 on the first page, from x on every other page
if ($current_page > 1) {
    // linear equation for x
    $initial_count = $perPage * ($current_page - 1) + 1;
}
$count = $initial_count - 1;
?>
<div>
    <section class="mt-10">
        <x-componable.table-header title='Applications' />
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between pb-4 pl-4 pr-4 pt-16">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="text"
                            class="bg-gray-50 border dark:bg-gray-800 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                            placeholder="Search" required="">
                        </div>
                    </div>
                    <div class="flex space-x-8">
                        <div class="flex space-x-0 items-center">
                            <label class="mr-3 text-sm font-medium dark:text-gray-500 text-gray-900">Year:</label>
                            <select wire:model.live="year"
                                class="bg-gray-50 border dark:bg-gray-800 dark:text-gray-500 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  block p-2.5 pr-8">
                                <option value="">All</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <label class="mr-3 text-sm font-medium dark:text-gray-500 text-gray-900">Course:</label>
                            <select wire:model.live="course_code" id="course_code"
                                class="bg-gray-50 border dark:bg-gray-800 dark:text-gray-500 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-8">
                                <option value="">All</option>
                                <option value="ACCA">ACCA</option>
                                <option value="CIMA">CIMA</option>
                                <option value="AAT">AAT</option>
                                <option value="CFA">CFA</option>
                                <option value="BICA">BICA</option>
                            </select>
                        </div>

                        <div class="flex items-center">
                            <label class="mr-3 text-sm font-medium dark:text-gray-500 text-gray-900">Admission:</label>
                            <select wire:model.live="admission"
                                class="bg-gray-50 border dark:bg-gray-800 dark:text-gray-500 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-8">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="admitted">Admitted</option>
                                <option value="waitlisted">Waitlisted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">No.</th>
                                <th scope="col" class="px-4 py-3" wire:click="setSortBy('id')">
                                    @include('livewire.includes.sort-button', [
                                        "name"=>"id",
                                        "displayName"=>"PROFILE ID"
                                    ])
                                </th>
                                <th scope="col" class="px-4 py-3" wire:click="setSortBy('fullname')">
                                    @include('livewire.includes.sort-button', [
                                        "name"=>"fullname",
                                        "displayName"=>"FULLNAME"
                                    ])
                                </th>
                                <th scope="col" class="px-4 py-3" wire:click="setSortBy('surname')">
                                    @include('livewire.includes.sort-button', [
                                        "name"=>"surname",
                                        "displayName"=>"SURNAME"
                                    ])
                                </th>
                                <th scope="col" class="px-4 py-3" wire:click="setSortBy('gender')">
                                    @include('livewire.includes.sort-button', [
                                        "name"=>"gender",
                                        "displayName"=>"GENDER"
                                    ])
                                </th>
                                <th scope="col" class="px-4 py-3">National ID</th>
                                <th scope="col" class="px-4 py-3">Department</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <?php $count += 1; ?>
                                <tr wire:key="1" class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $count }}
                                    </th>
                                    <td class="px-4 py-3">{{ $student->student_profile_id }}</td>
                                    <td class="px-4 py-3">{{ $student->fullname }}</td>
                                    <td class="px-4 py-3">{{ $student->surname }}</td>
                                    <td class="px-4 py-3">{{ $student->gender }}</td>
                                    <td class="px-4 py-3">
                                        @if ($student->omang != null)
                                            {{ $student->omang }}
                                        @else
                                            {{ $student->passport_number }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $student->course_code }}</td>
                                    <td class="px-4 py-3">
                                    <a href="{{ route('applications.edit', $student->student_profile_id)}}" wire:navigate class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white font-semibold rounded">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                   
                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live='perPage'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

