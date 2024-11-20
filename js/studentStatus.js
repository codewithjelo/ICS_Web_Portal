document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("turnOverTable");

  if (!table) {
    console.error("Error: #turnOverTable not found.");
    return;
  }

  table.addEventListener("change", function (event) {
    if (event.target && event.target.id === "studentStatus") {
      const studentStatus = event.target.value;
      const row = event.target.closest("tr");
      const gradeSection = row.querySelector("#gradeSection");
      const academicYear = row.querySelector("#academicYear");
      const getGradeLevelId = row.querySelector("#getGradeLevel").value;
      let gradeLevelId = parseInt(getGradeLevelId);

      // Reset gradeSection options
      gradeSection.innerHTML = "<option selected disabled>Select</option>";

      if (studentStatus === "Passed") {
        if (gradeLevelId === 7) {
          fetchGradeSections(gradeLevelId, gradeSection);
        } else {
          gradeLevelId += 1; // Increment grade_level_id
          fetchGradeSections(gradeLevelId, gradeSection);
        }
        gradeSection.disabled = false;
        academicYear.disabled = false;
      } else if (studentStatus === "Retained") {
        fetchGradeSections(gradeLevelId, gradeSection);
        gradeSection.disabled = false;
        academicYear.disabled = false;
      } else if (studentStatus === "Dropped") {
        gradeSection.disabled = true;
        academicYear.disabled = true;
        return; // Exit function
      }
    }
  });

  function fetchGradeSections(gradeLevelId, gradeSection) {
    console.log("Fetching grade sections for grade level ID:", gradeLevelId);
    fetch(`../function/turnOverSection.php?grade_level_id=${gradeLevelId}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        console.log("Fetched data:", data);
        if (Array.isArray(data) && data.length > 0) {
          data.forEach((section) => {
            const option = document.createElement("option");
            option.value = section.section_id;
            option.textContent = `${section.grade_level} - ${section.section_name}`;
            gradeSection.appendChild(option);
          });
        } else {
          console.log("No sections found for grade level", gradeLevelId);
        }
      })
      .catch((error) => {
        console.error("Error fetching grade sections:", error);
      });
  }
});
