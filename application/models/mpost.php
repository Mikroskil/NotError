<?php
/**
 * 
 */
class MPost extends CI_Model {
	
    var $table='posts';
	function __construct() {
	    parent::__construct();
	}
    
    function insert($data){
        $this ->db->insert($this->table,$data);
    }
    
    function update($id,$data){
        $this->db->update($this->table,$data,array('PostID'=>$id));
    }
    
    function delete($id){
        $this -> db -> where('PostID',$id);
        $this -> db -> delete($this -> table);
        
        return TRUE;
    }
    
    function getlast(){
        $cek=$this->db->order_by('PostID','desc')->limit(1)->get($this->table)->row();
        
        if(empty($cek)){
            return 1;
            
        }else{
            return $cek->PostID + 1;
        }
        
    }
    
    function getrow($id){
        return $this->db->where('PostID',$id)->get($this->table)->row();
    }
    
    function getall($param=""){
        if(!empty($param)){
            $this -> db -> where($param);
        }
        return $this -> db -> get($this -> table); 
    }
    
    
    
    
    
    
    
}
