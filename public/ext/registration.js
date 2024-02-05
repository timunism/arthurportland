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

export default {
    getRoles
}
