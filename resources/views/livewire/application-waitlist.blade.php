{{-- 
    NOTE: @props is only for anynomous components. 
    so to get it to work here, I declared a public variable '$id'
    on this component's class.
--}}
@props(['id'])
<a id="waitlistButton" href="#"
   wire:click="waitlist({{ $id }})"
   class="text-orange-600 hover:text-purple-500 transition-all font-semibold underline">
    Push to Waitlist
</a>
