$(function(){
    //Add Package
    $('#addButton').on('click',function(){
        const html =`<input type="hidden" name="id" id="id">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="OFF" required>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="fiscal_year" name="fiscal_year" placeholder="Fiscal Years (ex : FY23)" autocomplete="OFF" required>
            <label for="fiscal_year">Fiscal Years</label>
        </div>`;
        $('#packageForm').html(html);
        $('#packageForm').attr('action',document.location.origin+'/DX_KMS/public/package/addPackage');

        $('#packageModalLabel').html('Add Package');

        $('.modal-footer button[type=submit]').html('Save');
        $('.modal-footer button[type=submit]').removeClass('btn-danger');
        $('.modal-footer button[type=submit]').addClass('btn-primary');

        $('.modal-footer button[type=button]').html('Close');
        $('.modal-footer button[type=button]').removeClass('btn-primary');
        $('.modal-footer button[type=button]').addClass('btn-secondary');
        

        $('#id').val('');
        $('#name').val('');
        $('#fiscal_year').val('');
    });
    
    //Update Package
    $('tr').on('click', function(event){
        event.stopPropagation();

        const html =`<input type="hidden" name="id" id="id">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="OFF" required>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="fiscal_year" name="fiscal_year" placeholder="Fiscal Years (ex : FY23)" autocomplete="OFF" required>
            <label for="fiscal_year">Fiscal Years</label>
        </div>`;
        $('#packageForm').html(html);
        $('#packageForm').attr('action',document.location.origin+'/DX_KMS/public/package/updatePackage');

        $('#packageModalLabel').html('Edit Package');

        $('.modal-footer button[type=submit]').html('Update');
        $('.modal-footer button[type=submit]').removeClass('btn-danger');
        $('.modal-footer button[type=submit]').addClass('btn-primary');

        $('.modal-footer button[type=button]').html('Close');
        $('.modal-footer button[type=button]').removeClass('btn-primary');
        $('.modal-footer button[type=button]').addClass('btn-secondary');

        const id = $(this).data('id');
        $.ajax({
            url: document.location.origin+"/DX_KMS/public/package/getPackageById",
            data : {id : id},
            method : 'POST',
            success : function(data){
                data = JSON.parse(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#fiscal_year').val(data.fiscal_year);
            }
        });
    });
    
    //Delete Package
    $('.deletePackageButton').on('click', function(event){
        event.stopPropagation();

        const html =`<input type="hidden" name="id" id="id">
        <p id="pConfirm"></p>`;
        $('#packageForm').html(html);
        $('#packageForm').attr('action',document.location.origin+'/DX_KMS/public/package/deletePackage');

        $('#packageModalLabel').html('Delete Package');

        $('.modal-footer button[type=submit]').html('Delete');
        $('.modal-footer button[type=submit]').removeClass('btn-primary');
        $('.modal-footer button[type=submit]').addClass('btn-danger');

        $('.modal-footer button[type=button]').html('Cancel');
        $('.modal-footer button[type=button]').removeClass('btn-secondary');
        $('.modal-footer button[type=button]').addClass('btn-primary');

        const id = $(this).data('id');
        $.ajax({
            url: document.location.origin+"/DX_KMS/public/package/getPackageById",
            data : {id : id},
            method : 'POST',
            success : function(data){
                data = JSON.parse(data);
                $('#pConfirm').html("Are you sure to delete package " + data.name + "?")
                $('#id').val(data.id);
            }
        });
    });
    
    //Courses Modal
    $('.coursesButton').on('click', function(event){
        event.stopPropagation();
        
        const packageId = $(this).data('id');
        $.ajax({
            url: document.location.origin+"/DX_KMS/public/package_course/getPackageCourse",
            data : {id : packageId},
            method : 'POST',
            success : function(res){
                const data = JSON.parse(res);
                let html = "";
                data.forEach((package,index) => {
                    html += `
                    <tr>
                            <td>${index+1}</td>
                            <td>${package.course_name}</td>
                            <td>${package.trainer_name}</td>
                            <td>${package.durasi}</td>
                    </tr>
                    `;
                });
                $('#headContent').html(`
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Trainer</th>
                    <th scope="col">Duration</th>
                </tr>`);
                $('#bodyContent').html(html);
            }
        });
        
    });

    // Assigmnet Modal
    $('.assigmentButton').on('click', function(event){
        event.stopPropagation();
        
        const packageId = $(this).data('id');
        $.ajax({
            url: document.location.origin+"/DX_KMS/public/package_assigment/getPackageAssigment",
            data : {id : packageId},
            method : 'POST',
            success : function(res){
                const data = JSON.parse(res);
                let html = "";
                data.forEach((assigment,index) => {
                    html += `
                    <tr>
                            <td>${index+1}</td>
                            <td>${assigment.trainee_npk}</td>
                            <td>${assigment.nama}</td>
                            <td>${assigment.class}</td>
                    </tr>
                    `;
                });
                $('#headContent').html(`
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NPK</th>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                </tr>`);
                $('#bodyContent').html(html);
            }
        });
        
    });
})
