<?=$this -> load -> view('admin/header')?>
<h2><?=$title?></h2><br />

<h2><marquee scrolldelay="200" style="font-family:'Bradley Hand ITC' ">Selamat Datang Dashboard Administrator Not Error </marquee></h2><br />

<table width="100%" style="font-family:'Agency FB';font-size: 18px;">
    <tr>
        <td>         
			<div class="ui-block-a">
        		<div class="jqm-block-content">
        			<h3>Pages &amp; Post</h3>
        			<p><?=anchor('page', 'Page')?></p>
        			<p><?=anchor('post', 'Post')?></p>
        			<p><?=anchor('page/add', 'New Page')?></p>
        			<p><?=anchor('post/add', 'New Post')?></p>
        		</div>
        	</div>
        </td>
        <td>
        	<div class="ui-block-a">
        		<div class="jqm-block-content">
        			<h3>Category &amp; Media</h3>
					<p><?=anchor('category', 'Categories')?></p>
            		<p><?=anchor('category/add', 'New Category')?></p>
        			<p><?=anchor('media', 'Libarary')?></p>
                    <p><?=anchor('media/add', 'Add New Media')?></p>
        		</div>
        	</div>    
        	</td>  
        	</tr>
        	<tr>
        <td>     	
        	<div class="ui-block-a">
        		<div class="jqm-block-content">
        			<h3>Appearance</h3>
					<p><?=anchor('theme', 'Themes')?></p>
            		<p><?=anchor('setting/logo', 'Logo')?></p>
        			<p><?=anchor('setting/favicon', 'Favicon')?></p>
                    <p><?=anchor('footer/add', 'New Footer Column')?></p>
                    <p><?=anchor('footer', 'Footer Column')?></p>
        		</div>
        	</div>
        </td>
        <td>
        	<div class="ui-block-a">
        		<div class="jqm-block-content">
        			<h3>Others</h3>
        		    <p><?=anchor('user', 'Users')?></p>
            		<p><?=anchor('user/add', 'New User')?></p>
        			<p><?=anchor('comment', 'Comments')?></p>
        			<p><?=anchor('setting/general', 'General')?></p>
        			<p>&nbsp;</p>
        		</div>
        	</div>
        
        </td>
    </tr>
</table>
<style>
	.ui-block-a{
		background: rgba(27,233,117,0.2);
		padding:3px;
		border-radius:10px;
	}
	
	a{
		text-decoration: none;
	}
	
	a:hover{
		text-decoration: none;
		color:#003147;
	}
	
	p{
		margin:10px;
		
	}
	
	h3{
		border-bottom: ridge;
		padding:3px 6px 6px 3px;
		margin: 2px 2px 2px 2px;
	}
</style>
<?=$this -> load -> view('admin/footer')?>
