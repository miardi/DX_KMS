<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="mb-3 h2">Packages List</h2>
            <!-- Button trigger modal -->
            <button type="button" id="addButton" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#packageModal">
                New Package
            </button>

            <!-- Table all packages -->
            <table class="table table-hover">
                <!-- <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">FY</th>
                    </tr>
                </thead> -->
                <tbody class="table-group-divider">
                    <?php $i=1; foreach($data as $package) { ?>
                    <tr data-bs-toggle="modal" data-bs-target="#packageModal" data-id="<?= $package['id'] ?>">
                        <th scope="row"><?= $i ?></th>
                        <td><?= $package['name'] ?></td>
                        <td><?= $package['fiscal_year'] ?></td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-primary coursesButton" data-bs-toggle="modal" data-bs-target="#coursesModal" data-id="<?= $package['id'] ?>">Courses</button>

                            <button type="button" class="btn btn-sm btn-primary assigmentButton" data-bs-toggle="modal" data-bs-target="#coursesModal" data-id="<?= $package['id'] ?>">Assigment</button>
                            
                            <button class="btn btn-sm btn-danger ms-5 deletePackageButton" data-bs-toggle="modal" data-bs-target="#packageModal" data-id="<?= $package['id'] ?>">Delete</button>
                        </td>
                    </tr>
                    <?php $i++;} ?>
                </tbody>
            </table>
            <!-- End of table packages -->
        </div>
    </div>
    
    <!-- Modal package -->
    <div class="modal fade" id="packageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="packageModalLabel">Add Package</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="packageForm" action="<?= BASE_URL ?>/package/addPackage" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="OFF" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fiscal_year" name="fiscal_year" placeholder="Fiscal Years (ex : FY23)" autocomplete="OFF" required>
                        <label for="fiscal_year">Fiscal Years</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="packageForm" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End of modal package -->

    <!-- Modal courses -->
    <div class="modal fade" id="coursesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="coursesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="coursesModalLabel">Package Courses</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gap-2">
                <table class="table">
                    <thead id="headContent">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Trainer</th>
                            <th scope="col">Duration</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="bodyContent">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="packageForm" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End of modal courses -->
</main>
<script src="<?= BASE_URL ?>/js/DX_KMS_PACKAGE.js"></script>