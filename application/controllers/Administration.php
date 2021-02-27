<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {



  function __construct(){

		parent::__construct();

		//initialise the autoload things for this class
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
		$this->load->model('Usermodel');

	}

  public function index(){
    if(!isset($this->session->balnxr_admin)){
			redirect('/','refresh');
		}
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}

  public function admin_home(){
      if(!isset($this->session->balnxr_admin)){
          redirect('/','refresh');
      }
      $data['alert']    = $this->session->flashdata('alert');
  		$data['error']    = $this->session->flashdata('error');
  		$data['success']  = $this->session->flashdata('success');
       // echo "string";die;
     	// $data['cat'] 	  = $this->db->get('categories')->result_array();
      // $data['cate'] = $this->db->get('categories_list')->result_array();

      $this->load->view('header');
   		$this->load->view('admin_view');
   		$this->load->view('footer');
}
  public function admin(){
      if(!isset($this->session->balnxr_admin)){
          redirect('/','refresh');
      }
      $data['alert']    = $this->session->flashdata('alert');
  		$data['error']    = $this->session->flashdata('error');
  		$data['success']  = $this->session->flashdata('success');
       // echo "string";die;
     	$data['cat'] 	  = $this->db->get('categories')->result_array();
      $data['cate'] = $this->db->get('categories_list')->result_array();

      $this->load->view('header');
   		$this->load->view('administration',$data);
   		$this->load->view('footer');
}
  public function sm_categories(){
      if(!isset($this->session->balnxr_admin)){
          redirect('/','refresh');
      }
      $data['alert']    = $this->session->flashdata('alert');
  		$data['error']    = $this->session->flashdata('error');
  		$data['success']  = $this->session->flashdata('success');
       // echo "string";die;
     	$data['cat'] 	  = $this->db->order_by("cat_name", "DESC")->get('shower_categories')->result_array();
      $data['cate'] = $this->db->get('categories_list')->result_array();

      $this->load->view('header');
   		$this->load->view('administration_sm',$data);
   		$this->load->view('footer');
}

public function add_sub_cat($id){
    if(!isset($this->session->balnxr_admin)){
        redirect('/','refresh');
    }
     $this->session->set_userdata('cat_id',$id);
    redirect('administration/view_sub_cat');
}
public function add_sub_cat_sm($id){
    if(!isset($this->session->balnxr_admin)){
        redirect('/','refresh');
    }
     $this->session->set_userdata('sm_cat_id',$id);
    redirect('administration/view_sub_cat_sm');
}
public function view_sub_cat(){
  if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
  }
  $data['alert'] = $this->session->flashdata('alert');
  $data['error'] = $this->session->flashdata('error');
  $data['success'] = $this->session->flashdata('success');
  $id=$this->session->userdata('cat_id');
  $data['id']=$id;
  // print_r($coupondata);die;
  $data['sub_cats'] = $this->db->where('cat_id',$id)->get('sub_categories')->result_array();
  $this->load->view('header');
  $this->load->view('admin_sub_categories',$data);
  $this->load->view('footer');
}
public function view_sub_cat_sm(){
  if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
  }
  $data['alert'] = $this->session->flashdata('alert');
  $data['error'] = $this->session->flashdata('error');
  $data['success'] = $this->session->flashdata('success');
  $id=$this->session->userdata('sm_cat_id');
  $data['id']=$id;
  // print_r($coupondata);die;
  $data['sub_cats'] 	  = $this->db->where('cat_id',$id)->get('sub_categories_shower_mirror')->result_array();
  $this->load->view('header');
  $this->load->view('admin_sub_categories_sm',$data);
  $this->load->view('footer');
}

public function add_drop_categories(){
  if(!isset($this->session->balnxr_admin)){
    redirect('/','refresh');
  }
  // echo "string";die;
  // echo "<pre>";print_r($this->input->post());die;
  $item1	=	$this->input->post('add_drop_cat');
  $item['cat_name'] = ucfirst($item1);


  $result=$this->Usermodel->insertDropCategories($item);
  if ($result){
  $this->session->set_flashdata('success',"Category Added Successfully..!!");
  redirect('administration/admin');
  }
  else{
  $this->session->set_flashdata('error',"Category Not Created ..!!");
  redirect('administration/admin');
  }
}
public function add_drop_categories_sm(){
  if(!isset($this->session->balnxr_admin)){
    redirect('/','refresh');
  }
  // echo "string";die;
  // echo "<pre>";print_r($this->input->post());die;
  $item1	=	$this->input->post('add_drop_cat');
  $item['cat_name'] = ucfirst($item1);


  $result=$this->Usermodel->insertDropCategories_sm($item);
  if ($result){
  $this->session->set_flashdata('success',"Category Added Successfully..!!");
  redirect('administration/sm_categories');
  }
  else{
  $this->session->set_flashdata('error',"Category Not Created ..!!");
  redirect('administration/sm_categories');
  }
}

