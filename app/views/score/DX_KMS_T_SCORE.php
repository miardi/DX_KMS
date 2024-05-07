<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2>Score List</h2>

            <!-- Table all score -->
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NPK</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Package</th>
                        <th scope="col">Class</th>
                        <th scope="col">PT</th>
                        <th scope="col">HT</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($data as $index => $score) { ?>
                        <tr>
                            <th scope="row"><?= $index+1 ?></th>
                            <td><?= $score['trainee_id'] ?></td>
                            <td><?= $score['nama'] ?></td>
                            <td><?= $score['course_name'] ?></td>
                            <td><?= $score['package_name'] ?></td>
                            <td><?= $score['class'] ?></td>
                            <td><?= $score['score_pt']??"-" ?></td>
                            <td><?= $score['score_ht']??"-" ?></td>
                            <td>edit|delete</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- End of table score -->
        </div>
    </div>
</main>