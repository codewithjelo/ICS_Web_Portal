<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICS - Guidance Dashboard</title>
    <?php include "../partials/head.php" ?>
    <?php include "../modal/announcementModal.php" ?>
    <?php include "../modal/viewAnnouncementModal.php" ?>
    <?php include "../modal/studentRecordModal.php" ?>
    <?php include "../modal/enrollmentModal.php" ?>
    <?php include "../modal/viewMissionVision.php" ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <div class="container mt-4">
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
                                <p class="header-title">Ibaan Central School - Guidance Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Information Section -->
                        <div class="col-md-6">
                            <div class="student-section d-flex flex-row position-absolute bottom-0 start-0">
                                <img src="../img/avatar.jpg" class="avatar" alt="Profile" style="width: 11%; height: 11%;">
                                <div class="student-info d-flex flex-column justify-content-center">
                                    <p class="info-bold text-start">DELA CRUZ, JUAN C.</p>
                                    <p class="info-text text-start">ID (123456)</p>
                                    <p class="info-text text-start">Guidance Counselor</p>
                                </div>
                            </div>
                        </div>
                        <!-- Sign Out -->
                        <div class="col-md-6">
                            <div class="so-section position-absolute bottom-0 end-0">
                                <button type="button" class="btn so-btn btn-primary rounded-5"><i class="bi bi-box-arrow-in-right"></i> Sign Out</button>
                            </div>
                        </div>

                    </div>
                </header>
            </div>
        </div>

        <!-- Body Container  -->
        <div class="row mt-3">
            <div class="col-md-3">
                <!-- Menu Bar -->
                <div class="menu d-flex flex-column rounded-4 row-gap-4 p-4" style="height: 520px;">
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#announcementModal"><iconify-icon class="menu-icon ph-icon" icon="iconoir:megaphone"></iconify-icon><span style="margin: 0 0 0 10px;">Announcement</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#enrollmentModal"><iconify-icon class="menu-icon ph-icon" icon="iconoir:notes"></iconify-icon><span style="margin: 0 0 0 10px;">Enrollment</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2"><iconify-icon class="menu-icon ph-icon" icon="ant-design:dashboard-outlined"></iconify-icon><span style="margin: 0 0 0 10px;">Dashboard</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#studentRecordModal"><iconify-icon class="menu-icon ph-icon" icon="material-symbols:list-alt-outline"></iconify-icon><span style="margin: 0 0 0 10px;">Student Record</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#studentRecordModal"><iconify-icon class="menu-icon ph-icon" icon="material-symbols:list-alt-outline"></iconify-icon><span style="margin: 0 0 0 10px;">Upload Schedule</span></a>
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
                    <div class="announcement overflow-y-scroll" style="height: 383px;">
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
                                                <strong>JUAN C. DELA CRUZ</strong><br>
                                                <span>Guidance Counselor</span><br>
                                                <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                            </div>
                                        </div>
                                        <div class="row px-5 pt-4">
                                            <p class="fw-bold lh-base" style="color: black;"><?php echo htmlspecialchars($row['title']); ?></p>
                                            <p class="lh-base text-truncate" style="color: black; white-space: pre-wrap; height: 18px;"><?php echo htmlspecialchars($row['announcement_text']); ?></p>
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