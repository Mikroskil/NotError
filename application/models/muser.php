<?php

/**
 * 
 */
class MUser extends CI_Model {
	
    var $table = 'users';
	var $info = 'userinformations';
	function __construct() {
		parent::__construct();
	}
    
    function login($username, $password){
        $password = md5($password);
        
        $this -> db -> where(array('UserName'=>$username,'Password'=>$password,'RoleID'=>1));
        $cek = $this -> db -> get($this -> table);
        
        if($cek -> num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
	
	function userLogin($username, $password){
        $password = md5($password);
        
        $this -> db -> where(array('UserName'=>$username,'Password'=>$password,'RoleID'=>2));
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
    function insertinfo($data){
        $this -> db -> insert($this -> info, $data);
    }
    
    function update($id, $data){
        $this -> db -> update($this -> table,$data,array('UserName'=>$id));
    }
    function updateinfo($id, $data){
        $this -> db -> update($this ->info,$data,array('UserName'=>$id));
    }
    
    function delete($id){
        $this -> db -> where('UserName',$id);
        $this -> db -> delete($this -> table);
        $this -> db -> where('UserName',$id);
        $this -> db -> delete($this -> info);
        
        return TRUE;
    }
    
    function getall($param=""){
       if(!empty($param)){
           $this -> db -> where($param);
       }
       $this -> db -> join('userinformations ui', 'ui.UserName = u.UserName','LEFT');
       return $this -> db -> get($this->table. ' u');
       
   }
	
	function getrow($user){
		$this -> db -> join ('userinformations ui','ui.UserName = u.UserName','LEFT');
		return $this -> db -> where('u.UserName',$user) -> get($this -> table.' u') -> row();
	}
	
}
