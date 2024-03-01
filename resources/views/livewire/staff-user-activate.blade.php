{{-- 
    NOTE: @props is only for anynomous components. 
    so to get it to work here, I declared a public variable '$id'
    on this component's class.
--}}
@props(['id'])
<a href="#"
    wire:click="activate({{ $id }})"
    class="px-3 py-1 border-2 hover:border-green-600 hover:bg-transparent bg-green-600 text-white hover:text-green-600 transition-all font-semibold rounded"
    >
    Activate
</a>