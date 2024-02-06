<x-app-layout>
    <div class="mt-5">
        <div class="flex justify-end">
            <livewire:pulse.period-selector />
        </div>
        <div class="container">
            <div class="sm:flex">
                <livewire:pulse.usage cols="4" class="sm:flex-auto sm:w-32 sm:mr-2 mt-2"/>
                <livewire:pulse.slow-outgoing-requests cols="4" class="sm:flex-auto sm:w-64 mt-2"/>
            </div>
            <div class="flex">
                <livewire:pulse.exceptions cols="6" class="flex-auto mt-2"/>
            </div>
            <div class="sm:flex">
                <livewire:pulse.queues cols="4" class="sm:flex-auto sm:w-64 sm:mr-2 mt-2"/>
                <livewire:pulse.cache cols="4" class="sm:flex-auto sm:w-32 mt-2"/>
            </div>
            <div class="sm:flex">
                <livewire:pulse.slow-requests cols="6" class="sm:flex-auto mt-2"/>
            </div>
            <div class="sm:flex">
                <livewire:pulse.slow-queries cols="8" class="sm:flex-auto sm:mr-2 mt-2"/>
                <livewire:pulse.slow-jobs cols="6" class="sm:flex-auto mt-2"/>
            </div>
        </div>  
    </div>
</x-app-layout>
