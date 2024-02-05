<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" id="navtop" class="bg-white dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 border-b border-gray-200 fixed z-30 w-full">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
       <div class="flex items-center justify-between">
          <div class="flex items-center justify-start">
            <x-componable.sidebar-toggler-button/>
             <form id="search" action="#" method="GET" class="hidden ml-36 lg:block lg:pl-32">
                <label for="topbar-search" class="sr-only">Search</label>
                <div class="mt-1 relative lg:w-64">
                   <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                      </svg>
                   </div>
                   <input type="text" name="search" id="topbar-search" class="bg-gray-50 border dark:bg-gray-800 dark:text-gray-500 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full pl-10 p-2.5" placeholder="Search">
                </div>
             </form>
          </div>
          <div class="flex items-center">
            <div class="mr-5">
               <x-componable.theme-toggler-button/>
            </div>
             <button id="toggleSidebarMobileSearch" type="button" class="lg:hidden text-gray-500 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg">
                <span class="sr-only">Search</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
             </button>
             <div class="hidden lg:flex items-center">
                @if (!Auth::user())
                  <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-base font-normal text-gray-500 mr-5">Guest</span>
                @endif
             </div>
             @if (Auth::user())
               <div class="flex items-center ms-6">
                  <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                  </svg>
                  <x-dropdown align="right" width="48">
                     <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                              <div class="hidden sm:flex" x-data="{{ json_encode(['name'=> Auth::User()->fullname.' '.Auth::User()->surname]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                              <div class="ms-1">
                                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                 </svg>
                              </div>
                        </button>
                     </x-slot>

                     <x-slot name="content">
                        <div class="flex sm:hidden text-sm dark:text-gray-100 dark:font-normal font-medium text-gray-700 p-3 justify-star" x-data="{{ json_encode(['name'=> Auth::User()->fullname.' '.Auth::User()->surname]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name">

                        </div>
                        <x-dropdown-link :href="route('profile')" wire:navigate >
                              {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                              <x-dropdown-link>
                                 {{ __('Log Out') }}
                              </x-dropdown-link>
                        </button>
                     </x-slot>
                  </x-dropdown>
               </div>
             @endif
          </div>
       </div>
    </div>
 </nav>