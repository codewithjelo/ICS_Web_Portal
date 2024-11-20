function loadGradesubjects() {
    $.ajax({
        url: '../function/fetchSubjectId.php', // Path to the external PHP file
        type: 'GET',
        success: function(response) {
            const subjects = JSON.parse(response);
            const subjectSelect = $('#subjectInputGrades');
            subjectSelect.empty(); // Clear existing options
  
            if (subjects.length > 0) {
                subjectSelect.append('<option selected disabled>Subject</option>');
                subjects.forEach(subjects => {
                    subjectSelect.append('<option value="' + subjects.subject_id + '">' + subjects.subject_name + '</option>');
                });
            } else {
                subjectSelect.append('<option>No subjects available</option>');
            }
        },
        error: function() {
            alert("Error fetching subjects.");
        }
    });
  }
  
  $(document).ready(function() {
    loadGradesubjects();
  });