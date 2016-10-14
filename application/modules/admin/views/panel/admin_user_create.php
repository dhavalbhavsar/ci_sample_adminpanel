<script type="text/javascript">
    // When the browser is ready...
    $(function () {
        // Setup form validation on the #register-form element
        $("#frmVal").validate({
            // Specify the validation rules
            rules: {
                first_name: "required",
                last_name: "required",
                username: "required",
                password: "required",
                retype_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            // Specify the validation error messages
            messages: {
                first_name: "Please enter your first name",
                last_name: "Please enter your last name",
                username: "Please enter your username",
                password: "Please enter your password",
                retype_password: {
                    required: "Please enter your retype password",
                    equalTo: "Password does not match."
                },
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
                <h3 class="box-title">Add Admin</h3>
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>

                <?php echo $form->bs3_text('Username', 'username', !empty($form_data->username) ? $form_data->username : ''); ?>
                <?php echo $form->bs3_text('First Name', 'first_name', !empty($form_data->first_name) ? $form_data->first_name : ''); ?>
                <?php echo $form->bs3_text('Last Name', 'last_name', !empty($form_data->last_name) ? $form_data->last_name : ''); ?>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option <?php echo isset($form_data->status)?(($form_data->status == 1) ? "selected='selected'" : ""):""; ?> value="1">Active</option>
                        <option <?php echo isset($form_data->status)?(($form_data->status == 0) ? "selected='selected'" : ""):""; ?> value="0">Inactive</option>
                    </select>
                </div>
                <?php echo $form->bs3_password('Password', 'password'); ?>
                <?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>

                <?php if (!empty($groups)): ?>
                    <div class="form-group">
                        <label for="groups">Groups</label>
                        
                            <?php foreach ($groups as $key => $group): ?>
                        <div>
                                <label class="checkbox-inline">
                                    <input type="radio" name="groups" value="<?php echo $group->id; ?>" <?php echo !empty($form_data->groups)?(($form_data->groups == $group->id)?'checked="checked"':(($key == 1) ? 'checked="checked"' : "")):(($key == 1) ? 'checked="checked"' : "") ?> > <?php echo $group->name; ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        
                    </div>
                <?php endif; ?>

                <?php echo $form->bs3_submit(); ?>

                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

</div>