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
    	<h2>Iklan Aktif</h2>
    	
        <div id="tabs-1">
			<table class="datatable" width="100%" >
		    <thead>
		    <tr>
		        <!-- <td><input type="checkbox" id="cek" /></td> -->
		        <th>Post</th>
		        <th>Type</th>
		        <th>Category</th>
		        <th>Price</th>
		        <th>Condition</th>
		        <th>Date</th>
		        <th>Expired</th>
		        <th>Status</th>
		    </tr>
		    </thead>
		    <tbody>
		    <?php
		        $d = 0;
		        foreach ($all->result() as $d) {
		            $type = $this -> db -> where('POstTypeID',$d->PostTypeID) -> get('posttypes') -> row();
		        	$stat = $this -> db -> where('StatusID',$d->StatusID) -> get('status') -> row();
                    $cat = $this -> db -> where('CategoryID',$d->CategoryID) -> get('categories') -> row();
                    $med = $this -> db -> where('MediaID',$d->MediaID) -> get('media') -> row();
		        	if($d->StatusID==1){
		    ?>
		        <tr>
		            <!-- <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->PostID?>" /></td> -->
		            <td>
		                <center>
		                  <?=anchor(site_url('post/view/'.$d->PostSlug),'<img width="72" height="72" src="'.$med -> MediaFullPath.'" /><br />'.$d->PostTitle)?>
		                </center>
	                </td>
	                <td>
                        <?=$type->PostTypeName?>
                    </td>
	                <td>
	                    <?=$cat->CategoryName?>
	                </td>
	                <td>
	                    <?='Rp. '.$d->Price?>
	                    <?=$d->IsNego? '<br /><small>Nego</small>':''?>
                    </td>
                    <td><?=$d->ConditionID==BARU? 'new' : 'second' ?></td>
		            <td>
		                <?=date('d-M-Y',strtotime($d->PostDate))?><br />
		                <?=date('H:i:s',strtotime($d->PostDate))?>
	                </td>
		            
		            <!-- <td><?=date('d-M-Y',strtotime($d->PostExpired))?></td> -->
		            <td><?=$d->PostExpired? $d->PostExpired : 'Unlimited' ?></td>
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
