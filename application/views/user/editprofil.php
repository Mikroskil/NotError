<?php $this -> load -> view('header')?>


<style>
    .navv{
        padding-left: 3px
    }
    
    .navv li{
        float: left;
        list-style: none;
        margin-right: 5px
    }
    .navv li a{
        text-decoration: none;
        font-size: 14px
    }        
    
</style>
    
<ul class="navv">
    <li><?=anchor(base_url(),'Home')?> >> </li>
    <li><a href="#"><?=$title?></a></li>
</ul>

<div class="clear" style="height: 1px"></div>

<div>
    <?php $this -> load -> view('user/nav')?>
    
    <div class="dash_user">
        <style type="text/css">
            select{
                width: 300px;
                padding: 5px
            }
        </style>
        
    <fieldset>
    	<legend><h2><?=$title?></h2></legend>
    
	<?php if($this->input->get('success')==1){?>
       <div class="success">Your data has been saved</div> 
    <?php }?>
    
    <?php if(validation_errors()){?>
       <div class="error"><?=validation_errors()?></div> 
    <?php }?>
    
    <?=form_open(current_url(),array('id'=>'validate'))?>	
    	<table width="100%">
    		<tr>
    			<th>Photo Profile</th>
    			<td>
    				<input type="file" name="userfile" id="userfile" class="ui" />
                    <?php $pp = $edit?$result->PhotoProfile:""; ?>
                    <input type="hidden" id="MediaID" name="MediaID" value="<?=$pp?>" />
                    <span class="uploadstatus"></span>
                    <div class="success infomedia" style="width: 100px;height: 100px;padding: 5px;float: left;margin-right: 10px;overflow: hidden" >
                        <?php if(!empty($pp)){ ?>
                            <img style="height: 100%; width: 100%" src="<?=$result->PhotoProfile?>" />                        <?php }?>
                    </div>
                    
                    
    			</td>
    		</tr>
    		<tr>
    			<th>Username</th>
    			<td>
    				<input type="text" class="required text" name="UserName" value="<?=$edit?$result->UserName:set_value('UserName')?>" />
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
    		<tr>
    			<th>&nbsp;</th>
    			<td>
    				<button class="ui" type="submit">Save</button>
    			</td>
    		</tr>
    	</table>
    	
<script type="text/javascript">
    $(document).ready(function(){
        $('#userfile').change(function(){
            $(this).attr('disable',true);
            $('.uploadstatus').html('Sedang mengupload file <img src="<?=base_url()?>assets/images/load.gif" alt="ajaxloading" />');
            $('form').ajaxSubmit({
                dataType: 'json',
                url: '<?=site_url('media/upload')?>',
                success : function(data){
                    //$('.removemedia').show();
                    $('#MediaID').val(data.fullmediapath);
                    $('.infomedia').html('<img src="<?=base_url()?>assets/images/profile/'+data.mediapath+'" width="100" />').show();
                    $(this).attr('disable',false);
                    $('.uploadstatus').empty();
                },
                error : alert('gagal')
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



    <?=form_close()?>
    </fieldset>
    
    </div>	
    <div class="clear"></div>
    
</div>


<?php $this -> load -> view('footer')?>
