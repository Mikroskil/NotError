<?php
/**
 * 
 */
class Post extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> model('mpost');
	}
    
    function index(){
        ceklogin();
        $data['title'] = 'Post Lists';
        $data['all']   = $this -> mpost -> getall(); 
        
        $this -> load -> view('post/data', $data);
    }
    
    function add(){
        ceklogin();
        $data['edit']   = FALSE;
        $data['title']  = 'Add New Post';
        
        $rules=array(
            array(
                'field'=>'PostTitle',
                'label'=>'post title',
                'rules'=>'required'
            
            ),
            array(
                'field'=>'PostContent',
                'label'=>'post content',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            $last = $this -> mpost -> getlast();
            
            $insert=array(
                'PostID'        => $last,
                'PostTitle'     => $this -> input -> post('PostTitle'),
                'PostContent'   => $this -> input -> post('PostContent'),
                'CategoryID'   => $this -> input -> post('CategoryID'),
                'MediaID'       => $this -> input -> post('MediaID'),
                'PostDate'      => date('Y-m-d H:i:s'),
                'PostExpired'   => date('Y-m-d H:i:s',strtotime($this -> input -> post('PostExpired'))),
                'Description'   => $this -> input -> post('Description'),
                'ShowComment'   => $this -> input -> post('ShowComment'),
                'ShowShare'     => $this -> input -> post('ShowShare'),
                'CreatedBy'     => getAdminLogin('UserName'),
                'CreatedOn'     => date('Y-m-d H:i:s')
            );
            $this->mpost->insert($insert);
        
            redirect(site_url('post/edit/'.$last).'?success=1');
        
        }else{
            
            $this->load->view('post/form',$data);
        }
    }

    function edit($id){
        ceklogin();
        $data['edit']   = TRUE;
        $data['title']  = 'Change Post';
        $data['result'] = $this -> mpost -> getrow($id);
        
        $rules = array(
            array(
                'field'=>'PostTitle',
                'label'=>'post title',
                'rules'=>'required'
            
            ),
            array(
                'field'=>'PostContent',
                'label'=>'post content',
                'rules'=>'required'
            
            )
        );
        
        $this ->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            $last=$this->mpost->getlast();
            
            $insert=array(
                #'PostID'=>$last,
                'PostTitle'     =>$this->input->post('PostTitle'),
                'PostContent'   =>$this->input->post('PostContent'),
                'PostContent'   => $this -> input -> post('PostContent'),
                'CategoryID'   => $this -> input -> post('CategoryID'),
                'MediaID'       => $this -> input -> post('MediaID'),
                'PostDate'      => date('Y-m-d H:i:s'),
                'PostExpired'   => date('Y-m-d H:i:s',strtotime($this -> input -> post('PostExpired'))),
                'Description'   => $this -> input -> post('Description'),
                'ShowComment'   => $this -> input -> post('ShowComment'),
                'ShowShare'     => $this -> input -> post('ShowShare'),
                'UpdateBy'      => getAdminLogin('UserName'),
                'UpdateOn'      => date('Y-m-d H:i:s')
            );
            $this->mpost->update($id,$insert);
        
            redirect(site_url('post/edit/'.$id).'?success=1');
        
        }else{
            
            $this -> load -> view('post/form',$data);
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
            $this -> mpost -> delete($cek[$i]);
            $delete++; 
        }
        
        redirect(site_url('post').'?deleted=1');
        
    }
	
	
	function active(){
		cekUserLogin();
		$data['title'] = 'Iklan Aktif';
		$data['all']   = $this -> mpost -> getall(array('CreatedBy'=>getUserLogin('UserName')));
		
		$this -> load -> view('user/postactive',$data);	
	}
	
	
	function nonactive(){
		cekUserLogin();
		$data['title'] = 'Iklan Tidak Aktif';
		$data['all']   = $this -> mpost -> getall(array('CreatedBy'=>getUserLogin('UserName')));
		
		$this -> load -> view('user/postnonactive',$data);
	}
	
	function rejected(){
		cekUserLogin();
		$data['title'] = 'Iklan Ditolak';
		$data['all']   = $this -> mpost -> getall(array('CreatedBy'=>getUserLogin('UserName')));
		
		$this -> load -> view('user/postreject',$data);
	}
	
    function pasang(){
        cekUserLogin();
        #$data['edit']   = FALSE;
        $data['title']  = 'Pasang Iklan';
        
        $rules=array(
            array(
                'field'=>'PostTitle',
                'label'=>'post title',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            $last = $this -> mpost -> getlast();
            
            $insert=array(
                'PostID'        => $last,
                'PostTitle'     => $this -> input -> post('PostTitle'),
                'PostContent'   => $this -> input -> post('PostContent'),
                'CategoryID'   => $this -> input -> post('CategoryID'),
                'MediaID'       => $this -> input -> post('MediaID'),
                'PostDate'      => date('Y-m-d H:i:s'),
                #'PostExpired'   => date('Y-m-d H:i:s',strtotime($this -> input -> post('PostExpired'))),
                'Description'   => $this -> input -> post('Description'),
                #'ShowComment'   => $this -> input -> post('ShowComment'),
                #'ShowShare'     => $this -> input -> post('ShowShare'),
                'CreatedBy'     => getUserLogin('UserName'),
                'CreatedOn'     => date('Y-m-d H:i:s'),
                'StatusID'      => $this -> input -> post('StatusID'),
                'PostTypeID'    => $this -> input -> post('PostTypeID'),
                'Price'         => $this -> input -> post('Price'),
                'IsNego'        => $this -> input -> post('IsNego'),
                'ConditionID'   => $this -> input -> post('ConditionID'),
                'Country'       => $this -> input -> post('CountryID'),
                'ProvinceID'    => $this -> input -> post('ProvinceID'),
                'CityID'        => $this -> input -> post('CityID')
            );
            $this->mpost->insert($insert);
        
            redirect(site_url('post/pasang/'.$last).'?success=1');
        
        }else{
            
            $this->load->view('post/pasang',$data);
        }
    }
    
    

}
