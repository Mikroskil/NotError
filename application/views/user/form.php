<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>


<?=form_open(current_url(),array('id'=> 'validate')) ?>

<label for="UserName"><h3>Username</h3></label>
<input type="text" class="required" name="UserName" id="UserName" value="<?=$edit?$result->UserName : set_value('UserName')?>"  />

<label for="Password"><h3>Password</h3></label>
<input type="password" class="input" name="Password" id="Password" value="<?=set_value('Password')?>"  />
<br /><br />
<label for="RoleID"><h3>Role</h3></label>
<select name="RoleID">
    <option>Role</option>
    <?php
        $role = $this -> db -> order_by('RoleID','asc') -> get('Roles');
        getCombobox($role, 'RoleID', 'RoleName',$edit?$result->RoleID:set_value('RoleID'));
    ?>
</select>

<h3>Suspend</h3>
<input type="checkbox"name="IsSuspend" id="IsSuspend" value="<?=$edit?$result->IsSuspend:set_value('IsSuspend')?>"  />
<label style="vertical-align: middle" for="IsSuspend">Suspend This Username</label>

<br /><br /><br />

<fieldset>
    <legend>Information</legend>
    <table>
        <tr>
            <th>Photo Profile</th>
            <td>
                <?php $pp = $edit?$result->PhotoProfile:""; ?>
                <div class="success infomedia" style="width: 100px;height: 100px;padding: 5px;float: left;margin: 0 10px 0 0;overflow: hidden" >
                    <?php if(!empty($pp)){ ?>
                        <img style="height: 100%; width: 100%" src="<?=$result->PhotoProfile?>" />
                    <?php }?>
                </div>
                <a href="<?=site_url('media/selectpath')?>" class="pilihmedia ui">Choose Library</a><br /><br />
                <input type="file" name="userfile" id="userfile" class="ui" />
                <input type="hidden" id="MediaID" name="MediaID" value="<?=$pp?>" />
                <span class="uploadstatus"></span>
                
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <td>
                <input type="text" class="required text" name="Name" value="<?=$edit?$result->Name:set_value('Name')?>" />
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <input type="text" class="required email text" name="Email" value="<?=$edit?$result->Email:set_value('Email')?>" />
            </td>
        </tr>
        <tr>
            <th>Country</th>
            <td>
                <select id="CountryID" class="required" name="CountryID">
                    <option value="">Pilih Negara</option>
                    <?php $c = $this -> db -> order_by('CountryID', 'asc') -> get('countries');
                        GetCombobox($c, 'CountryID', 'CountryName', $edit ? $result->CountryID : set_value('CountryID'));
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Province</th>
            <td>
                <select id="ProvinceID" class="required" name="ProvinceID">
                    <?php $p = $this -> db -> order_by('ProvinceID', 'asc') -> where('CountryID',$result->CountryID) -> get('provinces');
                        GetCombobox($p, 'ProvinceID', 'ProvinceName', $edit?$result->ProvinceID:'');
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>City</th>
            <td>
                <select id="CityID" class="required" name="CityID">
                    <?php $ct = $this -> db -> order_by('CityID', 'asc') -> where('ProvinceID',$result->ProvinceID) -> get('cities');
                        GetCombobox($ct, 'CityID', 'CityName', $edit?$result->CityID:'');
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Address</th>
            <td>
                <textarea name="Address"><?=$edit?$result->Address:set_value('Address')?></textarea>
            </td>
        </tr>
        <tr>
            <th>HP/Telp.</th>
            <td>
                <input type="text" class="required text" name="Telp" value="<?=$edit?$result->Telp:set_value('Telp')?>" />
            </td>
        </tr>
    </table>
</fieldset>

<br />
<button type="submit" class="ui">Save</button>

<?=form_close()?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.pilihmedia').click(function(){
            var a = this;
            $('#GeneralDialog').load($(a).attr('href'),{},function(){
                var dlg = this;
                $(dlg).dialog({
                    modal:true,
                    width:800,
                    height:500,
                    show: 'clip',
                    title: 'Pilih Gambar'
                });
                $('.selectit',dlg).click(function(){
                    $('.removemedia').show();
                    $('#MediaID').val($(this).attr('mediaid'));
                    $('.infomedia').html('<img src="<?=base_url()?>assets/images/media/'+$(this).attr('src')+'" style="height: 100%; width: 100%" /> ').show();
                    $(dlg).dialog('close');
                    return false;
                });
            })
            return false;
        });
        
        $('#userfile').change(function(){
            $(this).attr('disable',true);
            $('.uploadstatus').html('Sedang mengupload file <img src="<?=base_url()?>assets/images/load.gif" alt="ajaxloading" />');
            $('form').ajaxSubmit({
                dataType: 'json',
                url: '<?=site_url('media/uploadprofile')?>',
                success : function(data){
                    //$('.removemedia').show();
                    $('#MediaID').val(data.fullmediapath);
                    $('.infomedia').html('<img src="<?=base_url()?>assets/images/profile/'+data.mediapath+'" width="100" height="100" />').show();
                    $(this).attr('disable',false);
                    $('.uploadstatus').empty();
                }
            });
        });
        
       $('#CountryID').change(function(){
                var con = this;
                $('#CityID').empty();
                $('#ProvinceID').unbind().load('<?=site_url('ajax/getprovinceoption')?>',{'id':$(con).val()},function(data){
                    $(this).change(function(){
                        var pro = this;
                        $('#CityID').unbind().load('<?=site_url('ajax/getcityoption')?>',{'province':$(pro).val()},function(data){
                            $('#CityID').change(function(){
                                $.ajax({
                                    url: '<?=site_url('ajax/cekshippingavailable')?>',
                                    data: {shipment:$('#ShipmentID').val(),city:$('#CityID').val()},
                                    dataType: 'json',
                                    type: 'post'
                                }).done(function(data){
                                    
                                });
                            });
                        });
                    });
                });
            }); 
    });
</script>


<?=$this -> load -> view('admin/footer')?>
