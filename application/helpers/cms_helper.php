<?php

define('ADMINLOGIN', 'AdminLogin');
define('USERLOGIN', 'UserLogin');

if(!function_exists('FileExtension_Check')){
    function FileExtension_Check($filename,$filetype){
        $file = explode(".", $filename);
        $extension = $file[count($file)-1];
        $extension = strtolower($extension);
        if($filetype == "gambar"){
            if($extension != "jpg" && $extension != "jpeg" && $extension != "gif" && $extension != "png"){
                return FALSE;
            }
        }
        return TRUE;
    }
}

if(!function_exists('FileExtension')){
    function FileExtension($filename){
        $file = explode(".", $filename);
        $extension = $file[count($file)-1];
        return $extension;
    }
}

function media_url(){
    return base_url()."assets/images/media/";
}

function template_url(){
    $CI =& get_instance();
    $CI->load->helper('url');
    if($CI->input->get('previewtheme')!=""){
        return base_url()."assets/themes/".$CI->input->get("previewtheme")."/";
    }else{
        return base_url()."assets/themes/".ACTIVETHEME."/";
    }
}

function cekLogin(){
    $CI =& get_instance();
    $CI->load->library('session');
    
    if($CI->session->userdata(ADMINLOGIN)){
        return TRUE;
    }else{
        show_error('Silahkan Login Kembali');
    }
}

function cekUserLogin(){
    $CI =& get_instance();
    $CI->load->library('session');
    
    if($CI->session->userdata(USERLOGIN)){
        return TRUE;
    }else{
        show_error('Silahkan Login Kembali');
    }
}

function getAdminLogin($param=""){
    $CI =& get_instance();
    $CI->load->library('session');
    
    $CI->load->model('muser');
    $username = $CI->session->userdata(ADMINLOGIN);
    
    if(empty($param)){
        return $CI->muser->getall(array('u.UserName'=>$username));
    }else{
        $res = $CI->muser->getall(array('u.UserName'=>$username))->row();
        return $res->$param;
    }
}

function getUserLogin($param=""){
    $CI =& get_instance();
    $CI->load->library('session');
    
    $CI->load->model('muser');
    $username = $CI->session->userdata(USERLOGIN);
    
    if(empty($param)){
        return $CI->muser->getall(array('u.UserName'=>$username));
    }else{
        $res = $CI->muser->getall(array('u.UserName'=>$username))->row();
        return $res->$param;
    }
}


function getSetting($settingname){
    $CI =& get_instance();
    $CI->load->database();
    $CI->load->model('msetting');
    return $CI->msetting->getall($settingname);
}

function setSetting($settingname,$settingvalue){
    $CI =& get_instance();
    $CI->load->database();
    $res = $CI->db->where(array('SettingName'=>$settingname))->get('settings')->row();
    if(empty($res)){
        $data = array('SettingName'=>$settingname,'SettingValue'=>$settingvalue);
        $CI->db->insert('settings',$data);
    }else{
        $data = array('SettingValue'=>$settingvalue);
        $CI->db->where(array('SettingName'=>$settingname));
        $CI->db->update('settings',$data);
    }
}

function Do_Shortcode($string){
    $CI = & get_instance();
    $CI->load->library('shortcodes');
    return $CI->shortcodes->parse($string);
}

function strip_shortcode($string){
    $find1 = "[";
    $find2 = "]";
    $pos1 = strpos($string, $find1);
    $pos2 = strpos($string, $find2);
    
    if($pos1 === FALSE || $pos2===FALSE){
        return $string;
    }
    
    $newstring = "";
    $newstring .= substr($string, 0,$pos1);
    $newstring .= substr($string, $pos2+1);
    return $newstring;
}

function parse_form($str){
    $CI =& get_instance();
    $CI->load->helper('captcha');
    $str = str_replace(array('{%','%}'), array('<','>'), $str);
    $str = str_replace(array('*action*','*base_url*','*ref*'), array(site_url('form/execute'),base_url(),$CI->input->get('ref')), $str);
    
    $rand = rand(000000,999999);
    
    $vals = array(
        'word' => $rand,
        'img_path' => './assets/images/captcha/',
        'img_url' => base_url().'assets/images/captcha/',
        'font_path' => './assets/fonts/Quartz.ttf',
        'img_width' => 150,
        'img_height' => 30,
        'expiration' => 7200
    );

    $cap = create_captcha($vals);
    $CI->load->library('session');
    $CI->session->set_userdata(array('Captcha'=>$rand));
    
    $str = str_replace(array('*captcha*'), $cap['image'], $str);
    return $str;
}


function getMediaPath($id){
    $CI =& get_instance();
    $CI->load->database();
    $cek = $CI->db->where('MediaID',$id)->get('media')->row();
    if(empty($cek)){
        return "";
    }else{
        return $cek->MediaFullPath;
    }
}

function getCombobox($object,$primary,$view,$selected=""){
    $CI =& get_instance();
    $CI->load->database();
    foreach ($object->result_array() as $r) {
        if(is_array($view)){
            $views = $r[$view[0]]." (".$r[$view[1]].")";
        }else{
            $views = $r[$view];
        }
        if(is_array($selected)){
            if(in_array($r[$primary], $selected)){
                echo '<option selected="selected" value="'.$r[$primary].'">'.$views.'</option>';
            }else{
                echo '<option value="'.$r[$primary].'">'.$views.'</option>';
            }
        }else{
            if($r[$primary] == $selected){
                echo '<option selected="selected" value="'.$r[$primary].'">'.$views.'</option>';
            }else{
                echo '<option value="'.$r[$primary].'">'.$views.'</option>';
            }
        }
    }
}


function GetMedia($id){
    $CI =& get_instance();
    $CI->load->database();
    $cek = $CI->db->where('MediaID',$id)->get('media')->row();
    if(empty($cek)){
        return FALSE;
    }else{
        return media_url().$cek -> MediaPath;
    }
}

function ActiveTheme(){
    $CI =& get_instance();
    $CI->load->helper('url');
    if($CI->input->get('previewtheme')!=""){
        return $CI->input->get('previewtheme');
    }else{
        return ACTIVETHEME;
    }
}

function ActiveThemePath(){
    return THEMEPATH.ActiveTheme();
}


function GetFooterColumn($classy=''){
    $CI = & get_instance();
    $CI->load->database();
    $CI->load->library('shortcodes');
    #$langid = ActiveLangID();
    
    $footers = $CI->db->where(array('IsShow'=>1))->order_by('Order','asc')->get('footers');
    
    foreach ($footers->result() as $footer) {
    
        $columnname = $footer->TotalColumn;
        
        if(empty($classy)){
            $classy = "footercol";
        }
        for ($i=0; $i < $columnname; $i++) {
            $class = $classy;
            if($i == ($columnname-1)){
                $class .= ' last';
            }
            if($i == 0){
                $class .= ' first';
            }
            $width = floor(100/$columnname);
        ?>
            <div class="<?=$class?>" style="width: <?=$width?>%">
                <div class="in">
                <?php
                    $r = $CI->db->where('Index',$i)->where('FooterID',$footer->FooterID)->order_by('Order','asc')->get('footerdetails');
                    echo "<ul>";
                        foreach ($r->result() as $side) {
                            $content = $CI->shortcodes->parse($side->HTMLFooter);
                            ?>
                            <li>
                                <h2><?=$side->FooterDetailName?></h2>
                                <?=$content?>
                            </li>
                            <?php
                        }
                    echo "</ul>";
                ?>
                </div>
            </div>
        <?php
        }
        echo '<div class="clear"></div>';
    }
}