<?php

/**
 * 
 */
class Media extends CI_Controller {
	
	function __construct() {
	    parent::__construct();
		$this -> load -> model('mmedia');
        
        $this->setPath_img_upload_folder("assets/images/media/");
        $this->setDelete_img_url(base_url().'media/deleteImage/');
        $this->setPath_url_img_upload_folder(base_url() . "assets/images/media/");
	}
    
    function multiselect(){
        cekLogin();
        $data['r'] = $this->mmedia->GetAll();
        $this->load->view('media/multiselect',$data);
    }
    
    function add(){
        cekLogin();
       $data ['edit'] = FALSE; 
       $data['title'] = 'Add New Media';
        $rules=array(
            array(
                'field'=>'MediaName',
                'label'=>'Media Name',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            
            $config['upload_path'] = './assets/images/media';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['max_width']  = 0;
            $config['max_height']  = 0;
            
            $this->load->library('upload',$config);
            
            if(!$this->upload->do_upload()){
                echo $this->upload->display_errors();
                return;
            }
            
            $dataupload = $this->upload->data();
                
            $last = $this -> mmedia -> getlast();
            $insert=array(
                    'MediaID'       => $last,
                    'MediaName'     => $this->input->post('MediaName'),
                    'MediaPath'     => $dataupload['file_name'],
                    'MediaFullPath' => base_url().'assets/images/media/'.$dataupload['file_name'],
                    'Description'   => $this->input->post('Description'),
                    'CreatedBy'     => getAdminLogin('UserName'),
                    'CreatedOn'     => date('Y-m-d H:i:s')
            );
            $this->mmedia->insert($insert);
        
            redirect(site_url('media/edit/'.$last).'?success=1');
        
        }else{
            $this->load->view('media/form',$data);
        }
        
        
    }
    
    function edit($id){
        cekLogin();
        $data['edit'] = TRUE;
        $data['title'] = 'Media';
        
        $data['result'] =$result = $this -> mmedia -> getrow($id);
        
                $rules=array(
            array(
                'field'=>'MediaName',
                'label'=>'Media Name',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            
            $config['upload_path'] = './assets/images/media';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['max_width']  = 0;
            $config['max_height']  = 0;
            
            $this->load->library('upload',$config);
            
            if(!$this->upload->do_upload()){
                echo $this->upload->display_errors();
                return;
            }
            
            $dataupload = $this->upload->data();
                
            $last = $this -> mmedia -> getlast();
            $insert=array(
                    'MediaName'     => $this->input->post('MediaName'),
                    'MediaPath'     => $dataupload['file_name'],
                    'MediaFullPath' => base_url().'assets/images/media/'.$dataupload['file_name'],
                    'Description'   => $this->input->post('Description'),
                    'UpdateBy'     => getAdminLogin('UserName'),
                    'UpdateOn'     => date('Y-m-d H:i:s')
            );
            $this->mmedia->update($id, $insert);
        
            redirect(site_url('media/edit/'.$id).'?success=1');
        
        }else{
            $this->load->view('media/form',$data);
        }
        
      }
    
    function index(){
        cekLogin();
        
        $data['title'] = 'Media';
        $data['all']   = $this -> mmedia -> getall(); 
        
        $this -> load -> view('media/data', $data);
    }
    
    function delete(){
        cekLogin();
        $cek = $this -> input -> post('cek');
        $delete = 0;
        
        if(empty($cek)){
            redirect('media');
        }
        
        for ($i=0; $i < count($cek); $i++) {
            $result = $this->mmedia->getrow($cek[$i]);
            $this -> mmedia -> delete($cek[$i]);
            $file = "./assets/images/media/".$result->MediaPath;
            if(is_file($file)){
                unlink($file);
            }
            $delete++; 
        }
        
        redirect(site_url('media').'?deleted=1');
        
    }
    function select(){
        cekLogin();
        $data['r'] = $this -> mmedia -> getall();
        
        $this -> load -> view('media/select',$data);
    }
    
    function selectpath(){
        cekLogin();
        $data['r'] = $this -> mmedia -> getall();
        
        $this -> load -> view('media/selectpath',$data);
    }
    
    function upload(){
            $config['upload_path'] = './assets/images/media';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['max_width']  = 0;
            $config['max_height']  = 0;
            $config['overwrite'] = FALSE;
            
            $this->load->library('upload',$config);
            
            if(!$this->upload->do_upload()){
                echo json_encode( array('error'=>$this->upload->display_errors()) );
                return;
            }
            
            $dataupload = $this->upload->data();
            
            $last = $this->mmedia->getlast();
            
            $data = array(
                    'MediaID'       => $last,
                    'MediaName'     => $dataupload['file_name'],
                    'MediaPath'     => $dataupload['file_name'],
                    'MediaFullPath' => base_url().'assets/images/media/'.$dataupload['file_name'],
                    'Description'   => "",
                    'CreatedBy'     => GetAdminLogin('UserName'),
                    'CreatedOn'     => date('Y-m-d H:i:s')
            );
            
            $this->mmedia->insert($data);
            
            $resp = array(
                        'mediaid'       => $last,
                        'mediapath'     => $dataupload['file_name'],
                        'fullmediapath' => base_url().'assets/images/media/'.$dataupload['file_name'],
                        'isimage'       => $dataupload['is_image']
            );
            
            echo json_encode($resp);
    }

        function uploadprofile(){
            $config['upload_path'] = './assets/images/profile';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['max_width']  = 0;
            $config['max_height']  = 0;
            $config['overwrite'] = FALSE;
            
            $this->load->library('upload',$config);
            
            
            #echo $config['upload_path'];
            #return;
            
            if(!$this->upload->do_upload()){
                echo json_encode( array('error'=>$this->upload->display_errors()) );
                return;
            }
            
            $dataupload = $this->upload->data();
            
            $last = $this->mmedia->getlast();
            
            $data = array(
                    'MediaID'       => $last,
                    'MediaName'     => $dataupload['file_name'],
                    'MediaPath'     => $dataupload['file_name'],
                    'MediaFullPath' => base_url().'assets/images/profile/'.$dataupload['file_name'],
                    'Description'   => "",
                    'CreatedBy'     => GetAdminLogin('UserName'),
                    'CreatedOn'     => date('Y-m-d H:i:s')
            );
            
            #$this->mmedia->insert($data);
            
            $resp = array(
                        'mediaid'       => $last,
                        'mediapath'     => $dataupload['file_name'],
                        'fullmediapath' => base_url().'assets/images/profile/'.$dataupload['file_name'],
                        'isimage'       => $dataupload['is_image']
            );
            
            echo json_encode($resp);
    }

    
//Function for the upload : return true/false
  public function do_upload() {

        if (!$this->upload->do_upload()) {
            return false;
        } else {
            //$data = array('upload_data' => $this->upload->data());
            return true;
        }
     }


//Function Delete image
    public function deleteImage() {

        //Get the name in the url
        $file = $this->uri->segment(3);
        
        $success = unlink($this->getPath_img_upload_folder() . $file);
        #$success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);

        //info to see if it is doing what it is supposed to 
        $info = new stdClass();
        $info->sucess = $success;
        $info->path = $this->getPath_url_img_upload_folder() . $file;
        $info->file = is_file($this->getPath_img_upload_folder() . $file);
        
        $this->db->delete('media',array('MediaPath'=>$file));
        
        if ($this->input->is_ajax_request()) {//I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {     //here you will need to decide what you want to show for a successful delete
            var_dump($file);
        }
    }


//Load the files
    public function get_files() {

        $this->get_scan_files();
    }

//Get info and Scan the directory
    public function get_scan_files() {

        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name);
        } else {
            $info = $this->get_file_objects();
        }
        header('Content-type: application/json');
        echo json_encode($info);
    }

