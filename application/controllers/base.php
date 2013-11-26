<?php
/**
 * 
 */
class Base extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> model('mpage');
	}
	
	function index(){
	    $pageid = GetSetting("HomePageID");
        $data['result'] = $this -> mpage -> getall(array('PageID'=>$pageid))->row();
        $data['title'] = "";
        
		$this -> load -> view('base.php', $data);	
	}
	
	function add($ab){
		$this -> load -> view ('utama.php');
        
	}
    
    function tim(){
        $this -> load -> view ('tim.php');
        
    }
	
	
}
