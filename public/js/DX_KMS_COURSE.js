$(function(){
    //Add Course
    $('#addButton').on('click',function(){
        $('#courseForm').attr('action',document.location.origin+'/DX_KMS/public/course/addcourse');
        $('#courseForm input').val('')

        $('#courseModalLabel').html('Add Course');

        $('.modal-footer button[form="courseForm"]').html('Save');
        $('.modal-footer button[form="courseForm"]').removeClass('btn-warning');
        $('.modal-footer button[form="courseForm"]').addClass('btn-primary'); 
        
        $('#deleteBtn').attr('hidden','true');

    });
    
    //Update Course
    $('tr').on('click', function(event){
        $('#courseForm').attr('action',document.location.origin+'/DX_KMS/public/course/updatecourse');

        $('#courseModalLabel').html('Edit Course');

        $('.modal-footer button[form="courseForm"]').html('Update');
        $('.modal-footer button[form="courseForm"]').removeClass('btn-primary');
        $('.modal-footer button[form="courseForm"]').addClass('btn-warning');

        
        $('#deleteBtn').removeAttr('hidden');

        const id = $(this).data('id');
        $.ajax({
            url: document.location.origin+"/DX_KMS/public/course/getCourseById",
            data : {id : id},
            method : 'POST',
            success : function(data){
                data = JSON.parse(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#type').val(data.type);
                $('#sub_type').val(data.sub_type);
            }
        });
    });
    
    //Delete Package
    $('.deleteButton').on('click', function(event){
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
})
