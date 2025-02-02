function submitTurnOver(button) {
    var studentId = button.getAttribute("data-student-id");
    var studentStatus = document.getElementById("studentStatus").value;
    var gradeSection = document.getElementById("gradeSection").value;
    var academicYear = document.getElementById("academicYear").value;


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
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/turnOverStudent.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Handle response
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Successfully processed, now remove the student row
                    var studentRow = button.closest("tr");
                    studentRow.remove();

                    // Show success message
                    Swal.fire(
                        "Turnover Processed!",
                        "Student turnover processed successfully.",
                        "success"
                    );
                } else {
                    // Show error message
                    Swal.fire(
                        "Error!",
                        "There was an issue processing the student turnover. Please try again.",
                        "error"
                    );
                }
            };

            // Send the request with all necessary data
            xhr.send(
                "get_student_id=" + studentId +
                "&student_status=" + studentStatus +
                "&grade_section=" + (gradeSection || "") +
                "&academic_year=" + (academicYear || "")
            );
        }
    });
}
