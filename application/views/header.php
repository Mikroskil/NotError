<!DOCTYPE  html>
<html>
    
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <link href="<?=getMediaPath(getSetting('Favicon'))?>" rel='shortcut icon' type='image/x-icon'/>
    
    <title>NotError</title>
    
    <script type="text/javascript" src="<?=base_url()?>assets/ui/js/jquery-1.9.1.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.8.3.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/ui/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/superfish/js/hoverIntent.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/superfish/js/superfish.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/ckeditor/adapters/jquery.js"></script>
    
    
    
    
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/datatable/media/css/demo_table_jui.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/datatable/media/css/demo_page.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/ckeditor/contents.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/ui/css/jquery-ui-1.10.3.custom.min.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/screen.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
    <link rel="stylesheet" media="screen" href="<?=base_url()?>assets/superfish/css/superfish.css">
    <link rel="stylesheet" media="screen" href="<?=base_url()?>assets/superfish/css/superfish-vertical.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/template/style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
    
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.sf-menu').superfish({
                //useClick: true
            });
                      
        });
        $(document).ready(function() {
	        oTable = $('.datatable').dataTable({
	            "bJQueryUI": true,
	            
	            "sPaginationType": "full_numbers"
	        });
	        $('.datatable').addClass('clear','both')
	    } );
    </script>
    
    
</head>
<body>
    <div class="container">
    
    <header class="header">
        <div class="logo">
            <a href="<?=base_url()?>"><img height="80" src="<?=getMediaPath(getSetting('Logo'))?>" /></a>
        </div>
        <!-- <h2 style="color: #FFF;margin-left: 6px;">Logo</h2> -->
        
        <div style="position: absolute; top: 10px; right: 10px; color: #CCC">
            <?php if($this->session->userdata(USERLOGIN)){
               echo 'Hai,<strong>'.getUserLogin('UserName').'</strong> '. anchor('user/dashboard','Dasboard',array('class'=>'ui')) .' | '. anchor('user/logout','Logout',array('class'=>'ui')); 
            }else{
               echo anchor('user/login','Login',array('class'=>'ui'))?> | <?=anchor('user/register','Register',array('class'=>'ui')); 
            }?>
        </div>
        
    </header>
    
    <div class="nav">
            <ul class="sf-menu">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li><a>Category</a>
                    <ul>
                        <li><a>Category 1</a></li>
                        <li><a>Category 2</a>
                            <ul>
                                <li><a>Category 1</a></li>
                                <li><a>Category 2</a></li>
                                <li><a>Category 4</a></li>
                            </ul>
                        </li>
                        <li><a>Category 3</a></li>
                        <li><a>Category 4</a></li>
                    </ul>
                </li>
                <li><a>Product</a></li>
                <li><a>Slider</a></li>
                <li><a>Blog</a></li>
                <li><a>About</a></li>
                <li><a>Other</a></li>
            </ul>
            
            <div class="searching">
                <?=form_open('post/seraching')?>
                <input type="text" name="s" class="s" placeholder="Searcing..." />
                <input type="button" class="ui" value="Search" />
                <?=form_close()?>
            </div>
        </div>
        <div class="clear"></div>
    
    <section class="contents">
        
    