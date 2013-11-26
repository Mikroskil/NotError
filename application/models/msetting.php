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
    
    
}
