<?php
/**
 * 
 */
class Widget extends CI_Controller {
	
	function __construct() {
		parent::__construct();
        $this -> load -> model('mwidget');
	}
    
    function index(){
        cekLogin();
        $data['title'] = 'All Widget';
        $data['all'] = $this -> mwidget -> getall();
        
        $this -> load -> view('widget/data', $data);
    }
    
    function add(){
        cekLogin();
        $data['edit'] =  FALSE;
        $data['title'] = 'Add New Widget';
        
        $rules=array(
            array(
                'field'=>'WidgetName',
                'label'=>'Widget Name',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            
            
            $last = $this -> mwidget -> getlast();
            
            $insert=array(
                'WidgetID'          => $last,
                'WidgetName'        => $this -> input -> post('WidgetName'),
                'Description'       => $this -> input -> post('Description'),
                'CreatedBy'         => $this -> input -> post('CreatedBy'),
                'CreatedOn'         => $this -> input -> post('CreatedOn'),
                'IsShow'            => $this -> input -> post('IsShow')
               
                
             );
            $this->mwidget->insert($insert);
        
            redirect(site_url('widget/edit/'.$last).'?success=1');
        
        }else{
        
        $this -> load -> view('widget/form', $data);
    }
    
    }
    
    function edit($id){
        cekLogin();
        $data['edit'] =  TRUE;
        $data['title'] = 'Change Widget';
        $data['result']= $this->mwidget->getrow($id);
         $rules=array(
            array(
                'field'=>'WidgetName',
                'label'=>'Widget Name',
                'rules'=>'required'
            
            )
        );
        
        $this -> form_validation -> set_rules($rules);
        if($this -> form_validation -> run()){
            
            
            
            $insert=array(
             
                'WidgetName'        => $this -> input -> post('WidgetName'),
                'Description'       => $this -> input -> post('Description'),
                'CreatedBy'         => $this -> input -> post('CreatedBy'),
                'CreatedOn'         => $this -> input -> post('CreatedOn'),
                'IsShow'            => $this -> input -> post('IsShow')
               
                
             );
            $this->mwidget->update($id,$insert);
        
            redirect(site_url('widget/edit/'.$id).'?success=1');
        
        }else{
        
        $this -> load -> view('widget/form', $data);
    }
    
        
    }
    
    function delete(){
        ceklogin();
        $cek = $this -> input -> post('cek');
        $delete = 0;
        
        if(empty($cek)){
            redirect('widget');
        }
        
        for ($i=0; $i < count($cek); $i++) {
            $this -> mwidget -> delete($cek[$i]);
            $delete++; 
        }
        
        redirect(site_url('widget').'?deleted=1');
        
    }
    
    
}
