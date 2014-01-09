<?php $this -> load -> view('header') ?>

<div class="content-login">

<div class="log-item">
<div class="login_user" style="padding: 10px">
    <fieldset>
        <legend><h2><?=$title?></h2></legend>
    
    <?php if(validation_errors()){?>
        <div class="error">
            <?=validation_errors('')?>
        </div>    
    <?php }?>
    
    <?=form_open(current_url(),array('id'=>'validate'))?>
    
    <input type="text" name="UserName" id="UserName" placeholder="Username" value="<?=set_value('UserName')?>" /><br />
    
    <input type="password" name="Password" id="Password" placeholder="Password" value="<?=set_value('Password')?>" /><br />
    
    <button type="submit" class="ui">Login</button>
    
    <?=form_close()?>
    </fieldset>
</div>

</div>

<div class="log-item">
    <div style="padding: 10px">
    <fieldset>
        <legend><h2>Register</h2></legend>
        <center>
            <p>Jika anda tidak mempunyai akun, silahkan registrasi disini:</p><br />
            <?=anchor('user/register','Register',array('class' => 'ui'))?>
        </center>
    </fieldset>
    </div>
</div>

</div>
<div class="clear"></div><br />

<?php $this -> load -> view('footer') ?>
