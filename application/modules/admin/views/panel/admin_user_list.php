<script language="JavaScript" type="text/javascript">
    function checkDelete(id, username) {
        var name = username.trim();
        if (confirm('Are you sure You want to delete ' + name + ' ?')) {
            window.location.href = 'panel/admin_user_delete/' + id;
        }
    }
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Admin Users</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $value) {
                                $user_id = $value->id;
                                if($user_id != 1){
                            ?>
                            <tr>
                                <td><?php echo $value->first_name; ?></td>
                                <td><?php echo $value->last_name; ?></td>
                                <td><?php echo $value->username; ?></td>
                                <td><div class="tools">       
                                        <a href="javascript:void(0);" onclick="return checkDelete(<?php echo $value->id ?>, '<?php echo trim($value->username) ?>')" title="Delete Admin User" class="fa fa-trash-o">
                                            <span class="delete-icon"></span>
                                        </a>
                                        <a href="panel/admin_user_edit/<?php echo $value->id; ?>" title="Edit Admin User" class="fa fa-edit edit_button">
                                            <span class="edit-icon"></span>
                                        </a>
                                        <a href="panel/admin_user_reset_password/<?php echo $value->id; ?>" class="fa fa-repeat crud-action" title="Reset Password"></a>    

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
                        {'bSortable': false, 'bSearchable': false, 'aTargets': [3]}
                    ]
                });

            });
        </script>