    protected function get_file_object($file_name) {
        $file_path = $this->getPath_img_upload_folder() . $file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {

            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
            $file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
            //File name in the url to delete 
            $file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
            $file->delete_type = 'DELETE';
            
            return $file;
        }
        return null;
    }
    
    
    //Scan
       protected function get_file_objects() {
        return array_values(array_filter(array_map(
             array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder())
                   )));
    }



// GETTER & SETTER 


    public function getPath_img_upload_folder() {
        return $this->path_img_upload_folder;
    }

    public function setPath_img_upload_folder($path_img_upload_folder) {
        $this->path_img_upload_folder = $path_img_upload_folder;
    }

    public function getPath_img_thumb_upload_folder() {
        return $this->path_img_thumb_upload_folder;
    }

    public function setPath_img_thumb_upload_folder($path_img_thumb_upload_folder) {
        $this->path_img_thumb_upload_folder = $path_img_thumb_upload_folder;
    }

    public function getPath_url_img_upload_folder() {
        return $this->path_url_img_upload_folder;
    }

    public function setPath_url_img_upload_folder($path_url_img_upload_folder) {
        $this->path_url_img_upload_folder = $path_url_img_upload_folder;
    }

    public function getPath_url_img_thumb_upload_folder() {
        return $this->path_url_img_thumb_upload_folder;
    }

    public function setPath_url_img_thumb_upload_folder($path_url_img_thumb_upload_folder) {
        $this->path_url_img_thumb_upload_folder = $path_url_img_thumb_upload_folder;
    }

    public function getDelete_img_url() {
        return $this->delete_img_url;
    }

    public function setDelete_img_url($delete_img_url) {
        $this->delete_img_url = $delete_img_url;
    }
    
    
    
}
