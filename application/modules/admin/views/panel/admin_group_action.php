<?php echo $form->messages(); ?>

<div class="row">

	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Group Permision: </h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>
					<table class="table table-bordered">
						<tr>
							<th style="width:120px">Group Name: </th>
							<td><?php echo $group_data->name; ?></td>
						</tr>
						<tr>
							<th>Description: </th>
							<td><?php echo $group_data->description; ?></td>
						</tr>
					</table>
                                        <div class="form-group">
                                            <label for="groups">Permision</label>
                                            
                                                <?php foreach($group_action as $key => $value) { ?>
                                                <div>
                                                <label class="checkbox-inline">
                                                        <input type="checkbox" name="group_action[]" value="<?php echo $value->id ?>" <?php echo ($value->selected == 'true')?'checked="checked"':'' ?>> <?php echo $value->action; ?>
                                                                                </label>
                                                </div>
                                                                                    <?php } ?>
                                                                                
                                            
                                        </div>
					<?php echo $form->bs3_submit(); ?>
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>