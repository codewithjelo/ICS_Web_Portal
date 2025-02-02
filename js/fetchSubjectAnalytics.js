$(document).ready(function () {
  // Fetch sections based on selected grade level
  $("#sectionAnalytics").change(function () {
    const sectionId = $("#sectionAnalytics").val();
    $("#subjectAnalytics").empty().append('<option value="" selected>Select</option>');
    if (sectionId) {
      $.ajax({
        url: "../function/fetchSubjectAnalytics.php",
        type: "POST",
        data: { section_analytics: sectionId },
        dataType: "json",
        success: function (response) {
          if (Array.isArray(response)) {
            response.forEach(subject => {
              $("#subjectAnalytics").append(
                `<option value="${subject.subject_id}">${subject.subject_name}</option>`
              );
            });
          } else {
            console.warn("Invalid response:", response);
          }
        },
        error: function (xhr) {
          console.error("Failed to fetch subjects:", xhr.responseText);
        },
      });
    }
  });
  

  // Attach event listeners to dropdowns
  document
    .querySelectorAll(
      "#sectionAnalytics, #academicYearAnalytics, #subjectAnalytics"
    )
    .forEach((dropdown) => {
      dropdown.addEventListener("change", function () {
        const section = document.getElementById("sectionAnalytics").value;
        const year = document.getElementById("academicYearAnalytics").value;
        const subject = document.getElementById("subjectAnalytics").value;

        // Only send request if all dropdowns have values
        if (section && year && subject) {
          fetchBottomStudents(section, year, subject);
        }
      });
    });    
    
    
    function fetchBottomStudents(section, year, subject) {
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../function/fetchBottomStudents.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
      xhr.onload = function () {
        if (this.status === 200) {
          console.log("Response received:", this.responseText); // Log the response
          document.getElementById("studentResults2").innerHTML = this.responseText;
        } else {
          console.error("Failed to fetch bottom students. Status:", this.status);
        }
      };
    
      xhr.onerror = function () {
        console.error("AJAX request for bottom students failed.");
      };
    
      xhr.send(
        `section_analytics=${encodeURIComponent(section)}&academic_year_analytics=${encodeURIComponent(year)}&subject_analytics=${encodeURIComponent(subject)}`
      );
    }    
});
