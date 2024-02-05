@props(['users', 'count', 'routename'])
<div class="m-6 py-8 px-8 max-w-sm dark:bg-slate-700 bg-white rounded-xl shadow dark:shadow-slate-900 shadow-slate-300 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
    <img class="block mx-auto h-24 rounded-full sm:mx-0 sm:shrink-0" src="{{ url('storage/icons/user.png') }}" alt="Woman's Face" />
    <div class="text-center sm:text-left">
      <div class="">
        <p class="text-lg dark:text-gray-50 text-black font-semibold">
          {{ $users }}
        </p>
        <p class="text-gray-500 dark:text-blue-400 font-medium">
          Total of {{ $count }} 
        </p>
      </div>
    </div>
    <div class="flex justify-center">
        <a href="{{ route($routename) }}"  class="space-y-5 px-4 py-1 text-sm dark:text-green-500 dark:border-green-500 dark:hover:bg-green-500 text-btn-default font-semibold rounded-full border border-btn-default hover:text-white hover:bg-btn-default hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">View</a>
    </div>
</div>