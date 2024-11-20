function loadStudentSections() {
    $.ajax({
        url: '../function/fetchSectionMaterials.php', // Path to the external PHP file
        type: 'GET',
        success: function(response) {
            const sections = JSON.parse(response);
            const sectionSelect = $('#sectionCertificate');
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

function loadStudentsBySection(sectionId) {
    if (sectionId) {
        $.ajax({
            url: '../function/fetchStudentsBySection.php', // New PHP file to fetch students
            type: 'GET',
            data: { section_id: sectionId },
            success: function(response) {
                const students = JSON.parse(response);
                const studentSelect = $('#studentCertificate');
                studentSelect.empty(); // Clear existing options

                if (students.length > 0) {
                    studentSelect.append('<option selected disabled>Select Student</option>');
                    students.forEach(student => {
                        studentSelect.append('<option value="' + student.student_id + '">' + student.full_name + '</option>');
                    });
                } else {
                    studentSelect.append('<option>No students available</option>');
                }
            },
            error: function() {
                alert("Error fetching students.");
            }
        });
    } else {
        $('#studentCertificate').empty().append('<option selected disabled>Select Student</option>');
    }
}

$(document).ready(function() {
    loadStudentSections(); // Call loadSections on page load

    // Event listener for section change
    $('#sectionCertificate').change(function() {
        const sectionId = $(this).val();
        loadStudentsBySection(sectionId); // Fetch students based on the selected section
    });

    // Event listener for student selection
    $('#studentCertificate').change(function() {
        const selectedStudent = $(this).find("option:selected");
        const fullName = selectedStudent.text();
        $('#fullName').val(fullName);
    });
});
