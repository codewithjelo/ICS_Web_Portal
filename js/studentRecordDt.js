$(document).ready(function() {
    $('#studentRecord').DataTable({
        scrollCollapse: false,
        paging: true,
        searching: true,
        fixedHeader: false,
        pageLength: 10,
        lengthChange: false
    });
});