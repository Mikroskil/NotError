<style>
    .navv{
        padding-left: 3px;
    }
    
    .navv li{
        float: left;
        list-style: none;
        margin-right: 5px;
    }
    
    .navv li a{
        text-decoration: none;
        font-size: 14px;
        color: #FFFF00;
    }        
    
</style>
    
<ul class="navv">
    <li><?=anchor(base_url(),'Home')?> >> </li>
    <li><a href="#"><?=$title?></a></li>
</ul>

<div class="clear" style="height: 10px"></div>

<h1 class="titles"><?=$model->PostTitle?></h1>

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

<script type="text/javascript" src="<?=base_url() ?>assets/js/jquery.bxGallery.1.1.min.js"></script>

<?php if(ALLOWSHARE){ ?>
    <p>
    <!-- AddThis Smart Layers BEGIN -->
    <!-- Go to http://www.addthis.com/get/smart-layers to customize -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-524b22b515663e7b"></script>
    <script type="text/javascript">
      addthis.layers({
        'theme' : 'gray',
        'share' : {
          'position' : 'left',
          'numPreferredServices' : 5
        },  
        'whatsnext' : {},  
        'recommended' : {} 
      });
    </script>
    <!-- AddThis Smart Layers END -->
    </p>
<?php } ?>

<div class="post">
    <div class="po">
        <ul id="Gambar">
            
            <?php if($media->MediaPath){ ?> 
                <li><img src="<?=$media->MediaFullPath?>" title="" /></li>
            <?php }else{ ?>
                <li><img src="<?=base_url() . "assets/images/no-image.png"?>" title="" /></li>
            <?php } ?>
           
            <?php
                foreach ($images->result() as $image) {
                    ?>
                    <li><img src="<?=$image->MediaFullPath?>" title="" /></li>
                    <?php
                }
            ?>
        </ul>
    </div>
    
    <div class="users">
        <?php
            $name = $this -> db -> where('UserName',$model -> CreatedBy) -> get('userinformations') -> row();
            $country = $this -> db -> where('CountryID',$name -> CountryID) -> get('countries') -> row();
            $prov = $this -> db -> where('ProvinceID',$name -> ProvinceID) -> get('provinces') -> row();
            $city = $this -> db -> where('CityID',$name -> CityID) -> get('cities') -> row();
        ?>
        
        <div class="pp">
            <img width="100" height="100" src="<?=$name -> PhotoProfile?>" />
        </div>
        
        
        <div class="id-profile">
            <h2 class="name"><?=$name -> Name?></h2>
            <h4><?=$name -> Telp?></h4>
            <h3><?=$name -> Email?></h3><br /><br />
            <?=$country -> CountryName?>, <?=$prov -> ProvinceName?>, <?=$city -> CityName?>
        </div>
        <br />
        <div class="post-r">
            <h2>Post By <?=$name -> Name?></h2>
            <ul>
            <?php
                $postr = $this -> db -> where('CreatedBy', $model -> CreatedBy) -> order_by('PostDate','desc') -> get('posts');
                
                foreach ($postr -> result() as $ps) {
                    
                $imgg = $this -> db -> where('MediaID', $ps -> MediaID) -> get('media') -> row(); 
                if($ps -> PostSlug != $model -> PostSlug){       
             ?>
                    
                <li>
                    <img width="64" height="64" style="float: left; margin-right: 10px" src="<?=$imgg -> MediaFullPath?>" />
                    <?=date('d/m/Y', strtotime($ps -> PostDate)) ?><br />
                    <h3>
                    <?=anchor(base_url().'post/view/'.$ps -> PostSlug.'.html',$ps -> PostTitle) ?>
                    </h3>
                    <div style="clear: both; margin-bottom: 10px"></div>
                </li>    
            <?php
                }
             } ?>
            </ul>
        </div>
        
        <div style="clear: both"></div>    
    </div>
    
    
    <div  style="height: 13px;" class="clear"></div>
    
    <!-- <div class="post-content">
        <?=Do_Shortcode(parse_form($model->PostContent))?>
    </div> -->
    <!-- <div class="clear"></div> -->
    
    <?php #if(!empty($model->Description)){ ?>
        <div class="post-content">
            <h3>Deskripsi</h3>
            <?=Do_Shortcode(parse_form($model->Description))?>
        </div>
    <?php #} ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.allowcomment').hide();
        $('#tombol_com').click(function(){
            $('.allowcomment').slideToggle();
        });
        
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
    $(document).ready(function(){
        
        $('#Gambar li img').click(function(){
            $.fancybox({
                'padding'       : 0,
                'href'          : $('li.on img').attr('src'),
                'title'         : '<?=trim(strip_tags($model->PostTitle))?>',
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic'

            });
        });
        
        $('#Gambar li img').each(function(){
            if($(this).width() > $(this).height()){
                $(this).css('width','100%').css('height','auto');
                var margintop = ($(this).parent().height() - $(this).height()) / 2;
                margintop = (margintop < 1) ? 0 : margintop;
                $(this).css('margin-top',margintop);
            }
            // }else{
                // $(this).css('height',$(this).parent().height()).css('width','auto');
                // var marginleft = ($(this).parent().width() - $(this).width()) / 2;
                // marginleft = (marginleft < 1) ? 0 : marginleft;
                // $(this).css('margin-left',marginleft);
            // }
        });
        
        <?php if(!empty($impactimage)){ ?>
            $('#Gambar li').hide();
            $('#Gambar').prepend('<li title="" style="position: absolute; display: list-item;"><img title="" src="<?=$impactimage?>" /></li>');
        <?php } ?>
        
        $('#Gambar').bxGallery({
            maxwidth: '',              // if set, the main image will be no wider than specified value (in pixels)
            maxheight: '',             // if set, the main image will be no taller than specified value (in pixels)
            thumbwidth: 75,           // thumbnail width (in pixels)
            thumbcrop: false,          // if true, thumbnails will be a perfect square and some of the image will be cropped
            croppercent: .35,          // if thumbcrop: true, the thumbnail will be scaled to this 
                                       // percentage, then cropped to a square
            thumbplacement: 'right',  // placement of thumbnails (top, bottom, left, right)
            thumbcontainer: '',        // width of the thumbnail container div (in pixels)
            opacity: .5,               // opacity level of thumbnails
            load_text: 'Loading ...',             // if set, text will display while images are loading
            load_image: '',
                                       // image to display while images are loading
            wrapperclass: 'outer'      // classname for outer wrapping div
        });
        
    });
