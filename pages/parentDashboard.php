<?php
session_start();

if (isset($_SESSION['logged_in']) != True) {
    header("Location: ../index");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICS - Parent Dashboard</title>
    <?php include "../partials/head.php" ?>
    <?php include "../modal/classScheduleModal.php" ?>
    <?php include "../modal/gradesModal.php" ?>
    <?php include "../modal/viewEcertificateModal.php" ?>
    <?php include "../modal/viewLearningMaterialsModal.php" ?>
    <?php include "../modal/viewAnnouncementsModal.php" ?>
    <?php include "../modal/viewMissionVisionModal.php" ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-4">
        <?php
        // Check if there is a SweetAlert message in the session
        if (isset($_SESSION['swal_message'])) {
            $swalType = $_SESSION['swal_message']['type'];
            $swalTitle = $_SESSION['swal_message']['title'];

            // Output the JavaScript to trigger the SweetAlert
            echo "<script>
            Swal.fire({
                icon: '$swalType',
                title: '$swalTitle',
                confirmButtonText: 'OK'
            });
        </script>";

            // Clear the session variable to prevent the message from showing again
            unset($_SESSION['swal_message']);
        }
        ?>

        <!-- Header Section  -->
        <div class="row">
            <div class="col-md-12">
                <header class="header-bg text-center position-relative">
                    <!-- Header Background -->
                    <div class="rounded-4 overlay position-absolute top-50 start-50 translate-middle" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
                    <img src="../img/schoolBanner.jpg" class="z-n2 rounded-4 img-fluid overflow-hidden" alt="Background" style="width: 100vw; height: 100%;">

                    <div class="row">
                        <!-- Logo Section -->
                        <div class="col-md-12">
                            <div class="logo-section d-flex flex-row align-items-center position-absolute top-0 start-0">
                                <img src="../img/icsLogo.png" class="img-fluid" alt="Logo">
                                <p class="header-title">Ibaan Central School - Parent Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">




<!-- Information Section -->
<div class="col-md-6">
    <div class="info-section d-flex flex-row position-absolute bottom-0 start-0">
        <img src="../img/avatar.jpg" class="avatar m-4" alt="Profile" style="width: 11%; height: 11%;">
        <div class="user-info d-flex flex-column justify-content-center">
            <?php
            include "../connectDb.php";
            // Prepare the query with academic year added
            $query = "SELECT CONCAT(s.last_name, ', ', s.first_name, ' ', LEFT(s.middle_name, 1), '.') AS full_name, 
                             s.lrn AS lrn, 
                             s.current_status AS current_status, 
                             s.academic_year AS academic_year, 
                             gl.grade_level AS grade_level, 
                             sec.section_name AS section_name, 
                             sec.section_id AS section_id,
                             CONCAT(p.last_name, ', ', p.first_name, ' ', LEFT(p.middle_name, 1), '.') AS parent_name 
                      FROM student s 
                      LEFT JOIN section sec ON s.section_id = sec.section_id 
                      LEFT JOIN grade_level gl ON s.grade_level_id = gl.grade_level_id 
                      LEFT JOIN parent p ON s.parent_id = p.parent_id 
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
                    <p class="info-bold text-start text-uppercase"><?php echo htmlspecialchars($row['parent_name']); ?></p>
                    <p class="info-text text-start"><?php echo htmlspecialchars($row['full_name']); ?></p>
                    <p class="info-text text-start">LRN (<?php echo htmlspecialchars($row['lrn']); ?>)</p>
                    <p class="info-text text-start">Grade <?php echo htmlspecialchars($row['grade_level']); ?> - <?php echo htmlspecialchars($row['section_name']); ?></p>
                    <p class="en-status text-start text-uppercase">
                        <?php echo htmlspecialchars($row['current_status']); ?> (AY <?php echo htmlspecialchars($row['academic_year']); ?>)
                    </p>
                <?php
                    $_SESSION['section_id'] = $row['section_id'];
                }
            } else { ?>
                <p class="info-bold text-start">No student found.</p>
            <?php }

            // Close the statement
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</div>

















                        <!-- Sign Out -->
                        <div class="col-md-6">
        <div class="so-section position-absolute bottom-0 end-0">
            <form id="logoutForm" action="../function/logoutAccount.php" method="POST">
                <button type="button" onclick="confirmLogout()" class="btn so-btn btn-primary rounded-5">
                    <i class="bi bi-box-arrow-in-right"></i> Sign Out
                </button>
            </form>
        </div>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('logoutForm').submit();
                }
            });
        }
    </script>

                    </div>
                </header>
            </div>
        </div>

        <!-- Body Container  -->
        <div class="row mt-3">
            <div class="col-md-3">
                <!-- Menu Bar -->
                <div class="menu d-flex flex-column rounded-4 row-gap-4 p-4" style="height: 520px;">
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#classScheduleModal"><i class="menu-icon bi bi-calendar"></i><span style="margin: 0 0 0 10px;">Class Schedule</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#gradesModal"><i class="menu-icon bi bi-list-check"></i><span style="margin: 0 0 0 10px;">Grades</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#viewMaterialsModal"><iconify-icon class="menu-icon ph-icon" icon="ph:pen"></iconify-icon><span style="margin: 0 0 0 10px;">School Materials</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#viewEcertModal"><iconify-icon class="menu-icon ph-icon" icon="ph:certificate"></iconify-icon><span style="margin: 0 0 0 10px;">eCertificate</span></a>
                </div>

            </div>
            <div class="col-md-4">
                <div class="mv-scroll rounded-4 p-2" style="height: 520px">
                    <!-- Mission and Vision  -->
                    <div class="mission-vision rounded-4 p-4 overflow-auto" style="height: 440px;">
                        <p class="mission-title fw-bold text-center p-2">MISSION</p>
                        <div class="mission-container overflow-auto">
                            <p class="mission-text text-break lh-1 rounded-2 p-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                        <p class="vision-title  fw-bold text-center p-2">VISION</p>
                        <div class="vision-container">
                            <p class="vision-text text-break lh-1 rounded-2 p-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a type="button" class="expand text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewMissionVision">Expand</a>
                    </div>
                </div>
            </div>

            <!-- Announcement  -->
            <div class="col-md-5">
                <div class="announcement-scroll rounded-4 p-4" style="height: 520px">
                    <p class="announcement-title fs-4 fw-bold text-center p-2">ANNOUNCEMENT</p>
                    <div class="announcement overflow-y-scroll" style="height: 385px;">
                        <?php
                        include "../connectDb.php";

                        // Initialize query with base SQL
                        $query = "SELECT * FROM announcements ORDER BY created_at DESC LIMIT 2";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="row mx-1 mb-3 rounded-3 p-3" style="background-color: var(--white);">
                                    <div class="col-md-12 mt-2">
                                        <div class="row align-items-center">
                                            <div class="col-6" style="width: 100px;">
                                                <img src="../img/avatar.jpg" alt="profilePic" style="width: 70px;">
                                            </div>
                                            <div class="col-6">
                                                <strong class="text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></strong><br>
                                                <span><?php echo htmlspecialchars($row['rank_name']); ?></span><br>
                                                <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                            </div>
                                        </div>
                                        <div class="row px-5 pt-4">
                                            <p class="fw-bold lh-base" style="color: black;"><?php echo htmlspecialchars($row['title']); ?></p>
                                            <p class="lh-base text-truncate" style="color: black; white-space: pre-wrap; height: 20px;"><?php echo htmlspecialchars($row['announcement_text']); ?></p>
                                        </div>
                                        <div class="row px-5 pb-4 justify-content-center">
                                            <?php
                                            $file_path = htmlspecialchars($row['announcement_file']);
                                            // Check if the file path is not null and not the empty directory path
                                            if (!is_null($file_path) && $file_path !== '../announcement/') {
                                                if (file_exists($file_path)) {
                                            ?>
                                                    <img class="img-thumbnail" src="<?php echo htmlspecialchars($row['announcement_file']); ?>" alt="announcementFile">
                                                <?php
                                                } else {
                                                ?>
                                                    <p>File not found: <?php echo $file_path; ?></p>'
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No announcements available.</p>";
                        }
                        ?>
                    </div>

                    <div class="text-center mt-4">
                        <a type="button" class="expand text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewAnnouncementModal">View More</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="row mt-3 mb-4">
            <div class="col-md-12">
                <footer class="shadow-lg rounded-4">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center mt-5" style="column-gap: 70px;">
                            <img src="../img/kneLogo.png" class="img-fluid footer-logo" alt="kne">
                            <img src="../img/dobLogo.png" class="img-fluid footer-logo" alt="dob" style="height: 95%">
                            <img src="../img/icsLogo.png" class="img-fluid footer-logo" alt="ics">
                        </div>
                    </div>
                    <div class="row school-section">
                        <div class="col-md-12">
                            <ul class="d-flex flex-row justify-content-center mt-5 list-inline" style="column-gap: 15%;">
                                <li class="d-flex flex-row align-items-center"><iconify-icon class="iconify-footer" icon="ri:facebook-circle-line"></iconify-icon><span style="margin: 0 0 0 10px;">Ibaan Central School</span></li>
                                <li class="d-flex flex-row align-items-center"><iconify-icon class="iconify-footer" icon="iconamoon:location-pin"></iconify-icon><span style="margin: 0 0 0 10px;">R4FM+5H5, Poblacion Rd, Ibaan, Batangas</span></li>
                                <li class="d-flex flex-row align-items-center"><iconify-icon class="iconify-footer" icon="ph:phone"></iconify-icon><span style="margin: 0 0 0 10px;">(043) 702 - 3669</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row copyright-section rounded-bottom-4" style="margin: 0;">
                        <div class="col-md-12">
                            <p class="text-center fw-bold mt-3">Copyright © Ibaan Central School</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>