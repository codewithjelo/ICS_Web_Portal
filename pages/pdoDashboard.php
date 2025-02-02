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
    <title>ICS - PDO Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <?php include "../partials/head.php" ?>
    <?php include "../modal/announcementModal.php" ?>
    <?php include "../modal/viewMissionVisionModal.php" ?>
    <?php include "../modal/studentRecordModal.php" ?>
    <?php include "../modal/calendarActivityModal.php" ?>
    <?php include "../modal/viewAnnouncementModal.php" ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/confirmSignOut.js"></script>
</head>

<body>
    <div class="container mt-4">
        <?php
        include "content/swalMessage.php";
        ?>

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
                                <p class="header-title">Ibaan Central School - PDO Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Information Section -->
                        <div class="col-md-6">
                            <div class="info-section d-flex flex-row position-absolute bottom-0 start-0">
                                <img src="../img/avatar.jpg" class="avatar-admin m-4" alt="Profile" style="width: 100px; height: 100px;">
                                <div class="user-info-admin d-flex flex-column justify-content-center">
                                    <?php
                                    include "../connectDb.php";
                                    // Prepare the query
                                    $query = "SELECT CONCAT(pdo.last_name, ', ', pdo.first_name, ' ', LEFT(pdo.middle_name, 1), '.') AS full_name, 
                                                     pdo.pdo_id AS pdo_id,
                                                     r.rank_name AS rank_name
                                              FROM pdo pdo
                                              LEFT JOIN rank r ON pdo.rank_id = r.rank_id
                                              WHERE pdo.pdo_id = RIGHT(?, 4)";

                                    // Prepare the statement to prevent SQL injection
                                    $stmt = $conn->prepare($query);

                                    // Bind the session user_id to the query
                                    $stmt->bind_param('s', $_SESSION['user_id']);

                                    // Execute the query
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <p class="info-bold text-start text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></p>
                                            <p class="info-text text-start">ICS-PDO<?php echo htmlspecialchars($row['pdo_id']); ?></p>
                                            <p class="info-text text-start"><?php echo htmlspecialchars($row['rank_name']); ?></p>
                                        <?php
                                            $_SESSION['full_name'] = $row['full_name'];
                                            $_SESSION['rank_name'] = $row['rank_name'];
                                        }
                                    } else { ?>
                                        <p class="info-bold text-start">No user found.</p>
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
            <div class="col-md-3">
                <!-- Menu Bar -->
                <div class="menu menu-pdo d-flex flex-column rounded-4 row-gap-4 p-4" style="height: 520px;">
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#announcementModal"><iconify-icon class="menu-icon ph-icon" icon="iconoir:megaphone"></iconify-icon><span style="margin: 0 0 0 10px;">Announcement</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#studentRecordModal"><iconify-icon class="menu-icon ph-icon" icon="material-symbols:list-alt-outline"></iconify-icon><span style="margin: 0 0 0 10px;">Student Record</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#calendarActivityModal"><i class="menu-icon bi bi-calendar"></i><span style="margin: 0 0 0 10px;">Calendar Activities</span></a>
                </div>
            </div>


            <div class="mv-body col-md-4" id="missionVision">
                <?php include "content/missionVisionBody.php" ?>
            </div>

            <!-- Announcement  -->
            <div class="announcement-body col-md-5" id="announcement">
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