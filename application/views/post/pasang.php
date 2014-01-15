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
        
        <h2><?=$title?></h2>
        
        <?php if($this->input->get('success')==1){?>
           <div class="success">Your data has been saved</div> 
        <?php }?>
        
        <?php if(validation_errors()){?>
           <div class="error"><?=validation_errors()?></div> 
        <?php }?>        
        
    <?=form_open(current_url(),array('id'=>'validate'))?>
    <table>
        <tr>
            <th>Type</th>
            <td>
                <input type="radio" name="PostTypeID" id="Sale" value="1" /><label for="Sale">Sale</label>
                <input type="radio" name="PostTypeID" id="Rent" value="2" /><label for="Rent">Rent</label>
                <input type="radio" name="PostTypeID" id="Service" value="3" /><label for="Service">Service</label>
            </td>
        </tr>
        <tr>
            <th><label for="PostTitle">Title</label></th>
            <td><input type="text" id="PostTitle" name="PostTitle" class="required text" value="<?=set_value('PostTitle')?>" /></td>
        </tr>
        <tr>
            <th>Category</th>
            <td>
                <select id="CategoryID" class="required" name="CategoryID">
                    <option value="">-- category --</option>
                    <?php $c = $this -> db -> order_by('CategoryID', 'asc') -> get('categories');
                        GetCombobox($c, 'CategoryID', 'CategoryName', set_value('CategoryID'));
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Condition</th>
            <td>
                <select id="ConditionID" class="required" name="ConditionID">
                    <option value="">-- condition --</option>
                    <?php $co = $this -> db -> order_by('ConditionID', 'asc') -> get('conditions');
                        GetCombobox($co, 'ConditionID', 'ConditionName', set_value('ConditionID'));
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="Price">Price</label></th>
            <td>
                <input type="text" id="Price" name="Price" class="required text number" value="<?=set_value('Price')?>" />
                <input type="checkbox" name="IsNego" id="IsNego" value="1" />
                <label for="IsNego">Nego</label>
            </td>
        </tr>
            <tr>
                <th>Country</th>
                <td>
                    <select id="CountryID" class="required" name="CountryID">
                        <option value="">-- country --</option>
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
            <th><label for="Description">Description</label></th>
            <td>
                <!-- <textarea name="Description" id="Description"><?=set_value('Description')?></textarea> -->
                <!-- <label for="Description"><h3>Description</h3></label> -->
                <textarea id="Description" name="Description"><?=set_value('Description')?></textarea>
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
                </script>
            </td>
        </tr>
        <tr>
            <th><label for="MediaID"><h3>Picture</h3></label></th>
            <td>
                <fieldset>
                <ul class="sortable gambars" style="list-style: none; padding: 0;" id="gambars">
                    <li>
                        <a href="#" class="selectpicture">Upload</a>
                    </li>
                </ul>
            </fieldset>
            </td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td><button type="submit" class="ui">Save</button></td>
        </tr>
    </table>
    <?=form_close()?>
    </div>
    
    <form id="uploader" enctype="multipart/form-data" method="post">
        <input type="file" style="visibility: hidden" id="filer" name="userfile" class="userfile" />
    </form>

    <div class="clear"></div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        function pushuploader(){
            $('.ui').button();
            var uploadercontent = '<li>'+
                                    '<center><a href="#" class="selectpicture">Upload</a>'+
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


<?php $this -> load -> view('footer')?>
