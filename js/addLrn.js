function addLrn(button) {
    // Find the closest row and its inputs
    var row = button.closest("tr");
    var studentId = button.getAttribute("data-student-id");

    // Get the form fields dynamically based on the row
    var studentLrn = row.querySelector(".studentLrn").value;
    var studentPassword = row.querySelector(".studentPassword").value;
    var confirmPassword = row.querySelector(".confirmPassword").value;

    if (studentLrn.length !== 12 || !/^\d{12}$/.test(studentLrn)) {
        Swal.fire("Error!", "LRN must be exactly 12 digits.", "error");
        return;
    }

    if (studentPassword.length < 8) {
        Swal.fire("Error!", "Password must be at least 8 characters long.", "error");
        return;
    }

    if (studentPassword !== confirmPassword) {
        Swal.fire("Error!", "Passwords do not match.", "error");
        return;
    }

    // SweetAlert2 confirmation
    Swal.fire({
        title: "Create account?",
        text: "Press YES to confirm.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "YES",
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX request to send the data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/addStudentAccount.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // On success, remove the row
                    row.remove();

                    Swal.fire("Success!", "Student account created successfully.", "success");
                    console.log(studentId, studentLrn, studentPassword, confirmPassword)
                } else {
                    Swal.fire("Error!", "There was an issue creating the account.", "error");
                }
            };

            xhr.send(
                "get_lrn_student_id=" + encodeURIComponent(studentId) +
                "&student_lrn=" + encodeURIComponent(studentLrn) +
                "&student_password=" + encodeURIComponent(studentPassword) +
                "&confirm_password=" + encodeURIComponent(confirmPassword)
            );
            
            
        }
    });
}
