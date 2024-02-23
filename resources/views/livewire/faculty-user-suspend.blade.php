{{-- 
    NOTE: @props is only for anynomous components. 
    so to get it to work here, I declared a public variable '$id'
    on this component's class.
--}}
@props(['id'])
<a href="#"
    wire:click="suspend({{ $id }})"
    class="px-3 py-1 border-2 hover:border-purple-500 hover:bg-transparent bg-purple-500 text-white hover:text-purple-500 transition-all font-semibold rounded">
    Suspend
</a>