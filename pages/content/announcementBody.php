<div class="announcement-scroll rounded-4 p-4" style="height: 520px">
    <p class="announcement-title fs-4 fw-bold text-center p-2">ANNOUNCEMENT</p>
    <div class="announcement overflow-y-scroll position-relative" style="height: 385px;">
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
                                <!-- Displaying Full Name and Rank -->
                                <strong class="text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></strong><br>
                                <span><?php echo htmlspecialchars($row['rank_name']); ?></span><br>
                                <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                            </div>
                        </div>
                        <div class="row px-5 pt-4">
                            <p class="fw-bold lh-base" style="color: black;"><?php echo htmlspecialchars($row['title']); ?></p>
                            <!-- Displaying Announcement Text with a limited height and text wrapping -->
                            <p class="lh-base text-truncate text-break " style="color: black; white-space: pre-wrap; height: 20px;"><?php echo nl2br(htmlspecialchars($row['announcement_text'])); ?></p>
                        </div>
                        <div class="row px-5 pb-4 justify-content-center">
                            <?php
                            $file_path = htmlspecialchars($row['announcement_file']);
                            // Check if the file path is not null and not the empty directory path
                            if (!empty($file_path) && $file_path !== '../announcement/') {
                                if (file_exists($file_path)) {
                            ?>
                                    <img class="img-thumbnail" src="<?php echo $file_path; ?>" alt="announcementFile">
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else { ?>
            <p class='position-absolute top-50 start-50 translate-middle lh-1 text-center' style='color: gray; font-size: 14px'>No announcements available.</p>
        <?php }
        ?>
    </div>

    <div class="text-center mt-4">
        <a type="button" class="expand text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewAnnouncementModal">View More</a>
    </div>
</div>