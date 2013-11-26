<?php
/**
 * 
 */
class User extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> model('muser');
	}
    
    function login(){
        $data['title'] = 'Login';
        
        $username = $this -> input -> post('UserName');
        $password = $this -> input -> post('Password');
        
        $rules = array(
            array(
                'field' => 'UserName',
                'label' => 'UserName',
                'rules' => 'required'
            ),
            array(
                'field' => 'Password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
            if($this -> muser -> login($username,$password)){
                $this -> session -> set_userdata(array(ADMINLOGIN => $username));
                
                if($this -> input -> post('redirect') == ""){
                    if($this -> session -> userdata(ADMINLOGIN) != ""){
                        redirect('user/dashboard');
                    }
                }else{
                    if($this -> session -> userdata(ADMINLOGIN) != ""){
                        redirect($this -> input -> post('redirect'));
                    }
                }
                
            }else{
                $this -> load -> view('user/login',$data);
            }
            
        }else{
            $this -> load -> view('user/login', $data);    
        }
        
    }

    function logout(){
        $this->session->unset_userdata(ADMINLOGIN);
        
        redirect(site_url());
    }
    
    
    
    function dashboard(){
        cekLogin();
        $data['title']  = 'Dashboard';
        
        
        $this -> load -> view('user/dashboard', $data);
    }
    
    
}
