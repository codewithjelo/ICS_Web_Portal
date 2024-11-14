<?php
include '../connectDb.php';

// Get section filter from POST request
$sectionFilter = isset($_POST['section_filter']) ? intval($_POST['section_filter']) : 0;

// Query the database based on the selected section ID
$query = "SELECT school_materials, school_materials_id FROM school_materials WHERE section_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $sectionFilter);
$stmt->execute();
$result = $stmt->get_result();

// Output results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get the full path of the file
        $filePath = $row['school_materials'];
        
        // Remove the "../school_materials/" part from the file name for display purposes
        $fileName = str_replace('../school_materials/', '', $filePath);
        ?>
        <div class="row column-gap-5 mt-3 mx-1 align-content-center position-relative rounded-3 border border-1" style="height: 40px;">
            <div class="col-md-8 ms-2"><?php echo htmlspecialchars($fileName); ?></div>
            <div class="col-md-2">
                <a class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 me-5" style="height: 40px; width: 50px; background-color: transparent;" href="<?php echo htmlspecialchars($row['school_materials']); ?>" download>
                    <i class="bi bi-download" style="color: black;"></i>
                </a>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 delete-file" data-file-id="<?php echo htmlspecialchars($row['school_materials_id']); ?>" style="height: 40px; width: 50px; background-color: transparent;">
                    <i class="bi bi-trash" style="color: black;"></i>
                </button>
            </div>
        </div>
        <?php
    }
} else { ?>
    <p class="text-center pt-5" style="color: gray;">No uploaded school materials.</p>;
<?php }

$stmt->close();
$conn->close();
?>