</script>

<div class="clear"></div>
<!-- <br /> -->

<?php if($model->ShowComment){ ?>
<button class="ui"id="tombol_com">Komentar</button><br /><br />
<div id="comments_list">
<div class="allowcomment">
    <?=form_open('post/comment/'.$model->PostID, array('id' => 'validate'))?>
    <table>
        <tr>
            <td><label for="Name">Nama*</label></td>
            <td><input class="required" type="text" style="width: 270px"  name="Name" id="Name" /><br /></td>
        </tr>
        <tr>
            <td><label for="Email">Email*</label></td>
            <td><input class="required email" type="text" style="width: 270px"  name="Email" id="Email" /><br /></td>
        </tr>
        <tr>
            <td><label for="Website">Website</label></td>
            <td><input type="text" size="30" name="Website" style="width: 270px" id="Website" class="" /><br /></td>
        </tr>
        <tr>
            <td><label for="Comment">Komentar</label><br /></td>
            <td><textarea class="required" style="width: 500px;" name="Comment" id="Comment"></textarea><br /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" class="ui button">Kirim</button></td>
        </tr>
    </table>
    <?=form_close() ?>
</div>
<br />

    <!-- <h3>Daftar Komentar</h3> -->
    <ol style="list-style: none" class="commentlist" id="comments">
    <?php $i = 1; foreach ($showcomments->result() as $comment) { ?>
        <li class="comment <?php if($i % 2 == 0) echo "even thread-even"; else echo "odd thread-odd"; ?> depth-1">
        <div class="comment-body">
            <h4 class="fl"> 
                <?php #if($comment->Website){ echo '<a href="http://'.$comment->Website.'" target="_blank" rel="external nofollow">'; } ?> 
                    <?=$comment->Name?> 
                <?php #if($comment->Website){ echo '</a>'; } ?>                
            </h4>
                <abbr title="<?=date('d M Y',strtotime($comment->CommentDate))?> at <?=date('H:i a',strtotime($comment->CommentDate))?>" class="published fr"><?=date('d M Y',strtotime($comment->CommentDate))?> at <?=date('H:i a',strtotime($comment->CommentDate))?></abbr>
            <p>
                <?php echo $this->typography->auto_typography($comment->Comment); ?>
            </p>            
        </div>
        </li>
    <?php
    $i++;
    } ?>
    </ol>
</div>

<?php } ?>

