<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Grades - ICS Teacher Portal</title>
    <link rel="stylesheet" href="../css/modal.css">
    <script src="../js/gradeLevelSelect.js"></script>
    <script src="../js/subjectSelect.js"></script>
</head>

<body>
    <div class="modal fade modal-lg" id="inputGradesModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                    <h1 class="modal-title" id="staticBackdropLabel">INPUT GRADES</h1>
                    <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="form-container">
                    <form id="uploadScheduleForm" action="../function/uploadGrades.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <?php
                            $teacherId = $_SESSION['get_user_id']; ?>
                            <input type="hidden" name="teacher_id_input_grades" value="<?php echo $teacherId ?>">
                            <label for="sectionInputGrades" class="form-label">Section</label>
                            <select class="form-select" id="sectionInputGrades" name="section_input_grades" required>
                                <option selected disabled>Select</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="subjectInputGrades" class="form-label">Subject</label>
                            <select class="form-select" id="subjectInputGrades" name="subject_input_grades" required>
                                <option selected disabled>Select</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="uploadInputGrades" class="form-label">Upload Grades</label>
                            <input class="form-control" type="file" id="uploadInputGrades" name="upload_input_grades" accept=".xls, .xlsx" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 border-0" style="background-color: var(--maroon)">Submit</button>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>