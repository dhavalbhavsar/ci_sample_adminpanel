<script language="JavaScript" type="text/javascript">
    function checkDelete(id, name) {
        var name = name.trim();
        if (confirm('Are you sure You want to delete ' + name + ' ?')) {
            window.location.href = 'panel/admin_user_group_delete/' + id;
        }
    }
</script>
<?php echo $form->messages(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Admin Users Groups</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groups as $key => $value) {
                                $group_id = $value->id;
                                if($group_id != 1){
                            ?>
                            <tr>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->description; ?></td>
                                <td><div class="tools">       
                                        <a href="javascript:void(0);" onclick="return checkDelete(<?php echo $value->id ?>, '<?php echo trim($value->name) ?>')" title="Delete Admin User Group" class="fa fa-trash-o">
                                            <span class="delete-icon"></span>
                                        </a>
                                        <a href="panel/admin_user_edit_group/<?php echo $value->id; ?>" title="Edit Group" class="fa fa-edit edit_button">
                                            <span class="edit-icon"></span>
                                        </a>
                                        <a href="panel/admin_group_action/<?php echo $value->id; ?>" title="Add Group Permission" class="glyphicon glyphicon-plus edit_button">
                                            <span class="edit-icon"></span>
                                        </a>
                                        <div class="clear"></div>
                                    </div></td></tr>
                        <?php 
                                }
                            } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <script>
            $(function () {
                $("#example2").DataTable({
                    "autoWidth": true,
                    "order": [[0, "asc"]],
                    "aoColumnDefs": [
                        {'bSortable': false, 'bSearchable': false, 'aTargets': [2]}
                    ]
                });

            });
        </script>
