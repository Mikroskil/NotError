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
        <h2><?=$title?></h2>        
        
    </div>
    <div class="clear"></div>
</div>





<?php $this -> load -> view('footer')?>
