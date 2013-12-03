<?php

/**
 * 
 */
class MMedia extends CI_Model {
	
    var $table = "media";
	function __construct() {
		parent::__construct();
	}
   function insert($data){
        $this -> db -> insert($this->table,$data);
    }
    
    function update($id,$data){
        $this -> db -> update($this -> table,$data,array('MediaID'=>$id));
        
    }
    
    function delete ($id){
        $this -> db -> where('MediaID',$id);
        $this -> db -> delete($this -> table);
        
        return TRUE;
    }
    
     function getlast(){
        $cek=$this->db->order_by('MediaID','desc')->limit(1)->get($this->table)->row();
        
        if(empty($cek)){
            return 1;
            
        }else{
            return $cek->MediaID + 1;
        }
        
    } 
     
      function getrow($id){
        return $this->db->where('MediaID',$id)->get($this->table)->row();
    }
    
       function getall(){
           return $this -> db -> get($this->table);
           
       } 
    
    
    
}


