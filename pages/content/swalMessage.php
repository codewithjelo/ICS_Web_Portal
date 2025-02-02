<?php
// Check if there is a SweetAlert message in the session
if (isset($_SESSION['swal_message'])) {
    $swalType = $_SESSION['swal_message']['type'];
    $swalTitle = $_SESSION['swal_message']['title'];

    // Output the JavaScript to trigger the SweetAlert
    echo "<script>
            Swal.fire({
                icon: '$swalType',
                title: '$swalTitle',
                confirmButtonText: 'OK'
            });
        </script>";

    // Clear the session variable to prevent the message from showing again
    unset($_SESSION['swal_message']);
}
