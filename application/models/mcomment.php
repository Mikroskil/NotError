<?php
/**
 * 
 */
class MComment extends CI_Model {
	
    var $table = 'comments';
    
	function __construct() {
		parent::__construct();
	}
    
    function insert($data){
        $this -> db -> insert($this -> table, $data);
    }
    
    function getall(){
        return $this -> db -> get($this -> table);
    }
}
