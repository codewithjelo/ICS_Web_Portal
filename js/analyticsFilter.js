$(document).ready(function () {
  // Fetch grade levels on page load
  $.ajax({
    url: "../function/fetchGradeLevels.php",
    type: "POST",
    dataType: "json",
    success: function (response) {
      $.each(response, function (index, grade) {
        $("#gradeLevelAnalytics").append(
          '<option value="' + grade.grade_level_id + '">' + grade.grade_level + "</option>"
        );
      });
    },
    error: function (xhr, status, error) {
      alert("Failed to retrieve grade levels.");
    },
  });

  // Fetch sections based on selected grade level
  $("#gradeLevelAnalytics").change(function () {
    var gradeLevelId = $(this).val();
    $.ajax({
      url: "../function/fetchSections.php",
      type: "POST",
      data: { grade_level_id: gradeLevelId },
      dataType: "json",
      success: function (response) {
        $("#sectionAnalytics").empty();
        $("#sectionAnalytics").append("<option selected>Select</option>");
        $.each(response, function (index, section) {
          $("#sectionAnalytics").append(
            '<option value="' + section.section_id + '">' + section.section_name + "</option>"
          );
        });
      },
      error: function (xhr, status, error) {
        alert("Failed to retrieve sections.");
      },
    });
  });

  // Fetch academic years
  $.ajax({
    url: "../function/fetchAcademicYear.php",
    type: "POST",
    dataType: "json",
    success: function (response) {
      $.each(response, function (index, academicYear) {
        $("#academicYearAnalytics").append(
          '<option value="' + academicYear.academic_year + '">' + academicYear.academic_year + "</option>"
        );
      });
    },
    error: function (xhr, status, error) {
      alert("Failed to retrieve academic year.");
    },
  });

  // Fetch chart data when section or academic year changes
  $("#sectionAnalytics, #academicYearAnalytics").change(function () {
    var sectionId = $("#sectionAnalytics").val();
    var academicYear = $("#academicYearAnalytics").val();

    if (sectionId && academicYear) {
      $.ajax({
        url: "../function/getGrades.php",
        type: "POST",
        data: {
          section_analytics: sectionId,
          academic_year_analytics: academicYear
        },
        dataType: "json",
        success: function (response) {
          if (response.error) {
            loadDefaultGraph();
          } else {
            const labels = response.map((item) => item.subject_name);
            const firstQuarterData = response.map((item) => parseFloat(item.first_quarter_avg));
            const secondQuarterData = response.map((item) => parseFloat(item.second_quarter_avg));
            const thirdQuarterData = response.map((item) => parseFloat(item.third_quarter_avg));
            const fourthQuarterData = response.map((item) => parseFloat(item.fourth_quarter_avg));

            const chartData = {
              labels,
              datasets: [
                {
                  label: "First Quarter",
                  data: firstQuarterData,
                  backgroundColor: "#FFE17A",
                  borderWidth: 1,
                },
                {
                  label: "Second Quarter",
                  data: secondQuarterData,
                  backgroundColor: "#FFCD4B",
                  borderWidth: 1,
                },
                {
                  label: "Third Quarter",
                  data: thirdQuarterData,
                  backgroundColor: "#FFB500",
                  borderWidth: 1,
                },
                {
                  label: "Fourth Quarter",
                  data: fourthQuarterData,
                  backgroundColor: "#B3892F",
                  borderWidth: 1,
                },
              ],
            };

            // Update the chart and show dynamic recommendations
            updateChart(chartData);
            showRecommendation(
              firstQuarterData,
              secondQuarterData,
              thirdQuarterData,
              fourthQuarterData,
              labels // Pass subject names
            );
          }
        },
        error: function (xhr, status, error) {
          alert("Failed to fetch chart data.");
        }
      });
    }
  });
});
