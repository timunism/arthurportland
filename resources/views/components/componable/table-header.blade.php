@props(['title'])
<div class="flex justify-center relative pb-8">
   <div 
   style="position:absolute;width:85%;z-index:10 !important;background:linear-gradient(to right, #671c89, #cd2aff)"
   class="dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-900 rounded-lg mt-4 p-4">
      <div class="flex items-center justify-between">
         <div class="flex-shrink-0">
            <span class="text-xl leading-none font-semibold dark:text-white text-gray-100">{{ $title }}</span>
         </div>
      </div>
   </div>
</div>