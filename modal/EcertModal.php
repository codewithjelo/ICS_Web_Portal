<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Status - ICS Teacher Portal</title>
    <link rel="stylesheet" href="../css/inputGradesModal.css">
    <script src="../js/ecertModal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.11/sweetalert2.min.js"></script>
    <style>
        /* Basic modal styling */
        .modal-content {
            padding: 20px;
            border-radius: 8px;
            background-color: #f5f7fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .modal-header {
            text-align: center;
            color: #444;
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        /* Styling for tab buttons */
        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .tab-button:hover {
            background-color: #0056b3;
        }

        .tab-button.active {
            background-color: #0056b3;
        }

        /* Styling for tab content */
        .tab-content {
            display: none;
            margin-top: 20px;
        }

        .tab-content.active {
            display: block;
        }

        /* Form styling */
        #ESstatusForm {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 2fr;
            margin-top: 10px;
        }

        #ESstatusForm label {
            font-weight: bold;
            color: #555;
            display: flex;
            align-items: center;
        }

        #ESstatusForm select, 
        #ESstatusForm input, 
        #ESstatusForm button {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            width: 100%;
        }

        /* Section and student div styling */
        #newSectionDiv, #retainedInfo {
            grid-column: span 2;
            margin-top: 15px;
            padding: 10px;
            background-color: #fafafa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Additional info styling */
        #retainedInfo p {
            margin: 5px 0;
            font-size: 0.95rem;
        }

        /* Styling for the e-certificate list */
        .ecert-list {
            display: grid;
            gap: 20px;
            margin-top: 10px;
        }

        .ecert-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .ecert-item a {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .ecert-item a:hover {
            background-color: #0056b3;
        }

        .ecert-item .error-msg {
            color: #e74c3c;
            font-size: 1rem;
            text-align: center;
        }

        .ecert-item .info {
            font-size: 1rem;
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #ESstatusForm {
                grid-template-columns: 1fr;
            }

            #ESstatusForm label {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- SweetAlert messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $_SESSION['success_message']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo $_SESSION['error_message']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="modal fade modal-lg" id="EcertModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Upload and Send E-Certificate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tab buttons -->
                    <div class="tabs">
                        <button class="tab-button active" data-tab="uploadTab">Upload E-Certificate</button>
                        <button class="tab-button" data-tab="viewTab">View Uploaded E-Certificates</button>
                    </div>

                    <!-- Tab Content -->
                    <div id="uploadTab" class="tab-content active">
                        <!-- Form inside modal for uploading -->
                        <form id="ESstatusForm">
                            <!-- Section Selection -->
                            <label for="ecertSectionSelect" class="form-label">Select Section:</label>
                            <select id="ecertSectionSelect" name="section" class="form-select mb-3" required>
                                <option value="">Choose a section</option>
                            </select>

                            <!-- Student Selection (populated based on selected section) -->
                            <label for="estudentSelect" class="form-label">Select Student:</label>
                            <select id="estudentSelect" name="student" class="form-select mb-3" required disabled>
                                <option value="">Choose a student</option>
                            </select>

                            <!-- File Upload -->
                            <label for="EsfileInput" class="form-label">Upload E-Certificate:</label>
                            <input type="file" id="EsfileInput" name="ecert_file" class="form-control mb-3" required accept=".pdf, .jpg, .jpeg, .png">

                            <!-- Display Uploaded File -->
                            <div id="filePreview" class="mt-3 p-3 border rounded" style="background-color: #f8f9fa;">
                                <!-- Uploaded file preview will be displayed here -->
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Upload and Send</button>
                        </form>
                    </div>

                    <div id="viewTab" class="tab-content">
                        <!-- Title for E-Certificate List -->
                        <h2 class="mt-4">Uploaded E-Certificates</h2>

                        <!-- Section for e-certificate list -->
                        <div id="ecertList" class="ecert-list">
                            <!-- E-certificate list will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Switch between tabs
        $('.tab-button').on('click', function() {
            const targetTab = $(this).data('tab');
            
            // Remove active class from all buttons and add to the clicked button
            $('.tab-button').removeClass('active');
            $(this).addClass('active');
            
            // Hide all tab content and show the clicked tab content
            $('.tab-content').removeClass('active');
            $('#' + targetTab).addClass('active');
        });

        document.getElementById('EsfileInput').addEventListener('change', function(event) {
            const fileInput = event.target;
            const filePreview = document.getElementById('filePreview');
            const file = fileInput.files[0];
            
            if (file) {
                const fileName = file.name;
                filePreview.textContent = `Selected file: ${fileName}`;
            } else {
                filePreview.textContent = '';
            }
        });

        $(document).ready(function() {
            $.ajax({
                url: '../modal/querys/t_modal.php',  // Make sure this path is correct
                type: 'GET',
                data: { action: 'getSections' },  // Request action for fetching sections
                success: function(data) {
                    // console.log("Sections data received:", data);

                    if (data.success) {
                        // console.log("Sections received:", data.data);

                        // Ensure the #ecertSectionSelect dropdown exists and is being populated
                        $('#ecertSectionSelect').empty();  // Clear any previous options
                        $('#ecertSectionSelect').append(new Option("Choose a section", ""));  // Add default option

                        // Populate section dropdown with available sections
                        data.data.forEach(function(section) {
                            // console.log("Adding section to dropdown:", section);
                            $('#ecertSectionSelect').append(new Option(section, section));
                        });

                        // console.log('Sections populated successfully.');
                    } else {
                        console.error('Error:', data.message);
                        // console.log('Error message:', data.message);
                    }
                },
                error: function(err) {
                    console.error('Error fetching sections:', err);
                    // console.log('Error details:', err);
                }
            });

            // Handle form submission
            $('#ESstatusForm').submit(function(event) {
                event.preventDefault();

                // Basic form validation
                const formData = new FormData(this);
                
                // Check if file is selected
                const EsfileInput = $('#EsfileInput')[0];
                // console.log(EsfileInput)
                if (!EsfileInput.files.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please upload an e-certificate.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                formData.append('action', 'uploadCert');
                // Send form data to backend (AJAX call)
                $.ajax({
                    url: '../modal/querys/uploadEcert.php',  // PHP script for handling form submission
                    type: 'POST',
                    data: formData,
                    processData: false,  // Don't process the data (needed for FormData)
                    contentType: false,  // Don't set content type
                    success: function(response) {
                        // console.log(response);

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'E-certificate uploaded and sent successfully!',
                                confirmButtonText: 'OK'
                            });
                            // Optionally reset the form after successful submission
                            $('#ESstatusForm')[0].reset();
                            $('#estudentSelect').prop('disabled', true); // Disable student select after submission
                        } else {
                            console.log(response.test)
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Error!',
                            //     text: response.message,
                            //     confirmButtonText: 'OK'
                            // });
                        }
                    },
                    error: function(err) {
                        // console.error('AJAX Error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Handle section change event to load students
            $('#ecertSectionSelect').change(function() {
                const selectedSection = $(this).val();  // Get the selected section
                // console.log("Selected section:", selectedSection);

                // Empty and disable student dropdown until a section is selected
                $('#estudentSelect').empty().append(new Option("Choose a student", ""));
                $('#estudentSelect').prop('disabled', true);  // Disable until we have student data

                // If a section is selected, fetch students
                if (selectedSection) {
                    // console.log("Fetching students for section:", selectedSection);
                    $.ajax({
                        url: '../modal/querys/t_modal.php',  // Make sure this path is correct
                        type: 'GET',
                        data: { 
                            action: 'getStudents',  // Request action to fetch students
                            section: selectedSection  // Pass the selected section
                        },
                        success: function(data) {
                            // console.log("Students data received:", data);

                            if (data.success) {
                                data.data.forEach(function(student) {
                                    // console.log("Adding student:", student);
                                    $('#estudentSelect').append(new Option(student.name, student.id));
                                });
                                $('#estudentSelect').prop('disabled', false);  // Enable student dropdown after populating
                                // console.log('Students populated successfully.');
                            } else {
                                console.error('Error:', data.message);
                                // console.log('Error message:', data.message);
                            }
                        },
                        error: function(err) {
                            // console.error('Error fetching students:', err);
                            // console.log('Error details:', err);
                        }
                    });
                } else {
                    // console.log("No section selected, clearing student dropdown.");
                }
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Status - ICS Teacher Portal</title>
    <link rel="stylesheet" href="../css/inputGradesModal.css">
    <script src="../js/ecertModal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.11/sweetalert2.min.js"></script>
    <style>
        /* Basic modal styling */
        .modal-content {
            padding: 20px;
            border-radius: 8px;
            background-color: #f5f7fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .modal-header {
            text-align: center;
            color: #444;
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        /* Styling for tab buttons */
        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .tab-button:hover {
            background-color: #0056b3;
        }

        .tab-button.active {
            background-color: #0056b3;
        }

        /* Styling for tab content */
        .tab-content {
            display: none;
            margin-top: 20px;
        }

        .tab-content.active {
            display: block;
        }

        /* Form styling */
        #ESstatusForm {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 2fr;
            margin-top: 10px;
        }

        #ESstatusForm label {
            font-weight: bold;
            color: #555;
            display: flex;
            align-items: center;
        }

        #ESstatusForm select, 
        #ESstatusForm input, 
        #ESstatusForm button {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            width: 100%;
        }

        /* Section and student div styling */
        #newSectionDiv, #retainedInfo {
            grid-column: span 2;
            margin-top: 15px;
            padding: 10px;
            background-color: #fafafa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Additional info styling */
        #retainedInfo p {
            margin: 5px 0;
            font-size: 0.95rem;
        }

        /* Styling for the e-certificate list */
        .ecert-list {
            display: grid;
            gap: 20px;
            margin-top: 10px;
        }

        .ecert-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .ecert-item a {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .ecert-item a:hover {
            background-color: #0056b3;
        }

        .ecert-item .error-msg {
            color: #e74c3c;
            font-size: 1rem;
            text-align: center;
        }

        .ecert-item .info {
            font-size: 1rem;
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #ESstatusForm {
                grid-template-columns: 1fr;
            }

            #ESstatusForm label {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- SweetAlert messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $_SESSION['success_message']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo $_SESSION['error_message']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="modal fade modal-lg" id="EcertModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Upload and Send E-Certificate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tab buttons -->
                    <div class="tabs">
                        <button class="tab-button active" data-tab="uploadTab">Upload E-Certificate</button>
                        <button class="tab-button" data-tab="viewTab">View Uploaded E-Certificates</button>
                    </div>

                    <!-- Tab Content -->
                    <div id="uploadTab" class="tab-content active">
                        <!-- Form inside modal for uploading -->
                        <form id="ESstatusForm">
                            <!-- Section Selection -->
                            <label for="ecertSectionSelect" class="form-label">Select Section:</label>
                            <select id="ecertSectionSelect" name="section" class="form-select mb-3" required>
                                <option value="">Choose a section</option>
                            </select>

                            <!-- Student Selection (populated based on selected section) -->
                            <label for="estudentSelect" class="form-label">Select Student:</label>
                            <select id="estudentSelect" name="student" class="form-select mb-3" required disabled>
                                <option value="">Choose a student</option>
                            </select>

                            <!-- File Upload -->
                            <label for="EsfileInput" class="form-label">Upload E-Certificate:</label>
                            <input type="file" id="EsfileInput" name="ecert_file" class="form-control mb-3" required accept=".pdf, .jpg, .jpeg, .png">

                            <!-- Display Uploaded File -->
                            <div id="filePreview" class="mt-3 p-3 border rounded" style="background-color: #f8f9fa;">
                                <!-- Uploaded file preview will be displayed here -->
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Upload and Send</button>
                        </form>
                    </div>

                    <div id="viewTab" class="tab-content">
                        <!-- Title for E-Certificate List -->
                        <h2 class="mt-4">Uploaded E-Certificates</h2>

                        <!-- Section for e-certificate list -->
                        <div id="ecertList" class="ecert-list">
                            <!-- E-certificate list will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Switch between tabs
        $('.tab-button').on('click', function() {
            const targetTab = $(this).data('tab');
            
            // Remove active class from all buttons and add to the clicked button
            $('.tab-button').removeClass('active');
            $(this).addClass('active');
            
            // Hide all tab content and show the clicked tab content
            $('.tab-content').removeClass('active');
            $('#' + targetTab).addClass('active');
        });

        document.getElementById('EsfileInput').addEventListener('change', function(event) {
            const fileInput = event.target;
            const filePreview = document.getElementById('filePreview');
            const file = fileInput.files[0];
            
            if (file) {
                const fileName = file.name;
                filePreview.textContent = `Selected file: ${fileName}`;
            } else {
                filePreview.textContent = '';
            }
        });

        $(document).ready(function() {
            $.ajax({
                url: '../modal/querys/t_modal.php',  // Make sure this path is correct
                type: 'GET',
                data: { action: 'getSections' },  // Request action for fetching sections
                success: function(data) {
                    // console.log("Sections data received:", data);

                    if (data.success) {
                        // console.log("Sections received:", data.data);

                        // Ensure the #ecertSectionSelect dropdown exists and is being populated
                        $('#ecertSectionSelect').empty();  // Clear any previous options
                        $('#ecertSectionSelect').append(new Option("Choose a section", ""));  // Add default option

                        // Populate section dropdown with available sections
                        data.data.forEach(function(section) {
                            // console.log("Adding section to dropdown:", section);
                            $('#ecertSectionSelect').append(new Option(section, section));
                        });

                        // console.log('Sections populated successfully.');
                    } else {
                        console.error('Error:', data.message);
                        // console.log('Error message:', data.message);
                    }
                },
                error: function(err) {
                    console.error('Error fetching sections:', err);
                    // console.log('Error details:', err);
                }
            });

            // Handle form submission
            $('#ESstatusForm').submit(function(event) {
                event.preventDefault();

                // Basic form validation
                const formData = new FormData(this);
                
                // Check if file is selected
                const EsfileInput = $('#EsfileInput')[0];
                // console.log(EsfileInput)
                if (!EsfileInput.files.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please upload an e-certificate.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                formData.append('action', 'uploadCert');
                // Send form data to backend (AJAX call)
                $.ajax({
                    url: '../modal/querys/uploadEcert.php',  // PHP script for handling form submission
                    type: 'POST',
                    data: formData,
                    processData: false,  // Don't process the data (needed for FormData)
                    contentType: false,  // Don't set content type
                    success: function(response) {
                        // console.log(response);

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'E-certificate uploaded and sent successfully!',
                                confirmButtonText: 'OK'
                            });
                            // Optionally reset the form after successful submission
                            $('#ESstatusForm')[0].reset();
                            $('#estudentSelect').prop('disabled', true); // Disable student select after submission
                        } else {
                            console.log(response.test)
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Error!',
                            //     text: response.message,
                            //     confirmButtonText: 'OK'
                            // });
                        }
                    },
                    error: function(err) {
                        // console.error('AJAX Error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Handle section change event to load students
            $('#ecertSectionSelect').change(function() {
                const selectedSection = $(this).val();  // Get the selected section
                // console.log("Selected section:", selectedSection);

                // Empty and disable student dropdown until a section is selected
                $('#estudentSelect').empty().append(new Option("Choose a student", ""));
                $('#estudentSelect').prop('disabled', true);  // Disable until we have student data

                // If a section is selected, fetch students
                if (selectedSection) {
                    // console.log("Fetching students for section:", selectedSection);
                    $.ajax({
                        url: '../modal/querys/t_modal.php',  // Make sure this path is correct
                        type: 'GET',
                        data: { 
                            action: 'getStudents',  // Request action to fetch students
                            section: selectedSection  // Pass the selected section
                        },
                        success: function(data) {
                            // console.log("Students data received:", data);

                            if (data.success) {
                                data.data.forEach(function(student) {
                                    // console.log("Adding student:", student);
                                    $('#estudentSelect').append(new Option(student.name, student.id));
                                });
                                $('#estudentSelect').prop('disabled', false);  // Enable student dropdown after populating
                                // console.log('Students populated successfully.');
                            } else {
                                console.error('Error:', data.message);
                                // console.log('Error message:', data.message);
                            }
                        },
                        error: function(err) {
                            // console.error('Error fetching students:', err);
                            // console.log('Error details:', err);
                        }
                    });
                } else {
                    // console.log("No section selected, clearing student dropdown.");
                }
            });
        });
    </script>
</body>
</html>
