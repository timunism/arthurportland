<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-componable.dashboard-elevated />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-semibold text-gray-700 m-2" style="font-size:1.4rem;">Home</h1>
                    @if (Auth::User() != 'student' && Auth::User() != 'applicant')
                        {{-- Begin Charts --}}
                        <div class="sm:flex mb-5 bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8">
                            {{-- Begin Chart Container --}}
                            <div class="sm:flex mx-auto">
                                <div class="m-2">
                                    {{-- Students Chart --}}
                                    <x-componable.chart
                                    type="pie"
                                    label="Active Students"
                                    xlist="['Male','Female']"
                                    ylist="[{{ $maleStudents }},{{ $femaleStudents }}]"
                                    colors="['rgb(168,83,233)','rgba(85,83,233)']"
                                    size="w-48"
                                    />
                                </div>
                                {{-- Lecturers Chart --}}
                                <div class="m-2">
                                    <x-componable.chart
                                    type="doughnut"
                                    label="Faculty"
                                    xlist="['Lecturer','hod']"
                                    ylist="[{{ $lecturers }},{{ $hods }}]"
                                    colors="['rgb(5,163,53)','rgb(37,120,236)']"
                                    size="w-48"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="sm:flex mb-5 justify-between bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8">
                            {{-- Active students --}}
                            <div class="m-2">
                                <x-componable.dashboard-sigline
                                    title="Active Students"
                                    count="{{ $maleStudents+$femaleStudents }}"
                                    colorid="1" 
                                    startcolor="rgb(168,83,233)"
                                    endcolor="rgba(85,83,233)"
                                    rectopacity="0.3"
                                />
                            </div>
                            <div class="m-2">
                                {{-- Active faculty --}}
                                <x-componable.dashboard-sigline
                                    title="Lecturers & Hods"
                                    count="{{ $lecturers+$hods }}"
                                    colorid="2"
                                    startcolor="rgb(5,163,53)"
                                    endcolor="rgb(37,120,236)"
                                    rectopacity="0.3"
                                />
                            </div>
                        </div>

                        {{-- End Charts --}}
                        {{-- Start Chart-Cards --}}
                        <div class="sm:flex justify-between">
                            <div class="bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8">
                                <div class="my-6 mx-auto">
                                    {{-- Begin Actual Chart --}}
                                    <x-componable.chart
                                    type="bar"
                                    label="DTEF Students (2023 - 2024)"
                                    xlist="['Male','Female']"
                                    ylist="[{{ $dtefMale }},{{ $dtefFemale }}]"
                                    colors="['rgb(168,83,233)','rgba(85,83,233)']"
                                    size="w-35"
                                    />
                                </div>
                            </div>
                            <div class="bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8">
                                <div class="my-6 mx-auto">
                                    {{-- Begin Actual Chart --}}
                                    <x-componable.chart
                                    type="bar"
                                    label="DTEF Submissions (Latest)"
                                    xlist="['Successful','Failed']"
                                    ylist="[{{ $dtefSuccessful }},{{ $dtefFailed }}]"
                                    colors="['rgb(232,140,78)','rgb(242,7,234)']"
                                    size="w-35"
                                    />
                                </div>
                            </div>
                        </div>
                        {{-- End Chart Cards --}}
                        <div class="mt-5 mb-5 bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8">
                            {{-- Begin Chart Container --}}
                            <div class="my-6 mx-auto">
                                {{-- Begin Actual Chart --}}
                                <x-componable.chart
                                type="line"
                                label="Pass Rate in Percentages (2021 - 2023)"
                                xlist="['2021','2022','2023']"
                                ylist="['63','75','89']"
                                colors="['rgba(85,83,233)','rgba(85,83,233)']"
                                size="w-35"
                                />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
