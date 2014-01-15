<?php $this -> load -> view('admin/header')?>

<style type="text/css">
    .placeholder {
        border: 1px dashed #4183C4;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .mjs-nestedSortable-error {
        background: #fbe3e4;
        border-color: transparent;
    }

    ul {
        margin: 0;
        padding: 0;
        padding-left: 30px;
    }

    ul.sortable, ul.sortable ul {
        margin: 0 0 0 25px;
        padding: 0;
        list-style-type: none;
    }

    ul.sortable {
        margin: 1em 0;
    }

    .sortable li {
        border: 1px solid #d4d4d4;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
        padding: 7px;
        margin: 5px;
        cursor: move;
        background: #f6f6f6;
        background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(47%,#f6f6f6), color-stop(100%,#ededed));
        background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        background: linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 );
        font-weight: bold;
        color: #444;
    }
    .sortable li .edit{
        float: right;
    }
</style>

<h2><?=$title?></h2>

<div style="background-color: #FFF;border-radius: 6px;box-shadow: 0 1px 2px rgba(0,0,0,0.3);padding: 15px 10px">

<?php if(validation_errors()){ ?>
    <div class="error">
        <?=validation_errors()?>
    </div>
<?php } ?>

<?php if($this -> input -> get('success')){ ?>
    <div class="success">
        Data berhasil di simpan
    </div>
<?php }?>

<?php if($edit){ ?>
<fieldset>
    <legend><h4>Kolom Footer</h4></legend>
<?php }?>

<?=$edit?form_open(site_url('footer/update/'.$result->FooterID),array('id' => 'validate')):form_open(current_url(),array('id' => 'validate'))?>

<label for="FooterName"><h3>Nama Kolom Footer</h3></label>
<input class="required" type="text" id="FooterName" name="FooterName" value="<?=$edit?$result->FooterName:set_value('FooterName')?>" />

<label for="TotalColumn"><h3>Total Kolom Footer</h3></label>
<input class="required" type="text" id="TotalColumn" name="TotalColumn" value="<?=$edit?$result->TotalColumn:set_value('TotalColumn')?>" />


<!-- <br /><br />
<input id="aktif" name="IsShow" type="checkbox" style="vertical-align: middle" <?=$edit?$result->IsShow?'checked=""':'':''?> value="1"  />
<label for="aktif"> langsung ditampilkan</label> -->
<br /><br />

<?=$edit?'<button type="submit" class="ui">Ubah</button>':'<button type="submit" class="ui">Simpan</button>'?>

<!-- <button type="submit" class="ui">
    Simpan
</button> -->

<?=form_close()?>

<?php if($edit){ ?>
    </fieldset>    
<?php }?>



