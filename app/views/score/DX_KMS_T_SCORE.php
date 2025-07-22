<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2>Score List</h2>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#addScoreModal">
                Add Score
            </button>
            <a href="<?= BASE_URL ?>/score/remidial" class="btn btn-warning ms-3">Remidial</a>

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
                        <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($data as $index => $score) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $score['trainee_id'] ?></td>
                            <td><?= $score['nama'] ?></td>
                            <td><?= $score['course_name'] ?></td>
                            <td><?= $score['package_name'] ?></td>
                            <td><?= $score['class'] ?></td>
                            <td><?= $score['score_pt'] ?? "-" ?></td>
                            <td><?= $score['score_ht'] ?? "-" ?></td>
                            <!-- <td>edit|delete</td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- End of table score -->
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addScoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addScoreModalLabel">Add Score</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-1 mb-3">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" id="package" aria-label="Package">
                                <option selected disabled value="">Select...</option>
                                <option value="1">KOSEN 17</option>
                            </select>
                            <label for="package">Package</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <select class="form-select" id="class" aria-label="Class">
                                <option selected value="" disabled>Select...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="ALL">ALL</option>
                            </select>
                            <label for="class">Class</label>
                        </div>
                    </div>
                    <div class="col-md-7">
                    <div class="form-floating">
                            <select class="form-select" id="course" aria-label="Course">
                                <option selected value="" disabled>Select...</option>
                            </select>
                            <label for="course">Course</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    const courseListPrint = function(package, kelas){
        const courseSelect = document.getElementById('course');
        fetch("<?= BASE_URL ?>" + "/schedule/getCourse/" + package + "/" + kelas)
        .then(res => res.json())
        .then(res => {
            console.log(res);
            courseSelect.innerHTML = '<option selected value="" disabled>Select...</option>';
            res.forEach(function(val){
                const el = document.createElement("option");
                el.innerHTML = val.name;
                el.setAttribute("value", val.course_id);
                courseSelect.appendChild(el);
            });          
        })
    }
    
    document.getElementById('package').addEventListener('change',function(ev){
        const package = this.value;
        const clas = document.getElementById('class').value;
        if( clas != ''){
            courseListPrint(package, clas);
        }
    });

    document.getElementById('class').addEventListener('change',function(ev){
        const clas = this.value;
        const package = document.getElementById('package').value;
        if( package != ''){
            courseListPrint(package, clas);
        }
    });
    
    document.getElementById('submitBtn').addEventListener('click', function(ev){
        const clas = document.getElementById('class').value;
        const package = document.getElementById('package').value;
        const course = document.getElementById('course').value;
        if(course != ''){
            location.href = location.origin + '/DX_KMS/public/score/input/' + course + '/' + clas + '/' + package;
        }
    })

    
</script>