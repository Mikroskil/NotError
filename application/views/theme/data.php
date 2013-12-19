<?php $this -> load -> view('admin/header') ?>

<h2><?=$title?></h2>

<?php if(empty($themes)){?>
<div class="error">
    Theme not available.
</div>
<? }else{ ?>
<div class="themes">
    <?php
    $i=0;
    
    $folders = $folder['tema'];
    foreach ($themes as $theme => $themename) {
        $i++;
        $fileinfo = $folders."/".$theme.'/info.txt';
        $read = read_file($fileinfo);
        $info = json_decode($read);
        $preview = $folders."/".$theme.'/preview.jpg';
        if(is_file($preview)){
            $image = base_url().$folders."/".$theme."/preview.jpg";
            $image = str_replace("./", "", $image);
        }else{
            $image = base_url().'assets/images/no-image.png';
        }
        ?>
        <div class="themebox">
            <img src="<?=$image?>" alt="Preview" />
            <h3><?=$info->ThemeName?> by <?=anchor($info->AuthorURL,$info->Author,array('target'=>'_blank'))?></h3>
        
        <?php
        $activetheme = ACTIVETHEME;
        #$activetheme = 1;
        if($theme != $activetheme){
            ?>
            <?=anchor(site_url('theme/activated/'.$theme),'Set',array('class'=>'ui'))?>
            <?=anchor(site_url()."?previewtheme=".$theme,'Preview',array('class'=>'preview ui'))?>
            <?php
        }else{
            ?><br />
            <i>Sudah diaktifkan</i>
            <?php
        }
            
        ?>
        </div>
        <?php
            if($i % 3 == 0){
                ?>
                <!-- <div class="clear"></div> -->
                <?php
            }
        ?>
        <?php
    }
    ?>
    </div>
<?php }?>
<div class="clear"></div>

<?php $this -> load -> view('admin/footer') ?>
