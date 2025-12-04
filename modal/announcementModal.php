<link rel="stylesheet" href="../css/modal.css">

<!-- Modal -->
<div class="modal fade modal-lg" id="announcementModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 700px !important;">
            <div class="modal-header justify-content-center"
                style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">ANNOUNCEMENT</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0"
                    style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <div class="announcement-card px-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="profile-icon" style="width: 100px;">
                            <?php
                            $fullName = $_SESSION['full_name'];
                            $rank_name = $_SESSION['rank_name'];
                            $profilePicture = $_SESSION['profile_picture']; ?>
                            <img class="img-fluid" src="<?php echo $profilePicture ?>" alt="profilePicture"
                                style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
                        </div>
                        <div>
                            <strong class="text-uppercase"><?php echo "$fullName"; ?></strong><br>
                            <span><?php echo "$rank_name"; ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <form class="position-relative" action="../function/createAnnouncement.php" method="POST"
                            enctype="multipart/form-data">
                            <div style="max-height: 400px; overflow-y: auto;">

                                <div class="mb-3">
                                    <input type="text" class="form-control fw-bold" id="announcementTitle"
                                        placeholder="Add title" name="announcement_title"
                                        style="border: none; border-bottom: 1px solid #d3d3d3ff; border-radius: .375rem .375rem 0 0"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <textarea type="text" class="form-control" id="announcementText"
                                        placeholder="Description" name="announcement_text"
                                        style="height: 200px; border: none;" required></textarea>
                                </div>

                                <!-- Hidden File Input -->
                                <input class="form-control" type="file" id="announcementFile" name="announcement_file"
                                    style="display: none;">

                                <!-- Image Preview Section -->
                                <div>
                                    <div id="imagePreview"
                                        class="upload-preview d-flex align-items-center justify-content-center border border-2 border-dashed rounded position-relative"
                                        style="height: 400px; cursor: pointer; background-color: #fffff;">
                                        <!-- Placeholder State -->
                                        <div id="placeholder" class="text-center">
                                            <i class="bi bi-camera-fill text-muted" style="font-size: 2rem;"></i>
                                            <p class="mb-0 text-muted">Click to upload image</p>
                                        </div>
                                        <!-- Preview Image -->
                                        <img id="previewImg" src="" alt="Image Preview"
                                            style="max-width: 100%; max-height: 100%; display: none; object-fit: contain;">
                                        <!-- Remove Button -->
                                        <button id="removeBtn" type="button"
                                            class="btn btn-sm btn-danger position-absolute"
                                            style="top: 10px; right: 10px; display: none; z-index: 10;">&times;</button>
                                    </div>
                                </div>
                            </div>


                            <div class="position-absolute my-3 w-100" style="background-color white">
                                <button type="submit" class="btn btn-primary border-0"
                                    style="background-color: var(--maroon)">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('imagePreview').addEventListener('click', function () {
        document.getElementById('announcementFile').click();
    });

    document.getElementById('announcementFile').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const placeholder = document.getElementById('placeholder');
        const previewImg = document.getElementById('previewImg');
        const removeBtn = document.getElementById('removeBtn');
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                placeholder.style.display = 'none';
                removeBtn.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.style.display = 'none';
            placeholder.style.display = 'block';
            removeBtn.style.display = 'none';
        }
    });

    document.getElementById('removeBtn').addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent triggering the upload click
        const fileInput = document.getElementById('announcementFile');
        const placeholder = document.getElementById('placeholder');
        const previewImg = document.getElementById('previewImg');
        const removeBtn = document.getElementById('removeBtn');

        // Clear the file input
        fileInput.value = '';
        // Reset preview
        previewImg.style.display = 'none';
        placeholder.style.display = 'block';
        removeBtn.style.display = 'none';
    });
</script>