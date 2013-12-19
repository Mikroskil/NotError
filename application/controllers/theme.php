<?php
/**
 * 
 */
class Theme extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> helper('file');
        $this -> load -> helper('directory');
	}
    
    function index(){
        cekLogin();
        $folder             = array();
        $folder['tema']  = './assets/themes';
        
        $data['folder']     = $folder;   
        $data['themes']     = directory_map($folder['tema']);
        $data['title']  = 'Themes List';
        
        
        $this -> load -> view('theme/data', $data);
    }
    
    function activated($name){
        cekLogin();
        
        setSetting('ActiveTheme', $name);
        
        redirect('theme'.'?success=1');
    }
    
}