<?php if($edit){ ?>
<br />

<?=anchor('footer/addHTML','+ HTML Biasa',array('class'=>'addHTML ui'))?>
<br />
    
<?=form_open(site_url('footer/save/'.$result -> FooterID))?>    
<fieldset>
    <legend><h4>Detail Kolom Footer</h4></legend>
    
    <div style="width: 100%">

    <?php foreach ($footers as $footer) { ?>
        <div class="column sidebarcontainer" id="SidebarLeftContainer">
            <div class="ui-widget-header">
                <h3>Footer Kolom <?=$footer['index']+1?></h3>
            </div>
            <ul id="" class="sortable draghere" style="min-height: 50px;">
                <?php
                    foreach ($footer['Data']->result() as $footerc) {
                        ?>
                        <li class="ui-state-default">
                            <span class="menuTitle"><?=$footerc->FooterDetailName?></span>
                            <span class="edit">
                                <a href="#" class="editSidebar">edit</a> | <a class="hapusfooterc" href="#">hapus</a>
                                <textarea name="SidebarHTML[]" class="SidebarHTML" style="display:none"><?=$footerc->HTMLFooter?></textarea>
                                <input type="hidden" name="SidebarName[]" class="SidebarName" value="<?=$footerc->FooterDetailName?>" />
                                <input type="hidden" name="IsLeft[]" class="IsLeft" value="<?=$footerc->Index?>" />
                            </span>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <?php if(($footer['index']+1) % 2 == 0){ ?>
        <div class="clear"></div>
        <?php } ?>
    <?php } ?>
    <div class="clear"></div>
    </div>
    
    <br /><br />
    <button type="submit" class="ui">
        Simpan
    </button>    
    
</fieldset>

<?=form_close()?>

<?php }?>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $( ".draghere" ).sortable({
            connectWith: ".draghere",
            stop : function(e,ui){
                var parent = $(ui.item).parents('.sidebarcontainer');
                var idx = $('.sidebarcontainer').index(parent);
                $('.IsLeft',ui.item).val(idx);
            }
        });
                
        $('.addHTML').click(function(){
            var a = this;
            $('#GeneralDialog').load($(a).attr('href'),{'edit':0},function(){
                if (CKEDITOR.instances['SidebarHTML']) {
                    CKEDITOR.remove(CKEDITOR.instances['SidebarHTML']);
                }
                $('#GeneralDialog').find('#SidebarHTML').ckeditor();
                $(this).dialog({
                    buttons : {
                        "OK" : function(){
                            if($('#SidebarHTML').val()==""){
                                alert('Silahkan isi HTML');
                                return;
                            }
                            if($('#SidebarName').val()==""){
                                alert('Silahkan isi Nama Sidebar');
                                return;
                            }
                            var cont = '<li class="ui-state-default">'+
                                '<span class="menuTitle">'+$('#SidebarName').val()+'</span>'+
                                '<span class="edit">'+
                                    '<a href="#" class="editSidebar">edit</a> | <a class="hapusfooterc" href="#">hapus</a>'+
                                    '<textarea name="SidebarHTML[]" class="SidebarHTML" style="display:none">'+$('#SidebarHTML').val()+'</textarea>'+
                                    '<input type="hidden" name="SidebarName[]" class="SidebarName" value="'+$('#SidebarName').val()+'" />'+
                                    '<input type="hidden" name="IsLeft[]" class="IsLeft" value="0" />'
                                '</span>'
                            '</li>';
                            $('.draghere').eq(0).append(cont);
                            activateedit();
                            activatehapus();
                            $(this).dialog('close');
                        },
                        "Batal" : function(){
                            $(this).dialog('close');
                        }
                    },
                    'width' : 900,
                    'height' : 520,
                    "title" : "HTML Biasa",
                    "modal" : true
                });
            });
            return false;
        });
        
        
        function activateedit(){
            $('.editSidebar').unbind().click(function(){
                var a = this;
                var idx = $('.editSidebar').index(this);
                $('#GeneralDialog').load('<?=site_url('footer/addhtml')?>',{'edit':1},function(){
                    if (CKEDITOR.instances['SidebarHTML']) {
                        CKEDITOR.remove(CKEDITOR.instances['SidebarHTML']);
                    }
                    $('#GeneralDialog').find('#SidebarHTML').ckeditor();
                    $('#SidebarName').val($('.SidebarName').eq(idx).val());
                    $('#SidebarHTML').val($('.SidebarHTML').eq(idx).val());
                    $(this).dialog({
                        buttons : {
                            "OK" : function(){
                                if($('#SidebarHTML').val()==""){
                                alert('Silahkan isi HTML');
                                return;
                                }
                                
                                if($('#SidebarName').val()==""){
                                    alert('Silahkan isi Nama Sidebar');
                                    return;
                                }
                                
                                $('.SidebarName').eq(idx).val($('#SidebarName').val());
                                $('.menuTitle').eq(idx).html($('#SidebarName').val());
                                $('.SidebarHTML').eq(idx).val($('#SidebarHTML').val());
                                
                                $(this).dialog('close');
                            },
                            "Batal" : function(){
                                $(this).dialog('close');
                            }
                        },
                        "title" : "Ubah Sidebar",
                        "width" : 900,
                        "height": 550,
                        "modal" : true
                    });
                });
                return false;
            });
        }
        activateedit();
        
        function activatehapus(){
            $('.hapusfooterc').unbind().click(function(){
                var yakin = confirm('Apa anda yakin?');
                if(yakin){
                    $(this).closest('li').fadeOut(500,function(){
                        $(this).remove();
                    });
                }
            });
        }
        activatehapus();
        
    });
</script>


<?php $this -> load -> view('admin/Footer')?>
