<script type="module">
    import '/ext/axios.min.js';
    import textHandler from '/ext/text_manipulation.js';
    import register from '/ext/registration.js';
  
    // Text Handling Functions
    const { capitalize } = textHandler;
  
    // Retrieve Courses
    const { getCourses } = register;
    
    try {
        getCourses(capitalize);
        console.log(getCourses(capitalize));
    }
    catch {
        
    }
</script>