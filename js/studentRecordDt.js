$(document).ready(function() {
    $('#studentRecord').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true, // Disable client-side sorting
        "lengthChange": false
    });
});
