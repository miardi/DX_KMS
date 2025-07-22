<?php
$schedule = $data['schedule'];
$listOfDate = $data['listOfDate'];
?>

<main class="container">
    <div class="row">
        <div class=" col-lg-12">
            <h2 class="mb-0 h2">Schedule</h2>
            <div class="dropdown mb-3">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Month : <?= date('F', mktime(0, 0, 0, $data['month'])) ?>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/7">July</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/8">August</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/9">September</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/10">October</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/11">November</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/12">December</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/1">January</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/2">February</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/3">March</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/4">April</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/5">May</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/schedule/6">June</a></li>
                </ul>
            </div>
            <div class="table-responsive-xxl">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <td>NO</td>
                            <td>COURSE</td>
                            <td>CLASS</td>
                            <td>TRAINER</td>
                            <td>ROOM</td>
                            <?php foreach ($listOfDate as $date) : ?>
                                <th><?= date_format($date, "d") ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($schedule as $index => $row) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['class'] ?></td>
                                <td><?= $row['trainer'] ?></td>
                                <td><?= $row['room'] ?></td>
                                <?php foreach ($listOfDate as $date) :
                                    $day = date_format($date, 'N');
                                    $difDay = date_diff($date, date_create('now'))->format('%r%a');
                                    $status = $row[date_format($date, 'Y-m-d')];
                                ?>
                                    <td class="<?= ($difDay === '0')? "table-danger " : ""; ?><?= ($day > 5) ? "table-secondary " : ""; ?>" style="<?= ($status == 0) ? "" : "background-color:green;" ?>">

                                    </td>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>