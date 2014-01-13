<?php

/**
 * 
 */
class Setting extends CI_Controller {  
    function __construct() {
        parent ::__construct();
    }
    
    function sethome($id){
        cekLogin();
        
        setSetting('HomePageID', $id);
        redirect('page');
        
    }
    
    function save(){
        cekLogin();
        $r = $this->input->get('redirect');
        $posts = $this->input->post();
        
        foreach ($posts as $settingname => $settingvalue){
            $this->msetting->Set($settingname,$settingvalue);
        }
        
        if(empty($r)){
            redirect(site_url('setting/general')."?success=1");
        }else{
            redirect(site_url($r)."?success=1");
        }
    }
    
    function general(){
        cekLogin();
        $data['title'] = 'General Setting';
        $data['r']      = $this -> msetting -> GetGeneral();
        
        $this -> load -> view('setting/general', $data);  
   
    }
    
    function email(){
        cekLogin();
        $data['title']  = 'Email Setting';
        
        $this -> load -> view('setting/email', $data);
    }
    
    
    function logo(){
        cekLogin();
        $data['title'] = 'Logo';
        $rules = array(
                        array(
                            'field'=>'MediaPath',
                            'label'=>'Logo',
                            'rules'=>'required'
                        )
        );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $this->db->where('SettingName','Logo');
            $data = array('SettingValue'=>$this->input->post('MediaPath'));
            $this->db->update('settings',$data);
            redirect(current_url()."?success=1", $data);
        }else{
            $this->load->view('setting/logo', $data);
        }
    }
    
    function favicon(){
        cekLogin();
        $data['title'] = 'Favicon';
        $rules = array(
                        array(
                            'field'=>'MediaPath',
                            'label'=>'Favicon',
                            'rules'=>'required'
                        )
        );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $this->db->where('SettingName','Favicon');
            $data = array('SettingValue'=>$this->input->post('MediaPath'));
            $this->db->update('settings',$data);
            redirect(current_url()."?success=1", $data);
        }else{
            $this->load->view('setting/favicon', $data);
        }
    }
}
