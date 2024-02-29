<x-app-layout>
    <div class="flex justify-between mb-4" style="position:absolute;top:8vh;">
        <div class="flex">
            <a href="{{ route('applications.index') }}" class="text-purple-600 font-bold cursor-pointer hover:scale-110 transition transition-100">Back</a>
        </div>
    </div>
    <div class="container mx-auto" style="width:80%;margin-top:-8vh;">
        <div class="flex justify-center items-center h-screen">
            <div class="w-full p-6 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center relative pb-8">
                    <div 
                    style="position:absolute;top:-10vh;width:85%;z-index:10 !important;background:linear-gradient(to right, #671c89, #cd2aff)"
                    class="dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-900 rounded-lg mt-4 p-4">
                       <div class="flex items-center justify-between">
                          <div class="flex-shrink-0">
                             <span class="text-xl leading-none font-semibold dark:text-white text-gray-100">Import Students</span>
                          </div>
                       </div>
                    </div>
                 </div>
                <h1 class="text-xl font-semibold">File Type:</h1>
    
                <form action="{{ route('import_applicants.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="file">CSV | Excel</label>
                        <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="file" id="import_file" name="import_file" required>
                    </div>
    
                    <div class="flex justify-betwwen">
                        <x-input-error :messages="$errors->get('email')" class="mt-4 text-red-500 text-sm font-semibold"/>
                        <button class="bg-green-600 hover:scale-95 transition text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
