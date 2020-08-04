const $ = (target) => {
    const elems = document.querySelectorAll(target);
    return (elems.length > 1) ? elems : document.querySelector(target);  
}

document.addEventListener("DOMContentLoaded", function(){
    M.Collapsible.init($('.collapsible'));
    M.FormSelect.init($('select'));
});