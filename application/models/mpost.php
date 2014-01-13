<?php
/**
 * 
 */
class MPost extends CI_Model {
	
    var $table='posts';
    var $postimage  = 'postimages';
    
	function __construct() {
	    parent::__construct();
	}
    
    function GetPostImage($id){
        $this -> db -> where('PostID', $id);
        $this -> db -> order_by('PostImageID','asc');
        $this -> db -> join('media m', 'm.MediaID = pm.MediaID','left');
        return $this -> db -> get($this -> postimage.' pm');
    }
    
    function GetLastPostImage(){
        $cek = $this -> db -> order_by('PostImageID','desc') -> limit(1) -> get($this -> postimage) -> row();
        if(empty($cek)){
            return 0;
        }else{
            return $cek -> PostImageID;
        }
    }
    
    function insert($data){
        $this ->db->insert($this->table,$data);
    }
    
    function insertpostimage($data){
        $this -> db -> insert($this ->postimage, $data);
    }
    
    function update($id,$data){
        $this->db->update($this->table,$data,array('PostID'=>$id));
    }
    
    function delete($id){
        $this -> db -> where('PostID',$id);
        $this -> db -> delete($this -> table);
        $this->db->where('PostID',$id);
        $this->db->delete($this -> postimage);
        
        return TRUE;
    }

    function deletepostimage($id){
        $this->db->where('PostID',$id);
        $this->db->delete($this -> postimage);
        
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
    
    
    
    function GetByKeyword($id,$limit=0,$offset=0,$orderby="",$order=""){
        $this->db->like(array('p.PostTitle'=>$id));
        
        if($limit > 0){
            $this->db->limit($limit,$offset);
        }
        
        if($order == "asc" || $order == "desc"){
            if(!empty($orderby)){
                $this->db->order_by($orderby,$order);
            }
        }
        
        $this->db->order_by('PostedOn','desc');
        $this->db->group_by('p.PostID');
        
        $ret = $this->db->get($this->posttable." p");
        return $ret;
    }
    
    
    
    
    
}
