<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('post/delete')?>

<button type="submit" class="ui">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>ID</th>
        <th>Title</th>
        <th>Date</th>
        <th>Created By</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->PostID?>" /></td>
            <td><?=$d->PostID?></td>
            <td><?=anchor(site_url('post/edit/'.$d->PostID),$d->PostTitle)?></td>
            <td><?=date('d-M-Y H:i:s',strtotime($d->PostDate))?></td>
            <td>Admin</td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
	
</script>


<?=$this -> load -> view('admin/footer')?>
