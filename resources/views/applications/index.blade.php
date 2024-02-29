<x-app-layout>
    <div class="mt-10">
        @if (
            Auth::User()->access == 'unrestricted' ||
            Auth::User()->access == 'records' ||
            Auth::User()->access == 'admin'
            )
            <x-componable.dashboard-elevated route="applications.logsview" title="View Logs"/>
        @endif
    </div>
    <livewire:applications-table />
</x-app-layout>
