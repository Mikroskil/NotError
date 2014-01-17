<!DOCTYPE  html>
<html>
    
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <link href="<?=getMediaPath(getSetting('Favicon'))?>" rel='shortcut icon' type='image/x-icon'/>
    
    <title><?=(empty($title)) ? WEBSITENAME : $title." | ".WEBSITENAME ?></title>
    <!-- <title>NotError</title> -->
    
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
    
    <link rel="stylesheet" href="<?=template_url()?>style.css" type="text/css"/>
    
    
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
        
        <div class="linker">
            <?php if($this->session->userdata(USERLOGIN)){
               echo 'Hai,<strong>'.getUserLogin('Name').'</strong> '. anchor('user/dashboard/'.getUserLogin('UserName'),'Dasboard',array('class'=>'ui')) .' | '. anchor('user/logout','Logout',array('class'=>'ui')); 
            }else{
               echo anchor('user/login','Login',array('class'=>'ui'))?> | <?=anchor('user/register','Register',array('class'=>'ui')); 
            }?>
        </div>
        
    </header>
    
    <div class="nav">
        <?=form_open(site_url('post/search'),array('method'=>'get'))?>
            <input type="text" name="key" class="s searchings" placeholder="Searcing..." />
            <select name="prov">
                <option value="">-- Pilih Provinsi --</option>
                <?php
                    $prov = $this -> db -> order_by('ProvinceID','asc') -> get('provinces');
                    getCombobox($prov, 'ProvinceID', 'ProvinceName');
                ?>
            </select>
            <select name="cat">
                <option value="">-- Pilih Kategori --</option>
                <?php
                    $cat = $this -> db -> order_by('CategoryID','asc') -> get('categories');
                    getCombobox($cat, 'CategoryID', 'CategoryName');
                ?>
            </select>
            
            
                <!-- <input type="text" name="s" class="s" placeholder="Searcing..." /> -->
                <input type="submit" class="ui cari" value="Search" />
        <?=form_close()?>
            
    </div>
        <div class="clear"></div>
    
    <section class="contents">
        
    