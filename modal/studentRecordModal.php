<link rel="stylesheet" href="../css/modal.css">
<script src="../js/studentRecordDt.js"></script>

<!-- Modal -->
<div class="modal fade modal-xl" id="studentRecordModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 750px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">STUDENT RECORD</h1>
                <button type="button" class="btn-close btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Table -->
                <div class="overflow-y-scroll" style="max-height: 600px;">
                    <div class="table-responsive m-2">
                        <table id="studentRecord" class="table table-bordered text-start mt-3" style="width: 2000px;">
                            <thead>
                                <tr>
                                    <th>LRN</th>
                                    <th style="width: 150px !important;">Name</th>
                                    <th>Sex</th>
                                    <th>Academic Year</th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th style="width: 150px !important;">Parent Name</th>
                                    <th style="width: 50px !important;">PSA Certificate</th>
                                    <th style="width: 50px !important;">Progress Report Card</th>
                                    <th style="width: 50px !important;">Medical Assessment</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" id="dataTable">
                                <?php
                                include "../connectDb.php";

                                // Fetching data from both student and student_archives
                                $query = "(SELECT 
                                        sa.lrn AS lrn,
                                        CONCAT(sa.last_name, ', ', sa.first_name, ', ', sa.middle_name) AS full_name,
                                        CONCAT(sa.last_name, ', ', sa.first_name) AS full_name_2,
                                        sa.middle_name AS student_middle_name,
                                        sa.sex AS sex,
                                        sa.academic_year AS academic_year,
                                        gl.grade_level AS grade_level,
                                        sec.section_name AS section_name,
                                        sf.psa_birth_certificate AS psa,
                                        sf.progress_report_card AS prc,
                                        sf.medical_assessment AS med,
                                        CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) AS parent_name
                                    FROM 
                                        student_archives sa
                                    LEFT JOIN 
                                        section sec ON sa.section_id = sec.section_id
                                    LEFT JOIN 
                                        grade_level gl ON sa.grade_level_id = gl.grade_level_id
                                    LEFT JOIN 
                                        parent p ON sa.parent_id = p.parent_id
                                    LEFT JOIN 
                                        student_file sf ON sf.student_id = sa.student_id)

                                    UNION ALL

                                    (SELECT 
                                        s.lrn AS lrn,
                                        CONCAT(s.last_name, ', ', s.first_name, ', ', s.middle_name) AS full_name,
                                        CONCAT(s.last_name, ', ', s.first_name) AS full_name_2,
                                        s.middle_name AS student_middle_name,
                                        s.sex AS sex,
                                        s.academic_year AS academic_year,
                                        gl.grade_level AS grade_level,
                                        sec.section_name AS section_name,
                                        sf.psa_birth_certificate AS psa,
                                        sf.progress_report_card AS prc,
                                        sf.medical_assessment AS med,
                                        CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) AS parent_name
                                    FROM 
                                        student s
                                    LEFT JOIN 
                                        section sec ON s.section_id = sec.section_id
                                    LEFT JOIN 
                                        grade_level gl ON s.grade_level_id = gl.grade_level_id
                                    LEFT JOIN 
                                        parent p ON s.parent_id = p.parent_id
                                    LEFT JOIN 
                                        student_file sf ON sf.student_id = s.student_id)
                                ";

                                $result = mysqli_query($conn, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <?php
                                            if ($row['lrn'] != NULL) { ?>
                                                <td>
                                                    <?php echo htmlspecialchars($row['lrn']); ?>
                                                </td>
                                            <?php } else { ?>
                                                <td style="color: gray;">Pending</td>
                                            <?php }
                                            ?>
                                            </td>
                                            <td> <?php if ($row['student_middle_name'] == NULL) {
                                                        echo htmlspecialchars($row['full_name_2']);
                                                    } else {
                                                        echo htmlspecialchars($row['full_name']);
                                                    } ?> </td>
                                            <td class="text-capitalize"> <?php echo htmlspecialchars($row['sex']) ?> </td>
                                            <td> <?php echo htmlspecialchars($row['academic_year']) ?> </td>
                                            <td> <?php echo htmlspecialchars($row['grade_level']) ?> </td>
                                            <td> <?php echo htmlspecialchars($row['section_name']) ?> </td>
                                            <td> <?php echo htmlspecialchars($row['parent_name']) ?> </td>
                                            <?php if ($row['psa'] != NULL) { ?>
                                                <td>

                                                    <a class="pt-2 btn btn-secondary d-flex flex-row" style="font-size: 16px; height: 40px; width: 150px; background-color: var(--maroon); color: var(--white);" href="<?php echo htmlspecialchars($row['psa']) ?>" download>

                                                        Download<iconify-icon class="ps-4" icon="tabler:download" style="font-size: 20px; color: var(--white);"></iconify-icon>
                                                    </a>
                                                </td>
                                            <?php
                                            } else { ?>
                                                <td style="color: gray;">
                                                    No File Uploaded.
                                                </td>
                                            <?php
                                            } ?>
                                            <?php if ($row['psa'] != NULL) { ?>
                                                <td>

                                                    <a class="pt-2 btn btn-secondary d-flex flex-row" style="font-size: 16px; height: 40px; width: 150px; background-color: var(--maroon); color: var(--white);" href="<?php echo htmlspecialchars($row['prc']) ?>" download>

                                                        Download<iconify-icon class="ps-4" icon="tabler:download" style="font-size: 20px; color: var(--white);"></iconify-icon>
                                                    </a>
                                                </td>
                                            <?php
                                            } else { ?>
                                                <td style="color: gray;">
                                                    No File Uploaded.
                                                </td>
                                            <?php
                                            } ?>
                                            <?php if ($row['psa'] != NULL) { ?>
                                                <td>

                                                    <a class="pt-2 btn btn-secondary d-flex flex-row" style="font-size: 16px; height: 40px; width: 150px; background-color: var(--maroon); color: var(--white);" href="<?php echo htmlspecialchars($row['med']) ?>" download>

                                                        Download<iconify-icon class="ps-4" icon="tabler:download" style="font-size: 20px; color: var(--white);"></iconify-icon>
                                                    </a>
                                                </td>
                                            <?php
                                            } else { ?>
                                                <td style="color: gray;">
                                                    No File Uploaded.
                                                </td>
                                            <?php
                                            } ?>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td class='text-center' colspan="10">No records found.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>