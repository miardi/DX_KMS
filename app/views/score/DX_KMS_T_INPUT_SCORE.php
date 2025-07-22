<?php
$dataInput = $data['dataInput'];
$trainer = $data['trainer'];
?>

<main class="container">
    <div class="row">
        <section class="col-xl-12">
            <h2 class="h2 mb-5">Input Score</h2>
            <form action="<?= BASE_URL . '/score/submitScore' ?>" method="POST">
                <!-- information course row -->
                <div class="row g-1 mb-3">
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="pacakgeName" id="package" placeholder="Package" value="<?= $dataInput[0]['package_name'] ?>" readonly>
                            <input type="hidden" name="packageID" value="<?= $dataInput[0]['package_id'] ?>">
                            <label for="package">Package</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="class" id="class" placeholder="Class" value="<?= $dataInput[0]['class'] ?>" readonly>
                            <label for="class">Class</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="courseName" id="course" placeholder="Course" value="<?= $dataInput[0]['course_name'] ?>" readonly>
                            <input type="hidden" name="courseID" value="<?= $dataInput[0]['course_id'] ?>">
                            <label for="course">Course</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="startDate" id="startDate" placeholder="Start Date" value="<?= $dataInput[0]['date_start'] ?>">
                            <label for="startDate">Start Date</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="endDate" id="endDate" placeholder="End Date" value="<?= $dataInput[0]['date_end'] ?>">
                            <label for="endDate">End Date</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="trainerNPK" id="trainer" aria-label="Trainer">
                                <?php foreach($trainer as $name) :?>
                                <option <?= ($name['npk']==$dataInput[0]['trainer_npk'])?"Selected":"" ?> value="<?= $name['npk'] ?>"><?= $name['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <label for="trainer">Trainer</label>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- end of information course row -->
                
                <!-- check for null pt or ht -->
                <div class="row">
                    <div class="col-6 text-end">
                        <div class="text-primary">Switch for enable or disable score >></div>
                    </div>
                    <div class="form-check form-switch col-1">
                        <input class="form-check-input m-auto" type="checkbox" role="switch" id="ptSwitch" checked>
                    </div>
                    <div class="form-check form-switch col-1">
                        <input class="form-check-input m-auto" type="checkbox" role="switch" id="htSwitch" checked>
                    </div>
                </div>
                <?php foreach ($dataInput as $index => $row) : ?>
                    <!-- row -->
                    <div class="row g-1 mb-3">
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="trainee[<?= $index ?>][npk]" id="npk" placeholder="NPK" value="<?= $row['trainee_npk'] ?>" readonly>
                                <label for="npk">NPK</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="trainee[<?= $index ?>][name]" id="name" placeholder="Name" value="<?= $row['trainee_name'] ?>" readonly>
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-floating">
                                <input type="text" class="form-control pt-score" name="trainee[<?= $index ?>][PT]" id="paperTest" placeholder="PT" required autocomplete="OFF">
                                <label for="paperTest">PT</label>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-floating">
                                <input type="text" class="form-control ht-score" name="trainee[<?= $index ?>][HT]" id="handOnTest" placeholder="HT" required autocomplete="OFF">
                                <label for="handOnTest">HT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Note" name="trainee[<?= $index ?>][note]" id="note" autocomplete="OFF"></textarea>
                                <label for="note">Note</label>
                            </div>
                        </div>
                    </div>
                    <!-- end of row -->
                <?php endforeach ?>
                <div class="row g-1">
                    <div class="col-md-11 text-end">
                        <input type="submit" value="Submit" name="inputScore" class="btn btn-primary btn-lg">
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>

<script src="<?= BASE_URL ?>/js/DX_KMS_INPUT_SCORE.js"></script>