<script src="../js/getId.js"></script>

<!-- Modal -->
<div class="modal fade modal-xl" id="viewAnnouncementModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height:850px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important;">
                <h1 class="modal-title" id="staticBackdropLabel">ANNOUNCEMENT</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0"
                    style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="announcement-container overflow-y-auto" id="announcementContainer" style="height: 680px;">
                    <?php
                    include "../connectDb.php";

                    $tableName = [
                        4 => 'guidance',
                        5 => 'principal',
                        6 => 'pdo',
                    ];
                    $idColumn = [
                        4 => 'guidance_id',
                        5 => 'principal_id',
                        6 => 'pdo_id',
                    ];

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
                            ?>

                            <div class="row shadow mx-2 mb-5 rounded-3">

                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        <div class="col-6" style="width: 100px;">
                                            <img src="../img/avatar.jpg" alt="profilePic" style="width: 100px;">
                                        </div>
                                        <div class="col-6">
                                            <strong
                                                class="text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></strong><br>
                                            <span><?php echo htmlspecialchars($row['rank_name']); ?></span><br>
                                            <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row px-5 pt-2">
                                        <p class="fw-bold lh-base" style="color: black;">
                                            <?php echo htmlspecialchars($row['title']); ?></p>
                                        <p class="lh-base" style="color: black; white-space: pre-wrap;">
                                            <?php echo htmlspecialchars($row['announcement_text']); ?></p>
                                    </div>
                                    <div class="row px-5 pb-4 justify-content-center">
                                        <?php
                                        $filePath = htmlspecialchars($row['announcement_file']);
                                        // Check if the file path is not null and not the empty directory path
                                        if (!is_null($filePath) && $filePath !== '../announcement/') {
                                            if (file_exists($filePath)) {
                                                ?>
                                                <img class="img-fluid img-thumbnail"
                                                    src="<?php echo htmlspecialchars($row['announcement_file']); ?>"
                                                    alt="announcementFile" style="width: 400px !important;">
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
                        <p class='position-absolute top-50 start-50 translate-middle' style='color: gray; font-size: 20px'>
                            No announcements available.</p>
                    <?php }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>