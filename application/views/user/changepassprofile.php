<?php $this -> load -> view('header')?>

<div>
    <?php $this -> load -> view('user/nav')?>
    
    <div class="dash_user">
        <fieldset>
            <legend><h2><?=$title?></h2></legend>
        
        
                
<?php if(validation_errors()){?>
    <div class="error">
        <?=validation_errors('')?>
    </div>    
<?php }?>

<?php if($this->input->get('oldpassword')=='false'){ ?>
    <div class="error">
        Old password is not right
    </div>
<?php } ?>

<?php if($this->input->get('newpassword')=='false'){ ?>
    <div class="error">
        The new password is not the same
    </div>
<?php } ?>

<?php if($this->input->get('success')){ ?>
    <div class="success">
        Your data has been saved
        <script type="text/javascript">
            alert('Password berhasil diganti, silahkan login kembali.');
            location.href = '<?=site_url('user/logout')?>';
        </script>
    </div>
<?php } ?>        
        
<?=form_open(current_url(),array('id'=>'validate', 'class'=>'ajaxvalidate Confirm','confirm'=>'Apa anda yakin?'))?>

<table border="0">
    <tr>
        <td><label for="OldPassword">Old Password</label></td>
        <td>:</td>
        <td>
        <input id="OldPassword" type="password" size="30" class="required text" name="OldPassword" value="<?php set_value('Password'); ?>"  />
        </td>
    </tr>
    
    <tr>
        <td><label for="Password">New Password</label></td>
        <td>:</td>
        <td>
        <input id="Password" type="password" size="30" class="required text" name="Password" value="<?php set_value('Password'); ?>"  />
        </td>
    </tr>
    
    <tr>
        <td><label for="RPassword">Confirm New Password</label></td>
        <td>:</td>
        <td>
        <input id="RPassword" type="password" size="30" class="required text" name="RPassword" value="<?php set_value('Password'); ?>"  />
        </td>
    </tr>
    
</table>


<div class="clear"></div>
<br />
<input type="submit" class="ui" value="Simpan" />

<?=form_close()?>
</fieldset>
    </div>
    <div class="clear"></div>
</div>





<?php $this -> load -> view('footer')?>
