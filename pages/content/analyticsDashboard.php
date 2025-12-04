<script src="../js/graphAnalytics.js"></script>
<script src="../js/analyticsFilter.js"></script>
<script src="../js/updateChart.js"></script>
<script src="../js/recommendation.js"></script>
<script src="../js/fetchSubjectAnalytics.js"></script>
<script src="../js/fetchTopStudent.js"></script>

<div class="analytic-container row">
    <div class="analytic-dashboard p-2">
        <h2 class="text-white d-flex align-items-center justify-content-center my-2">ACADEMIC PERFORMANCE OVERVIEW</h2>
        <div class="analytic-scroll overflow-y-auto m-3" style="max-height: 425px; overflow-x: hidden;">
            <div id="filterSection" class="d-flex flex-row m-3 gap-2">

                <!-- Grade Level Dropdown -->
                <div>
                    <label for="gradeLevelAnalytics" class="form-label" style="color: var(--white);">Grade Level</label>
                    <select class="form-select" id="gradeLevelAnalytics" name="grade_level_analytics" style="height: 35px; width: 150px;">
                        <option selected value="">Select</option>
                    </select>
                </div>

                <!-- Section Dropdown -->
                <div>
                    <label for="sectionAnalytics" class="form-label" style="color: var(--white);">Section</label>
                    <select class="form-select" id="sectionAnalytics" name="section_analytics" style="height: 35px; width: 150px;">
                        <option selected value="">Select</option>
                    </select>
                </div>

                <!-- Academic Year Dropdown -->
                <div>
                    <label for="academicYearAnalytics" class="form-label" style="color: var(--white);">Academic Year</label>
                    <select class="form-select" id="academicYearAnalytics" name="academic_year_analytics" style="height: 35px; width: 150px;">
                        <option selected>Select</option>
                    </select>
                </div>

            </div>

            <div class="bar-chart">
                <canvas id="averageSubjectBarChart" width="280" height="150"></canvas>
            </div>

            <div class="recommendation-container d-flex flex-column rounded-3 mt-2 pe-3" style="width: 900px; min-height: 40px; background-color: var(--white);">
                <div class="d-flex flex-row mt-1 ms-2">
                    <iconify-icon icon="mage:light-bulb" width="30" height="30" style="color: black; margin-top: 3px;"></iconify-icon>
                    <p class="pt-3 ps-1 fw-bold" style="color: black; font-size: 20px;">Recommendation</p>
                </div>
                <p id="recommendationMessage" class="ps-3 lh-base" style="color: black; font-size: 13px;">Please select a section to see recommendations.</p>
            </div>

            <div class="mt-2 pb-3">
                <label for="subjectAnalytics" class="form-label" style="color: var(--white);">Subjects</label>
                <select class="form-select" id="subjectAnalytics" name="subject_analytics" style="height: 35px; width: 150px;">
                    <option selected>Select</option>
                </select>
            </div>

            <!-- Student Data Table -->
            <div class="wrapper p-2 border">
                <table class="table table-striped" style="background-color: var(--white); margin-bottom: 30px !important;">
                    <thead>
                        <tr style="background-color: var(--gold);">
                            <th class="fw-bold text-center" colspan="2" style="font-size: 24px;">TOP LIST</th>
                        </tr>
                        <tr>
                            <th class="ps-4">Student Name</th>
                            <th class="ps-4">Average Grade</th>
                        </tr>
                    </thead>
                    <tbody id="studentResults">
                        <tr>
                            <td colspan="2" class="text-center" style="color: gray;">No data available</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-striped" style="background-color: var(--white); margin-bottom: 0 !important;">
                    <thead>
                        <tr style="background-color: var(--gold);">
                            <th class="fw-bold text-center" colspan="2" style="font-size: 24px;">BOTTOM LIST</th>
                        </tr>
                        <tr>
                            <th class="ps-4">Student Name</th>
                            <th class="ps-4">Average Grade</th>
                        </tr>
                    </thead>
                    <tbody id="studentResults2">
                        <tr>
                            <td colspan="2" class="text-center" style="color: gray;">No data available</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>