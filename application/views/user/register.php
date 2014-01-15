<?php $this -> load -> view('header')?>

<style>
    .navv{
        padding-left: 3px
    }
    
    .navv li{
        float: left;
        list-style: none;
        margin-right: 5px
    }
    .navv li a{
        text-decoration: none;
        font-size: 14px
    }        
    
</style>
    
<ul class="navv">
    <li><?=anchor(base_url(),'Home')?> >> </li>
    <li><a href="#"><?=$title?></a></li>
</ul>

<div class="clear" style="height: 1px"></div>

<div class="reg-item">
<center>  

<fieldset>
    <legend><h2><?=$title?></h2></legend>
    <?php if($this -> input -> get('success')){ ?>
        <div class="success">
            Register Berhasil, Silahkan Login.
        </div>
    <?php }?>
<?=form_open(current_url(),array('id'=>'validate'))?>
    <table>
        <tr>
            <th>Username</th>
            <td><input type="text" class="required" name="UserName" value="<?=set_value('UserName')?>" /></td>
        </tr>
        <tr>
            <th>Password</th>
            <td><input type="password" class="required" maxlength="5" name="Password" value="<?=set_value('Password')?>" /></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" class="required" name="Name" value="<?=set_value('Name')?>" /></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="text" class="required email" name="Email" value="<?=set_value('Email')?>" /></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td><button type="submit" class="ui">Register</button></td>
        </tr>
    </table>
<?=form_close()?>

</fieldset>
   
</center> 
</div>
<div class="clear"></div>

<script type="text/javascript">
    $(document).ready(function(){
       $('.error').append('<br/>'); 
    });
    
    
</script>
<?php $this -> load -> view('footer')?>
