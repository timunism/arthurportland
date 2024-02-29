<x-app-layout>
    <div class="mt-10">
        <div class="flex justify-end">
            @if (
                Auth::User()->access == 'unrestricted' ||
                Auth::User()->access == 'admissions' ||
                Auth::User()->access == 'admin')
                <a href="{{ route('import_applicants.index') }}"
                    class=" text-slate-600 text-md py-1 px-2 border-2 hover:scale-95 transition border-slate-600 font-semibold rounded"
                >Import</a>
            @endif
            @if (
                Auth::User()->access == 'unrestricted' ||
                Auth::User()->access == 'records' ||
                Auth::User()->access == 'admin'
                )
                <a href="{{ route('applications.logsview') }}"
                class=" text-white mx-2 text-md py-1 px-2 border-2 bg-slate-600 hover:scale-95 transition border-slate-600 font-semibold rounded"
                >View Logs</a>
            @endif
        </div>
    </div>
    <livewire:applications-table />
</x-app-layout>
