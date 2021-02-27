<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('balnxr_admin');
		if(!isset($session_data) || $session_data->admin_id=="")
		{
		 	redirect("Login");
		}
		
		$this->load->model("Usermodel");
	}
	
	public function manage_user()
	{
	    // Fetch all data from table
	    $tbl = "users";
	    $feilds = "*";
	    $arr = array("type" => "User");
	    
	    $result = $this->Usermodel->get_data($tbl, $feilds, $arr);
	    $data = array("result" => $result);
		$this->load->view('manage_user', $data);
	}
	
	public function manage_org()
	{
	    // Fetch all data from table
	    $tbl = "users";
	    $feilds = "*";
	    $arr = array("type" => "Organization");
	    
	    $result = $this->Usermodel->get_data($tbl, $feilds, $arr);
	    $data = array("result" => $result);
		$this->load->view('manage_org', $data);
	}
    
    public function view_org()
    {
        $user_id = $this->uri->segment('3');
        
        $this->session->set_userdata("view_id", $user_id);
        
        redirect("Users/view_org_detail");
    }
    
    public function view_org_detail()
    {
        $user_id = $this->session->userdata("view_id");
        
        $tbl = "users";
	    $feilds = "*";
	    $arr = array("user_id" => $user_id);
	    
        $detail = $this->Usermodel->get_details($tbl, $feilds, $arr);
        
        // Fetch Favorite categories 
        $qry = "SELECT c.category_name FROM fav_charity_categories f, charity_categories c WHERE f.cat_id = c.cat_id AND f.user_id = '".$user_id."'";
        $cat_detail = $this->Usermodel->run_query($qry);
        
        $data = array("detail" => $detail, "cat_detail" => $cat_detail);
		$this->load->view('view_org', $data);
    }
    
    public function manage_charity_nav()
    {
        $list =  array();
        
        $qry = "SELECT c.*, cc.category_name FROM charity c, charity_categories cc WHERE c.cat_id = cc.cat_id";
	    $result = $this->Usermodel->run_query($qry);
	    foreach($result as $result)
	    {
	        // check wheather that charity is registered to balanxr
	        $tbl = "users";
	        $feilds = "*";
	        $arr = array("id" => $result->charity_id, "sub_type" => "Charity");
	        $details = $this->Usermodel->get_details($tbl, $feilds, $arr);
	        
	        $result->register_detail = $details;
	        $list[] = $result;
	    }
	    
	    $data = array("result" => $list);
		$this->load->view('manage_charity_nav', $data);
    }
	
}
