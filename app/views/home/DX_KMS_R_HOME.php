<?php
$unscored = $data['unscored'];
?>

<main class="container">
    <section class="row">
        <div class="card mb-5">
            <h5 class="card-header">Uninput Score</h5>
            <div class="card-body overflow-y-auto" style="height: 310px;">
                <?php foreach ($unscored as $val) : ?>
                    <div class="alert alert-warning" role="alert">
                        <?= 'Score for ' . $val['course_name'] . ' is not inputed by Trainer ' . $val['trainer_name'] ?>
                        <br>
                        <a href="<?= BASE_URL ?>/score/input/<?= $val['course_id'] ?>/<?= $val['class'] ?>/<?= $val['package_id'] ?>">Click to input the score...</a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <article onclick="location.href = '<?= BASE_URL ?>/home/summary_scores'" class="col-xl-5 border mb-5">
            <h2 class="text-center">Rank Average</h2>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPK</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>PT</th>
                        <th>HT</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($data['average'] as $index => $student) { ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $student['trainee_id'] ?></td>
                            <td><?= $student['nama'] ?></td>
                            <td><?= $student['class'] ?></td>
                            <td><?= number_format($student['PT'], 2) ?></td>
                            <td><?= number_format($student['HT'], 2) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </article>
        <div class="col-1"></div>
        <article onclick="location.href = '<?= BASE_URL ?>/score/remidial'" class="col-xl-6 border mb-5">
            <h2 class="text-center">Rank Remed</h2>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPK</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>PT</th>
                        <th>HT</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($data['remed'] as $index => $student) { ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $student['trainee_id'] ?></td>
                            <td><?= $student['nama'] ?></td>
                            <td><?= $student['class'] ?></td>
                            <td><?= $student['PT'] ?></td>
                            <td><?= $student['HT'] ?></td>
                            <td><?= $student['total'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </article>
    </section>
</main>