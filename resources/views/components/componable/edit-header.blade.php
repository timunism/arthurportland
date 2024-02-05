@props(['title', 'year', 'status'])
<div class="bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
    <div class="flex items-center justify-between mb-4">
       <div class="flex-shrink-0">
          <span class="text-2xl sm:text-3xl leading-none font-bold dark:text-white text-gray-900">{{ $title }}</span>
          <h3 class="text-base font-normal text-gray-500">{{ $year }}</h3>
       </div>
       <div class="flex items-center justify-end flex-1 dark:text-green-500 text-green-500 text-base font-bold">
          {{ $status }}
       </div>
    </div>
    <div id="main-chart"></div>
 </div>