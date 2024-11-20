function loadGradeSections() {
  $.ajax({
      url: '../function/fetchSectionMaterials.php', // Path to the external PHP file
      type: 'GET',
      success: function(response) {
          const sections = JSON.parse(response);
          const sectionSelect = $('#sectionInputGrades');
          sectionSelect.empty(); // Clear existing options

          if (sections.length > 0) {
              sectionSelect.append('<option selected disabled>Section</option>');
              sections.forEach(section => {
                  sectionSelect.append('<option value="' + section.section_id + '">' + section.section_name + '</option>');
              });
          } else {
              sectionSelect.append('<option>No sections available</option>');
          }
      },
      error: function() {
          alert("Error fetching sections.");
      }
  });
}

$(document).ready(function() {
  loadGradeSections(); // Call loadSections on page load
});