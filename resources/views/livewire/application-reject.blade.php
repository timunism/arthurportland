@props(['id'])
<a href="#"
    wire:click="reject({{ $id }})"
    class="px-3 py-1 border-2 hover:border-red-500 hover:bg-transparent bg-red-500 text-white hover:text-red-500 transition-all font-semibold rounded">
    Reject
</a>
