{{-- 
    NOTE: @props is only for anynomous components. 
    so to get it to work here, I declared a public variable '$id'
    on this component's class.
--}}
@props(['id'])
<a href="#"
    wire:click="deactivate({{ $id }})"
    class="px-3 py-1 border-2 hover:border-red-500 hover:bg-transparent bg-red-500 text-white hover:text-red-500 transition-all font-semibold rounded">
    Deactivate
</a>