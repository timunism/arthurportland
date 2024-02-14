<x-app-layout>
    <div id="applybot-progression" class="mt-6 bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
        <div class="flex items-center justify-start text-purple-600 text-base font-bold">
            <a href="{{ route('apply.index') }}" class="mt-3 cursor-pointer hover:scale-110 transition transition-100">Back</a>
         </div>
        <div class="flex items-center justify-between mt-2 mb-10">
           <div class="flex-shrink-0">
              <span class="text-2xl sm:text-3xl leading-none font-bold dark:text-white text-gray-600">Application</span>
              <h3 class="text-base font-normal text-gray-500">Make sure to fill all fields accordingly before submitting</h3>
           </div>
        </div>
        <x-componable.application-form />
      </div>
      <x-scripts.application-form />
</x-app-layout>