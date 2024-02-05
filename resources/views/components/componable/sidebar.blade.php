<?php 

// Link & Route Allocation for Students
$students = ['Defer', 'Withdraw', 'Transfer'];

// Link & Route Allocation for Admins
$admins = [
   1=>['name'=>'Applications', 'route'=>'applications.index', 'uri'=>'applications'], 
   2=>['name'=>'DTEF', 'route'=>'dtef.index', 'uri'=>'dtef']
];

$view = "";

if (Auth::User()) {
   if (Auth::User()->role != "student") {
      $view = $admins;
   }
   else {
      $view = $students;
   }
}
# Retrieve current page URI
# This is sent to the client, and then processed by javascript to highlight the current link
$currentSelection = request()->route()->uri();
$currentSelection = explode('/', $currentSelection);
$currentSelection = $currentSelection[0];
?>
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
                  <li class="ml-3">
                     <a id="apply" href="{{ route('applybot') }}" class="text-base dark:hover:text-white dark:hover:bg-gray-700 text-gray-300 dark:text-gray-400 font-normal rounded-lg hover:bg-theme-light flex items-center p-2 group ">
                        <svg class="w-6 h-6 dark:group-hover:text-white text-gray-300 flex-shrink-0 transition duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3 flex-1 whitespace-nowrap">Apply</span>
                     </a>
                  </li>
                @endif
             </ul>
          </div>
       </div>
    </div>
    {{-- URI sent by the server is rendered here --}}
   <span id="currentUri" class="{{ $currentSelection }}"></span>
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