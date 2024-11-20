    <?php
    include '../connectDb.php';

    $grade_level_id = $_GET['grade_level_id'];

    // Query to get sections based on grade level
    $query = "SELECT gl.grade_level, s.section_id, s.section_name 
                FROM grade_level gl
                JOIN section s ON gl.grade_level_id = s.grade_level_id
                WHERE gl.grade_level_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $grade_level_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sections = [];
    while ($row = $result->fetch_assoc()) {
        $sections[] = $row;
    }

    echo json_encode($sections);

    $stmt->close();
    $conn->close();

    ?>
