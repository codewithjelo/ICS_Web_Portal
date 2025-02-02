<script src="../js/deleteCertificate.js"></script>
<?php
include '../connectDb.php';


$sectionFilter = isset($_POST['section_filter']) ? intval($_POST['section_filter']) : 0;


$query = "SELECT e_certificate, full_name, e_certificate_id FROM e_certificate WHERE section_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $sectionFilter);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="row column-gap-4 mt-3 mx-1 align-content-center position-relative rounded-3 border border-1" style="height: 80px;">
            <input type="hidden" name="certificate_id" value="">
            <div class="col-md-1 ms-2">
                <img class="img_fluid" src="<?php echo htmlspecialchars($row['e_certificate']); ?>" alt="e_certificate"
                    style="height: 60px;">
            </div>
            <div class="col-md-9">
                <p class="text-start fw-bold pt-4 me-5" style="font-size: 18px; color: black;"><?php echo htmlspecialchars($row['full_name']); ?></p>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 delete-file me-3"
                    onclick="deleteCertificate(this)" data-certificate-id="<?php echo htmlspecialchars($row['e_certificate_id']); ?>"
                    style="height: 40px; width: 50px; background-color: transparent;">
                    <iconify-icon class="pt-1" icon="mingcute:delete-line" style="font-size: 20px; color: black;"></iconify-icon>
                </button>
            </div>
        </div>
    <?php
    }
} else { ?>
    <p class="text-center pt-5" style="color: gray;">No uploaded certificate.</p>
<?php }

$stmt->close();
$conn->close();
?>