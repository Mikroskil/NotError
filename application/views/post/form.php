<?=$this -> load -> view('admin/header')?>

<h2><?=$title?></h2><br />

<?php if($this->input->get('success')==1){?>
   <div class="success">Your data has been saved</div> 
<?php }?>

<?php if(validation_errors()){?>
   <div class="error"><?=validation_errors()?></div> 
<?php }?>



<?=form_open(current_url())?>

<table>
    <tr>
        <th><h3>Type Post</h3></th>
        <td>
            <input type="radio" value="1" name="PostTypeID" id="Sale"  <?=$edit? $result->PostTypeID==1?'checked=""':'' : ''?> /> <label for="Sale">Sale</label>
            <input type="radio" value="2" name="PostTypeID" id="Rent"  <?=$edit? $result->PostTypeID==2?'checked=""':'' : ''?> /> <label for="Rent">Rent</label>
            <input type="radio" value="3" name="PostTypeID" id="Service"  <?=$edit? $result->PostTypeID==3?'checked=""' : '':''?> /> <label for="Service">Service</label>
        </td>
    </tr>
    <tr>
        <th><label for="PostTitle"><h3>Title</h3></label></th>
        <td>
            <input type="text" id="PostTitle" name="PostTitle" value="<?=$edit?$result->PostTitle:set_value('PostTitle')?>" /><br />
            <!-- <textarea id="PostTitle" name="PostTitle"><?=$edit?$result->PostTitle : set_value('PostTitle')?></textarea><br />
            <script>
                CKEDITOR.replace('PostTitle', {
                    height : 75,
                    toolbar : [{
                        name : 'document',
                        items : ['Source', '-']
                    }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                    ['Undo', 'Redo'], // Defines toolbar group without name.
                    {
                        name : 'basicstyles',
                        items : ['Bold', 'Italic', 'Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor']
                    }]
                }); 
            </script> -->
        </td>
    </tr>
    <tr>
        <th><label for="CategoryID"><h3>Category</h3></label></th>
        <td>
            <select id="CategoryID" name="CategoryID">
                <option value="">-- Not Category --</option>
                <?php
                    $catt = $this -> db -> get('categories');
                    echo getCombobox($catt, 'CategoryID', 'CategoryName',$result->CategoryID);
                ?>
                    
            </select>
        </td>
    </tr>
    <tr>
        <th><label for="MediaID"><h3>Media</h3></label></th>
        <td>
            <fieldset style="background: #EFEFDE">
                <ul class="sortable gambars" style="list-style: none; padding: 0;" id="gambars">
                    <li>
                        <center>
                            <a style="margin-top: 5px;" href="#" class="ui selectpicture">Upload</a>
                            <br /><br /><br />
                            <a href="#" class="ui selectmedia">Media</a>
                        </center>
                    </li>
                    <?php if($edit && !empty($images)){ ?>
                        <?php $mastermedia = GetMedia($result->MediaID); ?>
                        <?php if(!empty($mastermedia)){ ?>
                        <li>
                            <img src="<?=$mastermedia?>" />
                            <a href="#" class="deletephoto deletephoto">x</a>
                            <input type="hidden" name="MediaID[]" value="<?=$result->MediaID?>" />
                        </li>
                        <?php } ?>
                        <?php foreach ($images->result() as $media) { ?>
                            <li>
                                <img src="<?=$media->MediaFullPath?>" />
                                <a href="#" class="deletephoto deletephoto">x</a>
                                <input type="hidden" name="MediaID[]" value="<?=$media->MediaID?>" />
                            </li>
                        <?php } ?>
                    <?php }else{ ?>
                    
                    <?php } ?>
                </ul>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th><label for="Description"><h3>Description</h3></label></th>
        <td>
            <textarea class="ckeditor" id="Description" name="Description"><?=$edit?$result->Description:set_value('Description')?></textarea><br />
        </td>
    </tr>
    <tr>
        <th><label for="Price"><h3>Price</h3></label></th>
        <td>
            <input type="text" id="Price" name="Price" value="<?=$edit?$result->Price:set_value('Price')?>" />
            <input type="checkbox" value="1" name="IsNego" id="IsNego" <?=$edit?'checked=""':''?> />
            <label for="IsNego">Nego</label>
            <br />
        </td>
    </tr>
    <tr>
        <th><h3>Condition</h3></th>
        <td>
            <select  id="ConditionID" class="required" name="ConditionID">
                <option value="">Pilih Kondisi</option>
                <?php
                    $cond = $this -> db -> order_by('ConditionID','asc') -> get('conditions');
                    getCombobox($cond, 'ConditionID', 'ConditionName',$edit?$result->ConditionID:set_value('ConditionID'));
                ?>
            </select>
        </td>
    </tr>
    <tr>
            <th><h3>Country</h3></th>
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
        <th><h3>Province</h3></td>
        <td>
            <select id="ProvinceID" class="required" name="ProvinceID">
                <?php $p = $this -> db -> order_by('ProvinceID', 'asc') -> where('CountryID',$result->CountryID) -> get('provinces');
                    GetCombobox($p, 'ProvinceID', 'ProvinceName', $edit?$result->ProvinceID:'');
                ?>
            </select>
        </td>
    </tr>
    
    
    <tr>
        <th><h3>City</h3></th>
        <td>
            <select id="CityID" class="required" name="CityID">
                <?php $ct = $this -> db -> order_by('CityID', 'asc') -> where('ProvinceID',$result->ProvinceID) -> get('cities');
                    GetCombobox($ct, 'CityID', 'CityName', $edit?$result->CityID:'');
                ?>
            </select>
        </td>    
    </tr>

    <tr>
        <th><h3>Status</h3></th>
        <td>
            <select id="StatusID" class="required" name="StatusID">
                <option value="">Pilih Status</option>
                <?php
                    $cond = $this -> db -> order_by('StatusID','asc') -> get('status');
                    getCombobox($cond, 'StatusID', 'StatusName',$edit?$result->StatusID:set_value('StatusID'));
                ?>
            </select>

        </td>
    </tr>
    <tr>
        <th><label for="PostExpired"><h3>Post Expired</h3></label></th>
        <td>
            <input type="text" id="PostExpired" class="datepicker" name="PostExpired" value="<?=$edit?$result->PostExpired:set_value('PostExpired')?>" /><br />
        </td>
    </tr>
