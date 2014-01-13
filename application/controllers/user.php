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
            if($this -> muser -> userLogin($username,$password)){
                $this -> session -> set_userdata(array(USERLOGIN => $username));
                
                if($this -> input -> post('redirect') == ""){
                    if($this -> session -> userdata(USERLOGIN) != ""){
                        redirect('user/dashboard');
                    }
                }else{
                    if($this -> session -> userdata(USERLOGIN) != ""){
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
        $this->session->unset_userdata(USERLOGIN);
        
        redirect(site_url());
    }
    
    
    
    function dashboard(){
        cekUserLogin();
        $data['title']  = 'Dashboard';
        
        
        $this -> load -> view('user/dashboard', $data);
    }
	
	function editprofil($user){
		cekUserLogin();
		$data['edit'] = TRUE;
		$data['title'] = "Edit Profile";
		$data['result'] = $this -> muser -> getrow($user);
		
		$rules = array(
			array(
				'field' => 'UserName',
				'label'	=> 'Username',
				'rules' => 'required'		
			),
			array(
				'field' => 'Name',
				'label'	=> 'Name',
				'rules' => 'required'		
			)
		);
		
		$this -> form_validation -> set_rules($rules);
		
        if($this -> form_validation -> run()){
            $update = array(
                       'Name'       => $this -> input -> post('Name'),
                       'PhotoProfile' => $this -> input -> post('MediaID'),
                       'CountryID'    => $this -> input -> post('CountryID'),
                       'ProvinceID'   => $this -> input -> post('ProvinceID'),
                       'CityID'       => $this -> input -> post('CityID'),
                       'Address'    => $this -> input -> post('Address'),
                       'Telp'       => $this -> input -> post('Telp')
            );
            
            $this -> muser -> updateinfo($user, $update);
            
            redirect(site_url('user/editprofil/'.$user).'?success=1');
        }else{
            $this -> load -> view('user/editprofil', $data);    
        }
		
	}

    
    function changepassprofile(){
        cekUserLogin();
        $data['title']  = 'Change Password';
        
        $rules = array(
                        array(
                            'field'=>'Password',
                            'label'=>'Password Baru',
                            'rules'=>'required'
                        )
        );
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
        
            $this -> db -> where('Password', md5($this -> input -> post('OldPassword')));
            $r = $this -> db -> get('users');
            
            if($r -> num_rows() < 1){
                redirect(current_url().'?oldpassword=false');
                #show_error('Password lama tidak tepat');
                #return;
            }
            
            if($this -> input -> post('Password') != $this -> input -> post('RPassword')){
                redirect(current_url().'?newpassword=false');
                #show_error("Password baru tidak sama");
                #return;
            }
            
            $data = array('Password' => md5($this -> input -> post('Password')));
            $this -> db -> update('users', $data, array('UserName' => $this -> session -> userdata(USERLOGIN)));
            redirect(current_url()."?success=1");
        }else{
            $this->load->view('user/changepassprofile', $data);
        }
    }

    function register(){
        $data['title']  = 'Register';
        
        $rules = array(
            array(
                'field' => 'UserName',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'Email',
                'label' => 'Email',
                'rules' => 'required'
            ),
            array(
                'field' => 'Password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );
        
        $username = $this -> input -> post('UserName');
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
            $insert = array(
                    'UserName'      => $username,
                    'Password'      => md5($this -> input -> post('Password')),
                    'RoleID'        => 2,
                    'IsSuspend'     => 0
            );
            $this -> muser -> insert($insert);
            
            $info = array(
                    'UserName'      => $username,
                    'Name'          => $this -> input -> post('Name'),
                    'Email'         => $this -> input -> post('Email')
            );
            $this -> muser -> insertinfo($info);
            
            #echo "<script>alert(Register anda berhasil, Silahkan Login);</script>";
            redirect(current_url().'?success=1');
        }else{
            $this -> load -> view('user/register', $data);    
        }
        
    } 
    
    function add(){
        cekLogin();
        $data['edit'] = FALSE;
        $data['title']  = 'New User';
        
        $rules = array(
            array(
                'field' => 'UserName',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'filed' => 'Password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );
        
        $user = $this -> input -> post('UserName');
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
            
            $insert = array(
                'UserName'  => $user,
                'Password'  => md5($this -> input -> post('Password')),
                'RoleID'    => $this -> input -> post('RoleID'),
                'IsSuspend' => $this -> input -> post('IsSuspend')
            );
            
            $this -> muser -> insert($insert);
            
            $info = array(
                'UserName'  => $user,
                'Name'      => $this -> input -> post('Name'),
                'Email'     => $this -> input -> post('Email'),
                'PhotoProfile'   => $this -> input -> post('MediaID'),
                'CountryID' => $this -> input -> post('CountryID'),
                'ProvinceID' => $this -> input -> post('ProvinceID'),
                'CityID'    => $this -> input -> post('CityID'),
                'Address'   => $this -> input -> post('Address'),
                'Telp'      => $this -> input -> post('Telp')
            );
            
            $this -> muser -> insertinfo($info);
            
            redirect(site_url('user/edit/'.$user).'?success=1');
        }else{
            $this -> load -> view('user/form', $data);    
        }
        
    }
    
    
    function edit($username){
        cekLogin();
        $data['edit'] = TRUE;
        $data['title']  = 'Edit User';
        $data['result'] = $result = $this -> muser -> getrow($username);
        
        $rules = array(
            array(
                'field' => 'UserName',
                'label' => 'Username',
                'rules' => 'required'
            )
        );
        
        $user = $this -> input -> post('UserName');
        
        $this -> form_validation -> set_rules($rules);
        
        if($this -> form_validation -> run()){
            $insert = array(
                'UserName'  => $user,
                'RoleID'    => $this -> input -> post('RoleID'),
                'IsSuspend' => $this -> input -> post('IsSuspend')
            );
            if($this->input->post('Password')!=""){
                $insert['Password'] = md5($this->input->post('Password'));
            }
            $this -> muser -> update($username, $insert);
            
            $info = array(
                'UserName'  => $user,
                'Name'      => $this -> input -> post('Name'),
                'Email'     => $this -> input -> post('Email'),
                'PhotoProfile'   => $this -> input -> post('MediaID'),
                'CountryID' => $this -> input -> post('CountryID'),
                'ProvinceID' => $this -> input -> post('ProvinceID'),
                'CityID'    => $this -> input -> post('CityID'),
                'Address'   => $this -> input -> post('Address'),
                'Telp'      => $this -> input -> post('Telp')
            );
            
            $this -> muser -> updateinfo($username, $info);
               
            redirect(site_url('user/edit/'.$user).'?success=1');
        }else{
            $this -> load -> view('user/form', $data);
        }
    }

        
    function index(){
        cekLogin();
        $data['title']  = 'All User';
        $data['all']    = $this -> muser -> getall();
        
        $this -> load -> view('user/data', $data);
    }
    
    function delete(){
        ceklogin();
        $cek = $this -> input -> post('cek');
        $delete = 0;
        
        if(empty($cek)){
            redirect('user');
        }
        
        for ($i=0; $i < count($cek); $i++) {
            $this -> muser -> delete($cek[$i]);
            $delete++; 
        }
        
        redirect(site_url('user').'?deleted=1');
        
    }
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
    
}
