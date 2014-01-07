<?php
/**
 * 
 */
class MWidget extends CI_Model {
	
    var $table='widgets';
	function __construct() {
		parent::__construct();
	}
    
    function insert ($data){
        $this -> db -> insert($this -> table,$data);
    }
    
    function update ($id,$data){
        $this -> db -> update($this -> table,$data,array('WidgetID'=>$id));
    }
    
     function delete ($id){
        $this -> db -> where('WidgetID',$id);
        $this -> db -> delete($this -> table);
        
        return TRUE;
    }
     
     function getlast(){
         $cek=$this->db->order_by('WidgetID','desc')->limit(1)->get($this->table)->row();
        
        if(empty($cek)){
            return 1;
            
        }else{
            return $cek->WidgetID + 1;
        }
     }
     
     function getrow($id){
        return $this->db->where('WidgetID',$id)->get($this->table)->row();
    }
    
       function getall(){
           return $this -> db -> get($this->table);
           
       } 
    
     
     
     
}

