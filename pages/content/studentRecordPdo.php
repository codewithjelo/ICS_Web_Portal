<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/studentRecordModal.css">
<script src="../js/studentRecordDt.js"></script>

<div class="student-record-container row">
    <div class="student-record-dashboard p-2">
        <div class="sr-pdo-scroll" style="max-height: 500px;">
            <h2 class="text-white d-flex align-items-center justify-content-center my-2">STUDENT RECORDS</h2>

            <div class="table-responsive m-2" style="max-height: 440px; border-radius: 5px; overflow-y: scroll;">
                <table id="studentRecord" class="table table-bordered text-start"
                    style="table-layout: fixed; margin: 0;">
                    <thead style="background-color: var(--maroon);">
                        <tr style="font-size: 14px; color: var(--white);">
                            <th style="width: 15px">LRN</th>
                            <th style="width: 40px">Name</th>
                            <th>Sex</th>
                            <th style="width: 10px">School Year</th>
                            <th>Grade</th>
                            <th>Section</th>
                            <th>PSA</th>
                            <th>PRC</th>
                            <th>MA</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
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
                                        sf.medical_assessment AS med
                                    FROM 
                                        student_archives sa
                                    LEFT JOIN 
                                        section sec ON sa.section_id = sec.section_id
                                    LEFT JOIN 
                                        grade_level gl ON sa.grade_level_id = gl.grade_level_id
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
                                        sf.medical_assessment AS med
                                    FROM 
                                        student s
                                    LEFT JOIN 
                                        section sec ON s.section_id = sec.section_id
                                    LEFT JOIN 
                                        grade_level gl ON s.grade_level_id = gl.grade_level_id
                                    LEFT JOIN 
                                        student_file sf ON sf.student_id = s.student_id)
                                ";

                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr style="font-size: 12px;">
                                    <td class="fw-bold">
                                        <?php if ($row['lrn'] != NULL) {
                                            echo htmlspecialchars($row['lrn']);
                                        } else { ?>
                                            <span style="color: gray; width: 117px;">Pending</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-wrap">
                                        <?php
                                        if ($row['student_middle_name'] == NULL) {
                                            echo htmlspecialchars($row['full_name_2']);
                                        } else {
                                            echo htmlspecialchars($row['full_name']);
                                        }
                                        ?>
                                    </td>
                                    <td class="text-capitalize"><?php echo htmlspecialchars($row['sex']) ?></td>
                                    <td><?php echo htmlspecialchars($row['academic_year']) ?></td>
                                    <td><?php echo htmlspecialchars($row['grade_level']) ?></td>
                                    <td><?php echo htmlspecialchars($row['section_name']) ?></td>

                                    <!-- PSA Certificate -->
                                    <td>
                                        <?php if ($row['psa'] != NULL) { ?>
                                            <a class="btn btn-secondary d-flex align-items-center justify-content-center" title="Download File"
                                                style="padding: 5px; font-size: 12px; height: 30px; width: 65px; background-color: var(--maroon); color: var(--white);"
                                                href="<?php echo htmlspecialchars($row['psa']) ?>" download>
                                                <i class="bi bi-download me-1"></i>
                                            </a>
                                        <?php } else { ?>
                                            <span style="color: gray;">Not found.</span>
                                        <?php } ?>
                                    </td>

                                    <!-- Progress Report Card -->
                                    <td>
                                        <?php if ($row['prc'] != NULL) { ?>
                                            <a class="btn btn-secondary d-flex align-items-center justify-content-center" title="Download File"
                                                style="padding: 5px; font-size: 12px; height: 30px; width: 65px; background-color: var(--maroon); color: var(--white);"
                                                href="<?php echo htmlspecialchars($row['prc']) ?>" download>
                                                <i class="bi bi-download me-1"></i>
                                            </a>
                                        <?php } else { ?>
                                            <span style="color: gray;">Not found.</span>
                                        <?php } ?>
                                    </td>

                                    <!-- Medical Assessment -->
                                    <td>
                                        <?php if ($row['med'] != NULL) { ?>
                                            <a class="btn btn-secondary d-flex align-items-center justify-content-center" title="Download File"
                                                style="padding: 5px; font-size: 12px; height: 30px; width: 65px; background-color: var(--maroon); color: var(--white);"
                                                href="<?php echo htmlspecialchars($row['med']) ?>" download>
                                                <i class="bi bi-download"></i>
                                            </a>
                                        <?php } else { ?>
                                            <span style="color: gray;">Not found.</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td class='text-center' colspan="10">Not found.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>