<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="mb-3 h2">Courses List</h2>
            <!-- Button trigger modal -->
            <button type="button" id="addButton" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#courseModal">
                New Course
            </button>
            <div style="height: 600px; overflow-y:scroll;">
                <!-- Table all courses -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Sub Type</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach($data as $index => $course) { ?>
                        <tr data-bs-toggle="modal" data-bs-target="#courseModal" data-id="<?= $course['id'] ?>">
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $course['name'] ?></td>
                            <td><?= $course['type'] ?></td>
                            <td><?= $course['sub_type'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- End of table courses -->
            </div>

        </div>
    </div>

    <!-- Modal courses -->
    <div class="modal fade" id="courseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="courseModalLabel">Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gap-2">
                <form id="courseForm" action="#" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Course Name" autocomplete="OFF" required>
                        <label for="name">Course Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="type" id="type" class="form-control" placeholder="Type" autocomplete="OFF">
                        <label for="type">Type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="sub_type" id="sub_type" class="form-control" placeholder="Sub Type" autocomplete="OFF">
                        <label for="sub_type">Sub Type</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <div class="col">
                        <button type="button" id="deleteBtn" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="courseForm" class="btn btn-primary">Save</button>
                    </div>
            </div>
            </div>
        </div>
    </div>
    <!-- End of modal courses -->

    <!-- delete -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gap-2">
                <form id="deleteForm" action="#" method="post">
                    <input type="hidden" name="id" id="id">
                    <h3>Are you sure to delete <span id="courseNameDelete">...</span></h3>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="deleteForm" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End of delete -->
</main>
<script src="<?= BASE_URL ?>/js/DX_KMS_COURSE.js"></script>