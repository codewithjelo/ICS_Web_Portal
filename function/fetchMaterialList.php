<script src="../js/deleteMaterial.js"></script>
<?php
include '../connectDb.php';


$sectionFilter = isset($_POST['section_filter']) ? intval($_POST['section_filter']) : 0;


$query = "SELECT school_materials, school_materials_id FROM school_materials WHERE section_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $sectionFilter);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $filePath = $row['school_materials'];

        
        $fileName = str_replace('../school_materials/', '', $filePath);
?>
        <div class="row column-gap-5 mt-3 mx-1 align-content-center position-relative rounded-3 border border-1" style="height: 40px;">
            <input type="hidden" name="material_id" value="">
            <div class="col-md-8 ms-2 fw-bold"><?php echo htmlspecialchars($fileName); ?></div>
            <div class="col-md-2">
                <a class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 me-5" style="height: 40px; width: 50px; background-color: transparent;" href="<?php echo htmlspecialchars($row['school_materials']); ?>" download>
                    <iconify-icon class="pt-1" icon="tabler:download" style="font-size: 20px; color: black;"></iconify-icon>
                </a>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 delete-file" onclick="deleteMaterial(this)" data-material-id="<?php echo htmlspecialchars($row['school_materials_id']); ?>" style="height: 40px; width: 50px; background-color: transparent;">
                    <iconify-icon class="pt-1" icon="mingcute:delete-line" style="font-size: 20px; color: black;"></iconify-icon>
                </button>
            </div>
        </div>
    <?php
    }
} else { ?>
    <p class="text-center pt-5" style="color: gray;">No uploaded school materials.</p>
<?php }

$stmt->close();
$conn->close();
?>