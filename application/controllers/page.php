<?php
/**
 * 
 */
class Page extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> model('mpage');
	}
    
    function index(){
        ceklogin();
        $data['title'] = 'All Page';
        $data ['all'] = $this -> mpage -> getall();
        
        $this -> load -> view('page/data',$data);
    }
    
    function add(){
        ceklogin();
        $data['edit'] = FALSE;
        $data['title'] = 'Add New Page';
        
        $rules = array(
            array(
                'field' => 'PageTitle',
                'label' => 'page title',
                'rules' => 'required'
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
            $pageurl = ($this->input->post('PageURL')=="") ? url_title(strip_tags(strtolower($this->input->post('PageTitle')))) : strtolower($this->input->post('PageURL'));
            $pageurl = str_replace('.', '-', $pageurl);
            
            $lastid = $this -> mpage -> getlast();
            
            $insert = array(
                    'PageID'        => $lastid,
                    'PageTitle'     => $this -> input -> post('PageTitle'),
                    'HTML'          => $this -> input -> post('HTML'),
                    'CSS'           => $this -> input -> post('CSS'),
                    'Javascript'    => $this -> input -> post('Javascript'),
                    'PageURL'       => $pageurl,
                    'ShowTitle'     => $this -> input -> post('ShowTitle'),
                    'CreatedBy'     => getAdminLogin('UserName'),
                    'CreatedOn'     => date('Y-m-d H:i:s')
            );
            
            $this -> mpage -> insert($insert);
            
            redirect(site_url('page/edit/'.$lastid).'?success=1');
                
        }else{
            $this -> load -> view('page/form', $data);
        }
        
        
    }
    
    function edit($id){
        ceklogin();
        $data['edit'] = TRUE;
        $data['title'] = 'Change Page';
        
        $data['result'] = $this -> mpage -> getrow($id);
        
        $rules = array(
            array(
                'field' => 'PageTitle',
                'label' => 'page title',
                'rules' => 'required'
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
            $pageurl = ($this->input->post('PageURL')=="") ? url_title(strip_tags(strtolower($this->input->post('PageTitle')))) : strtolower($this->input->post('PageURL'));
            $pageurl = str_replace('.', '-', $pageurl);
            
            $update = array(
                    'PageTitle'     => $this -> input -> post('PageTitle'),
                    'HTML'          => $this -> input -> post('HTML'),
                    'CSS'           => $this -> input -> post('CSS'),
                    'Javascript'    => $this -> input -> post('Javascript'),
                    'PageURL'       => $pageurl,
                    'ShowTitle'     => $this -> input -> post('ShowTitle'),
                    'UpdateBy'     => getAdminLogin('UserName'),
                    'UpdateOn'     => date('Y-m-d H:i:s')
            );
            
            $this -> mpage -> update($id,$update);
            
            redirect(site_url('page/edit/'.$id).'?success=1');
                
        }else{
            $this -> load -> view('page/form', $data);
        }
    }
    
    function delete(){
        ceklogin();
        $cek = $this -> input -> post('cek');
        $delete = 0;
        
        if(empty($cek)){
            redirect('post');
        }
        
        for ($i=0; $i < count($cek); $i++) {
            $this -> mpage -> delete($cek[$i]);
            $delete++; 
        }
        
        redirect(site_url('post').'?deleted=1');
        
    }
    
    
    
    
}

