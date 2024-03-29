{{-- 
    NOTE: @props is only for anynomous components. 
    so to get it to work here, I declared a public variable '$id'
    on this component's class.
--}}
@props(['id'])
<a href="#"
    <?php 
    $one_time_key = 'KEY'.random_int(1, 90).random_int(100, 199)
    ?>
    wire:click="admit({{ $id }})"
    wire:confirm="Are you sure?"
    class="px-3 py-1 border-2 hover:border-green-600 hover:bg-transparent bg-green-600 text-white hover:text-green-600 transition-all font-semibold rounded">
    Admit
</a>