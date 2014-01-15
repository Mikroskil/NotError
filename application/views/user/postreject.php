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

<div>
    <?php $this -> load -> view('user/nav')?>
    
    <div class="dash_user" id="tabs">
    	<h2>Iklan Ditolak</h2>
    	
    	<div id="tabs-1">
			<table class="datatable" width="100%" >
		    <thead>
		    <tr>
		        <td><input type="checkbox" id="cek" /></td>
		        <th>Picture</th>
		        <th>Title</th>
		        <th>Date</th>
		        <th>Created By</th>
		        <th>Status</th>
		    </tr>
		    </thead>
		    <tbody>
		    <?php
		        $d = 0;
		        foreach ($all->result() as $d) {
		        	$stat = $this -> db -> where('StatusID',$d->StatusID) -> get('status') -> row();
		        	if($d->StatusID==5){
		    ?>
		        <tr>
		            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->PostID?>" /></td>
		            <td><?=$d->MediaID?></td>
		            <td><?=anchor(site_url('post/edit/'.$d->PostID),$d->PostTitle)?></td>
		            <td><?=date('d-M-Y H:i:s',strtotime($d->PostDate))?></td>
		            <td><?=$d->CreatedBy?$d->CreatedBy:$d->UpdateBy?></td>
		            <td><?=$stat->StatusName?></td>
		        </tr>    
		    <?php }
					 }?>
		    </tbody>
		
		</table>
		<div class="clear"></div>
    </div>
    <script>
		$(function() {
			$( "#tabs" ).tabs();
		});
	</script>
	    
    </div>
    <div class="clear"></div>
    
</div>





<?php $this -> load -> view('footer')?>
