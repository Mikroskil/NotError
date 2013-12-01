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
        <th>Category Name</th>
        <th>Parent</th>
        <th>Category URL</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
            $par = $this -> db -> where('CategoryID',$d->IsParent) -> get('categories') ->row();
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->CategoryID?>" /></td>
            <td><?=$d->CategoryID?></td>
            <td><?=anchor(site_url('category/edit/'.$d->CategoryID),$d->CategoryName)?></td>
            <td><?=$d->IsParent? $par->CategoryName: ' - '?></td>
            <td><?=base_url().'category/view/'.$d->CategoryURL.'.html'?></td>
        </tr>    
    <?php }?>
    </tbody>
</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
	
</script>


<?=$this -> load -> view('admin/footer')?>
