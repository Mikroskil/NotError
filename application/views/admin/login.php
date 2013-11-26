<!DOCTYPE  html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="<?=base_url()?>assets/images/logo1.ico" rel='shortcut icon' type='image/x-icon'/>
    <title>Admin</title>
   
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.8.3.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/ui/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"></script>
    
    <link rel="stylesheet" href="<?=base_url()?>assets/css/screen.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/ui/css/jquery-ui-1.10.3.custom.min.css" type="text/css" media="screen" title="no title" charset="utf-8"/>

    <style type="text/css">
		body {	
			background: #FFFFEC;
		}
		p {
			margin: 0;
		}

		.adminlogin {
			background: #222222;
			width: 250px;
			margin: 0 auto;
			margin-top: 150px;
			padding: 20px;
			border-radius: 8px;
			border: 5px solid rgba(0,0,0,0.5);
		}
		.adminlogin input {
			width: 236px;
			padding: 7px 5px;
			margin-bottom: 15px;
			border-radius: 3px;
			box-shadow: 0px 1px 2px rgba(255,255,255,0.6);
		}
    </style>

</head>

<body>
    
<div class="adminlogin">
    <h3 style="margin-top: 0; color: #FFF">
        <center><img height="70" src="<?=base_url().'assets/images/logo.png'?>" /></center>
    </h3>
    
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
    <div class="clear"></div>
</div>

</body>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
       $('.ui').button(); 
    });
</script>

</html>

