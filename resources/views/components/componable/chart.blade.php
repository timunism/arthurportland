{{-- 
  DYNAMIC CHART GENERATOR (uses tw-elements to render charts to display)
  
  Possible Types:
  1. doughnut
  2. line
  3. polarArea
  4. pie
  5. radar
  6. bar  
--}}

@props(['size', 'type', 'label', 'xlist', 'ylist', 'colors'])
<div class="mx-auto {{ $size }} overflow-hidden">
  <h1 class="flex mx-auto justify-center font-medium text-gray-600">{{ $label }}</h1>
    <canvas
      data-te-chart={{ $type }}
      data-te-dataset-label={{ $label }}
      data-te-labels={{ $xlist }}
      data-te-dataset-data={{ $ylist }}
      data-te-dataset-background-color={{ $colors }}
    >
    </canvas>
</div>