public function add_sub_cates()
{
  if(!isset($this->session->balnxr_admin)){
    redirect('/','refresh');
  }
  // echo "<pre>";print_r($this->input->post());die;
  $item['cat_id']	=	$this->input->post('cat_id');
  $item['sub_name']	=	$this->input->post('sub_name');

  $data = $this->db->select('sub_name')->where('cat_id',$item['cat_id'])->get('sub_categories')->result_array();
  $list = array();
  foreach ($data as $key) {
    $key = $key['sub_name'];
    $list[] = $key;
  }
  if(in_array($item['sub_name'],$list))
  { // KD
    $this->session->set_flashdata('error'," Sub Category already present..!!");
    redirect('administration/view_sub_cat');
  }

  $result=$this->Usermodel->insertsubcatvalue($item);
  if ($result){
  $this->session->set_flashdata('success',"Sub Categorie Added Successfully..!!");
  redirect('administration/view_sub_cat');
  }
  else{
  $this->session->set_flashdata('error',"Sub Categorie Not Created ..!!");
  redirect('administration/view_sub_cat');
  }
}
public function add_sub_cates_sm()
{
  if(!isset($this->session->balnxr_admin)){
    redirect('/','refresh');
  }
  // echo "<pre>";print_r($this->input->post());die;
  $item['cat_id']	=	$this->input->post('cat_id');
  $item['sub_name']	=	$this->input->post('sub_name');

  $data = $this->db->select('sub_name')->where('cat_id',$item['cat_id'])->get('sub_categories_shower_mirror')->result_array();
  $list = array();
  foreach ($data as $key) {
    $key = $key['sub_name'];
    $list[] = $key;
  }
  if(in_array($item['sub_name'],$list))
  { // KD
    $this->session->set_flashdata('error'," Sub Category already present..!!");
    redirect('administration/view_sub_cat_sm');
  }

  $result=$this->Usermodel->insertsubcatvalue_sm($item);
  if ($result){
  $this->session->set_flashdata('success',"Sub Categorie Added Successfully..!!");
  redirect('administration/view_sub_cat_sm');
  }
  else{
  $this->session->set_flashdata('error',"Sub Categorie Not Created ..!!");
  redirect('administration/view_sub_cat_sm');
  }
}
public function delete_sub_cate($id){
  if(!isset($this->session->balnxr_admin)){
    redirect('/','refresh');
  }
  $delete= $this->db->where('sub_id',$id)->delete('sub_categories');
  if ($delete > 0){
  $this->session->set_flashdata('success',"Sub Categories Deleted Successfully..!!");
  redirect('administration/view_sub_cat');
  }
  else{
  $this->session->set_flashdata('error',"Sub Categories Not Deleted ..!!");
  redirect('administration/view_sub_cat');
  }
}
public function delete_sub_cate_sm($id){
  if(!isset($this->session->balnxr_admin)){
    redirect('/','refresh');
  }
  $delete= $this->db->where('sub_id',$id)->delete('sub_categories_shower_mirror');
  if ($delete > 0){
  $this->session->set_flashdata('success',"Sub Categories Deleted Successfully..!!");
  redirect('administration/view_sub_cat_sm');
  }
  else{
  $this->session->set_flashdata('error',"Sub Categories Not Deleted ..!!");
  redirect('administration/view_sub_cat_sm');
  }
}

  public function backsplash_cat()
  {
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    // echo "string";die;
    $data['cat'] 	  = $this->db->get('backsplash_category')->result_array();
    $data['cate'] = $this->db->get('categories_list')->result_array();

    $this->load->view('header');
    $this->load->view('adminis_backsplash',$data);
    $this->load->view('footer');
  }

  public function add_sub_cat_back_sp($id)
  {
    if(!isset($this->session->balnxr_admin)){
        redirect('/','refresh');
    }
     $this->session->set_userdata('backsp_cat_id',$id);
     redirect('administration/view_sub_cat_back_sp');
  }

  public function view_sub_cat_back_sp()
  {
    if(!isset($this->session->balnxr_admin)){
        redirect('/','refresh');
    }
    $data['alert'] = $this->session->flashdata('alert');
    $data['error'] = $this->session->flashdata('error');
    $data['success'] = $this->session->flashdata('success');
    $id=$this->session->userdata('backsp_cat_id');
    $data['id']=$id;
    // print_r($coupondata);die;
    $data['sub_cats'] = $this->db->where('cat_id',$id)->get('backsplash_sub_category')->result_array();
    $data['cat_name'] = $this->db->where('id',$id)->get('backsplash_category')->row_array();
    $this->load->view('header');
    $this->load->view('backsp_sub_categories',$data);
    $this->load->view('footer');
  }

  public function add_sub_back_sp_cates()
  {
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    // echo "<pre>";print_r($this->input->post());die;
    $item['cat_id']	=	$this->input->post('cat_id');
    $item['sub_name']	=	$this->input->post('sub_name');

    $data = $this->db->select('sub_name')->where('cat_id',$item['cat_id'])->get('backsplash_sub_category')->result_array();
    $list = array();
    foreach ($data as $key) {
      $key = $key['sub_name'];
      $list[] = $key;
    }
    if(in_array($item['sub_name'],$list))
    { // KD
      $this->session->set_flashdata('error'," Sub Category already present..!!");
      redirect('administration/view_sub_cat_back_sp');
    }

    $result=$this->Usermodel->insert_back_sp_subcatvalue($item);
    if ($result)
    {
      $this->session->set_flashdata('success',"Sub Category Added Successfully..!!");
      redirect('administration/view_sub_cat_back_sp');
    }
    else
    {
      $this->session->set_flashdata('error',"Sub Category Not Created ..!!");
      redirect('administration/view_sub_cat_back_sp');
    }
  }

  public function delete_back_sp_sub_cate($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $delete= $this->db->where('sub_id',$id)->delete('backsplash_sub_category');
    if ($delete > 0)
    {
      $this->session->set_flashdata('success',"Sub Category Deleted Successfully..!!");
      redirect('administration/view_sub_cat_back_sp');
    }
    else
    {
      $this->session->set_flashdata('error'," Sub Category Not Deleted ..!!");
      redirect('administration/view_sub_cat_back_sp');
    }
  }


    public function balustrade_categ()
    {
      if(!isset($this->session->balnxr_admin)){
        redirect('/','refresh');
      }
      $data['alert']    = $this->session->flashdata('alert');
      $data['error']    = $this->session->flashdata('error');
      $data['success']  = $this->session->flashdata('success');
      // echo "string";die;
      $data['cat'] 	  = $this->db->get('balustrade_category')->result_array();
      // $data['cate'] = $this->db->get('categories_list')->result_array();

      $this->load->view('header');
      $this->load->view('adminis_balustrade',$data);
      $this->load->view('footer');
    }

    public function add_sub_cat_balustrade($id)
    {
      if(!isset($this->session->balnxr_admin)){
          redirect('/','refresh');
      }
       $this->session->set_userdata('balustrade_cat_id',$id);
       redirect('administration/view_sub_cat_balustrade');
    }

    public function view_sub_cat_balustrade()
    {
      if(!isset($this->session->balnxr_admin)){
          redirect('/','refresh');
      }
      $data['alert'] = $this->session->flashdata('alert');
      $data['error'] = $this->session->flashdata('error');
      $data['success'] = $this->session->flashdata('success');
      $id=$this->session->userdata('balustrade_cat_id');
      $data['id']=$id;
      // print_r($coupondata);die;
      $data['sub_cats'] = $this->db->where('cat_id',$id)->get('balustrade_sub_category')->result_array();
      $data['cat_name'] = $this->db->where('id',$id)->get('balustrade_category')->row_array();
      $this->load->view('header');
      $this->load->view('balustrade_sub_categories',$data);
      $this->load->view('footer');
    }

    public function add_sub_balustrade_cates()
    {
      if(!isset($this->session->balnxr_admin)){
        redirect('/','refresh');
      }
      // echo "<pre>";print_r($this->input->post());die;
      $item['cat_id']	=	$this->input->post('cat_id');
      $item['sub_name']	=	$this->input->post('sub_name');

      $data = $this->db->select('sub_name')->where('cat_id',$item['cat_id'])->get('balustrade_sub_category')->result_array();
      $list = array();
      foreach ($data as $key) {
        $key = $key['sub_name'];
        $list[] = $key;
      }
      if(in_array($item['sub_name'],$list))
      { // KD
        $this->session->set_flashdata('error'," Sub Category already present..!!");
        redirect('administration/view_sub_cat_balustrade');
      }

      $result=$this->Usermodel->insert_balustrade_subcatvalue($item);
      if ($result)
      {
        $this->session->set_flashdata('success',"Sub Category Added Successfully..!!");
        redirect('administration/view_sub_cat_balustrade');
      }
      else
      {
        $this->session->set_flashdata('error',"Sub Category Not Created ..!!");
        redirect('administration/view_sub_cat_balustrade');
      }
    }

    public function delete_balustrade_sub_cate($id)
    {
      if(!isset($this->session->balnxr_admin))
      {
        redirect('/','refresh');
      }
      $delete= $this->db->where('sub_id',$id)->delete('balustrade_sub_category');
      if ($delete > 0)
      {
        $this->session->set_flashdata('success',"Sub Category Deleted Successfully..!!");
        redirect('administration/view_sub_cat_balustrade');
      }
      else
      {
        $this->session->set_flashdata('error'," Sub Category Not Deleted ..!!");
        redirect('administration/view_sub_cat_balustrade');
      }
    }

  public function view_calendar()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['alert'] = $this->session->flashdata('alert');
    $data['error'] = $this->session->flashdata('error');
    $data['success'] = $this->session->flashdata('success');

    // print_r($coupondata);die;
    // $data['sub_cats'] 	  = $this->db->where('cat_id',$id)->get('sub_categories')->result_array();
    $this->load->view('header');
    $this->load->view('view_calendar',$data);
    $this->load->view('footer');
  }

  public function mail_description()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['alert'] = $this->session->flashdata('alert');
    $data['error'] = $this->session->flashdata('error');
    $data['success'] = $this->session->flashdata('success');

    // print_r($coupondata);die;
    $data['mail_desc'] 	  = $this->db->get('mail_description')->result_array();

   


    $this->load->view('header');
    $this->load->view('view_mail_description',$data);
    $this->load->view('footer');
  }

  public function addmail_description()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');
    $this->load->view('addmail_description',$data);
    $this->load->view('footer');
  }

  public function save_description()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['title']         = $this->input->post('description_title');
    $data['description']   = $this->input->post('description');
    $data['description']   = $this->input->post('description');

    $result=$this->Usermodel->insertdescription($data);
    if($result > 0)
    {
      $this->session->set_flashdata('success',"Mail Description Added Successfully..!!");
      redirect('administration/save_description_new');
    }
    else
    {
      $this->session->set_flashdata('error', 'Something Went Wrong..!');
      redirect('administration/mail_description');
    }
  }

  public function editDescription()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $mail_dsc_id = $this->input->post('mail_dsc_id');
    $mail_dsc_title = $this->input->post('mail_dsc_title');
    $mail_descp = $this->input->post('mail_descp');

    if($mail_dsc_id != "")
    {
      if($mail_dsc_title != "" || $mail_descp != "")
      {
        $usr_arr = array("title"=> $mail_dsc_title, "description"=> $mail_descp );
        $tbl = "mail_description";
        $cond = array("id"=> $mail_dsc_id);
        $update = $this->Usermodel->update_query($usr_arr,$cond,$tbl);
        if($update > 0 )
        {
          $this->session->set_flashdata('success',"Mail Description Edited Successfully.");
          redirect('administration/mail_description');
        }
        else
        {
          $this->session->set_flashdata('error',"No data updated.");
          redirect('administration/mail_description');
        }
      }
      else
      {
        $this->session->set_flashdata('error',"Description or Title should not be empty");
        redirect('administration/mail_description');
      }
    }
    else
    {
      $this->session->set_flashdata('error',"Something went wrong. Please try again.");
      redirect('administration/mail_description');
    }
  }

  public function delete_description($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $delete = $this->db->where('id',$id)->delete('customer');
    if ($delete > 0)
    {
      $this->session->set_flashdata('success',"Description Deleted Successfully..!!");
      redirect('administration/mail_description');
    }
    else
    {
      $this->session->set_flashdata('error',"Description Not Deleted ..!!");
      redirect('administration/mail_description');
    }
  }

  public function save_description_new()
  {
    redirect('administration/mail_description');
  }

  public function get_mail_desc()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $id = $this->input->post('mail_dsc_id');
    if($id != "")
    {
      $data = $this->db->select('*')->from('mail_description')->where('id',$id)->get()->row_array();
      print_r($data['description']);
    }
    else
    {
      echo "hello";
    }
  }


}
