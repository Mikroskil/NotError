<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>



<form enctype="multipart/form-data" action="<?=current_url()?>" method="post" id="validate">

<label for="MediaName"><h3>Media Name</h3></label>
<input type="text" id="MediaName" name="MediaName" value="<?=$edit?$result->MediaName:set_value('MediaName')?>" /><br />

<label for="MediaPath"><h3>Picture</h3></label>
<?php if($edit){ ?>
<?php if(FileExtension_Check($result->MediaPath, 'gambar')){ ?>
    <img height="150" src="<?=base_url()?>assets/images/media/<?=$result->MediaPath?>" />
    <br />
    <input type="file" size="30" name="userfile" /><br />
    <textarea readonly="" class="select" style="height:30px"><?=base_url().'assets/images/media/'.$result->MediaPath?></textarea>
<?php } ?>
<?php }else{ ?>
    <input type="file" size="30" class="required" name="userfile" /><br />
<?php } ?>


<label for="Description"><h3>Description</h3></label>
<textarea id="Description" name="Description"><?=$edit?$result->Description:set_value('Description')?></textarea><br />

<br />
<button type="submit" class="ui">Save</button><br /><br />
<?=form_close()?>

<?php if($edit){ ?>
<table class="meta ui-state-default" border="1">
    <tr>
        <td>
            Dibuat Oleh:
        </td>
        <td><?=$result->CreatedBy?></td>
    </tr>
    <tr>
        <td>
            Dibuat Pada:
        </td>
        <td><?=$result->CreatedOn?></td>
    </tr>
    <tr>
        <td>
            Diubah Oleh:
        </td>
        <td><?=$result->UpdateBy?></td>
    </tr>
    <tr>
        <td>
            Diubah Pada:
        </td>
        <td><?=$result->UpdateOn?></td>
    </tr>
</table>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.select').on('click',function(){
            $(this).select();
        });
    });
</script>


<?=$this -> load -> view('admin/footer')?>
