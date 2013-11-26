<?php
/**
 * 
 */
class Mpage extends CI_Model {
	var $table='pages';
	function __construct() {   
	   parent::__construct();
    }
    
    function insert($data){
        $this -> db -> insert($this->table,$data);
    }
    
    function update($id,$data){
        $this -> db -> update($this->table,$data,array('PageID'=>$id));
        
    }
    
    function delete ($id){
        $this -> db -> where('PageID',$id);
        $this -> db -> delete($this -> table);
        
        return TRUE;
    }
    
     function getlast(){
        $cek=$this->db->order_by('PageID','desc')->limit(1)->get($this->table)->row();
        
        if(empty($cek)){
            return 1;
            
        }else{
            return $cek->PageID + 1;
        }
        
    }
    
    function getrow($id){
        return $this->db->where('PageID',$id)->get($this->table)->row();
    }
    
   function getall($param=""){
       if(!empty($param)){
           $this -> db -> where($param);
       }
       return $this -> db -> get($this->table);
       
   } 
    
    
}
