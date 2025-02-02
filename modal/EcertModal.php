<link rel="stylesheet" href="../css/modal.css">

<!-- Modal -->
<div class="modal fade modal-xl" id="eCertModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 600px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">E-CERTIFICATE</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0;">


                <ul class="nav nav-tabs mx-3" id="uploadTabs" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="post-tab-cert" data-bs-toggle="tab" data-bs-target="#postCert" type="button" role="tab" aria-controls="post" aria-selected="true" style="color: black">Post</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="uploaded-tab-cert" data-bs-toggle="tab" data-bs-target="#uploadedCert" type="button" role="tab" aria-controls="uploaded" aria-selected="false" style="color: black">Uploaded</button>
                    </li>
                </ul>


                <div class="tab-content" id="postTabContent">


                    <div class="tab-pane fade show active" id="postCert" role="tabpanel" aria-labelledby="post-tab-cert" style="height: 400px;">

                        <!-- Upload Section -->
                        <div class="card m-3">


                            <div class="card-body" style="height: 358px;">

                                <h5 class="card-title">Post</h5>

                                <form action="../function/uploadCertificate.php" id="uploadCertificate" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="sectionCertificate" class="form-label">Section</label>
                                        <select id="sectionCertificate" class="form-select" name="section_cert">
                                            <option selected disabled>Section</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="studentCertificate" class="form-label">Student Name</label>
                                        <select id="studentCertificate" class="form-select" name="student_cert">
                                            <option selected disabled>Select Student</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="certInput" class="form-label">Upload Certificate</label>
                                        <input type="file" accept=".jpg, .png" class="form-control" id="certInput" name="student_certificate" required>

                                    </div>

                                    <input type="hidden" name="full_name" id="fullName">

                                    <button type="submit" class="btn btn-primary border-0" style="background-color: var(--maroon)">Post</button>

                                </form>

                            </div>


                        </div>


                    </div>


                    <div class="tab-pane fade" id="uploadedCert" role="tabpanel" aria-labelledby="uploaded-tab-cert" style="height: 400px;">
                        <!-- Uploaded Section -->
                        <div class="card m-3 overflow-y-auto pb-2" style="height: 360px;">

                            <div class="card-body">

                                <div class="row position-relative">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Uploaded</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-absolute top-50 end-0 translate-middle-y pe-2">
                                            <select class="form-select" id="sectionCertificateFilter" name="section_certificate_filter">
                                                <option selected>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="overflow-y" id="uploadedCertificate" style="max-height: 295px;">

                                    <!-- List of Uploaded Certificate by Section -->
                                    <?php
                                    include '../connectDb.php';
                                    if (isset($_SESSION['get_user_id'])) {
                                        $teacher_id = $_SESSION['get_user_id'];
                                        // Query the database based on the selected section ID
                                        $query = "SELECT e_certificate, full_name, e_certificate_id FROM e_certificate
                                            WHERE teacher_id = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param('i', $teacher_id);
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
                                                        <button class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 delete-file me-3" onclick="deleteCertificate(this)" data-certificate-id="<?php echo htmlspecialchars($row['e_certificate_id']); ?>" style="height: 40px; width: 50px; background-color: transparent;">
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
                                    }

                                    ?>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>