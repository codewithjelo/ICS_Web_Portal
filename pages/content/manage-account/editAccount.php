<div class="page ma-pdo-scroll overflow-y-auto position-relative" id="editPage" style="max-height: 485px;">
    <div class="table-container">

        <div class="position-sticky top-0" style="background-color: var(--maroon); z-index: 999;">
            <div class="d-flex flex-row position-relative align-items-center justify-content-center">
                <button type="button" class="btn position-absolute"
                    style="left: 0; background-color: white; color: black;" onclick="showRecordsPage()">
                    <i class="bi bi-arrow-left"></i> Back
                </button>
                <h2 class="text-white">EDIT ACCOUNT</h2>
            </div>
        </div>

        <form id="editAccount" action="../function/editAccountForm.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="maEditUserId" name="user_id">
            <input type="hidden" id="maEditRoleId" name="role_id">
            <!-- Hidden input for cropped image file -->
            <input type="file" id="editCroppedImageFile" name="editProfile" style="display: none;">

            <!-- Profile Picture Section -->
            <div class="mb-3 d-flex flex-column align-items-center">
                <label class="form-label">Profile Picture</label>

                <!-- Original file input (hidden) -->
                <input type="file" class="form-control d-none" id="maEditProfile" accept="image/*">

                <div class="position-relative mb-3">
                    <div id="editProfilePreviewContainer"
                        class="rounded-circle border border-3 border-secondary overflow-hidden"
                        style="width: 150px; height: 150px; position: relative; cursor: pointer;">

                        <!-- Placeholder -->
                        <div id="editProfilePlaceholder" class="d-flex align-items-center justify-content-center"
                            style="width: 100%; height: 100%; background-color: #f0f0f0; position: absolute; top: 0; left: 0; z-index: 1; cursor: pointer;">
                            <img id="maEditDefaultProfile" src="" alt="Current Profile"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Loaded image -->
                        <img id="maEditProfilePreview" src="" alt="Profile Preview" draggable="false"
                            style="position: absolute; user-select: none; display: none; z-index: 2;">
                    </div>


                    <!-- Action Button (Camera or Remove) -->
                    <button type="button" id="editProfileActionBtn"
                        class="btn btn-sm btn-primary rounded-circle position-absolute"
                        style="bottom: 5px; right: 5px; width: 40px; height: 40px; z-index: 10;">
                        <i class="bi bi-camera-fill" id="editActionIcon"></i>
                    </button>
                </div>

                <div id="editImageControls" style="display: none;">
                    <small class="text-white d-block text-center mb-2">Drag to adjust • Scroll to zoom</small>
                    <div class="d-flex align-items-center gap-2 justify-content-center">
                        <button type="button" class="btn btn-sm" id="editZoomOut" style="border: 1px solid var(--gold); color: var(--gold);">
                            <i class="bi bi-zoom-out"></i>
                        </button>
                        <input type="range" id="editZoomSlider" min="100" max="300" value="100" step="1"
                            style="width: 150px;">
                        <button type="button" class="btn btn-sm" id="editZoomIn" style="border: 1px solid var(--gold); color: var(--gold);">
                            <i class="bi bi-zoom-in"></i>
                        </button>
                        <button type="button" class="btn btn-sm" id="editResetPosition"
                            title="Reset" style="border: 1px solid var(--gold); color: var(--gold);">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </div>
                </div>

                <small class="text-white">Click on image or camera icon to change</small>
            </div>

            <div class="d-flex flex-row gap-3">
                <div class="mb-3 flex-grow-1">
                    <label for="maEditFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="maEditFirstName" name="editFirstName" required>
                </div>

                <div class="mb-3 flex-grow-1">
                    <label for="maEditMiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="maEditMiddleName" name="editMiddleName" required>
                </div>

                <div class="mb-3 flex-grow-1">
                    <label for="maEditLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="maEditLastName" name="editLastName" required>
                </div>
            </div>

            <div class="d-flex flex-row gap-3">
                <div class="mb-3 flex-grow-1">
                    <label for="maEditPassword" class="form-label">New Password (leave blank to keep current)</label>
                    <input type="password" class="form-control" id="maEditPassword" name="editPassword">
                </div>

                <div class="mb-3 flex-grow-1">
                    <label for="maEditEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="maEditEmail" name="editEmail" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="maEditRoleName" class="form-label">Role</label>
                <input type="text" class="form-control" id="maEditRoleName" readonly>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success text-white">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Hidden canvas for cropping -->
<canvas id="editCropCanvas" style="display: none;"></canvas>

<script src="/ICS_Web_Portal/js/editFormZoomPan.js"></script>