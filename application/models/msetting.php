<?php
/**
 * 
 */
class MSetting extends CI_Model {
	var $table = 'settings';
	function __construct() {
		parent::__construct();
	}
    
    function getall($settingname){
        $a = $this->db->where('SettingName',$settingname)->get($this->table)->row();
        if(empty($a)){
            return "";
        }else{
            return $a->SettingValue;
        }
    }
    
    function GetGeneral(){
        return $this->db->where('IsGeneral',1)->get($this->table);
    }
    
    function Get($settingname){
        $a = $this->db->where('SettingName',$settingname)->get($this->table)->row();
        if(empty($a)){
            return "";
        }else{
            return $a->SettingValue;
        }
    }
    
    function Set($settingname,$value){
        $this->db->where('SettingName',$settingname);
        $data = array('SettingValue'=>$value);
        $this->db->update($this->table,$data);
        return TRUE;
    }
    
    
}
