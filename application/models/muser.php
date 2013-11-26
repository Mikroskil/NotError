<?php

/**
 * 
 */
class MUser extends CI_Model {
	
    var $table = 'users';
	function __construct() {
		parent::__construct();
	}
    
    function login($username, $password){
        $password = md5($password);
        
        $this -> db -> where(array('UserName'=>$username,'Password'=>$password));
        $cek = $this -> db -> get($this -> table);
        
        if($cek -> num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    function insert($data){
        $this -> db -> insert($this -> table, $data);
    }
    
    function update($id, $data){
        $this -> db -> update($this -> table,$data,array('UserName'=>$id));
    }
    
    function delete($id){
        $this -> db -> where('UserName',$id);
        $this -> db -> delete($this -> table);
        
        return TRUE;
    }
    
    function getall($param=""){
       if(!empty($param)){
           $this -> db -> where($param);
       }
       return $this -> db -> get($this->table);
       
   }
}
