function submitTurnOver(button) {
    const row = button.closest("tr");
    const studentId = button.getAttribute("data-student-id");
    const studentStatus = row.querySelector(".studentStatus").value;
    const gradeSection = row.querySelector(".gradeSection").value;
    const academicYear = row.querySelector(".academicYear").value;

    // Check if required fields are empty
    if (!studentStatus || (studentStatus !== "Dropped" && (!gradeSection || !academicYear))) {
        Swal.fire("Error!", "Please fill in all required fields.", "error");
        return; // Prevent the request if fields are empty
    }

    // SweetAlert2 confirmation before turnover
    Swal.fire({
        title: "Turnover Student?",
        text: "Press YES if you want to proceed.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "YES",
    }).then((result) => {
        if (result.isConfirmed) {
            // Create AJAX request to send data
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/turnOverStudent.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Handle response
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Successfully processed, now remove the student row
                    row.remove();

                    // Show success message
                    Swal.fire("Turnover Processed!", "Student turnover processed successfully.", "success");
                } else {
                    // Show error message
                    Swal.fire("Error!", "There was an issue processing the student turnover. Please try again.", "error");
                }
            };

            // Send the request with all necessary data
            xhr.send(
                `get_student_id=${studentId}&student_status=${studentStatus}&grade_section=${gradeSection}&academic_year=${academicYear}`
            );
        }
    });
}
