/* SPECIAL FUNCTIONS START */

// Function for capitalizing text
function capitalize(text){
    var x = text[0];
    var y = text.replace(text[0],'');
    text = x.toUpperCase() + y;

    return text;
}

export default {
    capitalize
}