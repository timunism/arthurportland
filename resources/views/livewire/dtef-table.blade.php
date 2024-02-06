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
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between p-4">
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
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium dark:text-gray-500 text-gray-900">Year:</label>
                            <select wire:model.live="year"
                                class="bg-gray-50 border dark:bg-gray-800 dark:text-gray-500 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="2022/2023">2022-2023</option>
                                <option value="2023/2024">2023-2024</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">No.</th>
                                <th scope="col" class="px-4 py-3">Fullname</th>
                                <th scope="col" class="px-4 py-3">Surname</th>
                                <th scope="col" class="px-4 py-3">National ID</th>
                                <th scope="col" class="px-4 py-3">Program Code</th>
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
                                    <td class="px-4 py-3">{{ $student->fullname }}</td>
                                    <td class="px-4 py-3">{{ $student->surname }}</td>
                                    <td class="px-4 py-3">{{ $student->national_id }}</td>
                                    <td class="px-4 py-3">{{ $student->program_code }}</td>
                                    <td class="px-4 py-3">
                                    <a href="{{ route('dtef.edit', $student->id) }}" wire:navigate class="px-3 py-1 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded">View</a>
                                    <a href="{{ route('dtefsubmission.entry', $student->id)}}" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white font-semibold rounded">Submit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                   
                <div class="flex justify-center mt-5 ">
                    <a href="{{ route('dtefsubmission.bulk')}}" class="px-3 py-1 border-2 border-green-500 bg-transparent text-green-500 font-semibold rounded">Bulk Submission</a>
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
