function loadFilterSections() {
    $.ajax({
        url: '../function/fetchSectionMaterials.php', // Path to the PHP file to get sections
        type: 'GET',
        success: function(response) {
            const sections = JSON.parse(response);
            const sectionFilter = $('#sectionFilter');
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

    $('#sectionFilter').on('change', function() {
        const sectionId = $(this).val();
        fetchFilteredMaterials(sectionId);
    });
}

function fetchFilteredMaterials(sectionId) {
    $.ajax({
        url: '../function/fetchMaterialList.php', // Path to PHP file for filtering materials
        type: 'POST',
        data: { section_filter: sectionId },
        success: function(data) {
            $('#uploadedFiles').html(data);
        },
        error: function() {
            alert("Error fetching materials.");
        }
    });
}

$(document).ready(function() {
    loadFilterSections(); // Call loadSections on page load
});