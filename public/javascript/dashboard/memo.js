$(document).ready(function() {
    $('#memo').DataTable({
        paging: false, // Disable paging
        searching: false, // Disable searching
        info: false, // Disable info text
        lengthChange: false // Disable the "Show x entries" dropdown
    });
});
