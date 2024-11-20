<?php
include "../connectDb.php";

if (isset($_POST['material_id'])) {
    $material_id = $_POST['material_id'];

    // Delete the announcement from the database
    $query = "DELETE FROM school_materials WHERE school_materials_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $material_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
