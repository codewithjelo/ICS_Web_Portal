<?php
session_start();

if (isset($_SESSION['logged_in']) != True) {
    header("Location: ../index");
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ICS - Parent Dashboard</title>
<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
<?php include "../partials/head.php" ?>
<?php include "../modal/classScheduleModal.php" ?>
<?php include "../modal/gradesModal.php" ?>
<?php include "../modal/viewCertificateModal.php" ?>
<?php include "../modal/viewLearningMaterialsModal.php" ?>
<?php include "../modal/viewAnnouncementsModal.php" ?>
<?php include "../modal/viewMissionVisionModal.php" ?>
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/body.css">
<link rel="stylesheet" href="../css/footer.css">
<script src="../js/confirmSignOut.js"></script>
</head>

<body>
    <div class="container mt-4">
        <?php include "content/swalMessage.php"?>

        <!-- Header Section  -->
        <div class="row">


            <div class="col-md-12">


                <header class="header-bg text-center position-relative">

                    <!-- Header Background -->
                    <div class="black-bg rounded-4 overlay position-absolute top-50 start-50 translate-middle" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
                    <img src="../img/schoolBanner.jpg" class="ics-banner z-n2 rounded-4 img-fluid overflow-hidden" alt="Background" style="width: 100vw; height: 100%;">


                    <div class="row">
                        <!-- Logo Section -->
                        <div class="col-md-12">
                            <div class="logo-section d-flex flex-row align-items-center position-absolute top-0 start-0">
                                <img src="../img/icsLogo.png" class="logo img-fluid" alt="Logo">
                                <p class="header-title">Ibaan Central School - Parent Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Information Section -->
                        <div class="info-holder col-md-6">
                            <div class="info-section d-flex flex-row position-absolute bottom-0 start-0">
                                <?php
                                include "../connectDb.php";

                                // Prepare the query to fetch the student's profile picture and other details
                                $query = "SELECT CONCAT(s.last_name, ', ', s.first_name, ' ', LEFT(s.middle_name, 1), '.') AS full_name,
                                CONCAT(s.last_name, ', ', s.first_name) AS full_name_2, 
                                        s.middle_name AS student_middle_name,
                                        s.lrn AS lrn,
                                        s.student_id AS student_id,
                                        s.current_status AS current_status, 
                                        s.academic_year AS academic_year, 
                                        gl.grade_level AS grade_level,
                                        gl.grade_level_id AS grade_level_id,  
                                        sec.section_name AS section_name, 
                                        sec.section_id AS section_id,
                                        CONCAT(p.last_name, ', ', p.first_name, ' ', LEFT(p.middle_name, 1), '.') AS parent_name,
                                        sf.student_picture AS student_profile
                                    FROM student s 
                                    LEFT JOIN section sec ON s.section_id = sec.section_id 
                                    LEFT JOIN grade_level gl ON s.grade_level_id = gl.grade_level_id 
                                    LEFT JOIN parent p ON s.parent_id = p.parent_id 
                                    LEFT JOIN student_file sf ON s.student_id = sf.student_id
                                    WHERE s.lrn = ?";

                                // Prepare the statement to prevent SQL injection
                                $stmt = $conn->prepare($query);

                                // Bind the session user_id to the query
                                $stmt->bind_param('s', $_SESSION['user_id']);

                                // Execute the query
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <img src="<?php if ($row['student_profile'] == NULL) {
                                                        echo '../img/avatar.jpg';
                                                    } else {
                                                        echo htmlspecialchars($row['student_profile']);
                                                    } ?>" class="avatar m-4" alt="Profile" style="width: 100px; height: 100px;">

                                        <div class="user-info d-flex flex-column justify-content-center">
                                            <p class="info-bold text-start text-uppercase"><?php echo htmlspecialchars($row['parent_name']); ?></p>
                                            <p class="info-text text-start text-uppercase">
                                        <?php if ($row['student_middle_name'] == NULL) {
                                                        echo htmlspecialchars($row['full_name_2']);
                                                    } else {
                                                        echo htmlspecialchars($row['full_name']);
                                                    } ?>
                                        </p>
                                            <p class="info-text text-start">LRN (<?php echo htmlspecialchars($row['lrn']); ?>)</p>
                                            <p class="info-text text-start"><?php if($row['grade_level_id'] == 1) {
                                                echo htmlspecialchars($row['grade_level']); ?> - <?php echo htmlspecialchars($row['section_name']);
                                            } else { ?>
                                             Grade <?php echo htmlspecialchars($row['grade_level']); ?> - <?php echo htmlspecialchars($row['section_name']);} ?></p>
                                            <p class="en-status text-start text-uppercase">
                                                <?php echo htmlspecialchars($row['current_status']); ?> (AY <?php echo htmlspecialchars($row['academic_year']); ?>)
                                            </p>
                                        </div>
                                    <?php
                                        $_SESSION['section_id'] = $row['section_id'];
                                        $_SESSION['student_id'] = $row['student_id'];
                                        $_SESSION['academic_year'] = $row['academic_year'];
                                    }
                                } else { ?>
                                    <p class="info-bold text-start">No user found.</p>
                                <?php }

                                // Close the statement and connection
                                $stmt->close();
                                $conn->close();
                                ?>
                            </div>
                        </div>


                        <!-- Sign Out -->
                        <div class="col-md-6">
                            <div class="so-section position-absolute bottom-0 end-0">
                                <form id="signOutForm" action="../function/logoutAccount.php" method="POST">
                                    <button type="button" onclick="confirmSignOut()" class="btn so-btn btn-primary rounded-5">
                                        <i class="bi bi-box-arrow-in-right"></i> Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>


                    </div>
                </header>


            </div>
        </div>

        <!-- Body Container  -->
        <div class="row body-container mt-3">


            <div class="body-col col-md-3">

                <!-- Menu Bar -->
                <div class="menu d-flex flex-column rounded-4 row-gap-4 p-4" style="height: 520px;">
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#classScheduleModal"><i class="menu-icon bi bi-calendar"></i><span style="margin: 0 0 0 10px;">Class Schedule</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#gradesModal"><i class="menu-icon bi bi-list-check"></i><span style="margin: 0 0 0 10px;">Grades</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#viewMaterialsModal"><iconify-icon class="menu-icon ph-icon" icon="ph:pen"></iconify-icon><span style="margin: 0 0 0 10px;">School Materials</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#viewCertModal"><iconify-icon class="menu-icon ph-icon" icon="ph:certificate"></iconify-icon><span style="margin: 0 0 0 10px;">eCertificate</span></a>
                </div>


            </div>


            <div class="mv-body body-col col-md-4">
                <?php include "content/missionVisionBody.php" ?>
            </div>

            <!-- Announcement  -->
            <div class="announcement-body body-col col-md-5">
                <?php include "content/announcementBody.php" ?>
            </div>

        </div>

        <!-- Footer -->
        <div class="row mt-3 mb-4">
            <?php include "content/footer.php" ?>
        </div>
    </div>
</body>

</html>