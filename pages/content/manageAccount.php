<link rel="stylesheet" type="text/css" href="../css/manageAccount.css">

<div class="ma-container row">
    <div class="ma-dashboard p-3">
        <!-- Records List Page -->
        <div id="recordsPage" class="page active">
            <div class="table-container">
                <div class="header-section">
                    <div class="d-flex justify-content-center align-items-center mb-3 text-center position-relative">
                        <h2 class="text-white">MANAGE ACCOUNT</h2>
                        <button class="add-btn btn position-absolute" style="background-color: white; color: black;"
                            onclick="showAddForm()">
                            <i class="bi bi-plus"></i> Add Account
                        </button>
                    </div>

                    <div class="d-flex gap-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="searchInput" placeholder="Search Account"
                                oninput="searchRecords()">
                        </div>
                        <div class="role-filter mb-3">
                            <select class="form-select" id="roleFilter" onchange="filterByRole()">
                                <option value="">All Roles</option>
                                <?php
                                // Fetch distinct roles from the database
                                $roleQuery = "SELECT DISTINCT role_id, role_name FROM role ORDER BY role_id";
                                $roleResult = mysqli_query($conn, $roleQuery);

                                if (mysqli_num_rows($roleResult) > 0) {
                                    while ($roleRow = mysqli_fetch_assoc($roleResult)) {
                                        $roleId = htmlspecialchars($roleRow['role_id']);
                                        $roleName = htmlspecialchars($roleRow['role_name']);
                                        if ($roleId != 2) {
                                            echo "<option value='$roleName'>$roleName</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="table-responsive overflow-y-auto" style="max-height: 370px;">
                    <table id="accountTable" class="table table-hover table-striped position-relative">
                        <thead class="table-light position-sticky top-0">
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="recordsTableBody">
                            <?php
                            include "../connectDb.php";

                            $query = " SELECT act.user_id, r.role_name, r.role_id,
                                CASE
                                    WHEN act.role_id = 1 THEN CONCAT(st.last_name, ', ', st.first_name, CASE WHEN st.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(st.middle_name, 1), '.') ELSE '' END)
                                    WHEN act.role_id = 3 THEN CONCAT(t.last_name, ', ', t.first_name, CASE WHEN t.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(t.middle_name, 1), '.') ELSE '' END)
                                    WHEN act.role_id = 4 THEN CONCAT(g.last_name, ', ', g.first_name, CASE WHEN g.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(g.middle_name, 1), '.') ELSE '' END)
                                    WHEN act.role_id = 5 THEN CONCAT(p.last_name, ', ', p.first_name, CASE WHEN p.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(p.middle_name, 1), '.') ELSE '' END)
                                    WHEN act.role_id = 6 THEN CONCAT(pd.last_name, ', ', pd.first_name, CASE WHEN pd.middle_name IS NOT NULL THEN CONCAT(' ', LEFT(pd.middle_name, 1), '.') ELSE '' END)
                                END AS full_name,

                                CASE
                                    WHEN act.role_id = 1 THEN st.first_name
                                    WHEN act.role_id = 3 THEN t.first_name
                                    WHEN act.role_id = 4 THEN g.first_name
                                    WHEN act.role_id = 5 THEN p.first_name
                                    WHEN act.role_id = 6 THEN pd.first_name
                                END AS first_name,

                                CASE
                                    WHEN act.role_id = 1 THEN st.middle_name
                                    WHEN act.role_id = 3 THEN t.middle_name
                                    WHEN act.role_id = 4 THEN g.middle_name
                                    WHEN act.role_id = 5 THEN p.middle_name
                                    WHEN act.role_id = 6 THEN pd.middle_name
                                END AS middle_name,

                                CASE
                                    WHEN act.role_id = 1 THEN st.last_name
                                    WHEN act.role_id = 3 THEN t.last_name
                                    WHEN act.role_id = 4 THEN g.last_name
                                    WHEN act.role_id = 5 THEN p.last_name
                                    WHEN act.role_id = 6 THEN pd.last_name
                                END AS last_name,

                                CASE
                                    WHEN act.role_id = 1 THEN st.profile_picture
                                    WHEN act.role_id = 3 THEN t.profile_picture
                                    WHEN act.role_id = 4 THEN g.profile_picture
                                    WHEN act.role_id = 5 THEN p.profile_picture
                                    WHEN act.role_id = 6 THEN pd.profile_picture
                                END AS profile_picture,

                                CASE
                                    WHEN act.role_id = 1 THEN pr.email
                                    WHEN act.role_id = 3 THEN t.email
                                    WHEN act.role_id = 4 THEN g.email
                                    WHEN act.role_id = 5 THEN p.email
                                    WHEN act.role_id = 6 THEN pd.email
                                END AS email

                                FROM `account` act
                                LEFT JOIN `student` st ON st.lrn = act.user_id
                                LEFT JOIN `parent` pr ON st.parent_id = pr.parent_id
                                LEFT JOIN `teacher` t ON t.teacher_id = RIGHT(act.user_id, 4)
                                LEFT JOIN `guidance` g ON g.guidance_id = RIGHT(act.user_id, 4)
                                LEFT JOIN `principal` p ON p.principal_id = RIGHT(act.user_id, 4)
                                LEFT JOIN `pdo` pd ON pd.pdo_id = RIGHT(act.user_id, 4)
                                LEFT JOIN `role` r ON r.role_id = act.role_id;";

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $userId = htmlspecialchars($row['user_id']);
                                    $profilePicture = htmlspecialchars($row['profile_picture']);
                                    $fullName = htmlspecialchars($row['full_name']);
                                    $firstName = htmlspecialchars($row['first_name']);
                                    $middleName = htmlspecialchars($row['middle_name']);
                                    $lastName = htmlspecialchars($row['last_name']);
                                    $email = htmlspecialchars($row['email']);
                                    $roleName = htmlspecialchars($row['role_name']);
                                    $roleId = htmlspecialchars($row['role_id']);

                                    ?>
                                    <tr style="font-size: 14px;">
                                        <td class="fw-bold"><?php echo $userId; ?></td>
                                        <td><?php echo $fullName; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $roleName; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success action-btn"
                                                onclick="showEditPage('<?php echo $userId; ?>', '<?php echo addslashes($profilePicture); ?>', '<?php echo addslashes($firstName); ?>', '<?php echo addslashes($middleName); ?>','<?php echo addslashes($lastName); ?>', '<?php echo addslashes($email); ?>', '<?php echo $roleId; ?>', '<?php echo addslashes($roleName); ?>')">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <?php if ($roleId > 2) {
                                                ?>
                                                <button class="btn btn-sm btn-danger action-btn"
                                                    onclick="deleteAccount('<?php echo $userId; ?>', '<?php echo $roleId; ?>')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                                <?php
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center text-muted">No records found</td></tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Record Page -->
        <?php include 'manage-account/editAccount.php'; ?>

        <!-- Add Record Page -->
        <?php include 'manage-account/addAccount.php'; ?>

    </div>
</div>

<script>
    function showRecordsPage() {
        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        document.getElementById('recordsPage').classList.add('active');
        document.getElementById('searchInput').value = '';
    }

    function filterByRole() {
        const selectedRole = document.getElementById('roleFilter').value.toLowerCase();
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#recordsTableBody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const role = cells[3]?.textContent.toLowerCase() || '';
            const id = cells[0]?.textContent.toLowerCase() || '';
            const name = cells[1]?.textContent.toLowerCase() || '';
            const email = cells[2]?.textContent.toLowerCase() || '';

            // Check both role filter and search input
            const matchesRole = selectedRole === '' || role.includes(selectedRole);
            const matchesSearch = searchInput === '' ||
                id.includes(searchInput) ||
                name.includes(searchInput) ||
                email.includes(searchInput) ||
                role.includes(searchInput);

            if (matchesRole && matchesSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function searchRecords() {
        filterByRole();
    }

    function showEditPage(userId, profilePicture, firstName, middleName, lastName, email, roleId, roleName) {
        document.getElementById('maEditUserId').value = userId;
        document.getElementById('maEditFirstName').value = firstName;
        document.getElementById('maEditMiddleName').value = middleName;
        document.getElementById('maEditLastName').value = lastName;
        document.getElementById('maEditEmail').value = email;
        document.getElementById('maEditRoleId').value = roleId;
        document.getElementById('maEditRoleName').value = roleName;

        // Set the profile picture preview
        const profilePreview = document.getElementById('maEditDefaultProfile');
        if (profilePicture && profilePicture !== '') {
            profilePreview.src = profilePicture;
        } else {
            profilePreview.src = '../uploads/profile_pictures/avatar.jpg';
        }

        document.getElementById('maEditProfile').value = '';

        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        document.getElementById('editPage').classList.add('active');
    }

    function showAddForm() {
        document.getElementById('addAccount').reset();
        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        document.getElementById('addPage').classList.add('active');
    }

    function deleteAccount(userId, roleId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/ICS_Web_Portal/function/deleteAccount.php?user_id=' + encodeURIComponent(userId) + '&role_id=' + encodeURIComponent(roleId);
            }
        });
    }
</script>