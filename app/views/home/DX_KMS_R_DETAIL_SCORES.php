<?php
$scores = $data['scores'];
?>

<main class="container">
<section class="row">
    <h2 class="text-center">Summary Score</h2>
    <table id="summaryTable" class="table table-hover table-striped display">
        <thead>
            <tr>
                <th>No</th>
                <th>COURSE</th>
                <th>NPK</th>
                <th>NAME</th>
                <th>CLASS</th>
                <th>PT</th>
                <th>HT</th>
                <th>TRAINER</th>
                <th>NOTE</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($scores as $index => $score) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $score['COURSE'] ?></td>
                    <td><?= $score['NPK'] ?></td>
                    <td><?= $score['NAME'] ?></td>
                    <td><?= $score['CLASS'] ?></td>
                    <td><?= ($score['PT'] == NULL)?'-':number_format($score['PT'], 2) ?></td>
                    <td><?= ($score['HT'] == NULL)?'-':number_format($score['HT'], 2) ?></td>
                    <td><?= $score['TRAINER'] ?></td>
                    <td><?= $score['NOTE'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
</main>

<script>
    new DataTable("#summaryTable",{
        paging: false,
        scrollCollapse: true,
        scrollY: '70vh',
        layout: {
            topStart: {
                buttons: [{
                    extend: 'excel',
                    text: 'Download Score',
                    title : 'Summary Score Kosen 17'
                }]
            }
        }
    });
</script>