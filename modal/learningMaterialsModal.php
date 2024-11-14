<!-- Modal -->
<?php
include '../connectDb.php';
?>


<link rel="stylesheet" href="../css/modal.css">
<script src="../js/getSectionMaterials.js"></script>
<script src="../js/filterSectionMaterials.js"></script>

<div class="modal fade modal-xl" id="teacherMaterialsModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">SCHOOL MATERIALS</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <ul class="nav nav-tabs mx-3" id="uploadTabs" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="post-tab" data-bs-toggle="tab" data-bs-target="#post" type="button" role="tab" aria-controls="post" aria-selected="true">Post</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="uploaded-tab" data-bs-toggle="tab" data-bs-target="#uploaded" type="button" role="tab" aria-controls="uploaded" aria-selected="false">Uploaded</button>
                    </li>

                </ul>


                <div class="tab-content" id="postTabContent">


                    <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab" style="height: 400px;">

                        <!-- Upload Section -->
                        <div class="card m-3">


                            <div class="card-body" style="height: 358px;">

                                <h5 class="card-title">Post</h5>

                                <form action="../function/uploadSchoolMaterial.php" id="uploadForm" method="POST" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label for="sectionMaterials" class="form-label">Section</label>
                                        <select id="sectionMaterials" class="form-select" name="section_name">
                                            <option selected disabled>Section</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fileInput" class="form-label">Upload File</label>
                                        <input type="file" class="form-control" id="fileInput" name="school_materials">

                                    </div>

                                    <button type="submit" class="btn btn-primary">Post</button>

                                </form>

                            </div>


                        </div>


                    </div>


                    <div class="tab-pane fade" id="uploaded" role="tabpanel" aria-labelledby="uploaded-tab" style="height: 400px;">
                        <!-- Uploaded Section -->
                        <div class="card m-3 overflow-y-auto" style="height: 360px;">

                            <div class="card-body">

                                <div class="row position-relative">
                                    <div class="col-md-8">
                                        <h5 class="card-title">Uploaded</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-absolute top-50 end-0 translate-middle-y pe-2">
                                            <select class="form-select" id="sectionFilter" name="section_filter">
                                                <option selected>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="overflow-y" id="uploadedFiles" style="max-height: 295px;">

                                    <!-- List of Uploaded Materials by Section -->
                                    <p class="text-center pt-5" style="color: gray;">Select a section.</p>;
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>