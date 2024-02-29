<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-center items-center h-screen">
            <div class="w-full p-6 bg-white rounded-lg shadow-lg">
                <h1 class="text-xl font-semibold">Import File</h1>
    
                <form action="{{ route('import_applicants.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="file">File:</label>
                        <input class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="file" id="import_file" name="import_file">
                    </div>
    
                    <div class="flex justify-end">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
