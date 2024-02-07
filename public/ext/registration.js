function getRoles(capitalize){
    axios.get('/get_roles')
    .then(function (response){
        let roles = response.data;
        let dropdown = document.getElementById('role');
        dropdown.options.length = 0; // reset options
        dropdown.add(new Option('Select Role', '')); // add a default option

        for (let role of roles){
        dropdown.add(new Option(
            capitalize(role.role), // text to display
            role.role, // value to post
            ))
        }
    });
}
function getCourses(capitalize){
    axios.get('/get_courses')
    .then(function (response){
        let courses = response.data;
        let dropdown = document.getElementById('course');
        dropdown.options.length = 0; // reset options
        dropdown.add(new Option('Select Course', '')); // add a default option

        for (let course of courses){
        dropdown.add(new Option(
            capitalize(course.course_name), // text to display
            course.id, // value to post
            ))
        }
    });
}

export default {
    getRoles,
    getCourses
}
