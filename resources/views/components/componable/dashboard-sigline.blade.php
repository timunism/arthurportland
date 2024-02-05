@props(['startcolor', 'endcolor', 'title', 'count', 'rectopacity', 'colorid'])
<div class="flex">
    <div class="mt-2">
        <span class="p-2 text-gray font-semibold">
            {{ $count }}
        </span>
        <span class="p-2 text-gray-500 font-semibold">
            {{ $title }}
        </span>
    </div>
    <div>
        <svg class="w-24 ml-auto p-2" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="{{ $rectopacity }}" width="17" height="21" rx="1" fill="#e4e4f2"/>
            <rect opacity="{{ $rectopacity }}" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
            <rect opacity="{{ $rectopacity }}" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
            <rect opacity="{{ $rectopacity }}" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
            <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:{{ $colorid }})" stroke-width="2" stroke-linejoin="round"/>
            <defs>
            <linearGradient id="paint0_linear_622:{{ $colorid }}" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
            <stop stop-color="{{ $endcolor }}"/>
            <stop offset="1" stop-color="{{ $startcolor }}"/>
            </linearGradient>
            </defs>
        </svg>
    </div>
</div>