@php 
$logs = Storage::disk('public')->get('logs/.imports-YChdyIOAkduVCYsuOPsk192K');
$logs = json_decode($logs, true);
$count = 0;
@endphp
<x-app-layout>
    <section class="mt-10">
        <div class="flex justify-between mb-4">
            <div class="flex">
                <a href="{{ route('applications.index') }}" class="text-purple-600 font-bold cursor-pointer hover:scale-110 transition transition-100">Back</a>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('applications.logsview') }}" wire:navigate class=" text-slate-700 text-center font-semibold hover:text-purple-500" style="margin-top:2px;">Admissions</a>
                <a href="#" class="bg-purple-500 px-2 py-1 font-semibold text-white rounded">Imports</a>
            </div>
            <div class="flex">
                <span class="font-semibold text-gray-600"><sup>powered by </sup><span class="font-bold text-gray-600">LOG<span class="text-purple-600">ATRON</span></span></span>
            </div>
        </div>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-center pb-4 pl-4 pr-4 pt-4">
                    <div class="flex justify-center">
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
                </div>
                <div class="overflow-x-auto overflow-y-auto max-h-96">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">No.</th>
                                <th scope="col" class="px-4 py-3">Start Time</th>
                                <th scope="col" class="px-4 py-3">End Time</th>
                                <th scope="col" class="px-4 py-3">Effect</th>
                                <th scope="col" class="px-4 py-3">Processed By</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($logs == null)
                                <tr class>
                                    <th></th>
                                    <td></td>
                                    <td></td>
                                    <td class="p-4 font-semibold text-md">Nothing To Show</td>
                                </tr>
                            @else
                                @foreach ($logs as $key=>$value)
                                    @php
                                    $key = explode('_', $key);
                                    $key = $key[0];
                                    $count += 1;
                                    @endphp
                                    <tr wire:key="1" class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $count }}
                                        </th>
                                        <td class="px-4 py-3">{{ $value['start_time'] }}</td>
                                        <td class="px-4 py-3">{{ $value['end_time'] }}</td>
                                        <td class="px-4 py-3">{{ $value['effect'] }}</td>
                                        <td class="px-4 py-3">{{ $key }}</td>
                                        <td class="px-4 py-3">
                                        <a href="" wire:navigate class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white font-semibold rounded">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>                   
            </div>
        </div>
    </section>
</x-app-layout>
