<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('widget/delete')?>

<button type="submit" class="ui">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>ID</th>
        <th>Title</th>
        <th>Show</th>
    </tr>
    </thead>
    
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
            $widget=$this->db->where('WidgetID',$d->WidgetID)->get('widgets')->row();
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->WidgetID?>" /></td>
            <td><b><?=$d->WidgetID?></b></td>
            <td><?=$d->WidgetName?></td>
            <td><?=$d->IsShow? 'ya': 'tidak' ?></td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
    
</script>


<?=$this -> load -> view('admin/footer')?>
