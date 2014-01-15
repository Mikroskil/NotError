<!DOCTYPE  html>
<html>
    
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <link href="<?=getMediaPath(getSetting('Favicon'))?>" rel='shortcut icon' type='image/x-icon'/>
    
    <title>Admin</title>
    
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
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
    
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.sf-menu').superfish({
                //useClick: true
            });
                      
        });
        
    </script>
    
    
</head>
<body>
    <div class="container">
    
    
    <header class="header">
        <img class="adminLogo" height="50" src="<?=base_url().'assets/images/logo.png'?>" /> 
    </header>
    
    <section class="contents">
        
    <div class="span-5">
        <div id="accordion">
            <h3>Dashboard</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('admin', 'Dashboard')?></li>
                    <li><?=anchor('admin/logout', 'Logout')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3 style="display: none">Post</h3>
            <div  style="display: none">
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('post', 'All Posts')?></li>
                    <li><?=anchor('post/add', 'Add New Post')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Post Ads</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('post', ' All Post Ads')?></li>
                    <li><?=anchor('post/add', 'Add New Post Ads')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Category</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('category', 'All Categories')?></li>
                    <li><?=anchor('category/add', 'Add New Category')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Page</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('page', 'All Pages')?></li>
                    <li><?=anchor('page/add', 'Add New Page')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Comment</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('comment', 'All Comments')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Media</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('media', 'Libarary')?></li>
                    <li><?=anchor('media/add', 'Add New Media')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Appearance</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('theme', 'Themes')?></li>
                    <li><?=anchor('setting/logo', 'Logo')?></li>
                    <li><?=anchor('setting/favicon', 'Favicon')?></li>
                    <!-- <li>
                        <?=anchor('widget', 'Widgets')?>
                        <ul>
                            <li><?=anchor('widget/add', 'Add New Widget')?></li>
                            <li><?=anchor('widget', 'All Widgets')?></li>
                        </ul>
                    </li> -->
                    <!-- <li>
                        <?=anchor('menu', 'Menus')?>
                        <ul>
                            <li><?=anchor('menu/add', 'Add New Menu')?></li>
                            <li><?=anchor('menu', 'All Menus')?></li>
                        </ul>
                    </li> -->
                    <li>
                        <?=anchor('footer', 'Footer Column')?>
                        <ul>
                            <li><?=anchor('footer/add', 'Add New Footer Column')?></li>
                            <li><?=anchor('footer', 'All Footer Column')?></li>
                        </ul>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Users</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('user', 'All Users')?></li>
                    <li><?=anchor('user/add', 'Add New User')?></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <h3>Settings</h3>
            <div>
                <ul class="sf-menu sf-vertical">
                    <li><?=anchor('setting/general', 'General')?></li>
                    <!-- <li><?=anchor('setting/email', 'Email')?></li> -->
                </ul>
                <div class="clear"></div>
            </div>
            
            
        </div>
        
    </div>
    <div class="isi">