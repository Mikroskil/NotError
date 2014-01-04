<?php $this -> load -> view('header')?>

<div>
    <?php $this -> load -> view('user/nav')?>
    
    <div class="dash_user" id="tabs">
    	<!-- <h2><?=$title?></h2> -->
    	
    	<ul>
			<li><a href="#tabs-1">Iklan Non Aktif</a></li>
			<li><a href="#tabs-2">Iklan Expired</a></li>
		</ul>
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
		        	if($d->StatusID==3){
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
    <div id="tabs-2">
			<table class="datatable" width="100%">
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
		        	if($d->StatusID==4){
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
