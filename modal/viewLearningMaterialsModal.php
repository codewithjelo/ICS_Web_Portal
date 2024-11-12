


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Materials - ICS Parent Portal</title>
    <link rel="stylesheet" href="../css/classScheduleModal.css">
    <!-- Add Bootstrap CSS for modal styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Trigger AJAX to load materials when the modal is opened
        $('#viewMaterialsModal').on('show.bs.modal', function () {
            // Fetch the materials from the server (via AJAX)
            fetchMaterials();
        });

        // Function to fetch materials via AJAX
        function fetchMaterials() {
            $.ajax({
                url: 'fetchMaterials.php', // PHP file that handles fetching materials
                method: 'GET',
                success: function(response) {
                    // Populate modal with the response data (materials)
                    $('#materialsContainer').html(response);
                },
                error: function() {
                    $('#materialsContainer').html('<p>Error loading materials.</p>');
                }
            });
        }

        // Function to upload a new material and update the modal content immediately
        function uploadMaterial() {
            var formData = new FormData($('#uploadForm')[0]);

            $.ajax({
                url: 'uploadMaterial.php', // PHP file that handles file upload
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // After uploading, fetch the updated materials list
                    fetchMaterials();
                },
                error: function() {
                    alert('Error uploading material.');
                }
            });
        }
    </script>
</head>
<body>
    <div class="modal fade modal-xl" id="viewMaterialsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">LEARNING MATERIALS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="materialsContainer">
                    <!-- Materials will be loaded here by AJAX -->
                    <?php

// Assuming the section ID is stored in the session for the logged-in user
$section_id = $_SESSION['section_id']; // Modify this based on how you store the section_id

// Database connection
include '../connectDb.php';

// Fetch materials from the database for the specific section
$query = "SELECT * FROM school_materials WHERE section_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $section_id);  // "i" means integer
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to store materials
$materials = [];

if ($result && $result->num_rows > 0) {
    // Fetch all materials into the $materials array
    while ($row = $result->fetch_assoc()) {
        $materials[] = $row;
    }
}

// Check if materials exist and display them
if (!empty($materials)) {
    foreach ($materials as $material) {
        echo '<div class="material-card mb-3">';
        echo '<div class="material-card-text">';
        echo '<strong>' . basename(htmlspecialchars($material['school_materials'])) . '</strong>';
        echo '</div>';
        echo '<div class="material-card-icon">';
        echo '<a href="../uploads/' . htmlspecialchars($material['school_materials']) . '" download>';
        echo '<i class="bi bi-download"></i> Download';
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No materials available for this section.</p>';
}
?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