</table>

<!-- <label for="PostContent"><h3>Content</h3></label>
<textarea class="ckeditor" id="PostContent" name="PostContent"><?=$edit?$result->PostContent:set_value('PostContent')?></textarea><br /> -->

<!-- <label for="Description"><h3>Description</h3></label>
<textarea id="Description" name="Description"><?=$edit?$result->Description:set_value('Description')?></textarea><br />
<script>
    CKEDITOR.replace('Description', {
        height : 100,
        toolbar : [{
            name : 'document',
            items : ['Source', '-']
        }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
        ['Undo', 'Redo'], // Defines toolbar group without name.
        {
            name : 'basicstyles',
            items : ['Bold', 'Italic', 'Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor']
        }]
    }); 
</script><br /> -->


<!-- <label for="ViewDetailID"><h3>View Detail</h3></label>
<input type="text" id="ViewDetailID" name="ViewDetailID" value="<?=$edit?$result->ViewDetailID:set_value('ViewDetailID')?>" /><br /> -->



<br />

<?php if($edit){?><label for="url"><h3>URL</h3></label>
<div style="background: #ccc;padding: 5px 10px;">
<?=base_url()?>post/view/<input type="text" id="url" name="PostSlug" value="<?=$result->PostSlug?>" />.html

</div>
<input style="width: 97%" type="text" readonly="" value="<?=base_url().'post/view/'.$result->PostSlug.'.html'?>" />
<?php } ?>


<h3>Show Comment</h3>
<input type="checkbox" name="ShowComment" id="ShowComment" <?=$edit? $result->ShowComment? 'checked=""' :'' : ''?>  value="1" /><label for="ShowComment">Show Comment This Post</label>

