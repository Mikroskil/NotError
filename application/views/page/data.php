<?php $this -> load -> view('admin/header')?>

<h2><?=$title?></h2>
<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('page/delete')?>

<button type="submit" class="ui">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>ID</th>
        <th>Title</th>
        <th>URL</th>
        <th>Created On</th>
        <th>Created By</th>
        <th>Home Page</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
            if($d->PageID == getSetting("HomePageID")){
                $sethome = "Home Page";
            }else{
               $sethome = anchor('setting/sethome/'.$d->PageID,'Set home');
            }
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->PageID?>" /></td>
            <td><?=$d->PageID?></td>
            <td><?=anchor(site_url('page/edit/'.$d->PageID),$d->PageTitle)?></td>
            <td><?=base_url().'page/view/'.$d->PageURL.'.html'?></td>
            <td><?=$d->UpdateOn? date('d-M-Y H:i:s',strtotime($d->UpdateOn)): date('d-M-Y H:i:s',strtotime($d->CreatedOn)) ?></td>
            <td><?=$d->UpdateBy? $d->UpdateBy:$d->CreatedBy ?></td>
            <td><?=$sethome ?></td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
    
</script>




<?php $this -> load -> view('admin/footer')?>
