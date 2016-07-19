
<div id="content">

<div class="content-wrapper">  


<!-- Confirm Modal -->
    <div class="modal show" id="deactivate-modal" tabindex="-1" role="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open("auth/deactivate/".$user->id);?>
                    <div class="modal-header">
                        
                        <h4 class="modal-title" id="myModalLabel">
                            <?= sprintf(lang('deactivate_subheading'), $user->first_name.' '.$user->last_name);?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        Do you want to deactivate this account?
                        <?php echo form_hidden('confirm','yes'); ?>
                         <?php echo form_hidden($csrf); ?>
                         <?php echo form_hidden(array('id'=>$user->id)); ?>

                    </div>

                    <div class="modal-footer">
                        <a href="<?= site_url('auth') ?>" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-danger">Yes, deactivate it</button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

 </div>
</div>