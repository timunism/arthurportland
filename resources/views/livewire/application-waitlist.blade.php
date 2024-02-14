@props(['id'])
<a id="waitlistButton" href="#"
   wire:click="waitlist({{ $id }})"
   class="text-orange-600 hover:text-purple-500 transition-all font-semibold underline">
    Push to Waitlist
</a>
