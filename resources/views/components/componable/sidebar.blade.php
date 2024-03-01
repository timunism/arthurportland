@php 
use App\Models\StudentProfile;
if (Auth::User()) {
   $hasApplied = StudentProfile::where('email', Auth::User()->email)->first();
}
// Link & Route Allocation for Students
$new_applicant = [
   1=>['name'=>'Apply', 'route'=>'apply.index', 'uri'=>'apply']
];
$applicant = [];

// Link & Route Allocation for Admins
$admin = [
   1=>['name'=>'Applications', 'route'=>'applications.index', 'uri'=>'applications'], 
   //2=>['name'=>'DTEF', 'route'=>'dtef.index', 'uri'=>'dtef']
];

$view = "";

if (Auth::User()) {
   if (Auth::User()->access != 'individual') {
      $view = $admin;
   }
   else {
      if (Auth::User()->role == 'applicant') {
         if ($hasApplied == null) {
            // Assume the user is a new applicant
            $view = $new_applicant;
         }
         else {
            $view = $applicant;
         }
      }
   }
}
# Retrieve current page URI
# This is sent to the client, and then processed by javascript to highlight the current link
$currentSelection = explode('/', request()->route()->uri());
$currentUri = $currentSelection[0];

# for Highlighting DTEF dropdown links
# I'll move this to JavaScript in the coming updates
$dtefUri = [
      'admissions'=>'none',
      'registrations'=>'none',
      'results'=>'none'
];
$forDtef = $currentSelection[1] ?? 'none';
foreach ($dtefUri as $key => $value) {
   if ($key == $forDtef){
      $dtefUri[$key] = 'dtef';
      break;
   }
}
@endphp
<aside id="sidebar" class="fixed hidden z-40 bg-theme-default h-full top-0 left-0 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75" aria-label="Sidebar">
   <div id="closeSidebar" class='toggleSidebarHitBox fixed right-0 bg-gray-400 opacity-50 lg:hidden' style="height: 100vh; width:100%"></div>
    <div class="relative flex-1 flex flex-col min-h-0 border-r dark:border-gray-700 border-theme-default bg-theme-default dark:bg-gray-800 dark:text-gray-400 pt-0 ">
       <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
          <div class="flex-1 px-3 bg-theme-default dark:bg-gray-800 dark:text-gray-400 divide-y space-y-1">
             <ul class="space-y-2 pb-2">
                <li>
                   <form action="#" method="GET" class="lg:hidden">
                      <label for="mobile-search" class="sr-only">Search</label>
                      <div class="relative">
                         <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                         </div>
                         <input type="text" name="email" id="mobile-search" class="bg-gray-50 border dark:border-gray-700 border-gray-300 text-gray-900 dark:text-gray-400 text-sm rounded-lg focus:ring-cyan-600 block w-full pl-10 p-2.5" placeholder="Search">
                      </div>
                   </form>
                </li>
                <div id="logo-holder">
                  <a href="" class="async-link" id="logo">
                     <img src="{{ url('storage/logo.png') }}" alt="Logo">
                  </a>
                </div>
                @if (Auth::user())
                  <li class="ml-3">
                     <a id="dashboard" href="{{ route('dashboard') }}" class="async-link text-base dark:hover:text-white dark:hover:bg-gray-700 dark:text-gray-400 text-gray-300 font-normal rounded-lg flex items-center mt-8 p-2 hover:bg-theme-light group">
                        <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 group-hover:scale-90 group-hover:rotate-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                           <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                     </a>
                  </li>
                  @if (Auth::User()->role != 'examinations_officer')
                     @foreach ($view as $link)
                     <li class="ml-3">
                        <a id="{{ $link['uri'] }}" href="{{ route($link['route']) }}" wire:navigate class="async-link text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-theme-light flex items-center p-2 group ">
                           <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 group-hover:scale-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                           </svg>
                           <span class="ml-3 flex-1 whitespace-nowrap">{{ $link['name'] }}</span>
                        </a>
                     </li>
                     @endforeach
                  @endif
                  @if (Auth::User()->access == 'admissions' || Auth::User()->access == 'unrestricted')
                     <li class="ml-3">
                        <a id="staff" href="{{ route('staff.index') }}" wire:navigate class="async-link text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-theme-light flex items-center p-2 group ">
                           <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 group-hover:scale-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                           </svg>
                           <span class="ml-3 flex-1 whitespace-nowrap">Staff</span>
                        </a>
                     </li>
                  @endif
                  @if (Auth::User()->access != 'individual')
                     <li class="ml-3">
                        <div class="relative" 
                           @if ($currentUri == 'dtef')
                              x-data="{ open: true }"
                           @else
                              x-data="{ open: false }"
                           @endif 
                           @click.outside="open = false" @close.stop="open = false">
                           <span id="" @click="open = ! open" class="cursor-pointer text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg flex items-center p-2 group ">
                              <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 group-hover:scale-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                              </svg>
                              <span class="ml-3 flex justify-between whitespace-nowrap">
                                 DTEF
                                 <span class="flex px-4 place-items-center mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                       <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                       />
                                    </svg> 
                                 </span>
                              </span>
                           </span>
                     
                           <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute z-50 mt-2 w-48 rounded-md shadow-lg ltr:origin-top-left rtl:origin-top-right start-0"
                                 style="display: none;"
                                 >
                              <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 px-2 border border-theme-light dark:bg-gray-700">
                                 @if (Auth::User()->role != 'examinations_officer' 
                                       && Auth::User()->role != 'lecture'
                                       && Auth::User()->role != 'hod')
                                    <a id="{{ $dtefUri['admissions'] }}" href="{{ route('dtef.admissions') }}" wire:navigate class="async-link my-1 text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-[#702c8f99] flex items-center p-2 group ">
                                       <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 group-hover:scale-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                       </svg>
                                       <span class="ml-3 flex-1 whitespace-nowrap">Admissions</span>
                                    </a>
                                    <a id="{{ $dtefUri['registrations'] }}" href="{{ route('dtef.registrations') }}" wire:navigate class="async-link text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-[#702c8f99] flex items-center p-2 group ">
                                       <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 group-hover:scale-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                       </svg>
                                       <span class="ml-3 flex-1 whitespace-nowrap">Registrations</span>
                                    </a>
                                 @endif
                                 @if (Auth::User()->role != 'lecturer' && Auth::User()->role != 'hod')
                                    <a id="{{ $dtefUri['results'] }}" href="{{ route('dtef.results') }}" wire:navigate class="async-link my-1 text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-[#702c8f99] flex items-center p-2 group ">
                                       <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 group-hover:scale-90 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                       </svg>
                                       <span class="ml-3 flex-1 whitespace-nowrap">Results</span>
                                    </a>
                                 @endif
                              </div>
                           </div>
                     </div>
                     </li>
                  @endif
                @endif
                @if (!Auth::user())
                  <li class="ml-3">
                     <a id="login" href="{{ route('login') }}" class="text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-theme-light flex items-center p-2 group ">
                        <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Sign In</span>
                     </a>
                  </li>
                  <li class="ml-3">
                     <a id="register" href="{{ route('register') }}" class="text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-theme-light flex items-center p-2 group ">
                        <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Sign Up</span>
                     </a>
                  </li>
                @endif
             </ul>
          </div>
       </div>
    </div>
    {{-- URI sent by the server is rendered here --}}
   <span id="currentUri" class="{{ $currentUri }}"></span>
   <script data-navigate-track>
   // Retrieve element with id currentUri
   var currentPage = document.getElementById('currentUri');
   // currentUri contains a classname that refers to the id of the current page's link
   // use that classname in the getElementById function to retrieve the link
   var sidebarLink = document.getElementById(currentPage.classList[0]);
   // highlight the link by adding the 'active link' css styles
   sidebarLink.classList.add('active-sidebar-link')
   // and voila
   </script>
 </aside>