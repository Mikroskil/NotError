<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>



<?=form_open(current_url())?>

<label for="PageTitle"><h3>Title</h3></label>
<input type="text" id="PageTitle" name="PageTitle" value="<?=$edit?$result->PageTitle:set_value('PageTitle')?>" /><br />
<input type="checkbox" name="ShowTitle" id="ShowTitle" value="1" <?=$edit? $result->ShowTitle? 'checked=""':'':''?> /><label for="ShowTitle">Show title for this page</label>

<br /><br />
<label for="HTML"><h3>Content</h3></label>
<textarea class="ckeditor" id="HTML" name="HTML"><?=$edit?$result->HTML:set_value('HTML')?></textarea><br />

<fieldset>
    <label for="CSS"><h3 class="ui btnCSS">CSS</h3></label>
    <textarea style="width: 95%" id="CSS" name="CSS"><?=$edit?$result->CSS:set_value('CSS')?></textarea><br />

    <label for="Javascript"><h3 class="ui btnJS">Javascript</h3></label>
    <textarea style="width: 95%" id="Javascript" name="Javascript"><?=$edit?$result->Javascript:set_value('Javascript')?></textarea><br />    
</fieldset>
<div class="clear"></div>

<label for="Description"><h3>Description</h3></label>
<textarea id="Description" name="Description"><?=$edit?$result->Description:set_value('Description')?></textarea>

<?php if($edit){?>
<label for="PageURL"><h3>URL</h3></label>
<span style="background: #aaa; padding: 9px 5px 6px;"><?=base_url().'page/view/' ?></span>
<input style="width: 270px" type="text" id="PageURL" name="PageURL" value="<?=$edit?$result->PageURL:set_value('PageURL')?>" /><br />
<input style="width: 500px" type="text" readonly="" value="<?=base_url().'page/view/'.$result->PageURL.'.html'?>" />
<?php } ?>


<br /><br />
<button type="submit" class="ui">Save</button><br /><br />
<?=form_close()?>

<?php if($edit){ ?>
<table rules="all" border="1">
    <tr>
        <td>Created By</td>
        <td><?=$result->CreatedBy?></td>
    </tr>
    <tr>
        <td>Created On</td>
        <td><?=$result->CreatedOn?></td>
    </tr>
    <tr>
        <td>Update By</td>
        <td><?=$result->UpdateBy?></td>
    </tr>
    <tr>
        <td>Update On</td>
        <td><?=$result->UpdateOn?></td>
    </tr>
</table>

<?php }?>


<script type="text/javascript">
    $(document).ready(function(){
       $('#Javascript').hide();
       $('#CSS').hide();
       
       $('.btnCSS').live('click',function(){
           $('#CSS').slideToggle();
       });
       $('.btnJS').live('click',function(){
           $('#Javascript').slideToggle();
       });
        
    });
</script>





<?=$this -> load -> view('admin/footer')?>
