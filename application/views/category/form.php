<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>



<?=form_open(current_url())?>

<label for="CategoryName"><h3>Category Name</h3></label>
<input type="text" id="CategoryName" name="CategoryName" value="<?=$edit?$result->CategoryName:set_value('CategoryName')?>" /><br />

<label for="IsParent"><h3>Sub Category Name</h3></label>
<select id="IsParent" name="IsParent">
    <option value="">-- Nothing --</option>
    <?php
        $catt = $this -> db -> get('categories');
        echo getCombobox($catt, 'CategoryID', 'CategoryName',$result->IsParent);
    ?>
        
</select>

<label for="ViewTypeID"><h3>View Type</h3></label>
<input type="text" id="ViewTypeID" name="ViewTypeID" value="<?=$edit?$result->ViewTypeID:set_value('ViewTypeID')?>" /><br />

<label for="SidebarRight"><h3>Sidebar Right</h3></label>
<input type="text" id="SidebarRight" name="SidebarRight" <?=$edit? $result->SidebarRight? '' :'' : ''?> value="<?=$edit?$result->SidebarRight:set_value('SidebarRight')?>" /><br />

<label for="SidebarLeft"><h3>Sidebar Left</h3></label>
<input type="text" id="SidebarLeft" name="SidebarLeft" value="<?=$edit?$result->SidebarLeft:set_value('SidebarLeft')?>" /><br />

<?php if($edit){?>
<label for="CategoryURL"><h3>Category URL</h3></label>
<span style="background: #aaa; padding: 9px 5px 6px;"><?=base_url().'category/view/' ?></span>
<input style="width: 253px" type="text" id="CategoryURL" name="CategoryURL" value="<?=$edit?$result->CategoryURL:set_value('CategoryURL')?>" /><br />
<input style="width: 500px" type="text" readonly="" value="<?=base_url().'category/view/'.$result->CategoryURL.'.html'?>" />
<?php } ?>

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
