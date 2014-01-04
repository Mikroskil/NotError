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