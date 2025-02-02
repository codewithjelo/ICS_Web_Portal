$(document).ready(function () {

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
            fetchResults(section, year, subject);
          }
        });
      });
  
      function fetchResults(section, year, subject) {
        console.log("Selected parameters:", section, year, subject); // Add this line to debug
    
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../function/fetchStudentAnalytics.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
        xhr.onload = function () {
            if (this.status === 200) {
                console.log("Response received:", this.responseText); // Log the response
                document.getElementById("studentResults").innerHTML = this.responseText;
            } else {
                console.error("Failed to fetch top students. Status:", this.status);
            }
        };
    
        xhr.onerror = function () {
            console.error("AJAX request for top students failed.");
        };
    
        xhr.send(
            `section_analytics=${encodeURIComponent(section)}&academic_year_analytics=${encodeURIComponent(year)}&subject_analytics=${encodeURIComponent(subject)}`
        );
    }

  });
  