<?php
include "../connectDb.php";

if (isset($_POST['certificate_id'])) {
    $certificate_id = $_POST['certificate_id'];

    // Delete the announcement from the database
    $query = "DELETE FROM e_certificate WHERE e_certificate_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $certificate_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
