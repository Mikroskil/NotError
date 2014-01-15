<?php if(!empty($catname)){ ?>
<h2><?= $catname ?></h2>
<?php } ?>

<div class="clear"></div>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?=base_url()?>assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="<?=base_url()?>assets/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>assets/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="<?=base_url()?>assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>assets/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?=base_url()?>assets/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="<?=base_url()?>assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>assets/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

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
    <li><a href="#">Hasil Pencarian</a></li>
</ul>

<div class="clear" style="height: 10px"></div>

<?php
    foreach ($model->result() as $post) {
        
        if($post -> PostExpired > date('Y-m-d') || empty($post -> PostExpired)){
        $media = $this->db->where('MediaID',$post->MediaID)->get('media')->row();
?>


<div class="viewtypelist">
<?php
    if (empty($media)) {
        $pic = base_url() . "assets/images/no-image.png";
    } else {
        $pic = $media -> MediaFullPath;
    }
?>

    <a href="<?=$pic?>" class="fancybox" data-fancybox-group="gallery" title="<?=strip_tags($post->PostTitle)?>"> 
        <div class="imgcontainer" style="text-align: center; float: left; border: 1px solid #CCC; margin-right: 10px;">
        <?php if(empty($media)){ ?>
            <img align="center" src="<?=base_url()?>assets/images/no-image.png" />
        <?php }else{ ?>
            <img align="center" src="<?=$media->MediaFullPath?>" />
        <?php } ?>
        </div>
    </a>
    
    <!-- <div>
    <div class="judul"> -->
        <p class="waktu">
            <?=date('D, d M Y', strtotime($post -> PostDate))?>
        </p>
        
        <h2 class="judul">
            <?php #if($post->PostTypeID == PRODUCTNO){ ?>
                <? #=anchor(site_url('post/berita/'.$post->PostSlug),$post->PostTitle) ?>
            <?php #}else{ ?>
                <?=anchor(site_url('post/view/'.$post->PostSlug),$post->PostTitle)?>
            <?php #} ?>
        </h2>    
    <!-- </div>
    <div class="waktu"> -->
                
    <!-- </div> -->
    <!-- <div class="clear"></div> -->
    <!-- </div> -->
    
    <?php
        $cond = $this -> db -> where('ConditionID',$post -> ConditionID) -> get('conditions') -> row();
        $prov = $this -> db -> where('ProvinceID',$post -> ProvinceID) -> get('provinces') -> row();
        $city = $this -> db -> where('CityID',$post -> CityID) -> get('cities') -> row();
    ?>
    
    <p><?=$cond -> ConditionName?></p>
    <h4><?='Rp. '.$post -> Price?></h4>
    <p><?=$prov -> ProvinceName.', '.$city -> CityName?></p>
    
    <!-- <p class="content">
        <?=word_limiter(strip_tags(strip_shortcode(parse_form($post->Description))),30)?>
    </p> -->

    <div class="detail btn-container">
        <?=anchor(site_url('post/view/'.$post->PostSlug),"Detail",array('class'=>'ui'))?>
    </div>
    <div class="clear"></div>

</div>
<br /> <hr />

<?php } 
}
?>
<br />
<?php if(!isset($nopagination)){ ?>
    <?php if($exist){ ?>
        <?= PrintPagination($page, $pagenum, current_url()) ?>
    <?php } ?>
<?php } ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		
		$('.fancybox').fancybox({
                //prevEffect : 'none',
                //nextEffect : 'none',

                closeBtn  : true,
                arrows    : true,
                nextClick : true,

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });
		
	});
</script>