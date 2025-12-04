<?php
include '../connectDb.php';

function fetchGrades($conn, $studentId)
{
    $academic_year = $_SESSION['academic_year'];
    $query = "SELECT g.first_quarter, g.second_quarter, g.third_quarter, g.fourth_quarter, 
               s.subject_name
        FROM grade g
        JOIN subject s ON g.subject_id = s.subject_id
        WHERE g.student_id = ? AND g.academic_year = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $studentId, $academic_year);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0 ? $result : false;
}

$studentId = $_SESSION['user_id'] ?? null;
$grades = [];

if ($studentId) {
    $query = "SELECT student_id FROM student WHERE student.lrn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentRecord = $row['student_id'];
        $grades = fetchGrades($conn, $studentRecord);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades - ICS Parent Portal</title>
    <link rel="stylesheet" href="../css/modal.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="gradesModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content overflow-y-auto" style="max-height: 1100px;">
                <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                    <h1 class="modal-title" id="staticBackdropLabel">GRADES</h1>
                    <button type="button" class="btn-close position-absolute" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="data-table" class="table table-bordered rounded">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2">LEARNING AREAS</th>
                                <th class="text-center" colspan="4">Quarterly Rating</th>
                                <th class="text-center" rowspan="2">Final Rating</th>
                            </tr>
                            <tr>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($grades): ?>
                                <?php
                                $totalGrades = 0;
                                $subjectCount = 0;
                                ?>
                                <?php while ($row = $grades->fetch_assoc()): ?>
                                    <?php
                                    $final_rating = null;
                                    if (!is_null($row['fourth_quarter'])) {
                                        $final_rating = round(($row['first_quarter'] + $row['second_quarter'] + $row['third_quarter'] + $row['fourth_quarter']) / 4, 0);
                                        $totalGrades += $final_rating;
                                        $subjectCount++;
                                    }
                                    ?>
                                    <tr>
                                        <th><?php echo htmlspecialchars($row['subject_name']); ?></th>
                                        <td class="text-center"><?php echo round($row['first_quarter'], 0) ?? ''; ?></td>
                                        <td class="text-center"><?php echo isset($row['second_quarter']) ? round($row['second_quarter'], 0) : ''; ?></td>
                                        <td class="text-center"><?php echo isset($row['third_quarter']) ? round($row['third_quarter'], 0) : ''; ?></td>
                                        <td class="text-center"><?php echo isset($row['fourth_quarter']) ? round($row['fourth_quarter'], 0) : ''; ?></td>
                                        <td class="text-center"><?php echo $final_rating ?? ''; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <th>General Average</th>
                                    <td colspan="4"></td>
                                    <td class="text-center">
                                        <?php echo $subjectCount > 0 ? round($totalGrades / $subjectCount, 0) : ''; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No grades available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="row justify-content-end me-1">
                        <button class="btn btn-primary border-0" style="width: 100px; background-color: var(--maroon);" onclick="generatePDF()">
                            <i class="bi bi-printer"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function generatePDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            const title = 'Ibaan Central School';
            const pageWidth = doc.internal.pageSize.getWidth();
            const titleX = (pageWidth - doc.getTextWidth(title)) / 2;

            // Center the title
            doc.text(title, titleX, 15);

            doc.autoTable({
                html: '#data-table',
                startY: 25,
                headStyles: {
                    fillColor: [94, 3, 10], // Color #5E030A
                    textColor: [255, 255, 255], // White text
                    fontStyle: 'bold',
                },
                styles: {
                    fontSize: 10,
                },
            });

            doc.save('grades.pdf');
        }
    </script>

</body>

</html>