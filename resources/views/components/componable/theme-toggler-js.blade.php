<script>
    // JS code for the Theme Toggler Component
    // This initializes the event listeners needed for the theme-toggler button to work

    var darkIcon = document.getElementById('theme-toggle-dark-icon');
    var lightIcon = document.getElementById('theme-toggle-light-icon');
    
    function setTheme() {
        // Set theme on page load
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            lightIcon.classList.remove('hidden');
            // this adds the dark class to the html tag
            // which tells tailwind to prefer dark 
            document.documentElement.classList.add('dark')
            localStorage.theme = "dark";
        } else {
            darkIcon.classList.remove('hidden');
            document.documentElement.classList.remove('dark')
            localStorage.theme = "light";
        }
    }
    function toggleTheme() {
        if (localStorage.theme === 'dark') {
            localStorage.theme = 'light';
            document.documentElement.classList.remove('dark')
            lightIcon.classList.toggle('hidden');
            darkIcon.classList.toggle('hidden');
        }
        else if (localStorage.theme === 'light') {
            localStorage.theme = 'dark';
            document.documentElement.classList.add('dark')
            darkIcon.classList.toggle('hidden')
            lightIcon.classList.toggle('hidden');
        }
    }
    var themeToggler = document.getElementById('theme-toggle');
    themeToggler.addEventListener('click', toggleTheme);
    setTheme();
</script>