<h3>Show Share</h3>
<input type="checkbox" name="ShowShare" id="ShowShare" <?=$edit? $result->ShowShare? 'checked=""' :'' : 'checked=""'?>  value="1" /><label for="ShowShare">Show Share This Post</label>

<br /><br />
<button type="submit" class="ui">Save</button><br /><br />
<?=form_close()?>

<?php if($edit){ ?>
<table rules="all" border="1">
    <tr>
        <td>Created By</td>
        <td><?=$result->CreatedBy?></td>
    </tr>
    <tr>
        <td>Created On</td>
        <td><?=$result->CreatedOn?></td>
    </tr>
    <!-- <tr>
        <td>Update By</td>
        <td><?=$result->UpdateBy?></td>
    </tr>
    <tr>
        <td>Update On</td>
        <td><?=$result->UpdateOn?></td>
    </tr> -->
</table>

<?php }?>

<form id="uploader" enctype="multipart/form-data" method="post">
    <input type="file" style="visibility: hidden" id="filer" name="userfile" class="userfile" />
</form>

<script type="text/javascript">
    $(document).ready(function(){
       function pushuploader(){
            var uploadercontent = '<li>'+
                                    '<center><br /><a href="#" class="selectpicture">Upload Gambar</a>'+
                                    '<br /><br />Atau<br /><br />'+
                                    '<a href="#" class="selectmedia">Pilih Dari Media</a></center>'+
                                '</li>';
            $('#gambars').prepend(uploadercontent);
        }
                
        function upload(idx){
            $('.userfile').unbind().change(function(){
                $('#gambars li').eq(idx).html('<img style="width:auto; height:auto;" src="<?=base_url()?>assets/images/load.gif" /> <br /> Uploading...');
                $(this).parent().ajaxSubmit({
                    dataType: 'json',
                    url: '<?=site_url('media/upload')?>',
                    success : function(data){
                        var con =   '<img class="fancybox" src="'+data.fullmediapath+'" />'+
                                    '<a href="#" class="deletephoto deletephoto">x</a>'+
                                    '<input type="hidden" name="MediaID[]" value="'+data.mediaid+'" />';
                        $('#gambars li').eq(idx).html(con);
                        pushuploader();
                    }
                });
            });
        }
                
        $(document).ready(function(){
            $('#gambars').sortable();
            $('.deletephoto').live('click',function(){
                var yakin = confirm('Apa anda yakin?');
                if(yakin){
                    $(this).parents('li').remove();
                    if($('#gambars li').length == 0){
                        pushuploader();
                    }
                }
                return false;
            })
            
            $('.selectpicture').live('click',function(){
                var par = $(this).parents('li');
                var idx = $('#gambars li').index(par);
                upload(idx);
                $('#filer').click();
                return false;
            });
            
            $('.selectmedia').live('click',function(){
                var a = this;
                var par = $(this).parents('li');
                var idx = $('#gambars li').index(par);
                
                $('#GeneralDialog').load('<?=site_url('media/multiselect')?>',{},function(){
                    var dlg = this;
                    $(dlg).dialog({
                        modal:true,
                        width:800,
                        height:500,
                        show: 'clip',
                        title: 'Pilih Gambar',
                        buttons:{
                            "OK" : function(){
                                $('li input:checked',$(dlg)).each(function(){
                                    var conz =  '<li><img src="<?=base_url()?>assets/images/media/'+$(this).attr('src')+'" />'+
                                                '<a href="#" class="deletephoto deletephoto">x</a>'+
                                                '<input type="hidden" name="MediaID[]" value="'+$(this).attr('mediaid')+'" /> </li>';
                                    $('#gambars').append(conz);
                                });
                                $(dlg).dialog('close');
                            },
                            "Batal" : function(){
                                $(dlg).dialog('close');
                            }
                        }
                    });
                })
                return false;
            });
            
            $('.removemedia').live('click',function(){
                var kos = 0;
                var yakin = confirm('Apa anda yakin?');
                if(!yakin){
                    return false;
                }
                $('#MediaID').val(kos);
                $(this).closest('.infomedia').empty().hide();
                return false;
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
