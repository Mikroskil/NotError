<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>



<?=form_open(current_url())?>

<label for="WidgetName"><h3>Widget Name</h3></label>
<input type="text" id="WidgetName" name="WidgetName" value="<?=$edit?$result->WidgetName:set_value('WidgetName')?>" /><br />


        
</select>



<label for="IsShow"><h3>IsShow</h3></label>
<input type="checkbox" id="IsShow" name="IsShow" value="1" <?=$edit? $result->IsShow? 'checked=""' : '' :''?> /><br />


<label for="Description"><h3>Description</h3></label>
<textarea id="Description" name="Description"><?=$edit?$result->Description:set_value('Description')?></textarea>
<script>
    CKEDITOR.replace('Description', {
        height : 100,
        toolbar : [{
            name : 'document',
            items : ['Source', '-']
        }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
        ['Undo', 'Redo'], // Defines toolbar group without name.
        {
            name : 'basicstyles',
            items : ['Bold', 'Italic', 'Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor']
        }]
    }); 
</script><br />


<br /><br />
<button type="submit" class="ui">Save</button><br /><br />
<?=form_close()?>



<?=$this -> load -> view('admin/footer')?>
