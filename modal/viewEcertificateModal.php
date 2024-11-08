<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCertificate - ICS Parent Portal</title>
    <link rel="stylesheet" href="../css/classScheduleModal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Modal for Viewing E-Certificate -->
    <div class="modal fade modal-xl" id="viewEcertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title" id="staticBackdropLabel">E-CERTIFICATE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="certificates-container">
                    <!-- Dynamically populated certificate items -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to load and display e-certificates for the logged-in student
            function loadEcertificates() {
                $.ajax({
                    url: '../modal/querys/getEcertificates.php', // Adjust the path to your PHP API
                    type: 'GET',
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            var certContainer = $('#certificates-container');
                            certContainer.empty();  // Clear any previous content

                            // Loop through the e-certificates data and append to the modal
                            response.data.forEach(function(cert) {
                                var certCard = `
                                    <div class="cert-card" style="color: #000;">
                                        <img src="../img/ecertificates/${cert.file_name}" alt="Certificate Thumbnail">
                                        <div class="cert-card-text">
                                            <strong style="color: #000;">File Name: ${cert.file_name}</strong>
                                        </div>
                                        <div class="cert-card-icon">
                                            <a href="../img/ecertificates/${cert.file_name}" download="${cert.file_name}">
                                                <i style="color: #000;" class="bi bi-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                `;
                                certContainer.append(certCard);
                            });
                        } else {
                            $('#certificates-container').html('<p>No e-certificates found.</p>');
                        }
                    },
                    error: function() {
                        $('#certificates-container').html('<p>Error loading certificates. Please try again later.</p>');
                    }
                });
            }

            // Trigger modal open and load certificates when modal is shown
            $('#viewEcertModal').on('shown.bs.modal', function() {
                loadEcertificates();
            });
        });
    </script>
</body>

</html>
