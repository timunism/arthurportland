<script>
    // Sets theme on page load (required for pages without a theme-toggler e.g. guest pages)
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        // this adds the dark class to the html tag
        // which tells tailwind to prefer dark styles
        document.documentElement.classList.add('dark')
        localStorage.theme = "dark";
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.theme = "light";
    }
</script>