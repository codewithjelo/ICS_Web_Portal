function loadStudentFilterSections() {
    $.ajax({
        url: '../function/fetchSectionMaterials.php', // Path to the PHP file to get sections
        type: 'GET',
        success: function(response) {
            const sections = JSON.parse(response);
            const sectionFilter = $('#sectionCertificateFilter');
            sectionFilter.empty();

            if (sections.length > 0) {
                sectionFilter.append('<option selected disabled>Section</option>');
                sections.forEach(section => {
                    sectionFilter.append('<option value="' + section.section_id + '">' + section.section_name + '</option>');
                });
            } else {
                sectionFilter.append('<option>No sections available</option>');
            }
        },
        error: function() {
            alert("Error fetching sections.");
        }
    });

    $('#sectionCertificateFilter').on('change', function() {
        const sectionId = $(this).val();
        fetchFilteredStudent(sectionId);
    });
}

function fetchFilteredStudent(sectionId) {
    $.ajax({
        url: '../function/fetchStudentList.php', // Path to PHP file for filtering materials
        type: 'POST',
        data: { section_filter: sectionId },
        success: function(data) {
            $('#uploadedCertificate').html(data);
        },
        error: function() {
            alert("Error fetching student.");
        }
    });
}

$(document).ready(function() {
    loadStudentFilterSections(); // Call loadSections on page load
});