<link rel="stylesheet" href="../css/modal.css">

<div class="modal fade modal-xl" id="viewMaterialsModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 600px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">LEARNING MATERIALS</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                include '../connectDb.php';

                $section_id = $_SESSION['section_id'];

                $query = "SELECT school_materials, school_materials_id FROM school_materials WHERE section_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $section_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Output results
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $file_path = $row['school_materials'];

                        $file_name = str_replace('../school_materials/', '', $file_path);
                ?>
                        <div class="row column-gap-5 mt-3 mx-1 align-content-center position-relative rounded-3 border border-1" style="height: 40px;">
                            <input type="hidden" name="material_id" value="">
                            <div class="col-md-10 ms-2 fw-bold"><?php echo htmlspecialchars($file_name); ?></div>
                            <div class="col-md-2">
                                <a class="btn btn-secondary position-absolute top-50 end-0 translate-middle-y border border-0 mt-1" style="height: 40px; width: 50px; background-color: transparent;" href="<?php echo htmlspecialchars($row['school_materials']); ?>" download>
                                    <iconify-icon icon="tabler:download" style="font-size: 20px; color: black;"></iconify-icon>
                                </a>
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
            </div>
        </div>
    </div>
</div>