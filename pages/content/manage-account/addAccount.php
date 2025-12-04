<div class="page ma-pdo-scroll overflow-y-auto position-relative" id="addPage" style="max-height: 485px;">
    <div class="position-sticky top-0" style="background-color: var(--maroon); z-index: 999;">
        <div class="d-flex flex-row position-relative align-items-center justify-content-center">
            <button type="button" class="btn position-absolute" style="left: 0; background-color: white; color: black;"
                onclick="showRecordsPage()">
                <i class="bi bi-arrow-left"></i> Back
            </button>
            <h2 class="text-white">ADD ACCOUNT</h2>
        </div>
    </div>
    <form class="mt-2" action="../function/addAccountForm.php" id="addAccount" method="POST"
        enctype="multipart/form-data">

        <div class="mb-3 d-flex flex-column align-items-center">
            <label for="addProfilePic" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="maProfilePic" accept="image/*" style="display: none;">
            <!-- Hidden input for cropped image file -->
            <input type="file" id="croppedImageFile" name="addProfilePic" style="display: none;">

            <!-- Image Preview Section -->
            <div class="position-relative mb-3">
                <!-- Placeholder -->
                <div id="profilePlaceholder"
                    class="rounded-circle border border-3 border-secondary d-flex align-items-center justify-content-center"
                    style="width: 150px; height: 150px; background-color: #f0f0f0; cursor: pointer;">
                    <i class="bi bi-person-fill" style="font-size: 60px; color: #999;"></i>
                </div>

                <!-- Preview Image Container (hidden by default) -->
                <div id="profilePreviewContainer"
                    class="rounded-circle border border-3 border-secondary overflow-hidden"
                    style="width: 150px; height: 150px; display: none; position: absolute; top: 0; left: 0; cursor: move;">
                    <img id="profilePreviewImg" src="" alt="Profile Preview" draggable="false"
                        style="position: absolute; user-select: none; pointer-events: none;">
                </div>

                <!-- Action Button (Camera or Remove) -->
                <button type="button" id="profileActionBtn"
                    class="btn btn-sm btn-primary rounded-circle position-absolute"
                    style="bottom: 5px; right: 5px; width: 40px; height: 40px; z-index: 10;">
                    <i class="bi bi-camera-fill" id="actionIcon"></i>
                </button>
            </div>
            <div id="imageControls" style="display: none;">
                <small class="text-white d-block text-center mb-2">Drag to adjust • Scroll to zoom</small>
                <div class="d-flex align-items-center gap-2 justify-content-center">
                    <button type="button" class="btn btn-sm" id="zoomOut"
                        style="border: 1px solid var(--gold); color: var(--gold);">
                        <i class="bi bi-zoom-out"></i>
                    </button>
                    <input type="range" id="zoomSlider" min="100" max="300" value="100" step="1" style="width: 150px;">
                    <button type="button" class="btn btn-sm" id="zoomIn"
                        style="border: 1px solid var(--gold); color: var(--gold);">
                        <i class="bi bi-zoom-in"></i>
                    </button>
                    <button type="button" class="btn btn-sm" id="resetPosition" title="Reset"
                        style="border: 1px solid var(--gold); color: var(--gold);">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
            </div>
        </div>


        <div class="d-flex flex-row gap-3">
            <div class="mb-3 flex-grow-1">
                <label for="addFirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="maFirstName" name="addFirstName" required>
            </div>


            <div class="mb-3 flex-grow-1">
                <label for="addMiddleName" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="maMiddleName" name="addMiddleName" required>
            </div>


            <div class="mb-3 flex-grow-1">
                <label for="addLastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="maLastName" name="addLastName" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="addEmail" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="maEmail" name="addEmail" required>
        </div>

        <div class="d-flex flex-row gap-3">

            <div class="mb-3 flex-grow-1">
                <label for="addPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="maPassword" name="addPassword" required>
            </div>

            <div class="mb-3 flex-grow-1">
                <label for="addConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="maConfirmPassword" name="addConfirmPassword" required>
            </div>
        </div>


        <div class="d-flex flex-row gap-3">
            <?php
            include("../connectDb.php");
            $sqlRoles = "SELECT * FROM `role` WHERE role_id > 2";
            $stmtRoles = $pdo->prepare($sqlRoles);
            $stmtRoles->execute();
            $roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="mb-3 flex-grow-1">
                <label for="addRole" class="form-label">Role</label>
                <select class="form-select" id="maRole" name="addRole" required>
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo htmlspecialchars($role['role_id']); ?>">
                            <?php echo htmlspecialchars($role['role_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php
            include("../connectDb.php");
            $sqlRanks = "SELECT * FROM `rank`";
            $stmtRanks = $pdo->prepare($sqlRanks);
            $stmtRanks->execute();
            $ranks = $stmtRanks->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="mb-3 flex-grow-1">
                <label for="addRank" class="form-label">Rank</label>
                <select class="form-select" id="maRank" name="addRank" required>
                    <option value="">Select Rank</option>
                    <?php foreach ($ranks as $rank): ?>
                        <option value="<?php echo htmlspecialchars($rank['rank_id']); ?>">
                            <?php echo htmlspecialchars($rank['rank_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success text-white border border-0">Add Account</button>
    </form>
</div>

<!-- Hidden canvas for cropping -->
<canvas id="cropCanvas" style="display: none;"></canvas>

<script src="/ICS_Web_Portal/js/addFormZoomPan.js"></script>