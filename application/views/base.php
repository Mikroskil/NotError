<?=$this->load->view('header')?>

<?php if($result->ShowTitle) echo '<h2>'.$result->PageTitle.'</h2>' ?>

<div class="main-content">
    <?php if($result->CSS) echo '<style type="text/css">'.$result->CSS.'</style>' ?>
    <?=$result->HTML?>
    <?php if($result->Javascript) echo '<script type="text/javascript">'.$result->Javascript.'</script>' ?>
</div>


<?=$this->load->view('footer')?>

