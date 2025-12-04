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
    <?php include "../modal/viewAnnouncementModal.php" ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/confirmSignOut.js"></script>
    <script src="../js/showStudentRecord.js"></script>
    <script src="../js/showManageAccount.js"></script>
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
                    <div class="black-bg rounded-4 overlay position-absolute top-50 start-50 translate-middle"
                        style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
                    <img src="../img/schoolBanner.jpg" class="ics-banner z-n2 rounded-4 img-fluid overflow-hidden"
                        alt="Background" style="width: 100vw; height: 100%;">

                    <div class="row">
                        <!-- Logo Section -->
                        <div class="col-md-12">
                            <div
                                class="logo-section d-flex flex-row align-items-center position-absolute top-0 start-0">
                                <img src="../img/icsLogo.png" class="logo img-fluid" alt="Logo">
                                <p class="header-title">Ibaan Central School - PDO Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Information Section -->
                        <div class="col-md-6">
                            <div class="info-section d-flex flex-row position-absolute bottom-0 start-0">
                                <?php
                                include "../connectDb.php";
                                // Prepare the query
                                $query = "SELECT CONCAT(pdo.last_name, ', ', pdo.first_name, ' ', LEFT(pdo.middle_name, 1), '.') AS full_name, 
                                                     pdo.pdo_id AS pdo_id,
                                                     r.rank_name AS rank_name,
                                                     pdo.profile_picture AS profile_picture
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
                                    while ($row = $result->fetch_assoc()) {

                                        $profilePic = !empty($row['profile_picture']) ?
                                            htmlspecialchars($row['profile_picture']) : '../uploads/profile_pictures/avatar.jpg';
                                        ?>

                                        <img src="<?php echo $profilePic; ?>" class="avatar-admin m-4" alt="Profile"
                                            style="width: 100px; height: 100px; object-fit: cover; border: 4px solid var(--maroon);">
                                        <div class="user-info-admin d-flex flex-column justify-content-center">
                                            <p class="info-bold text-start text-uppercase">
                                                <?php echo htmlspecialchars($row['full_name']); ?>
                                            </p>
                                            <p class="info-text text-start">
                                                ICS-PDO<?php echo htmlspecialchars($row['pdo_id']); ?></p>
                                            <p class="info-text text-start"><?php echo htmlspecialchars($row['rank_name']); ?>
                                            </p>
                                            <?php
                                            $_SESSION['full_name'] = $row['full_name'];
                                            $_SESSION['rank_name'] = $row['rank_name'];
                                            $_SESSION['profile_picture'] = $row['profile_picture'];
                                            $_SESSION['uploader_id'] = $row['pdo_id'];
                                    }
                                } else { ?>
                                        <img src="../uploads/profile_pictures/avatar.jpg" class="avatar-admin m-4"
                                            alt="Profile"
                                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                        <div class="user-info-admin d-flex flex-column justify-content-center">
                                            <p class="info-bold text-start">No user found.</p>
                                        </div>
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
                                    <button type="button" onclick="confirmSignOut()"
                                        class="btn so-btn btn-primary rounded-5">
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
            <div class="col-md-3" style="padding: 0 0.5rem 0 0.75rem;">
                <!-- Menu Bar -->
                <div class="menu menu-pdo d-flex flex-column rounded-4 row-gap-4 p-4" style="height: 520px;">
                    <a type="button"
                        class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2"
                        data-bs-toggle="modal" data-bs-target="#announcementModal"><iconify-icon
                            class="menu-icon ph-icon" icon="iconoir:megaphone"></iconify-icon><span
                            style="margin: 0 0 0 10px;">Announcement</span></a>
                    <a type="button"
                        class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2 not-active"
                        id="studentRecordBtn"><iconify-icon class="menu-icon ph-icon"
                            icon="material-symbols:list-alt-outline"></iconify-icon><span
                            style="margin: 0 0 0 10px;">Student Record</span></a>

                    <a type="button"
                        class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2 not-active"
                        id="managePdoAccountBtn">
                        <iconify-icon class="menu-icon ph-icon" icon="iconoir:user"></iconify-icon>
                        <span style="margin: 0 0 0 10px;">Manage Account</span>
                    </a>
                </div>
            </div>


            <div class="mv-body col-md-4" id="missionVision" style="padding: 0 0.5rem;">
                <?php include "content/missionVisionBody.php" ?>
            </div>

            <!-- Announcement  -->
            <div class="announcement-body col-md-5" id="announcement" style="padding: 0 0.75rem 0 0.5rem;">
                <?php include "content/announcementBody.php" ?>
            </div>

            <div class="main-con col hidden" style="margin: 0 0.75rem 0 0.5rem; max-height: 520px;">
                <?php include "content/studentRecordPdo.php" ?>
            </div>

            <div class="ma-con col hidden" style="margin: 0 0.75rem 0 0.5rem; max-height: 520px;">
                <?php include "content/manageAccount.php" ?>
            </div>

        </div>
        <!-- Footer -->
        <div class="row mt-3 mb-4">
            <?php include "content/footer.php" ?>
        </div>
    </div>
</body>

<script>
    <?php if (isset($_SESSION['account_updated']) && $_SESSION['account_updated']): ?>
        $('#manageAccountBtn').removeClass('not-active');
        $('.ma-con').removeClass('hidden');

        $('#announcement').addClass('hidden');
        $('#missionVision').addClass('hidden');

        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Account updated successfully',
            timer: 2000,
            showConfirmButton: false
        });

        <?php unset($_SESSION['account_updated']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['account_added']) && $_SESSION['account_added']): ?>
        $('#manageAccountBtn').removeClass('not-active');
        $('.ma-con').removeClass('hidden');

        $('#announcement').addClass('hidden');
        $('#missionVision').addClass('hidden');

        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Account created successfully',
            timer: 2000,
            showConfirmButton: false
        });

        <?php unset($_SESSION['account_added']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['account_deleted']) && $_SESSION['account_deleted']): ?>
        $('#manageAccountBtn').removeClass('not-active');
        $('.ma-con').removeClass('hidden');

        $('#announcement').addClass('hidden');
        $('#missionVision').addClass('hidden');

        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Account removed successfully',
            timer: 2000,
            showConfirmButton: false
        });

        <?php unset($_SESSION['account_deleted']); ?>
    <?php endif; ?>
</script>

</html>