<script type="text/javascript">
    // When the browser is ready...
    $(function () {
        // Setup form validation on the #register-form element
        $("#frmVal").validate({
            // Specify the validation rules
            rules: {
                name: "required",
                description: "required",
            },
            // Specify the validation error messages
            messages: {
                name: "Please enter group name",
                description: "Please enter description",
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

    });
</script>

<?php echo $form->messages(); ?>

<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Groups</h3>
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>
                <?php echo $form->bs3_text('Group Name', 'name', !empty($form_data->name) ? $form_data->name : ''); ?>
                <?php echo $form->bs3_textarea('Description', 'description', !empty($form_data->description) ? $form_data->description : ''); ?>
                <?php echo $form->bs3_submit(); ?>
                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

</div>