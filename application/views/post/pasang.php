<?php $this -> load -> view('header')?>

<div>
    <?php $this -> load -> view('user/nav')?>
    
    <div class="dash_user">
        <h2><?=$title?></h2>        
        
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
                <textarea name="Description" id="Description"><?=set_value('Description')?></textarea>
            </td>
        </tr>
        <tr>
            <th>Picture</th>
            <td></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td><button type="submit" class="ui">Save</button></td>
        </tr>
    </table>
    <?=form_close()?>
    </div>
    <div class="clear"></div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
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
