<?php

/**
 * 
 */
class MCategory extends CI_Model {
	
    var $table ='categories';
	function __construct() {
		parent::__construct();
	}

    function insert($data){
        $this -> db -> insert($this->table,$data);
        
    }
    
    function update($id,$data){
        $this -> db -> update($this ->table,$data,array('CategoryID'=>$id));
        
    }

    function delete(){
        $this -> db -> where ('CategoryID',$id);
        $this -> db -> delete ($this->table);
        
        return TRUE;
    }
    
    function getall(){        
        return $this -> db -> get($this->table);
        
    }
    
    function getlast(){
        $cek=$this->db->order_by('CategoryID','desc')->limit(1)->get($this->table)->row();
        
        if(empty($cek)){
            return 1;
            
        }else{
            return $cek->CategoryID + 1;
        }
        
    }
    
    function getrow($id){
        return $this->db->where('CategoryID',$id)->get($this->table)->row();
    }
    
    function getid($name){
        return $this->db->where('CategoryURL',$name)->get($this->table)->row();
    }

}




