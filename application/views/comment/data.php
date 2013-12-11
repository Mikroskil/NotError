<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this -> input -> get('deleted')==1){?>
   <div class="success">Your data has been deleted</div> 
<?php }?>

<?=form_open('comment/delete')?>

<button type="submit" class="ui">Delete</button>
<table class="datatable" width="100%">
    <thead>
    <tr>
        <td><input type="checkbox" id="cek" /></td>
        <th>Username</th>
        <th>Post</th>
        <th>Email</th>
        <th>Date</th>
        <th>Comment</th>
    </tr>
    </thead>
    
    <tbody>
    <?php
        $d = 0;
        foreach ($all->result() as $d) {
            $post=$this->db->where('PostID',$d->PostID)->get('posts')->row();
    ?>
        <tr>
            <td><input type="checkbox" name="cek[]" class="cek" value="<?=$d->CommentID?>" /></td>
            <td><b><?=$d->Name?></b></td>
            <td><?=$post->PostTitle?></td>
            <td><?=$d->Email?></td>
            <td><?=date('d-M-Y H:i:s',strtotime($d->CommentDate))?></td>
            <td><?=$d->Comment?></td>
        </tr>    
    <?php }?>
    </tbody>

</table>

<?=form_close()?>

<script type="text/javascript" charset="utf-8">
    
</script>


<?=$this -> load -> view('admin/footer')?>
