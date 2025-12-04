<div class="announcement-scroll rounded-4 p-4" style="height: 520px">
    <div class="announcement overflow-y-auto position-relative" style="height: 420px;">
        <p class="announcement-title fs-4 fw-bold text-center px-2 pt-2 pb-3 position-sticky top-0"
            style="background-color: var(--maroon);">ANNOUNCEMENT</p>
        <?php
        include "../connectDb.php";

        $query = "SELECT anc.announcement_id AS announcement_id, anc.announcement_text AS announcement_text, anc.title AS title,
                        anc.announcement_file AS announcement_file, anc.uploader_id, anc.created_at AS created_at,
                        CASE 
                            WHEN LEFT(anc.uploader_id, 1) = '4' THEN CONCAT(g.last_name, ', ', g.first_name, CASE WHEN g.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(g.middle_name, 1), '.') ELSE '' END)
                            WHEN LEFT(anc.uploader_id, 1) = '5' THEN CONCAT(p.last_name, ', ', p.first_name, CASE WHEN p.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(p.middle_name, 1), '.') ELSE '' END)
                            WHEN LEFT(anc.uploader_id, 1) = '6' THEN CONCAT(pd.last_name, ', ', pd.first_name, CASE WHEN pd.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(pd.middle_name, 1), '.') ELSE '' END)
                        END AS uploader_full_name,
                        CASE 
                            WHEN LEFT(anc.uploader_id, 1) = '4' THEN g.profile_picture
                            WHEN LEFT(anc.uploader_id, 1) = '5' THEN p.profile_picture
                            WHEN LEFT(anc.uploader_id, 1) = '6' THEN pd.profile_picture
                        END AS profile_picture,
                        CASE 
                            WHEN LEFT(anc.uploader_id, 1) = '4' THEN rg.rank_name
                            WHEN LEFT(anc.uploader_id, 1) = '5' THEN rp.rank_name
                            WHEN LEFT(anc.uploader_id, 1) = '6' THEN rpd.rank_name
                        END AS rank_name
                        FROM `announcements` anc 
                        LEFT JOIN `guidance` g ON g.guidance_id = anc.uploader_id AND LEFT(anc.uploader_id, 1) = '4'
                        LEFT JOIN `principal` p ON p.principal_id = anc.uploader_id AND LEFT(anc.uploader_id, 1) = '5'
                        LEFT JOIN `pdo` pd ON pd.pdo_id = anc.uploader_id AND LEFT(anc.uploader_id, 1) = '6'
                        LEFT JOIN `rank` rg ON g.rank_id = rg.rank_id
                        LEFT JOIN `rank` rp ON p.rank_id = rp.rank_id
                        LEFT JOIN `rank` rpd ON pd.rank_id = rpd.rank_id
                        ORDER BY anc.created_at DESC;";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $profilePic = !empty($row['profile_picture']) ?
                    htmlspecialchars($row['profile_picture']) : '../uploads/profile_pictures/avatar.jpg';
                ?>

                <div class="row mx-1 mb-3 rounded-3 p-3" style="background-color: var(--white);">
                    <div class="col-md-12 mt-2">
                        <div class="row align-items-center">
                            <div class="col-6" style="width: 100px;">
                                <img src="<?php echo $profilePic; ?>" alt="profilePic"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                            <div class="col-6">
                                <!-- Displaying Full Name and Rank -->
                                <strong
                                    class="text-uppercase"><?php echo htmlspecialchars($row['uploader_full_name']); ?></strong><br>
                                <span><?php echo htmlspecialchars($row['rank_name']); ?></span><br>
                                <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                            </div>
                        </div>
                        <div class="row px-5 pt-4">
                            <p class="fw-bold lh-base" style="color: black;"><?php echo htmlspecialchars($row['title']); ?></p>

                            <p class="lh-base text-truncate text-break " style="color: black; height: 20px;">
                                <?php echo nl2br(htmlspecialchars($row['announcement_text'])); ?>
                            </p>
                        </div>
                        <div class="row px-5 pb-4 justify-content-center">
                            <?php
                            $filePath = htmlspecialchars($row['announcement_file']);
                            // Check if the file path is not null and not the empty directory path
                            if (!empty($filePath) && $filePath !== '../announcement/') {
                                if (file_exists($filePath)) {
                                    ?>
                                    <img class="img-thumbnail" src="<?php echo $filePath; ?>" alt="announcementFile">
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
            <p class='position-absolute top-50 start-50 translate-middle lh-1 text-center'
                style='color: gray; font-size: 14px'>No announcements available.</p>
        <?php }
        ?>
    </div>

    <div class="text-center mt-4">
        <a type="button" class="expand text-decoration-none" data-bs-toggle="modal"
            data-bs-target="#viewAnnouncementModal">View More</a>
    </div>
</div>