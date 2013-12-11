<?php
/**
 * 
 */
class Comment extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> model('mcomment');
	}
    
    function index(){
        ceklogin();
        $data['title']  = 'All Comment';
        $data['all']    = $this -> mcomment -> getall();
        
        $this -> load -> view('comment/data', $data);
    }
}
