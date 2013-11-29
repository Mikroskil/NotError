<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>



<?=form_open(current_url())?>

<label for="PostTitle"><h3>Title</h3></label>
<textarea id="PostTitle" name="PostTitle"><?=$edit?$result->PostTitle : set_value('PostTitle')?></textarea><br />
<script>
    CKEDITOR.replace('PostTitle', {
        height : 75,
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
</script>

<label for="CategoryID"><h3>Category</h3></label>
<select id="CategoryID" name="CategoryID">
    <option value="">-- Not Category --</option>
    <?php
        $catt = $this -> db -> get('categories');
        echo getCombobox($catt, 'CategoryID', 'CategoryName',$result->CategoryID);
    ?>
        
</select>

<label for="MediaID"><h3>Media</h3></label>
<input type="file" id="MediaID" name="MediaID" value="<?=$edit?$result->MediaID:set_value('MediaID')?>" />
<br /><br />

<label for="PostContent"><h3>Content</h3></label>
<textarea class="ckeditor" id="PostContent" name="PostContent"><?=$edit?$result->PostContent:set_value('PostContent')?></textarea><br />

<label for="Description"><h3>Description</h3></label>
<textarea id="Description" name="Description"><?=$edit?$result->Description:set_value('Description')?></textarea><br />
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

<label for="ViewDetailID"><h3>View Detail</h3></label>
<input type="text" id="ViewDetailID" name="ViewDetailID" value="<?=$edit?$result->ViewDetailID:set_value('ViewDetailID')?>" /><br />

<label for="PostExpired"><h3>Post Expired</h3></label>
<input type="text" id="PostExpired" class="datepicker" name="PostExpired" value="<?=$edit?$result->PostExpired:set_value('PostExpired')?>" /><br />

<h3>Show Comment</h3>
<input type="checkbox" name="ShowComment" id="ShowComment" <?=$edit? $result->ShowComment? 'checked=""' :'' : ''?>  value="1" /><label for="ShowComment">Show Comment This Post</label>

<h3>Show Share</h3>
<input type="checkbox" name="ShowShare" id="ShowShare" <?=$edit? $result->ShowShare? 'checked=""' :'' : 'checked=""'?>  value="1" /><label for="ShowShare">Show Share This Post</label>

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




<?=$this -> load -> view('admin/footer')?>
