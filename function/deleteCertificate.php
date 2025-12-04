<?php
include "../connectDb.php";

if (isset($_POST['certificate_id'])) {
    $certificateId = $_POST['certificate_id'];

    
    $query = "DELETE FROM e_certificate WHERE e_certificate_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $certificateId);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
