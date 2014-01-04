<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('user/delete')?>

<button type="submit" class="ui">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->UserName?>" /></td>
            <td><?=anchor(site_url('post/edit/'.$d->UserName),$d->UserName)?></td>
            <td><?=$d -> Name?></td>
            <td><?=$d -> Email?></td>
            <td><?=$d->RoleID==1?'Administrator':'User' ?></td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
    
</script>


<?=$this -> load -> view('admin/footer')?>
