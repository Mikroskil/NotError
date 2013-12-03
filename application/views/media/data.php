<?php $this -> load -> view('admin/header')?>

<h2><?=$title?></h2>
<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('media/delete')?>

<button type="submit" class="ui">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>ID</th>
        <th>Picture</th>
        <th>URL</th>
        <th>Date</th>
        <th>Author</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->MediaID?>" /></td>
            <td><?=$d->MediaID?></td>
            <td>
                <a href="<?=base_url()?>media/edit/<?=$d->MediaID?>.html">
                    <img height="150" src="<?=base_url()?>assets/images/media/<?=$d->MediaPath?>" />
                </a>
            </td>
            <td><?=$d->MediaFullPath?></td>
            <td><?=$d->UpdateOn? $d->UpdateOn : $d->CreatedOn?></td>
            <td><?=$d->UpdateBy? $d->UpdateBy : $d->CreatedBy?></td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>
<br /><br />
<script type="text/javascript" charset="utf-8">
    
</script>




<?php $this -> load -> view('admin/footer')?>
