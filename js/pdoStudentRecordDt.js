$('#pdoStudentRecordModal').on('shown.bs.modal', function () {
    $('#pdoStudentRecord').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "lengthChange": false
    });
});
