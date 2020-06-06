<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }  
    
    public function get_gallery_list(){
        
        $this->db->select('G.*, S.school_name');
        $this->db->from('galleries AS G');
        $this->db->join('schools AS S', 'S.id = G.school_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('G.school_id', $this->session->userdata('school_id'));
        }
        return $this->db->get()->result();
        
    }
     function duplicate_check($title, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('title', $title);      
        return $this->db->get('galleries')->num_rows();            
    }

}
