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
    
    <div class="dash_user">
        <?php
            $cit = $this -> db -> where('CityID',$result->CityID) -> get('cities') -> row();
            $prov = $this -> db -> where('ProvinceID',$result->ProvinceID) -> get('provinces') -> row();
            $coun = $this -> db -> where('CountryID',$result->CountryID) -> get('countries') -> row();
        ?>
        
        <div class="profil-info">
        <div class="success infomedia" style="width: 100px;height: 100px;padding: 5px;float: left;margin-right: 10px;overflow: hidden" >
          <?php $pp = $result->PhotoProfile; ?>
            <?php if(!empty($pp)){ ?>
                <img style="height: 100%; width: 100%" src="<?=$result->PhotoProfile?>" />
            <?php }?>
        </div>
        
        <h2 class="profil-name"><?=$result -> Name?></h2>
        <p class="profil-email"><?=$result->Email?></p>
        <p class="profil-email"><?=$result->Telp?></p>
        <p class="profil-tempat"><?=$cit -> CityName.', '.$prov -> ProvinceName.', '.$coun -> CountryName?></p>
        </div>
        <div class="clear"></div>
        
        <div class="profil-post">
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
                
                <th>Expired</th>
                
            </tr>
            </thead>
            <tbody>
            <?php
                $d = 0;
                foreach ($all->result() as $d) {
                    $type = $this -> db -> where('PostTypeID',$d->PostTypeID) -> get('posttypes') -> row();
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
                    
                    
                    <!-- <td><?=$d->PostExpired==NULL? 'unlimited' : date('d-M-Y',strtotime($d->PostExpired))?></td> -->
                    <td><?=$d->PostExpired? $d->PostExpired : 'Unlimited' ?></td>
                    
                </tr>    
            <?php }
            }?>
            </tbody>
        
        </table>
        </div>
    
    </div>  
    <div class="clear"></div>
    
</div>


<?php $this -> load -> view('footer')?>
