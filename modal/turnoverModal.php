<link rel="stylesheet" href="../css/modal.css">
<script src="../js/turnOverDt.js"></script>
<script src="../js/getIdTurnOver.js"></script>
<script src="../js/turnOverProcess.js"></script>
<script src="../js/studentStatus.js"></script>

<div class="modal fade modal-xl" id="turnOverModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 600px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">TURNOVER RECORD</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row overflow-y-scroll px-3" style="height: 450px;">


                    <table id="turnOverTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Grade Level</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Grade & Section</th>
                                <th>Academic Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../connectDb.php";
                            $current_year = date("Y");
                            $year_one = $current_year - 2;
                            $year_two = $current_year - 1;
                            $check_ay = "$year_one-$year_two";


                            if (isset($_SESSION['get_user_id'])) {
                                $teacher_id = $_SESSION['get_user_id'];

                                $query = "SELECT s.student_id AS student_id,
                                        CONCAT(s.first_name, ' ', LEFT(s.middle_name, 1), '. ', s.last_name) AS full_name,
                                        s.academic_year AS academic_year,
                                        sec.section_name AS section_name,
                                        gl.grade_level AS grade_level
                                    FROM 
                                        student s
                                    JOIN 
                                        teacher_section ts ON s.section_id = ts.section_id
                                    JOIN 
                                        section sec ON s.section_id = sec.section_id
                                    JOIN 
                                        grade_level gl ON s.grade_level_id = gl.grade_level_id
                                    WHERE 
                                        ts.teacher_id = ? AND s.academic_year = ? AND current_status = 'enrolled'";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param('is', $teacher_id, $check_ay);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td> <?php echo htmlspecialchars($row['full_name']) ?></td>
                                            <td> <?php echo htmlspecialchars($row['grade_level']) ?></td>
                                            <td> <?php echo htmlspecialchars($row['section_name']) ?></td>
                                            <td>
                                                <div class="col">
                                                    <?php $gradeLevelId = $_SESSION['grade_level_id']; ?>
                                                    <input type="hidden" id="getGradeLevel" value="<?php echo $gradeLevelId ?>">
                                                    <input type="hidden" id="getStudentId" name="get_student_id" value="">
                                                    <select class="form-select" id="studentStatus" name="student_status" required>
                                                        <option selected disabled>Select</option>
                                                        <option value="Passed">Passed</option>
                                                        <option value="Retained">Retained</option>
                                                        <option value="Dropped">Dropped</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col">
                                                    <select class="form-select" id="gradeSection" name="grade_section" required>
                                                        <option selected disabled>Select</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="academicYear" name="academic_year" placeholder="e.g., 2023-2024" style="width: 145px;" required>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary rounded-3"
                                                    onclick="submitTurnOver(this)" data-student-id="<?php echo htmlspecialchars($row['student_id']); ?>">
                                                    <i class="bi bi-arrow-return-right" style="color: white; font-size: 20px;"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class='text-center'>No records found.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            <?php }
                                $stmt->close();
                                $conn->close();
                            }
                            ?>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>