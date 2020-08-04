document.addEventListener("DOMContentLoaded", function(){
    M.Collapsible.init($('.collapsible'));
    M.FormSelect.init($('select'));
    M.Datepicker.init($('.datepicker'), {
        autoClose: true,
        format: 'yyyy-mm-dd',
        setDefaultDate: true,
        defaultDate: new Date()
    });
});