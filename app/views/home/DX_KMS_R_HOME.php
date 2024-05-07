<main class="">
    <section class="row">
        <article class="col-5 border ms-3 me-3 mb-5">
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
                    <?php foreach($data['average'] as $index=>$student){?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $student['trainee_id'] ?></td>
                        <td><?= $student['nama'] ?></td>
                        <td><?= $student['class'] ?></td>
                        <td><?= number_format($student['PT'],2) ?></td>
                        <td><?= number_format($student['HT'],2) ?></td>
                    </tr>    
                    <?php } ?>
                </tbody>
            </table>
        </article>
        <article class="col-6 border me-3 ms-3 mb-5">
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
                    <?php foreach($data['remed'] as $index=>$student){?>
                    <tr>
                        <td><?= $index+1 ?></td>
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