<?php

$remidial = $data['remidial'];

?>

<main class="container">
    <div class="row">
        <div class="col-lg">
            <h2>Remidial List</h2>

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
                        <th scope="col">Trainer</th>
                        <th scope="col">Remidial PT</th>
                        <th scope="col">Remidial HT</th>
                        <th scope="col">Note</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($remidial as $index => $score) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $score['trainee_id'] ?></td>
                            <td><?= $score['trainee_name'] ?></td>
                            <td><?= $score['course_name'] ?></td>
                            <td><?= $score['package_name'] ?></td>
                            <td><?= $score['class'] ?></td>
                            <td><?= $score['score_pt'] ?? "-" ?></td>
                            <td><?= $score['score_ht'] ?? "-" ?></td>
                            <td><?= $score['trainer_name'] ?></td>
                            <td><?= $score['remidial_pt'] ?? "-" ?></td>
                            <td><?= $score['remidial_ht'] ?? "-" ?></td>
                            <td><?= $score['note'] ?></td>
                            <?php
                                if($score['remidial_pt']==null && $score['remidial_ht']==null){
                                    echo "<td> <button class=\"btn btn-warning btn-sm\" data-id=\"$score[id]\">input</button></td>";
                                }
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- End of table score -->
        </div>
    </div>
</main>