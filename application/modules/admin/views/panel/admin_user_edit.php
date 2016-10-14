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
            },
            // Specify the validation error messages
            messages: {
                first_name: "Please enter your first name",
                last_name: "Please enter your last name",
                username: "Please enter your username",
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
                <h3 class="box-title">User Info</h3>
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>


                <?php echo $form->bs3_text('Username', 'username', $user_data[0]->username); ?>
                <?php echo $form->bs3_text('First Name', 'first_name', $user_data[0]->first_name); ?>
                <?php echo $form->bs3_text('Last Name', 'last_name', $user_data[0]->last_name); ?>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option <?php echo ($user_data[0]->active == 1) ? "selected='selected'" : ""; ?> value="1">Active</option>
                        <option <?php echo ($user_data[0]->active == 0) ? "selected='selected'" : ""; ?> value="0">Inactive</option>
                    </select>
                </div>
                <?php if (!empty($groups)): ?>
                    <div class="form-group">
                        <label for="groups">Groups</label>
                        
                            <?php foreach ($groups as $key => $group): ?>
                        <div>
                                <label class="checkbox-inline">
                                    <input type="radio" name="groups" value="<?php echo $group->id; ?>" <?php echo ($user_data[0]->group_id == $group->id) ? 'checked="checked"' : "" ?> > <?php echo $group->name; ?>
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