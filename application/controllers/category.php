<?php

/**
 * 
 */
class Category extends CI_Controller {	
	function __construct() {
		parent ::__construct();
		$this -> load -> model('mcategory');
	}
	
	function index(){
	    cekLogin();
		$data['title'] = 'All Category';
		$data['all']   = $this -> mcategory -> getall(); 
		$this -> load -> view('category/data',$data);		
		
	}
	
	function add(){
	    cekLogin();
        $data['edit']   = FALSE;
        $data['title']  = 'New Category';
        
        $rules=array(
            array(
                'field'=>'CategoryName',
                'label'=>'Category Name',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            $url = ($this->input->post('CategoryURL')=="") ? url_title(strip_tags(strtolower($this->input->post('CategoryName')))) : strtolower($this->input->post('CategoryURL'));
            $url = str_replace('.', '-', $url);
            
            $last = $this -> mcategory -> getlast();
            
            $insert=array(
                'CategoryID'        => $last,
                'CategoryName'      => $this -> input -> post('CategoryName'),
                'IsParent'          => $this -> input -> post('IsParent'),
                'CategoryURL'       => $url,
                'Description'       => $this -> input -> post('Description'),
                'ViewTypeID'        => $this -> input -> post('ViewTypeID'),
                'SidebarRight'      => $this -> input -> post('SidebarRight'),
                'SidebarLeft'       => $this -> input -> post('SidebarLeft'),
                'IsSystem'          => 0
                
                
            );
            $this->mcategory->insert($insert);
        
            redirect(site_url('category/edit/'.$last).'?success=1');
        
        }else{
            
            $this->load->view('category/form',$data);
        	}
        }

		function edit($id){
        ceklogin();
        $data['edit']   = TRUE;
        $data['title']  = 'Change Category';
        $data['result'] = $this -> mcategory -> getrow($id);
        
        $rules = array(
            array(
                'field'=>'CategoryName',
                'label'=>'Category Name',
                'rules'=>'required'
            
            ),
        );
        
        $this ->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $url = ($this->input->post('CategoryURL')=="") ? url_title(strip_tags(strtolower($this->input->post('CategoryName')))) : strtolower($this->input->post('CategoryURL'));
            $url = str_replace('.', '-', $url);
            
            $last=$this->mcategory->getlast();
            
            $insert=array(
                #'PostID'=>$last,
                'CategoryName'      => $this -> input -> post('CategoryName'),
                'IsParent'          => $this -> input -> post('IsParent'),
                'CategoryURL'       => $url,
                'Description'       => $this -> input -> post('Description'),
                'ViewTypeID'        => $this -> input -> post('ViewTypeID'),
                'SidebarRight'      => $this -> input -> post('SidebarRight'),
                'SidebarLeft'       => $this -> input -> post('SidebarLeft'),
                'IsSystem'          => 0
            );
            $this->mcategory->update($id,$insert);
        
            redirect(site_url('category/edit/'.$id).'?success=1');
        
        }else{
            
            $this -> load -> view('category/form',$data);
        }
    }


	
	function delete(){
	    cekLogin();
        $cek = $this -> input -> post('cek');
        $delete = 0;
        
        if(empty($cek)){
            redirect('category');
        }
        
        for ($i=0; $i < count($cek); $i++) {
            $this -> mcategory -> delete($cek[$i]);
            $delete++; 
        }
        
        redirect(site_url('category').'?deleted=1');
        
    }
}

