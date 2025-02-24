$(document).ready(function () {
  // Fetch grade levels on page load
  $.ajax({
    url: "../function/fetchGradeLevels.php", // Path to your PHP file for grade levels
    type: "GET",
    dataType: "json",
    success: function (response) {
      $.each(response, function (index, grade) {
        $("#gradeLevel").append(
          '<option value="' +
            grade.grade_level_id +
            '">' +
            grade.grade_level +
            "</option>"
        );
      });
    },
    error: function (xhr, status, error) {// Log the error
      alert("Failed to retrieve grade levels.");
    },
  });

  // Fetch sections based on selected grade level
  $("#gradeLevel").change(function () {
    var gradeLevelId = $(this).val(); // Debugging line
    $.ajax({
      url: "../function/fetchSections.php", // Path to your PHP file for sections
      type: "POST",
      data: { grade_level_id: gradeLevelId },
      dataType: "json",
      success: function (response) { // Debugging line
        $("#section").empty(); // Clear previous options
        $("#section").append("<option selected>Select</option>");
        $.each(response, function (index, section) {
          // Ensure the correct syntax here
          $("#section").append(
            '<option value="' +
              section.section_id +
              '">' +
              section.section_name +
              "</option>" // Use section_id for value
          );
        });
      },
      error: function (xhr, status, error) { // Log the error
        alert("Failed to retrieve sections.");
      },
    });
  });
});
  