@php 
use App\Models\StudentCoursePaper;

$papers = StudentCoursePaper::all();
@endphp
<div class="relative group">
    <div id="dropdown-button" class="flex justify-between cursor-pointer border text-sm font-semibold border-gray-500 p-2 w-48 rounded-md" >
      <span class="ml-2">Choose...</span>
      <svg xmlns="http://www.w3.org/2000/svg" class="flex justify-end w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </div>
    <div id="dropdown-menu" class="cursor-pointer grid grid-cols-3 hidden absolute mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1">
        <!-- Dropdown content goes here -->
        @foreach ($papers as $paper)
            <div class="flex justify-between">
                <span class="flex ml-3 justify-start place-items-center">{{ $paper->paper_name }}
                    <input type="checkbox" name="paper_{{ $paper->id }}" id="paper_{{ $paper->id }}" class="mx-2 p-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md"/>
                </span>
            </div>
        @endforeach
    </div>
</div>
<script>
const dropdownButton = document.getElementById('dropdown-button');
const dropdownMenu = document.getElementById('dropdown-menu');
const searchInput = document.getElementById('search-input');
let isOpen = false; // Set to true to open the dropdown by default

// Function to toggle the dropdown state
function toggleDropdown() {
    isOpen = !isOpen;
    dropdownMenu.classList.toggle('hidden', !isOpen);
}

dropdownButton.addEventListener('click', () => {
    toggleDropdown();
});
</script>