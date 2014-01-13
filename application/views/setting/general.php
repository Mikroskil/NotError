<?php $this->load->view('admin/header') ?>

<h2><?php echo $title ?></h2>



<?php if($this->input->get('success') == 1){ ?>
    <div class="success">
        Pengaturan sudah disimpan
    </div>
<?php } ?>

<?=form_open('setting/save')?>
<table border="0">
    <?php foreach ($r->result() as $d) { ?>

    <tr>
        <td width="200"><label for="<?=$d->SettingName?>"><?=$d->SettingLabel?></label></td>
        <td><input style="width: 400px;" type="text" name="<?=$d->SettingName?>" id="<?=$d->SettingName?>" value="<?=$d->SettingValue?>" /></td>
    </tr>
    <?php } ?>
</table>
<button class="ui" type="submit">Simpan</button>
<?=form_close()?>


<?php $this->load->view('admin/footer') ?>