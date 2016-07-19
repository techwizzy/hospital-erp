 

  <script type="text/javascript">

      $(function () {
       
        $('#UsrTable').DataTable({  
        });
      });
    </script>
</script>     



 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
       <div class="row">
            <div class="col-xs-12">
                    <?php if($message) { ?>
                           <div class="alert alert-success">
                                        <button data-dismiss="alert" class="close" type="button">×</button>
                                        <ul class="list-group"><?=  $message; ?></ul>
                                    </div>
                         <?php } ?>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  
               
                  List of Staff members
               
                </div><!-- /.box-header -->
                <div class="panel-body">
    
       
          <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th ><?php echo lang('first_name'); ?></th>
                           
                            <th ><?php echo lang('username'); ?></th>
                            <th >Group</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>Login status</th>
                            
                            <th>Work Status</th>
                            <th><?php echo lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user):?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($user->Firstname,ENT_QUOTES,'UTF-8');?> <?php echo htmlspecialchars($user->Lastname,ENT_QUOTES,'UTF-8');?></td>
                               
                                <td><?php echo htmlspecialchars($user->Username,ENT_QUOTES,'UTF-8');?></td>
                                <td>
                                   <?php echo htmlspecialchars($user->Title,ENT_QUOTES,'UTF-8');?>
                                </td>
                                <td><?= $user->company; ?></td>
                               <td>
                                   <?php echo htmlspecialchars($user->Gender,ENT_QUOTES,'UTF-8');?>
                                </td>
                                <td>
                                  <?php if($user->active==1){ ?> <div class="badge-success">active</div> <?php }else{ ?><div class="badge-green">inactive</div> <?php } ?>
                                </td>
                             
                                <td>
                                   <?php echo htmlspecialchars($user->work,ENT_QUOTES,'UTF-8');?>
                                </td>
                                <td><div class="btn-group">
                                      <button type="button" class="btn btn-primary btn-xs btn-flat">Action</button>
                                      <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li> <?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, "<i class=\"fa fa-bell\"> ".'Deactivate'." </i>") : anchor("auth/activate/". $user->id, 'Activate');?></li>
                                        <li> <?php echo anchor("auth/edit_user/".$user->id, "<i class=\"fa fa-edit\"> Edit </i>") ;?></li>
                                        
                                      </ul>
                                    </div>
                                </td>                            
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            
                        </tr>
                        </tfoot>
                    </table>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


