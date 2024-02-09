<x-app-layout>
    <div class="flex mt-6 h-72 mb-16 justify-center">
        <div class="bg-gray-200 flex mt-2 pl-5 pr-5 rounded justify-center place-items-center">
            <a href="{{ route('apply.standard') }}">
                <div class="bg-white p-3 rounded-xl shadow-xl flex items-center justify-between mt-4 h-24 w-64">
                    <div class="flex space-x-6 items-center">
                        <div>
                            <p class="font-semibold text-sm text-gray-400">Using</p>
                            <p class="font-semibold text-base">Standard Form</p>
                        </div>              
                    </div>
                    
                    <div class="flex space-x-2 items-center">
                        <div class="bg-yellow-200 rounded-md p-2 flex items-center">
                            <p class="text-yellow-600 font-semibold text-xs">Default</p>
                        </div>
                    </div>    
                </div>
            </a>
        </div>
        <div class="bg-gray-200 flex mt-2 pl-5 pr-5 rounded justify-center place-items-center">
            <a href="{{ route('apply.chatbot') }}">
                <div class="bg-white p-3 rounded-xl shadow-xl flex items-center justify-between mt-4 h-24  w-64">
                    <div class="flex space-x-6 items-center">
                        <div>
                            <p class="font-semibold text-sm text-gray-400">Using</p>
                            <p class="font-semibold text-base">Interactive Chatbot</p>
                        </div>              
                    </div>
                    
                    <div class="flex space-x-2 items-center">
                        <div class="bg-yellow-200 rounded-md p-2 flex items-center">
                            <p class="text-yellow-600 font-semibold text-xs">New</p>
                        </div>
                    </div>    
                </div>
            </a>
        </div>
    </div>
</x-app-layout>