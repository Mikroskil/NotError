<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('footer/delete')?>

<button class="ui" type="submit">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>Name</th>
        <th>Column</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    
    <tbody>
    <?php
        $d = 0;
        foreach ($r->result() as $d) {
            
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->FooterID?>" /></td>
            <td><?=anchor(site_url('footer/edit/'.$d->FooterID),$d->FooterName)?></td>
            <td><?=$d->TotalColumn?></td>
            <td><?=$d->IsShow? 'show': 'hide' ?></td>
            <td><?=$d->IsShow? anchor(site_url('footer/hide/'.$d->FooterID),'Hide') : anchor(site_url('footer/show/'.$d->FooterID),'Show')?></td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
    
</script>


<?=$this -> load -> view('admin/footer')?>

