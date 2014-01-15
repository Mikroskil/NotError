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
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            
            $slug = str_replace(array('.',' '), '-', url_title(strip_tags(strtolower($this->input->post('PostTitle')))));
            
            $medias = $this->input->post('MediaID');
            $mediaid = empty($medias[0]) ? 0 : $medias[0];
            
            $pe = $this -> input -> post('PostExpired');
            
            $last = $this -> mpost -> getlast();
            
            $insert=array(
                'PostID'        => $last,
                'PostTitle'     => $this -> input -> post('PostTitle'),
                'PostContent'   => $this -> input -> post('PostContent'),
                'CategoryID'   => $this -> input -> post('CategoryID'),
                'MediaID'       => $mediaid,
                'PostSlug'      => $slug,
                'PostDate'      => date('Y-m-d H:i:s'),
                'PostExpired'   => $pe? date('Y-m-d',strtotime($pe)) : NULL,
                'Description'   => $this -> input -> post('Description'),
                'ShowComment'   => $this -> input -> post('ShowComment'),
                'ShowShare'     => $this -> input -> post('ShowShare'),
                'CreatedBy'     => getAdminLogin('UserName'),
                'CreatedOn'     => date('Y-m-d H:i:s'),
                'StatusID'      => $this -> input -> post('StatusID'),
                'PostTypeID'    => $this -> input -> post('PostTypeID'),
                'Price'         => $this -> input -> post('Price'),
                'IsNego'        => $this -> input -> post('IsNego'),
                'ConditionID'   => $this -> input -> post('ConditionID'),
                'CountryID'     => $this -> input -> post('CountryID'),
                'ProvinceID'    => $this -> input -> post('ProvinceID'),
                'CityID'        =>$this -> input -> post('CityID')
            );
            $this->mpost->insert($insert);
            
            if(!empty($medias)){
                $img = 0;
                foreach ($medias as $image) {
                    $img++;
                    if($img == 1){
                        continue;
                    }
                    $lastimage = $this -> mpost -> GetLastPostImage()+1;
                    $data = array(
                        'PostImageID'   => $lastimage,
                        'PostID'        => $last,
                        'MediaID'       => $image
                    );
                    $this -> mpost -> insertpostimage($data);
                }
            }
        
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
        $data['images'] = $this -> mpost -> GetPostImage($id);
        
        $rules = array(
            array(
                'field'=>'PostTitle',
                'label'=>'post title',
                'rules'=>'required'
            
            )
        );
        
        $this ->form_validation->set_rules($rules);
        if($this->form_validation->run()){
            
            $slug = str_replace(array('.',' '), '-', strtolower($this->input->post('PostSlug')));
            #$slug = str_replace(array('.',' '), '-', url_title(strip_tags(strtolower($this->input->post('PostTitle')))));
            
            $medias = $this->input->post('MediaID');
            $mediaid = empty($medias[0]) ? 0 : $medias[0];
            
            #echo $this -> input -> post('PostExpired');
            #return;
            
            $pe = $this -> input -> post('PostExpired');
            
            #$last=$this->mpost->getlast();
            
            $insert=array(
                #'PostID'=>$last,
                'PostTitle'     =>$this->input->post('PostTitle'),
                'PostContent'   =>$this->input->post('PostContent'),
                'PostContent'   => $this -> input -> post('PostContent'),
                'CategoryID'   => $this -> input -> post('CategoryID'),
                'MediaID'       => $mediaid,
                'PostSlug'      => $slug,
                'PostDate'      => date('Y-m-d H:i:s'),
                'PostExpired'   => $pe? date('Y-m-d',strtotime($pe)) : NULL,
                'Description'   => $this -> input -> post('Description'),
                'ShowComment'   => $this -> input -> post('ShowComment'),
                'ShowShare'     => $this -> input -> post('ShowShare'),
                'UpdateBy'      => getAdminLogin('UserName'),
                'UpdateOn'      => date('Y-m-d H:i:s'),
                'StatusID'      => $this -> input -> post('StatusID'),
                'PostTypeID'    => $this -> input -> post('PostTypeID'),
                'Price'         => $this -> input -> post('Price'),
                'IsNego'        => $this -> input -> post('IsNego'),
                'ConditionID'   => $this -> input -> post('ConditionID'),
                'CountryID'     => $this -> input -> post('CountryID'),
                'ProvinceID'    => $this -> input -> post('ProvinceID'),
                'CityID'        =>$this -> input -> post('CityID')
            );
            $this->mpost->update($id,$insert);
            
            if(!empty($medias)){
                $this -> mpost -> deletepostimage($id);
                $img = 0;
                foreach ($medias as $image) {
                    $img++;
                    if($img == 1){
                        continue;
                    }
                    $lastimage = $this -> mpost -> GetLastPostImage()+1;
                    $data = array(
                        'PostImageID'   => $lastimage,
                        'PostID'        => $id,
                        'MediaID'       => $image
                    );
                    $this -> mpost -> insertpostimage($data);
                }
            }
        
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
		$data['title'] = 'Iklan Non Aktif';
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
            
            $slug = str_replace(array('.',' '), '-', url_title(strip_tags(strtolower($this->input->post('PostTitle')))));
            
            $medias = $this->input->post('MediaID');
            $mediaid = empty($medias[0]) ? 0 : $medias[0];
            
            $pe = $this -> input -> post('PostExpired');
            
            if(AUTOAPPROVE==AKTIF){
                $status = AKTIF;
            }else if(AUTOAPPROVE==NONAKTIF){
                $status = NONAKTIF;
            }else if(AUTOAPPROVE==REJECT){
                $status = REJECT;
            }
            
            $last = $this -> mpost -> getlast();
            
            $insert=array(
                'PostID'        => $last,
                'PostTitle'     => $this -> input -> post('PostTitle'),
                'PostContent'   => $this -> input -> post('PostContent'),
                'CategoryID'   => $this -> input -> post('CategoryID'),
                'MediaID'       => $mediaid,
                'PostSlug'      => $slug,
                'PostDate'      => date('Y-m-d H:i:s'),
                'PostExpired'   => date('Y-m-d', strtotime('+30 DAY')),
                'Description'   => $this -> input -> post('Description'),
                'ShowComment'   => $this -> input -> post('ShowComment'),
                'ShowShare'     => ALLOWSHARE,
                'CreatedBy'     => getUserLogin('UserName'),
                'CreatedOn'     => date('Y-m-d H:i:s'),
                'StatusID'      => $status,
                'PostTypeID'    => $this -> input -> post('PostTypeID'),
                'Price'         => $this -> input -> post('Price'),
                'IsNego'        => $this -> input -> post('IsNego'),
                'ConditionID'   => $this -> input -> post('ConditionID'),
                'CountryID'     => $this -> input -> post('CountryID'),
                'ProvinceID'    => $this -> input -> post('ProvinceID'),
                'CityID'        =>$this -> input -> post('CityID')
            );
            $this->mpost->insert($insert);
            
            if(!empty($medias)){
                $img = 0;
                foreach ($medias as $image) {
                    $img++;
                    if($img == 1){
                        continue;
                    }
                    $lastimage = $this -> mpost -> GetLastPostImage()+1;
                    $data = array(
                        'PostImageID'   => $lastimage,
                        'PostID'        => $last,
                        'MediaID'       => $image
                    );
                    $this -> mpost -> insertpostimage($data);
                }
            }
        
            redirect(site_url('post/pasang').'?success=1');
        
        }else{
            
            $this->load->view('post/pasang',$data);
        }
    }



    function search(){
        $this->load->helper('captcha');
        
        $key = $this->input->get('key');
        $prov = $this->input->get('prov');
        $cat = $this->input->get('cat');
        
        
        $condition = array();
        $condition['StatusID'] = 1;
        
        if($key != ''){
            $key = str_replace("-", " ", $key);
            #$condition['PostTitle'] = $key;
            
            #foreach ($model ->result() as $keyy) {
            #    echo $keyy->PostTitle.'<br/>';    
            #}
            
            #return;
        }
        
        if($prov != ''){
            $condition['ProvinceID'] = $prov;
        }
        
        if($cat != ''){
            $condition['CategoryID'] = $cat;
        }

        
        $data['model'] = $model = $this->mpost->GetAll($condition);
        if(!empty($key)){
            $data['model'] =$model = $this->db->like(array('PostTitle'=>$key)) ->get('posts');
        }
        #echo $this->db->last_query();
        
        
        $data['title'] = 'Hasil Pencarian';
        $data['catname'] = '';
        $data['description'] = '';
        $data['keyword'] = '';
        $data['exist'] = FALSE;
        
        
        
        $this->load->view('header',$data);
        $this->load->view(DEFAULTVIEWTYPE,$data);
        $this->load->view('footer',$data);
        
    }


    function view($url){
        $this->load->helper('captcha');

        $data['model'] = $model = $this->mpost->GetAll(array('PostSlug'=>$url),"")->row();

        $data['title'] = strip_tags($model->PostTitle);

        $data['media'] = $this->db->where('MediaID',$model->MediaID)->get('media')->row();
        
        $data['description'] = strip_tags($model->Description);
        
        $rand = rand(000000,999999);

        $vals = array(

            'word' => $rand,

            'img_path' => './assets/images/captcha/',

            'img_url' => base_url().'assets/images/captcha/',

            'font_path' => './assets/fonts/Quartz.ttf',

            'img_width' => 150,

            'img_height' => 30,

            'expiration' => 7200

        );
        
        
        $cap = create_captcha($vals);
        
        
        $data['images'] = $this->db->where('PostID',$model->PostID)->join('media','media.MediaID=postimages.MediaID','left')->get('postimages');
        
        $this->session->set_userdata(array('Captcha'=>$rand));

        $data['captcha'] = $cap['image'];
        
                
        $this->db->where(array('IsVerified'=>1));
        $this->db->order_by('CommentDate','asc');
        $showcomments = $data['showcomments'] = $this -> db -> where('PostID',$model -> PostID) -> get('comments');
        
        $cektemplate = $this->db->where('DetailViewID',$model->DetailViewID)->get('detailviews');
        #$template = $this->db->where('DetailViewID',$model->DetailViewID)->get('detailviews')->row();
                
        $data['loadview'] = ($cektemplate->num_rows == 0) ? DEFAULTDETAILVIEW : '';#$template->DetailViewFile;
        #$data['sidebarright'] = (empty($model->SidebarRight)) ? DEFAULTSIDEBARRIGHT : $model->SidebarRight;
        #$data['sidebarleft'] = (empty($model->SidebarLeft)) ? DEFAULTSIDEBARLEFT : $model->SidebarLeft;
        $data['sidebarright'] = '';
        $data['sidebarleft'] = '';
        
        $data['impactprice'] = 0;
        $data['impactweight'] = 0;
        $data['impactimage'] = "";
        
        
        $this->load->view('post/view',$data);
    }
    
    

}
