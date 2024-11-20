<link rel="stylesheet" href="../css/modal.css">

<div class="modal fade modal-xl" id="viewCertModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 600px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">E-CERTIFICATE</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="overflow-y" id="uploadedCertificate" style="max-height: 295px;">

                    <!-- List of Uploaded Certificate by Section -->
                    <?php
                    include '../connectDb.php';

                    $student_id = $_SESSION['student_id'];
                    // Query the database based on the selected section ID
                    $query = "SELECT e_certificate, full_name, e_certificate_id FROM e_certificate
                            WHERE student_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $student_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Output results
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
                                    <a class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 me-3" style="height: 40px; width: 50px; background-color: transparent;" href="<?php echo htmlspecialchars($row['e_certificate']); ?>" download>
                                        <iconify-icon class="pt-1" icon="tabler:download" style="font-size: 20px; color: black;"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else { ?>
                        <p class="text-center pt-5" style="color: gray;">No certificate.</p>
                    <?php }

                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>