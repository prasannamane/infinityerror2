<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    //initialise the autoload things for this class
    $this->load->model('Usermodel');
    $this->load->model('googlecalendar');

    // if(!isset($this->session->balnxr_admin)){
    //   redirect('/','refresh');
    // }
  }

  public function index()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data["user"]=$this->Usermodel->getcount("users");
    $this->load->view('header');
    $this->load->view('home_old',$data);
    $this->load->view('footer');
  }

  public function est_id($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
        redirect('/','refresh');
    }
    $this->session->set_userdata('cust_id',$id);
    // redirect('home/estimate');
    redirect('home/select_type_estimate');
  }

  public function select_type_estimate()
  {
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $this->db->empty_table('temp_images');
    $this->db->empty_table('temp_images_mirror');

    $this->load->view('header');
    $this->load->view('select_type_estimate',$data);
    $this->load->view('footer');
  }
  public function user(){
      
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    $data['userlist']=$this->Usermodel->getAlldata('tbl_register');
    
    $this->load->view('header');
    $this->load->view('home',$data);
    $this->load->view('footer');
    
  }    
  public function adduser(){
      
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    

    $this->load->view('header');
    $this->load->view('adduser');
    $this->load->view('footer');
    
  } 
  public function saveuser(){

    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("fnm");
    $lnm=$this->input->post("lnm");
    $email=$this->input->post("email");
    $mob=$this->input->post("mob");
    $password=base64_encode($this->input->post("pwd"));
    $pincode=$this->input->post("pincode");
    $gender=$this->input->post("gender");
    $status=$this->input->post("status");
    $age=$this->input->post("age");
    $approved=$this->input->post("approved");
    $date = date("Y-m-d");
    if(!($this->Usermodel->check_email_exist($email))){
        $config=[
                'upload_path'=>"./uploads",
                'allowed_types'=>'jpg|jpeg|png'
            ];
        $this->load->library('upload',$config);
        if($this->upload->do_upload("profile_img")){
            $uploaddata=$this->upload->data();
            // var_dump($uploaddata);die;
            $img_path="uploads/".$uploaddata['raw_name'].$uploaddata['file_ext'];
        }else{
            // $img_path="uploads/a4.jpg";
            $img_path="assets/img/blankdp.png";
        }
        $data=array(
            "lnm"        => $lnm,
            "fnm"        => $fnm,
            "email"       => $email,
            "mob"   => $mob,
            "password"    => $password,
            "img" => $img_path,
            "status"        => $status,
            "gender"       => $gender,
            "approved"   => $approved,
            "age"    => $age,
            "date_added" => $date,
            "pincode" => $pincode,
            );
        $user_id = $this->Usermodel->insert_table("tbl_register",$data);
        $work_data = array(
            'user_id'    => $user_id,
            'total_sets' => 0
            );
        $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'User Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    }
    redirect("home/user");
  }
  public function updateuser(){
      $id=$this->input->post("uid");
    $fnm=$this->input->post("fnm");
    $lnm=$this->input->post("lnm");
    $email=$this->input->post("email");
    $mob=$this->input->post("mob");
    $password=base64_encode($this->input->post("pwd"));
    $pincode=$this->input->post("pincode");
    $gender=$this->input->post("gender");
    $status=$this->input->post("status");
    $age=$this->input->post("age");
    $approved=$this->input->post("approved");
    $date = date("Y-m-d");
    $config=[
            'upload_path'=>"./uploads",
            'allowed_types'=>'jpg|jpeg|png'
        ];
    $this->load->library('upload',$config);
    if($this->upload->do_upload("profile_img")){
        $uploaddata=$this->upload->data();
        $img_path="uploads/".$uploaddata['raw_name'].$uploaddata['file_ext'];
    }else{
        // $img_path="uploads/a4.jpg";http://tech599.com/tech599.com/johnbhu/tencount/admin/assets/img/profile_small.jpg
            $img_path="assets/img/blankdp.png";
    }
    $data=array(
        "lnm"        => $lnm,
        "fnm"        => $fnm,
        "email"       => $email,
        "mob"   => $mob,
        "password"    => $password,
        "img" => $img_path,
        "status"        => $status,
        "gender"       => $gender,
        "approved"   => $approved,
        "age"    => $age,
        "date_added" => $date,
        "pincode" => $pincode,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"tbl_register");
    if($user_updated){
        $data1['success']  = 'User Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/user");
  }
  public function getdataurl(){
    //   print_r($this->input->post());
     $where=array(
          'id' => $this->input->post("uid")
          );
      $user1=$this->Usermodel->getdata('tbl_register',$where);
       // print_r($user1);
       // die;
        
      $data = $user1->fnm."@@@@".$user1->lnm."@@@@".$user1->mob."@@@@".$user1->email."@@@@".$user1->date_added."@@@@".gender[$user1->gender]."@@@@".user_status[$user1->status]."@@@@".approved[$user1->approved]."@@@@".$user1->last_login;
    //   $data = implode(" ",$user1);
      echo "<tr>
                <td>First Name</td>
                <td>$user1->fnm</td>
            </tr>
            <tr>
                <td>Last name</td>
                <td>$user1->lnm</td>
            </tr>
            <tr>
                <td>Telephone</td>
                <td>$user1->mob</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>$user1->email</td>
            </tr>
            <tr>
                <td>Date Added</td>
                <td>$user1->date_added</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>".gender[$user1->gender]."</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>".user_status[$user1->status]."</td>
            </tr>
            <tr>
                <td>Approved</td>
                <td>".approved[$user1->approved]."</td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td>".$user1->pincode."</td>
            </tr>
            <tr>
                <td>Last Login</td>
                <td>".$user1->last_login."</td>
            </tr>";
  }
  public function search_by_filter()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $fnm = trim($this->input->post("fnm"));
        $lnm = trim($this->input->post("lnm"));
        $email = trim($this->input->post("email"));
        $telephone = trim($this->input->post("telephone"));
        $status = $this->input->post("status");
        $approved = $this->input->post("approved");
        $pincode = trim($this->input->post("pincode"));
        
        $fnm_l=strlen($fnm);
        $lnm_l=strlen($lnm);
        $email_l=strlen($email);
        $telephone_l=strlen($telephone);
        $pincode_l=strlen($pincode);
        
        $q2 = "where fnm like '%$fnm%' or lnm like '%$lnm%' or email like '%$email%' or mob like '%$telephone%' or status = $status or approved = $status or pincode = $pincode;";

        $qr = $this->create_query($fnm, $lnm, $email, $telephone, $status, $pincode,$approved);
        
        // echo $qr;die;
        
        $q1 = "select * from tbl_register ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        // print_r($res);die;
        $html = "<script>
                    $('.view_event').click(function(){  
                    var idx = $('.view_event').index(this);
                    var uid = $('.view_uid').eq(idx).val();
                    var url = $('#getdataurl').val();
                    // alert( ' uid '+uid);
                    $.ajax({
                       type: 'POST',
                       url: url,
                       data:{uid:uid},
                       success:function(data){
                        //   alert(data);
                        $('#table-popup').html(data);
                        $('#myModal_view').modal('show');
                            // window.location.reload();
                       }
                    });
                });
                    $('#multiple_delete_user').change(function() {
                    	if(this.checked) {
                    		$('.del_user').prop('checked', true); 
                    	}else{
                    		$('.del_user').prop('checked', false);
                    	}
                    });
                    $('.del_user').change(function() {
                    	 if(false == $(this).prop('checked')){
                    		 $('#multiple_delete_user').prop('checked', false);
                    	 }
                    	 if($('.del_user:checked').length == $('.del_user').length){
                    		 $('#multiple_delete_user').prop('checked', true);
                    	 }
                    }); 
                    </script>";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                    	<thead>
                    		<tr>
                    			<th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>
                    			<th>Name</th>
                    			<th>Email</th>
                    			<th>Mobile No</th>
                    			<th>Registration Date</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td class='view_event'>
                                <input type='hidden' value='".base_url("home/getdataurl")."' id='getdataurl'/>
                                <input type='hidden' value='".$user['id']."' class='view_uid'/>
                                ".$user['fnm']." ".$user['lnm']."</td>
                                <td>".$user['email']."</td>
                                <td>".$user['mob']."</td>
                                <td>".$user['date_added']."</td>
                                <td>
                                    <form method='POST' action='".base_url("home/viewuser")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-primary btn-sm btn_view'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/edituser")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deleteuser")."'>
                                        <input type='hidden' value='".$user['id']."' name='duid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-trash'></i>
                                            <input type='submit' value='' class='btn btn-danger btn-sm btn_delete' onclick='return confirm('Are you sure to delete?');'>
                                        </div>
                                    </form>
                                    
                                </td>
                                
                                
                              </tr>  
                
                            "; 
            }
            $html = $html." </table>";
        }else{
          $html = $html. "<h3>No Data Available</h3>";  
        }
        echo $html;
        
  }
  
  public function filterworksearch(){
    //   print_r($this->input->post());die;
      
      
       $name = trim($this->input->post("name"));
        $uid = trim($this->input->post("uid"));
        $totalsets = trim($this->input->post("totalsets"));
        $dt = trim($this->input->post("dt"));
        $status = $this->input->post("status");
        $date_last = $this->input->post("date_last");


        // $q2 = "where fnm like '%$fnm%' or lnm like '%$lnm%' or email like '%$email%' or mob like '%$telephone%' or status = $status or approved = $status or pincode = $pincode;";

        $qr = $this->create_work_query($uid, $dt, $totalsets, $name, $status, $date_last);
        
        // echo $qr;
        
        // $q1 = "select * from tbl_register ";
        // $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        // print_r($res);die;
        $html = "<script>
                $('#delAllchk').change(function() {
                	if(this.checked) {
                		$('.del').prop('checked', true); 
                	}else{
                		$('.del').prop('checked', false);
                	}
                });
                $('.del').change(function() {
                 if(false == $(this).prop('checked')){
                	 $('#delAllchk').prop('checked', false);
                 }
                 if($('.del:checked').length == $('.del').length){
                	 $('#delAllchk').prop('checked', true);
                 }
                }); 
                </script>";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                            <thead>
                                <tr>
                                    <th><input type='checkbox' id='delAllchk' name='delAll' class='delAll'></th>
                                    <th>User id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Total Sets</th>
                                    <th>Added Date</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
        
                                </tr>
                            </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                <td><input type='checkbox' name='vehicle1' class='del' value='".$user['whid']."'></td>
                                <td>".$user['id']."</td>
                                <td>".$user['fnm']." ".$user['lnm']."</td>
                                <td>".user_status[$user['status']]."</td>
                                <td>".$user['total_sets']."</td>
                                <td>".$user['date_added']."</td>
                                <td>".$user['last_login']."</td>
                                <td>
                                    <div class='row'>
                                    
                                    <div class='col-xs-6'>
                                      <form method='POST' action='".base_url("home/view_work")."'>
                                         <input type='hidden' value='".$user['whid']." name='euid'>
                                         <input type='hidden' value='".$user['fnm']." ".$user['lnm']."' name='unm'>
                                         <button type='submit' class='btn btn-sm btn_view'><i class='fa fa-eye'></i></button>
                                      </form>

                                      <form method='POST' action='".base_url("home/deletework")."'>
                                         <input type='hidden' value='".$user['whid']."' name='duid'>
                                         <button type='submit' class='btn btn-sm btn_delete'><i class='fa fa-trash'></i></button>
                                      </form>

                                      
                                    </div>
                                                                    
                                    </div>
                                    
                                </td>
                                
                                
                              </tr>  
                
                            "; 
            }
            $html = $html." </table>";
        }else{
          $html = $html. "<h3>No Data Available</h3>";  
        }
        echo $html;
      
      
  }
  public function create_query($fnm, $lnm, $email, $mob, $status, $pincode,$approved) 
  {
      $options = array(
        'fnm' => $fnm,
        'lnm' => $lnm,
        'email' => $email,
        'mob' => $mob,
        'status' => $status,
        'pincode' => $pincode,
        'approved' => $approved,
        );
      $cond = '';
      $noopt = true;
      foreach ($options as $column => $value) {
        if ($value) {
          $noopt = false;
          if ($cond != '') $cond .= ' OR ';
          $cond .= "$column LIKE '%$value%'";
          }
        }
      return $noopt ? "SELECT * FROM tbl_register" : "SELECT * FROM tbl_register WHERE $cond;";
  }
  public function create_work_query($uid, $dt, $totalsets, $name, $status, $date_last) 
  {
      $options = array(
        'tr.fnm' => $name,
        'tr.lnm' => $name,
        'wh.total_sets' => $totalsets,
        'wh.user_id' => $uid,
        'tr.status' => $status,
        'tr.date_added' => $dt,
        'tr.last_login' => $date_last,
        );
      $cond = '';
      $noopt = true;
      foreach ($options as $column => $value) {
        if ($value) {
          $noopt = false;
          if ($cond != '') $cond .= ' OR ';
          $cond .= "$column LIKE '%$value%'";
          }
        }
      return $noopt ? "SELECT wh.id as whid,total_sets,wh.work_time,tr.* FROM work_history as wh left join tbl_register as tr on wh.user_id = tr.id" : "SELECT wh.id as whid,total_sets,wh.work_time,tr.* FROM work_history as wh left join tbl_register as tr on wh.user_id = tr.id WHERE $cond;";
  }
  public function estimate()
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $this->load->view('header');
    $this->load->view('select_type_estimate');
    $this->load->view('footer');
  }

  public function estimate_new()
  {
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $id=$this->session->userdata('cust_id');
    $data['last_est_id'] = $this->db->order_by('est_id',"desc")->limit(1)->get('new_estimate')->row_array();

    if (empty($data['last_est_id']))
    {
      $data['last_est_id']=1;
    }

    if(!empty($this->session->new_large_est))
    {
      $est_id = $this->session->new_large_est;
      $est_data['est_details']=$this->Usermodel->get_all_est_data($est_id);
    }

    // print_r($data['last_est_id']);die;
    $data['img_count'] = $this->db->get('temp_images')->num_rows();
    $data['cust_data'] = $this->db->where('id',$id)->get('customer')->row_array();
    // $data['temp_images'] = $this->db->order_by("img_id", "asc")->get('temp_images')->result_array();
    $data['uprights_sts_height'] = $this->db->where('cat_id',1)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_sts_width'] = $this->db->where('cat_id',2)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_sts_quantity'] = $this->db->where('cat_id',3)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_adj_height'] = $this->db->where('cat_id',4)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_adj_width'] = $this->db->where('cat_id',5)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_adj_quantity'] = $this->db->where('cat_id',6)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['cleats_height'] = $this->db->where('cat_id',7)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['cleats_width'] = $this->db->where('cat_id',8)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['cleats_quantity'] = $this->db->where('cat_id',9)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['drawers_dimension'] = $this->db->where('cat_id',10)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['drawers_quantity'] = $this->db->where('cat_id',11)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['top_shelf_height'] = $this->db->where('cat_id',12)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['top_shelf_width'] = $this->db->where('cat_id',13)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['top_shelf_quantity'] = $this->db->where('cat_id',14)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['shelves_height'] = $this->db->where('cat_id',15)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['shelves_width'] = $this->db->where('cat_id',16)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['shelves_quantity'] = $this->db->where('cat_id',17)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['hanging_Rail_type'] = $this->db->where('cat_id',18)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['frame_color'] = $this->db->where('cat_id',19)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['infill_type'] = $this->db->where('cat_id',20)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['frame_color_two'] = $this->db->where('cat_id',23)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['wardrobe_desc_one'] = $this->db->where('cat_id',24)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['wardrobe_desc_two'] = $this->db->where('cat_id',25)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['wardrobe_desc_three'] = $this->db->where('cat_id',26)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    // echo "<pre>";print_r($data);die;
    if(!empty($this->session->new_large_est))
    {
      if($est_id != "")
      {
        $data = array_merge($data,$est_data);
      }
    }
    $this->load->view('header');
    $this->load->view('create_estimate',$data);
    $this->load->view('footer');
  }

  public function estimate_new_large()
  {
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $id=$this->session->userdata('cust_id');
    $data['last_est_id'] = $this->db->order_by('est_id',"desc")->limit(1)->get('new_estimate')->row_array();
    // print_r($data['last_est_id']); die;
    if (empty($data['last_est_id'])) {
      $data['last_est_id']=1;
    }

    if(!empty($this->session->new_large_est))
    {
      $est_id = $this->session->new_large_est;
      $est_data['est_details']=$this->Usermodel->get_all_est_data($est_id);
    }

    $data['img_count'] = $this->db->get('temp_images')->num_rows();
    // print_r($data['img_count']);die;

    $data['cust_data'] = $this->db->where('id',$id)->get('customer')->row_array();
    // $data['temp_images'] = $this->db->order_by("img_id", "asc")->get('temp_images')->result_array();
    $data['uprights_sts_height'] = $this->db->where('cat_id',1)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_sts_width'] = $this->db->where('cat_id',2)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_sts_quantity'] = $this->db->where('cat_id',3)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_adj_height'] = $this->db->where('cat_id',4)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_adj_width'] = $this->db->where('cat_id',5)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['uprights_adj_quantity'] = $this->db->where('cat_id',6)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['cleats_height'] = $this->db->where('cat_id',7)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['cleats_width'] = $this->db->where('cat_id',8)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['cleats_quantity'] = $this->db->where('cat_id',9)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['drawers_dimension'] = $this->db->where('cat_id',10)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['drawers_quantity'] = $this->db->where('cat_id',11)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['top_shelf_height'] = $this->db->where('cat_id',12)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['top_shelf_width'] = $this->db->where('cat_id',13)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['top_shelf_quantity'] = $this->db->where('cat_id',14)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['shelves_height'] = $this->db->where('cat_id',15)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['shelves_width'] = $this->db->where('cat_id',16)->order_by('ABS(sub_name)', 'ASC')->get('sub_categories')->result_array();
    $data['shelves_quantity'] = $this->db->where('cat_id',17)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['hanging_Rail_type'] = $this->db->where('cat_id',18)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['frame_color'] = $this->db->where('cat_id',19)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['infill_type'] = $this->db->where('cat_id',20)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['frame_color_two'] = $this->db->where('cat_id',23)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['wardrobe_desc_one'] = $this->db->where('cat_id',24)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['wardrobe_desc_two'] = $this->db->where('cat_id',25)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    $data['wardrobe_desc_three'] = $this->db->where('cat_id',26)->order_by('sub_name', 'ASC')->get('sub_categories')->result_array();
    // echo "<pre>";print_r($data);die;
    if(!empty($this->session->new_large_est))
    {
      if($est_id != "")
      {
        $data = array_merge($data,$est_data);
      }
    }
    $this->load->view('header');
    $this->load->view('estimate_new_large',$data);
    $this->load->view('footer');
  }

  public function mirror_estimate(){
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $id=$this->session->userdata('cust_id');
    $data['last_est_id'] = $this->db->order_by('est_id',"desc")->limit(1)->get('sh_mi_estimate')->row_array();

    if (empty($data['last_est_id'])) {
    $data['last_est_id']=1;
    }
    $data['img_count'] = $this->db->get('temp_images')->num_rows();
    $data['cust_data'] = $this->db->where('id',$id)->get('customer')->row_array();
    // echo "<pre>";print_r($data);die;

    $data['shower_location1'] = $this->db->where('cat_id',1)->get('sub_categories_shower_mirror')->result_array();
    $data['shower_location2'] = $this->db->where('cat_id',2)->get('sub_categories_shower_mirror')->result_array();
    $data['shower_glass_type'] = $this->db->where('cat_id',3)->get('sub_categories_shower_mirror')->result_array();
    $data['shower_color_frame'] = $this->db->where('cat_id',4)->get('sub_categories_shower_mirror')->result_array();
    $data['mirror_location1'] = $this->db->where('cat_id',5)->get('sub_categories_shower_mirror')->result_array();
    $data['mirror_location2'] = $this->db->where('cat_id',6)->get('sub_categories_shower_mirror')->result_array();
    $data['mirror_glass_type'] = $this->db->where('cat_id',7)->get('sub_categories_shower_mirror')->result_array();
    $data['mirror_color_frame'] = $this->db->where('cat_id',8)->get('sub_categories_shower_mirror')->result_array();
    $data['mirror_desc_cat'] = $this->db->where('cat_id',9)->get('sub_categories_shower_mirror')->result_array();
    $data['mirror_desc_type'] = $this->db->where('cat_id',10)->get('sub_categories_shower_mirror')->result_array();
    $data['shower_desc'] = $this->db->where('cat_id',11)->get('sub_categories_shower_mirror')->result_array();
    $data['shower_notes'] = $this->db->where('cat_id',12)->get('sub_categories_shower_mirror')->result_array();

    $this->load->view('header');
    $this->load->view('mirror_estimate',$data);
    $this->load->view('footer');
  }

//balustrade_estimate

  public function balustrade_estimate()
  {
    $id=$this->session->userdata('cust_id');
    $data['last_est_id'] = $this->db->order_by('est_id',"desc")->limit(1)->get('balustrade_estimate')->row_array();

    if (empty($data['last_est_id']))
    {
      $data['last_est_id']=1;
    }
    $data['img_count'] = $this->db->get('temp_images')->num_rows();
    $data['cust_data'] = $this->db->where('id',$id)->get('customer')->row_array();
    // echo "<pre>";print_r($data);die;

    $data['balus_desc_first'] = $this->db->where('cat_id',1)->get('balustrade_sub_category')->result_array();
    $data['balus_desc_second'] = $this->db->where('cat_id',2)->get('balustrade_sub_category')->result_array();
    $data['balus_frame_first'] = $this->db->where('cat_id',3)->get('balustrade_sub_category')->result_array();
    $data['balus_frame_second'] = $this->db->where('cat_id',4)->get('balustrade_sub_category')->result_array();
    $data['balus_infill'] = $this->db->where('cat_id',5)->get('balustrade_sub_category')->result_array();
    $data['balus_notes'] = $this->db->where('cat_id',6)->get('balustrade_sub_category')->result_array();

    $this->load->view('header');
    $this->load->view('balustrade_estimate',$data);
    $this->load->view('footer');
  }

  public function create_balustrade_estimate()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    // echo "<pre>";print_r($this->input->post());die;
    $temp_imagess=$this->db->order_by("id", "asc")->get('temp_images_mirror')->result_array();
    $img=count($temp_imagess);
    // print_r($img);die;
    $image_count=$this->input->post('img_count');

    $table='balustrade_estimate_id';
    $cus_id['cus_id'] = $this->input->post('cus_id');
    $result_estimate=$this->Usermodel->create_new_estimate($table,$cus_id);

    if ($result_estimate > 0) {
      for ($i=0; $i < $img ; $i++) {
        // $data['est_id']                = $result_estimate;

        $str="imgdata".$i;
        $imgdata=$this->input->post($str);

        $str="bl_width".$i;
        $width=$this->input->post($str);

        $str="bl_height".$i;
        $height=$this->input->post($str);

        $str="first_desc".$i;
        $first_desc=$this->input->post($str);
        if ($first_desc=="Custom Text") {
          $str="first_desc_text".$i;
          $first_desc=$this->input->post($str);
        }

        $str="second_desc".$i;
        $second_desc=$this->input->post($str);
        if ($second_desc=="Custom Text") {
          $str="second_desc_text".$i;
          $second_desc=$this->input->post($str);
        }

        $est_id = $result_estimate;

        $cus_id = $this->input->post('cus_id');

         $insertimage_data=$this->Usermodel->insertbimage_data($imgdata,$width,$height,$first_desc,$second_desc,$est_id,$cus_id);

         $img_id=$insertimage_data;
         $point_name="points".$i;
         $point_name=$this->input->post($point_name);
         $point_value="points_val".$i;
         $point_value=$this->input->post($point_value);

         for ($j=0; $j < count($point_value); $j++){
           // echo "<pre>";print_r($point_value[$j]);
           if ($point_value[$j] !=0) {
          $insertpoint_data=$this->Usermodel->insertbponts_data($img_id,$point_name[$j],$point_value[$j],$est_id);
           }
         }
      }

      $details['est_id']             =$result_estimate;
      $details['cus_id']             =$this->input->post('cus_id');
      $details['description']        =$this->input->post('shower_desc');
      $details['frame_color']        =$this->input->post('frame_color');
      if ($details['frame_color']=="Custom Text") {
      $details['frame_color']        =$this->input->post('frame_color_text');
      }
      $details['frame_color1']        =$this->input->post('frame_color1');
      $details['infill_type']        =$this->input->post('infill_type');
      if ($details['infill_type']=="Custom Text") {
      $details['infill_type']        =$this->input->post('infill_type_text');
      }
      // $details['removal_takeaway']   =$this->input->post('removal');
      // if ($details['removal_takeaway']=="Custom Text") {
      // }
      $details['removal_takeaway']        =$this->input->post('removal_text');
      $details['note']   =$this->input->post('note');
      if ($details['note']=="Custom Text") {
        $details['note']        =$this->input->post('note_text');
      }
      $details['total']   =$this->input->post('total');
      $details['deposit']   =$this->input->post('deposite');
      $details['balance']   =$this->input->post('balance');
      $details['order_date']   =$this->input->post('ordered');
      $details['installed_date']   =$this->input->post('install');

      $table='balustrade_estimate';
      $result_uprights=$this->Usermodel->insertdetails($table,$details);

      if ($result_uprights > 0) {

        if (isset($est_id)=="") {
          $this->session->set_flashdata('error', 'Select atlest one image...!');

          redirect('home/balustrade_estimate');
        }
        else {
          $est_data['est_details']=$this->Usermodel->get_all_balustrade_data($est_id);

          $est_data['estimate_images']=$this->Usermodel->get_all_balustrade_images($est_id);

          $est_data['est_extra_measurment']=$this->Usermodel->get_extra_bmeasurment_data($est_id);

          $mail_title=$this->input->post('mail_title');
          $est_data['get_mail_desc']=$this->Usermodel->get_mail_desc($mail_title);
          // echo "<pre>";print_r($est_data);die;

            $first_estimate=$this->pdf_balustrade_estimate($est_data,$est_id);

            $this->email->set_mailtype("html");
            $this->email->from('info@tech599.com', 'CRM PROJECT');
            $this->email->to($est_data['est_details'][0]['email']);
            $this->email->subject('Estimate Copy');
            $this->email->message($est_data['get_mail_desc']['description']);
            $this->email->attach($first_estimate);
            if ($this->email->send()) {
              // echo "send";die;
              $this->db->empty_table('temp_images');
            $this->load->view('balustrade_bill',$est_data);
            }
            else {
              // echo "not send";die;
                $this->db->empty_table('temp_images');
                $this->load->view('balustrade_bill',$est_data);
            }
        }


      }else {
        // echo "string1";die;
        $this->session->set_flashdata('error', 'Error. Something Went Wrong...!');

        redirect('home/balustrade_estimate');
      }
    }
    else {
      // echo "string2";die;
      $this->session->set_flashdata('error', 'Error. Something Went Wrong...!');

      redirect('home/balustrade_estimate');
    }


   }


     public function pdf_balustrade_estimate($est_data,$est_id){
       // $page_data_demo= $this->load->view('demo1',$est_data,true);
        $page_data= $this->load->view('balustrade_estimate_pdf',$est_data,true);

        $this->load->library('pdf');

         $this->pdf->load_html($page_data);

         // $customPaper = array(0,0,800,1500);
         // $this->pdf->set_paper($customPaper);
         $this->pdf->set_paper('A4');
         $this->pdf->render();

         $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
         $file_name = $est_id."balustrade".'.pdf';
         $full_path_new  = $path.$file_name;

         $output = $this->pdf->output();
        unset($this->pdf);
        file_put_contents($full_path_new, $output);

         // $this->email->attach($full_path_new_sec);
         return $full_path_new;

     }


  public function splashback_estimate()
  {
    $id=$this->session->userdata('cust_id');
    $data['last_est_id'] = $this->db->order_by('est_id',"desc")->limit(1)->get('splashback_estimate')->result_array()[0];
    $data['img_count'] = $this->db->get('temp_images')->num_rows();
    $data['cust_data'] = $this->db->where('id',$id)->get('customer')->row_array();
    // echo "<pre>";print_r($data);die;

    $data['bksp_desc_first'] = $this->db->where('cat_id',1)->get('backsplash_sub_category')->result_array();
    $data['bksp_desc_second'] = $this->db->where('cat_id',2)->get('backsplash_sub_category')->result_array();
    $data['bksp_frame'] = $this->db->where('cat_id',3)->get('backsplash_sub_category')->result_array();
    // $data['bksp_frame_second'] = $this->db->where('cat_id',4)->get('backsplash_sub_category')->result_array();
    $data['bksp_infill_type'] = $this->db->where('cat_id',5)->get('backsplash_sub_category')->result_array();

    $this->load->view('header');
    $this->load->view('splashback_estimate',$data);
    $this->load->view('footer');
  }

  public function create_splashback_estimate(){
    // error_reporting(0);
    // echo "<pre>";print_r($this->input->post());die;
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $temp_imagess=$this->db->order_by("img_id", "asc")->get('temp_images')->result_array();
    $img=count($temp_imagess);
    // print_r($img);die;
    $image_count=$this->input->post('img_count');

    $table='splashback_estimate_id';
    $cus_id['cus_id'] = $this->input->post('cus_id');
    $result_estimate=$this->Usermodel->create_new_estimate($table,$cus_id);

    if ($result_estimate > 0) {
      for ($i=0; $i < $img ; $i++) {
        // $data['est_id']                = $result_estimate;

        $str="imgdata".$i;
        $imgdata=$this->input->post($str);

        $str="bl_width".$i;
        $width=$this->input->post($str);

        $str="bl_height".$i;
        $height=$this->input->post($str);

        $str="ab".$i;
        $ab=$this->input->post($str);

        $str="cd".$i;
        $cd=$this->input->post($str);

        $str="ef".$i;
        $ef=$this->input->post($str);

        $str="gh".$i;
        $gh=$this->input->post($str);

        $str="first_desc".$i;
        $first_desc=$this->input->post($str);
        if ($first_desc=="Custom Text") {
          $str="first_desc_text".$i;
          $first_desc=$this->input->post($str);
        }

        $str="second_desc".$i;
        $second_desc=$this->input->post($str);
        if ($second_desc=="Custom Text") {
          $str="second_desc_text".$i;
          $second_desc=$this->input->post($str);
        }

        $est_id               = $result_estimate;

        $cus_id = $this->input->post('cus_id');

         $insertimage_data=$this->Usermodel->insertspimage_data($imgdata,$width,$height,$ab,$cd,$ef,$gh,$first_desc,$second_desc,$est_id,$cus_id);

         $img_id=$insertimage_data;
         $point_name="points".$i;
         $point_name=$this->input->post($point_name);
         $point_value="points_val".$i;
         $point_value=$this->input->post($point_value);

         for ($j=0; $j < count($point_value); $j++){
           // echo "<pre>";print_r($point_value[$j]);
           if ($point_value[$j] !=0) {
          $insertpoint_data=$this->Usermodel->insertsbponts_data($img_id,$point_name[$j],$point_value[$j],$est_id);
           }
         }
      }

      $details['est_id']             =$result_estimate;
      $details['cus_id']             =$this->input->post('cus_id');
      $details['description']        ="";
      // $details['description']        =$this->input->post('shower_desc');
      $details['frame_color']        =$this->input->post('frame_color');
      if ($details['frame_color']=="Custom Text") {
          $details['frame_color']        =$this->input->post('frame_color_text');
      }
      $details['infill_type']        =$this->input->post('infill_type');
      if ($details['infill_type']=="Custom Text") {
          $details['infill_type']        =$this->input->post('infill_type_text');
      }

      $details['removal_takeaway']        =$this->input->post('removal_text');

      $details['note']             = $this->input->post('notes');
      $details['total']            = $this->input->post('total');
      $details['deposit']          = $this->input->post('deposite');
      $details['balance']          = $this->input->post('balance');
      $details['order_date']       = $this->input->post('ordered');
      $details['installed_date']   = $this->input->post('install');

      $table='splashback_estimate';
      $result_uprights=$this->Usermodel->insertdetails($table,$details);

      if ($result_uprights > 0) {

        if (isset($est_id)=="") {
          $this->session->set_flashdata('error', 'Select atlest one image...!');

          redirect('home/splashback_estimate');
        }
        else {
          $est_data['est_details']=$this->Usermodel->get_all_splashback_data($est_id);
          // $est_data['est_details_info']=$this->Usermodel->get_all_splashback_images($est_id);

          $est_data['estimate_images']=$this->Usermodel->get_all_splashback_images($est_id);

          $est_data['est_extra_measurment']=$this->Usermodel->get_extra_spmeasurment_data($est_id);

          $mail_title=$this->input->post('mail_title');
          $est_data['get_mail_desc']=$this->Usermodel->get_mail_desc($mail_title);

          // print_r($est_data['estimate_images']); die;

          foreach($est_data['estimate_images'] as $key=>$images)
          {
            $path=$images['splashback_images'];
            $path1=dirname($path);
            $path2=$path1.'/notext/';
            $imgnm=basename($path);
            $allpath=$path2.$imgnm;
            $est_data['estimate_images'][$key]['splashback_images'] = $allpath;
          }

            $first_estimate=$this->pdf_splashback_estimate($est_data,$est_id);
            $this->email->set_mailtype("html");
            $this->email->from('info@tech599.com', 'CRM PROJECT');
            $this->email->to($est_data['est_details'][0]['email']);
            $this->email->subject('Estimate Copy');
            $this->email->message($est_data['get_mail_desc']['description']);
            // $this->email->attach($full_path);
            $this->email->attach($first_estimate);
            // $this->email->attach($full_path_new);
            // $this->email->attach($door_estimate);

            if ($this->email->send()) {
              $this->db->empty_table('temp_images');
            $this->load->view('splashback_bill',$est_data);
            }
            else {
              $this->load->view('splashback_bill',$est_data);
                $this->db->empty_table('temp_images');
            }
        }


      }
    }

  }

  public function pdf_splashback_estimate($est_data,$est_id)
  {
    // $page_data_demo= $this->load->view('demo1',$est_data,true);
     $page_data= $this->load->view('splashback_estimate_pdf',$est_data,true);

     $this->load->library('pdf');

      $this->pdf->load_html($page_data);

      // $customPaper = array(0,0,800,1500);
      $this->pdf->set_paper('A4');
      $this->pdf->render();

      $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
      $file_name = $est_id."splashback".'.pdf';
      $full_path_new  = $path.$file_name;

      $output = $this->pdf->output();
     unset($this->pdf);
     file_put_contents($full_path_new, $output);

      // $this->email->attach($full_path_new_sec);
      return $full_path_new;

  }

  public function estimate_cancel(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    redirect('home/estimate_cancel_one','refresh');
  }


  public function estimate_cancel_one(){
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $this->db->empty_table('temp_images');
    $id=$this->session->userdata('cust_id');
    $data['last_est_id'] = $this->db->order_by('est_id',"desc")->limit(1)->get('new_estimate')->result_array()[0];
    $data['cust_data'] = $this->db->where('id',$id)->get('customer')->row_array();
    $data['temp_images'] = $this->db->get('temp_images')->result_array();
    $data['uprights_sts_height'] = $this->db->where('cat_id',1)->get('sub_categories')->result_array();
    $data['uprights_sts_width'] = $this->db->where('cat_id',2)->get('sub_categories')->result_array();
    $data['uprights_sts_quantity'] = $this->db->where('cat_id',3)->get('sub_categories')->result_array();
    $data['uprights_adj_height'] = $this->db->where('cat_id',4)->get('sub_categories')->result_array();
    $data['uprights_adj_width'] = $this->db->where('cat_id',5)->get('sub_categories')->result_array();
    $data['uprights_adj_quantity'] = $this->db->where('cat_id',6)->get('sub_categories')->result_array();
    $data['cleats_height'] = $this->db->where('cat_id',7)->get('sub_categories')->result_array();
    $data['cleats_width'] = $this->db->where('cat_id',8)->get('sub_categories')->result_array();
    $data['cleats_quantity'] = $this->db->where('cat_id',9)->get('sub_categories')->result_array();
    $data['drawers_dimension'] = $this->db->where('cat_id',10)->get('sub_categories')->result_array();
    $data['drawers_quantity'] = $this->db->where('cat_id',11)->get('sub_categories')->result_array();
    $data['top_shelf_height'] = $this->db->where('cat_id',12)->get('sub_categories')->result_array();
    $data['top_shelf_width'] = $this->db->where('cat_id',13)->get('sub_categories')->result_array();
    $data['top_shelf_quantity'] = $this->db->where('cat_id',14)->get('sub_categories')->result_array();
    $data['shelves_height'] = $this->db->where('cat_id',15)->get('sub_categories')->result_array();
    $data['shelves_width'] = $this->db->where('cat_id',16)->get('sub_categories')->result_array();
    $data['shelves_quantity'] = $this->db->where('cat_id',17)->get('sub_categories')->result_array();
    $data['hanging_Rail_type'] = $this->db->where('cat_id',18)->get('sub_categories')->result_array();
    $data['frame_color'] = $this->db->where('cat_id',19)->get('sub_categories')->result_array();
    $data['infill_type'] = $this->db->where('cat_id',20)->get('sub_categories')->result_array();
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('create_estimate',$data);
    $this->load->view('footer');
  }

  public function sampledesign(){

    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $data['img_count'] = $this->db->get('temp_images')->num_rows();
    // print_r($data);die;
    $this->load->view('header');
    $this->load->view('sample-design',$data);
    $this->load->view('footer');
  }


  public function customdesign(){

    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $this->load->view('header');
    $this->load->view('custom-design');
    $this->load->view('footer');
  }


   public function create_estimate2(){

    $this->load->view('bill2');

    // $this->load->view('header');
    // $this->load->view('bill2');
    // $this->load->view('footer');
  }





  public function img_upload(){

       $this->Usermodel->img_upload_dtls();
  }
  public function img_upload_mirror(){

       $this->Usermodel->img_upload_mirror();
  }
  public function img_upload_splashback(){

       $this->Usermodel->img_upload_splashback();
  }
  public function img_delete(){

       $this->Usermodel->img_delete();
  }
  public function img_counts(){

    $result=$this->db->select('*')->from('temp_images_mirror')->get()->result_array();
    if (count($result) > 0) {
      $count=count($result);
      echo $count;
    }
    else {
      $count=0;
      echo $count;
    }
  }
  public function count_db(){

         $temp_images=$this->db->order_by("img_id", "asc")->get('temp_images')->result_array();
         echo count($temp_images);
  }
  public function img_mirror_delete(){

       $this->Usermodel->img_mirror_delete();
  }
  public function img_splashback_delete(){

       $this->Usermodel->img_splashback_delete();
  }
  public function update_images(){

       $this->Usermodel->img_sample();
  }
  public function update_images_mirror(){

       $this->Usermodel->img_sample_mirror();
  }
  public function update_images_splashback(){

       $this->Usermodel->img_sample_splashback();
  }

  public function remove_sess()
  {
    $this->session->unset_userdata("new_large_est"); die;
    $est_id = $this->input->post('est_id');
    $details =  $this->Usermodel->get_all_est_dat($est_id);

    $response["message_code"]  = 0;
    $response["message"] = "Response";
    $response["res"] = $details;
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function create_estimate(){
    // error_reporting(0);
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    if($this->input->post('create_another') == "create_new_est")
    {
      // echo "<pre>";print_r($this->input->post());die;
      $temp_imagess      = $this->db->order_by("img_id", "asc")->get('temp_images')->result_array();
      $img               = count($temp_imagess);
      $image_count       = $this->input->post('img_count');
      $upright_width     = $this->input->post('upright_width');
      $up_adj_width      = $this->input->post('up_adj_width');
      $cleats_width      = $this->input->post('cleats_width');
      $drawers_size      = $this->input->post('drawers_size');
      $top_shelf_height  = $this->input->post('top_shelf_height');
      $shelves_width     = $this->input->post('shelves_width');
      $hanging_rail_type = $this->input->post('hanging_rail_type');
      $page_no = $this->input->post('page_no');
      // wardrobedescription
      $wardrobedescription1 = $this->input->post('wardrobedescription1');
      if ($wardrobedescription1=="NO SELECTION") {
        $wardrobedescription1 = "";
      }
      $wardrobedescription2 = $this->input->post('wardrobedescription2');
      $wardrobedescription3 = $this->input->post('wardrobedescription3');

      $table ='new_estimate';
      $cus_id['cus_id'] = $this->input->post('cus_id');
      if($page_no > 0)
      {
        $result_estimate = $this->input->post('est_numb');
        $this->db->set('pg_id',$page_no)->where('est_id',$result_estimate)->update($table);
      }
      else
      {
        $result_estimate = $this->Usermodel->create_new_estimate($table,$cus_id);
      }

      if($result_estimate > 0)
      {
        for($i=0; $i < count($upright_width) ; $i++)
        {
          $data1['est_id'] = $result_estimate;
          $data1['pg_id'] = $page_no;
          $data1['sts_width'] = $this->input->post('upright_width')[$i];
          if ($data1['sts_width']=="Custom Text") {
              $data1['sts_width'] = $this->input->post('custom_upright_width')[$i];
          }
          $data1['sts_height']            = $this->input->post('upright_height')[$i];
          if ($data1['sts_height']=="Custom Text") {
              $data1['sts_height'] = $this->input->post('custom_upright_height')[$i];
          }
          $data1['sts_qty'] = $this->input->post('upright_qty')[$i];
          if ($data1['sts_qty']=="Custom Text") {
              $data1['sts_qty'] = $this->input->post('custom_upright_qty')[$i];
          }

          $table='uprights_sts';
          $result_uprights = $this->Usermodel->insertuprights($table,$data1);
        }
        for ($j=0; $j < count($up_adj_width) ; $j++)
        {
          $data2['est_id'] = $result_estimate;
          $data2['pg_id'] = $page_no;

          $data2['adj_width'] = $this->input->post('up_adj_width')[$j];
          if ($data2['adj_width']=="Custom Text") {
              $data2['adj_width'] = $this->input->post('custom_up_adj_width')[$j];
          }

          $data2['adj_height'] = $this->input->post('up_adj_height')[$j];
          if ($data2['adj_height']=="Custom Text") {
              $data2['adj_height'] = $this->input->post('custom_upright_height')[$j];
          }

          $data2['adj_qty'] = $this->input->post('up_adj_qty')[$j];
          if ($data2['adj_qty']=="Custom Text") {
              $data2['adj_qty'] = $this->input->post('custom_up_adj_qty')[$j];
          }

          $table='uprights_adj';
           $result_uprights=$this->Usermodel->insertuprights($table,$data2);
        }
        for ($k=0; $k < count($cleats_width) ; $k++)
        {
          $data3['est_id'] = $result_estimate;
          $data3['pg_id'] = $page_no;

          $data3['cleats_width'] = $this->input->post('cleats_width')[$k];
          if ($data3['cleats_width']=="Custom Text") {
              $data3['cleats_width'] = $this->input->post('custom_cleats_width')[$k];
          }

          $data3['cleats_height'] = $this->input->post('cleats_height')[$k];
          if ($data3['cleats_height']=="Custom Text") {
              $data3['cleats_height'] = $this->input->post('custom_upright_height')[$k];
          }

          $data3['cleats_qty'] = $this->input->post('cleats_qty')[$k];
          if ($data3['cleats_qty']=="Custom Text") {
              $data3['cleats_qty'] = $this->input->post('custom_cleats_qty')[$k];
          }
          $table='cleats';
          $result_uprights=$this->Usermodel->insertuprights($table,$data3);
        }
        for ($l=0; $l < count($drawers_size) ; $l++)
        {
          $data4['est_id'] = $result_estimate;
          $data4['pg_id'] = $page_no;
          $data4['drawers_size'] = $this->input->post('drawers_size')[$l];
          if ($data4['drawers_size']=="Custom Text") {
              $data4['drawers_size'] = $this->input->post('custom_drawers_size')[$l];
          }

          $data4['drawers_qty'] = $this->input->post('drawers_qty')[$l];
          if ($data4['drawers_qty']=="Custom Text") {
              $data4['drawers_qty'] = $this->input->post('custom_drawers_qty')[$l];
          }

          $table='drawers';
           $result_uprights=$this->Usermodel->insertuprights($table,$data4);
        }
        for ($h=0; $h < count($top_shelf_height) ; $h++)
        {
          $data5['est_id'] = $result_estimate;
          $data5['pg_id'] = $page_no;

          $data5['shelf_width'] = $this->input->post('top_shelf_width')[$h];
          if ($data5['shelf_width']=="Custom Text") {
              $data5['shelf_width'] = $this->input->post('custom_top_shelf_width')[$h];
          }

          $data5['shelf_height'] = $this->input->post('top_shelf_height')[$h];
          if ($data5['shelf_height']=="Custom Text") {
              $data5['shelf_height'] = $this->input->post('custom_top_shelf_height')[$h];
          }

          $data5['shelf_qty'] = $this->input->post('top_shelf_qty')[$h];
          if ($data5['shelf_qty']=="Custom Text") {
              $data5['shelf_qty'] = $this->input->post('custom_top_shelf_qty')[$h];
          }

          $table = 'top_shelf';
          $result_uprights = $this->Usermodel->insertuprights($table,$data5);
        }
        for ($a=0; $a < count($shelves_width) ; $a++)
        {
          $data6['est_id'] = $result_estimate;
          $data6['pg_id'] = $page_no;
          $data6['shelves_width'] = $this->input->post('shelves_width')[$a];
          if ($data6['shelves_width']=="Custom Text") {
              $data6['shelves_width'] = $this->input->post('custom_shelves_width')[$a];
          }
          $data6['shelves_height'] = $this->input->post('shelves_height')[$a];
          if ($data6['shelves_height']=="Custom Text") {
              $data6['shelves_height'] = $this->input->post('custom_shelves_height')[$a];
          }
          $data6['shelves_qty'] = $this->input->post('shelves_qty')[$a];
          if ($data6['shelves_qty']=="Custom Text") {
              $data6['shelves_qty'] = $this->input->post('custom_shelves_qty')[$a];
          }

          $table='shelves';
          $result_uprights=$this->Usermodel->insertuprights($table,$data6);
        };
        for ($w=0; $w < count($wardrobedescription1) ; $w++)
        {
          $data8['est_id'] = $result_estimate;
          $data8['pg_id'] = $page_no;
          $data8['description_first'] = $wardrobedescription1[$w];
          if ($data8['description_first']=="Custom Text") {
            $data8['description_first']      = $this->input->post('custom_wardrobedescription1')[$w];
          }
          $data8['description_second'] = $wardrobedescription2[$w];
          if ($data8['description_second']=="Custom Text") {
            $data8['description_second']      = $this->input->post('custom_wardrobedescription2')[$w];
          }
          $data8['description_third'] = $wardrobedescription3[$w];
          if ($data8['description_third']=="Custom Text") {
            $data8['description_third']      = $this->input->post('custom_wardrobedescription3')[$w];
          }
          // echo "<pre>";print_r($data8);
          $table='wardrobe_description';
           $result_uprights=$this->Usermodel->insertuprights($table,$data8);
        };
        // echo "string";die;
        for ($e=0; $e < count($hanging_rail_type) ; $e++)
        {
          $table = 'hanging_rail';
          $data7['est_id'] = $result_estimate;
          $data7['pg_id'] = $page_no;
          $data7['hanging_rail_type'] = $hanging_rail_type[$e];
          if ($data7['hanging_rail_type']=="Custom Text")
          {
            $data7['hanging_rail_type'] = $this->input->post('custom_hanging_rail_type')[$e];
          }
          $result_uprights = $this->Usermodel->insertuprights($table,$data7);
        }
        for ($s=0; $s < $img; $s++)
        {
          // echo $s;echo "<br>";
          $str = "imgdata".$s;
          $imgdata = $this->input->post($str);
          // echo "<pre>".$result_estimate;print_r($imgdata);echo "<br>";
          $s_width_c ="s_width".$s;
          $s_width = $this->input->post($s_width_c);

          $s_height_c ="s_height".$s;
          $s_height = $this->input->post($s_height_c);

          $d_width_c ="d_width".$s;
          $d_width = $this->input->post($d_width_c);

          $d_height_c ="d_height".$s;
          $d_height = $this->input->post($d_height_c);
          if ($imgdata !="")
          {
            $est_id = $result_estimate;
            $insertimage_data=$this->Usermodel->insertimage_data($imgdata,$s_width,$s_height,$d_width,$d_height,$est_id,$page_no);
          }
          else
          {
            // echo "2";
          }
        }

        $details['est_id']      = $result_estimate;
        $details['pg_id']       = $page_no;
        $details['cust_id']     = $this->input->post('cus_id');
        $details['frame_color'] = $this->input->post('frame_color');
        if ($details['frame_color']=="Custom Text") {
          $details['frame_color'] = $this->input->post('frame_custom_color');
        }
        if ($details['frame_color']=="No Selection") {
        $details['frame_color'] ="";
        }
        $details['frame_color_sec'] = $this->input->post('frame_color1');
        if ($details['frame_color_sec']=="Custom Text") {
          $details['frame_color_sec'] = $this->input->post('frame_custom_color1');
        }
        $details['infill_type'] = $this->input->post('infill_type');
        if ($details['infill_type']=="Custom Text") {
          $details['infill_type'] = $this->input->post('infill_custom_type');
        }
        $details['est_note']            = $this->input->post('note');
        $details['representative_name'] = $this->input->post('rep_name');
        $details['reference_number']    = $this->input->post('ref_no');
        $details['send_mail']           = $this->input->post('pdf');
        $details['representative_home'] = $this->input->post('send_representative');
        $details['removal_takeaway']    = $this->input->post('shower_rem_tak');
        $details['total_amount']        = $this->input->post('total');
        $details['total_deposite']      = $this->input->post('deposite');
        $details['total_balance']       = $this->input->post('balance');

        $details['estimate_type']       = $this->input->post('estimate_select_type');
        $details['thumbnail_img']       = $this->input->post('thumb_img');
        $details['ordered']             = $this->input->post('ordered');
        $details['installed']           = $this->input->post('install');
        $table = 'estimate_details';
        $result_uprights=$this->Usermodel->insertdetails($table,$details);

        if ($result_uprights > 0)
        {
          // $send_mail = $this->input->post('pdf');
          // $send_representative = $this->input->post('send_representative');
          // redirect('home/estimate');
          if (isset($est_id)=="")
          {
            if($details['estimate_type'] == 1)
            {
              $this->session->set_flashdata('error', 'Select atlest one image...!');
              redirect('home/estimate_new_large');
            }
            else
            {
              $this->session->set_flashdata('error', 'Select atlest one image...!');
              redirect('home/estimate_new');
            }

          }
          $est_data['est_details']=$this->Usermodel->get_all_est_data($est_id);
          $est_data['est_details_info']=$this->Usermodel->get_all_est_deatils($est_id);

          $est_data['estimate_images']=$this->Usermodel->estimate_images($est_id);

          $est_data['uprights_std']=$this->Usermodel->uprights_std($est_id);
          // print_r($est_data['uprights_std']);die;
          $est_data['top_shelf']=$this->Usermodel->get_top_shelf($est_id);
          $est_data['cleats']=$this->Usermodel->get_cleats($est_id);

          $est_data['uprights_adj']=$this->Usermodel->uprights_adj($est_id);
          $est_data['shelves']=$this->Usermodel->get_shelves($est_id);
          $est_data['hanging_rail']=$this->Usermodel->get_hanging_rail($est_id);

          $est_data['est_drawers']=$this->Usermodel->get_all_est_drawer($est_id);

          $est_data['wardrobe_description']=$this->Usermodel->getwardrobe_description($est_id);
          // echo "<pre>";print_r($est_data);die;
          $this->db->empty_table('temp_images');

          if($details['estimate_type'] == 1)
          {
            $this->session->set_userdata('new_large_est',$est_id);
            redirect('Home/estimate_new_large');
            // echo $this->session->new_large_est; die;
          }
          else
          {
            $this->session->set_userdata('new_large_est',$est_id);
            redirect('Home/estimate_new');
            // $this->load->view('header');
            // $this->load->view('estimate_new',$data,$est_data);
            // $this->load->view('footer');
          }
        }
        else
        {
          $this->session->set_flashdata('error', 'Something Went Wrong..!');
          redirect('home/estimate');
        }
      }
      else
      {
        $this->session->set_flashdata('error', 'Something Went Wrong..!');
        redirect('home/estimate');
      }
    }
    else
    {
      $temp_imagess      = $this->db->order_by("img_id", "asc")->get('temp_images')->result_array();
      $img               = count($temp_imagess);
      $image_count       = $this->input->post('img_count');
      $upright_width     = $this->input->post('upright_width');
      $up_adj_width      = $this->input->post('up_adj_width');
      $cleats_width      = $this->input->post('cleats_width');
      $drawers_size      = $this->input->post('drawers_size');
      $top_shelf_height  = $this->input->post('top_shelf_height');
      $shelves_width     = $this->input->post('shelves_width');
      $hanging_rail_type = $this->input->post('hanging_rail_type');
      $page_no = $this->input->post('page_no');
      // wardrobedescription
      $wardrobedescription1 = $this->input->post('wardrobedescription1');
      if ($wardrobedescription1=="NO SELECTION") {
        $wardrobedescription1 = "";
      }
      $wardrobedescription2 = $this->input->post('wardrobedescription2');
      $wardrobedescription3 = $this->input->post('wardrobedescription3');

      $table ='new_estimate';
      $cus_id['cus_id'] = $this->input->post('cus_id');
      if($page_no > 0) //no need to create new estimate
      {
        $result_estimate = $this->input->post('est_numb');
        $this->db->set('pg_id',$page_no)->where('est_id',$result_estimate)->update($table); // update page number
      }
      else
      {
        $result_estimate = $this->Usermodel->create_new_estimate($table,$cus_id);
      }
      if($result_estimate > 0)
      {
        for($i=0; $i < count($upright_width) ; $i++)
        {
          $data1['est_id'] = $result_estimate;
          $data1['pg_id'] = $page_no;
          $data1['sts_width'] = $this->input->post('upright_width')[$i];
          if ($data1['sts_width']=="Custom Text") {
              $data1['sts_width'] = $this->input->post('custom_upright_width')[$i];
          }
          $data1['sts_height'] = $this->input->post('upright_height')[$i];
          if ($data1['sts_height']=="Custom Text") {
              $data1['sts_height'] = $this->input->post('custom_upright_height')[$i];
          }
          $data1['sts_qty'] = $this->input->post('upright_qty')[$i];
          if ($data1['sts_qty']=="Custom Text") {
              $data1['sts_qty'] = $this->input->post('custom_upright_qty')[$i];
          }

          $table='uprights_sts';
          $result_uprights = $this->Usermodel->insertuprights($table,$data1);
        }
        for ($j=0; $j < count($up_adj_width) ; $j++)
        {
          $data2['est_id'] = $result_estimate;
          $data2['pg_id'] = $page_no;

          $data2['adj_width'] = $this->input->post('up_adj_width')[$j];
          if ($data2['adj_width']=="Custom Text") {
              $data2['adj_width'] = $this->input->post('custom_up_adj_width')[$j];
          }

          $data2['adj_height'] = $this->input->post('up_adj_height')[$j];
          if ($data2['adj_height']=="Custom Text") {
              $data2['adj_height'] = $this->input->post('custom_upright_height')[$j];
          }

          $data2['adj_qty'] = $this->input->post('up_adj_qty')[$j];
          if ($data2['adj_qty']=="Custom Text") {
              $data2['adj_qty'] = $this->input->post('custom_up_adj_qty')[$j];
          }

          $table='uprights_adj';
           $result_uprights=$this->Usermodel->insertuprights($table,$data2);
        }
        for ($k=0; $k < count($cleats_width) ; $k++)
        {
          $data3['est_id'] = $result_estimate;
          $data3['pg_id'] = $page_no;

          $data3['cleats_width'] = $this->input->post('cleats_width')[$k];
          if ($data3['cleats_width']=="Custom Text") {
              $data3['cleats_width'] = $this->input->post('custom_cleats_width')[$k];
          }

          $data3['cleats_height'] = $this->input->post('cleats_height')[$k];
          if ($data3['cleats_height']=="Custom Text") {
              $data3['cleats_height'] = $this->input->post('custom_upright_height')[$k];
          }

          $data3['cleats_qty'] = $this->input->post('cleats_qty')[$k];
          if ($data3['cleats_qty']=="Custom Text") {
              $data3['cleats_qty'] = $this->input->post('custom_cleats_qty')[$k];
          }
          $table='cleats';
          $result_uprights=$this->Usermodel->insertuprights($table,$data3);
        }
        for ($l=0; $l < count($drawers_size) ; $l++)
        {
          $data4['est_id'] = $result_estimate;
          $data4['pg_id'] = $page_no;
          $data4['drawers_size'] = $this->input->post('drawers_size')[$l];
          if ($data4['drawers_size']=="Custom Text") {
              $data4['drawers_size'] = $this->input->post('custom_drawers_size')[$l];
          }

          $data4['drawers_qty'] = $this->input->post('drawers_qty')[$l];
          if ($data4['drawers_qty']=="Custom Text") {
              $data4['drawers_qty'] = $this->input->post('custom_drawers_qty')[$l];
          }

          $table='drawers';
           $result_uprights=$this->Usermodel->insertuprights($table,$data4);
        }
        for ($h=0; $h < count($top_shelf_height) ; $h++)
        {
          $data5['est_id'] = $result_estimate;
          $data5['pg_id'] = $page_no;

          $data5['shelf_width'] = $this->input->post('top_shelf_width')[$h];
          if ($data5['shelf_width']=="Custom Text") {
              $data5['shelf_width'] = $this->input->post('custom_top_shelf_width')[$h];
          }

          $data5['shelf_height'] = $this->input->post('top_shelf_height')[$h];
          if ($data5['shelf_height']=="Custom Text") {
              $data5['shelf_height'] = $this->input->post('custom_top_shelf_height')[$h];
          }

          $data5['shelf_qty'] = $this->input->post('top_shelf_qty')[$h];
          if ($data5['shelf_qty']=="Custom Text") {
              $data5['shelf_qty'] = $this->input->post('custom_top_shelf_qty')[$h];
          }

          $table = 'top_shelf';
          $result_uprights = $this->Usermodel->insertuprights($table,$data5);
        }
        for ($a=0; $a < count($shelves_width) ; $a++)
        {
          $data6['est_id'] = $result_estimate;
          $data6['pg_id'] = $page_no;
          $data6['shelves_width'] = $this->input->post('shelves_width')[$a];
          if ($data6['shelves_width']=="Custom Text") {
              $data6['shelves_width'] = $this->input->post('custom_shelves_width')[$a];
          }
          $data6['shelves_height'] = $this->input->post('shelves_height')[$a];
          if ($data6['shelves_height']=="Custom Text") {
              $data6['shelves_height'] = $this->input->post('custom_shelves_height')[$a];
          }
          $data6['shelves_qty'] = $this->input->post('shelves_qty')[$a];
          if ($data6['shelves_qty']=="Custom Text") {
              $data6['shelves_qty'] = $this->input->post('custom_shelves_qty')[$a];
          }

          $table='shelves';
           $result_uprights=$this->Usermodel->insertuprights($table,$data6);
        };
        for ($w=0; $w < count($wardrobedescription1) ; $w++)
        {
          $data8['est_id'] = $result_estimate;
          $data8['pg_id'] = $page_no;
          $data8['description_first'] = $wardrobedescription1[$w];
          if ($data8['description_first']=="Custom Text") {
            $data8['description_first']      = $this->input->post('custom_wardrobedescription1')[$w];
          }
          $data8['description_second'] = $wardrobedescription2[$w];
          if ($data8['description_second']=="Custom Text") {
            $data8['description_second']      = $this->input->post('custom_wardrobedescription2')[$w];
          }
          $data8['description_third'] = $wardrobedescription3[$w];
          if ($data8['description_third']=="Custom Text") {
            $data8['description_third']      = $this->input->post('custom_wardrobedescription3')[$w];
          }
          // echo "<pre>";print_r($data8);
          $table='wardrobe_description';
           $result_uprights=$this->Usermodel->insertuprights($table,$data8);
        };
        for ($e=0; $e < count($hanging_rail_type) ; $e++)
        {
          $table = 'hanging_rail';
          $data7['est_id'] = $result_estimate;
          $data7['pg_id'] = $page_no;
          $data7['hanging_rail_type'] = $hanging_rail_type[$e];
          if ($data7['hanging_rail_type']=="Custom Text")
          {
            $data7['hanging_rail_type'] = $this->input->post('custom_hanging_rail_type')[$e];
          }
          $result_uprights = $this->Usermodel->insertuprights($table,$data7);
        }
        for ($s=0; $s < $img; $s++)
        {
          // echo $s;echo "<br>";

          $str = "imgdata".$s;
          $imgdata = $this->input->post($str);
          // echo "<pre>".$result_estimate;print_r($imgdata);echo "<br>";
          $s_width_c ="s_width".$s;
          $s_width = $this->input->post($s_width_c);

          $s_height_c ="s_height".$s;
          $s_height = $this->input->post($s_height_c);

          $d_width_c ="d_width".$s;
          $d_width = $this->input->post($d_width_c);

          $d_height_c ="d_height".$s;
          $d_height = $this->input->post($d_height_c);
          if ($imgdata !="")
          {
            $est_id = $result_estimate;
            $insertimage_data=$this->Usermodel->insertimage_data($imgdata,$s_width,$s_height,$d_width,$d_height,$est_id,$page_no);
          }
          else
          {
            // echo "2";
          }
        }

        $details['est_id']      = $result_estimate;
        $details['pg_id']       = $page_no;
        $details['cust_id']     = $this->input->post('cus_id');
        $details['frame_color'] = $this->input->post('frame_color');
        if ($details['frame_color']=="Custom Text") {
          $details['frame_color'] = $this->input->post('frame_custom_color');
        }
        if ($details['frame_color']=="No Selection") {
        $details['frame_color'] ="";
        }
        $details['frame_color_sec'] = $this->input->post('frame_color1');
        if ($details['frame_color_sec']=="Custom Text") {
          $details['frame_color_sec'] = $this->input->post('frame_custom_color1');
        }
        $details['infill_type'] = $this->input->post('infill_type');
        if ($details['infill_type']=="Custom Text") {
          $details['infill_type'] = $this->input->post('infill_custom_type');
        }
        $details['est_note']            = $this->input->post('note');
        $details['representative_name'] = $this->input->post('rep_name');
        $details['reference_number']    = $this->input->post('ref_no');
        $details['send_mail']           = $this->input->post('pdf');
        $details['representative_home'] = $this->input->post('send_representative');
        $details['removal_takeaway']    = $this->input->post('shower_rem_tak');
        $details['total_amount']        = $this->input->post('total');
        $details['total_deposite']      = $this->input->post('deposite');
        $details['total_balance']       = $this->input->post('balance');

        $details['estimate_type']       = $this->input->post('estimate_select_type');
        $details['thumbnail_img']       = $this->input->post('thumb_img');
        $details['ordered']             = $this->input->post('ordered');
        $details['installed']           = $this->input->post('install');
        $table = 'estimate_details';
        $result_uprights=$this->Usermodel->insertdetails($table,$details);

        if ($result_uprights > 0)
        {
          $send_mail = $this->input->post('pdf');
          $send_representative = $this->input->post('send_representative');
          // redirect('home/estimate');
          if ($send_mail==1)
          {
            // $cus_id=$this->input->post('cus_id');
            if (isset($est_id)=="")
            {
              if($details['estimate_type'] == 1)
              {
                $this->session->set_flashdata('error', 'Select atlest one image...!');
                redirect('home/estimate_new_large');
              }
              else
              {
                $this->session->set_flashdata('error', 'Select atlest one image...!');
                redirect('home/estimate_new');
              }
            }

            $pages = $this->Usermodel->getWardrobesPages($est_id);
            $total_pages = $pages['pg_id'];

            $list = array();
            for($i = 0; $i <= $total_pages ; $i++)
            {
               $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
               $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
               $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
               // print_r($est_data['uprights_std']);die;
               $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
               $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
               $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
               $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
               $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
               $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
               $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
               $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

            }

            $est_data['est_details']           =  $list['est_details'];
            $est_data['estimate_images']       =  $list['estimate_images'];
            $est_data['uprights_std']          =  $list['uprights_std'];
            // print_r($est_data['uprights_std']);die;
            $est_data['top_shelf']             =  $list['top_shelf'];
            $est_data['cleats']                =  $list['cleats'];
            $est_data['uprights_adj']          =  $list['uprights_adj'];
            $est_data['shelves']               =  $list['shelves'];
            $est_data['hanging_rail']          =  $list['hanging_rail'];
            $est_data['est_drawers']           =  $list['est_drawers'];
            $est_data['est_details_data']      =  $list['est_details_data'];
            $est_data['wardrobe_description']  =  $list['wardrobe_description'];

            $mail_title=$this->input->post('mail_title');
            $est_data['get_mail_desc']=$this->Usermodel->get_mail_desc($mail_title);
          // echo "<pre>";  print_r($est_data);die;
            $first_estimate=$this->first_estimate($est_data,$est_id);
            $door_estimate=$this->door_estimate($est_data,$est_id);

            $this->email->set_mailtype("html");
            $this->email->from('info@tech599.com', 'CRM PROJECT');
            $this->email->to($est_data['est_details'][0]['email']);
            $this->email->subject('Estimate Copy');
            $this->email->message($est_data['get_mail_desc']['description']);
            // $this->email->attach($full_path);
            $this->email->attach($first_estimate);
            // $this->email->attach($full_path_new);
            $this->email->attach($door_estimate);

            if ($this->email->send())
            {
              $this->session->unset_userdata('new_large_est');
              $this->db->empty_table('temp_images');
              // $this->load->view('bill',$est_data);
              redirect('home/view_wardrobe_est/'.$est_id);
            }
            else
            {
              $this->session->unset_userdata('new_large_est');
              $this->db->empty_table('temp_images');
              // $this->load->view('bill',$est_data);
              redirect('home/view_wardrobe_est/'.$est_id);
            }

          }
          else
          {
            redirect('home/view_wardrobe_est/'.$est_id);
          }
          // if ($send_representative==1) {
          //   // $event = array(
          //   //       'summary'     => 'Demo',
          //   //       'start'       => date('Y-m-d', strtotime(' +1 day')).'T'.date("h:i").':00+03:00',
          //   //       'end'         => date('Y-m-d', strtotime(' +1 day')).'T'.date("h:i").':00+03:00',
          //   //       'description' => 'Test event',
          //   //   );
          //   //   $foo = $this->googlecalendar->addEvent('primary', $event);
          // }
          // else { }
        }
        else
        {
          $this->session->set_flashdata('error', 'Something Went Wrong..!');
          redirect('home/estimate');
        }
      }
      else
      {
        $this->session->set_flashdata('error', 'Something Went Wrong..!');
        redirect('home/estimate');
      }
    }
  }

  public function first_estimate($est_data,$est_id)
  {
    // $page_data_demo= $this->load->view('demo1',$est_data,true);
    $page_data= $this->load->view('pdf_testnew',$est_data,true);

    $this->load->library('pdf');

    $this->pdf->load_html($page_data);

    $customPaper = array(0,0,800,1500);
    $this->pdf->set_paper($customPaper);
    $this->pdf->render();

    $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name = $est_id."wardrop_first".'.pdf';
    $full_path_new  = $path.$file_name;

    $output = $this->pdf->output();
    unset($this->pdf);
    file_put_contents($full_path_new, $output);

    // $this->email->attach($full_path_new_sec);
    return $full_path_new;
  }

  public function door_estimate($est_data,$est_id)
  {
    // $page_data_demo= $this->load->view('demo1',$est_data,true);
    $page_data_demo= $this->load->view('wardrop_two_estimate_pdf',$est_data,true);

    $this->load->library('pdf');

     $this->pdf->load_html($page_data_demo);

     $customPaper_two = array(0,0,800,1500);
     $this->pdf->set_paper($customPaper_two);
     $this->pdf->render();

     $path_sec = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
     $file_name_second = $est_id."wardrop_second".'.pdf';
     $full_path_new_sec  = $path_sec.$file_name_second;
     //ob_start();
     $output_sec = $this->pdf->output();
     //ob_clean();

     file_put_contents($full_path_new_sec, $output_sec);

      // $this->email->attach($full_path_new_sec);
      return $full_path_new_sec;

  }


  public function view_wardrobe_est($est_id)
  {
    $pages = $this->Usermodel->getWardrobesPages($est_id);
    $total_pages = $pages['pg_id'];

    $list = array();
    for($i = 0; $i <= $total_pages ; $i++)
    {
       $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
       $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
       $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
       // print_r($est_data['uprights_std']);die;
       $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
       $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
       $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
       $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
       $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
       $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
       $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
       $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

    }

    $est_data['est_details']           =  $list['est_details'];
    $est_data['estimate_images']       =  $list['estimate_images'];
    $est_data['uprights_std']          =  $list['uprights_std'];
    $est_data['top_shelf']             =  $list['top_shelf'];
    $est_data['cleats']                =  $list['cleats'];
    $est_data['uprights_adj']          =  $list['uprights_adj'];
    $est_data['shelves']               =  $list['shelves'];
    $est_data['hanging_rail']          =  $list['hanging_rail'];
    $est_data['est_drawers']           =  $list['est_drawers'];
    $est_data['est_details_data']      =  $list['est_details_data'];
    $est_data['wardrobe_description']  =  $list['wardrobe_description'];



      //echo "<pre>";print_r($est_data['wardrobe_description']); exit;
    $this->session->unset_userdata('new_large_est');
    $this->load->view('bill',$est_data);
  }
  public function edituser(){
    //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('tbl_register',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    // $data['id'] = $user[0]["id"];
    // $data['name'] = $user[0]["name"];
    // $data['email'] = $user[0]["email"];
    // $data['mobile_no'] = $user[0]["mobile_no"];
    // $data['password'] = $user[0]["password"];
    // $data['profile_img'] = $user[0]["profile_img"];
    // $data['status'] = $user[0]["status"];
    // $data['verified'] = $user[0]["verified"];
    // $data['type'] = $user[0]["type"];
    
    // $data['id'] = $user->id;
    // $data['name'] = $user->name;
    // $data['email'] = $user->email;
    // $data['mobile_no'] = $user->mobile_no;
    // $data['password'] = $user->password;
    // $data['profile_img'] = $user->profile_img;
    // $data['status'] = $user->status;
    // $data['verified'] = $user->verified;
    // $data['type'] = $user->type;
    
    // echo "<pre>";var_dump($data);die;
    
    $this->load->view('header');
    $this->load->view('edituser', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
  public function getchartdata(){
      $hard_SQL="SELECT
            date(work_time) AS date,
            hardest_strike as hard
        FROM
            work_history 
        WHERE
            user_id=10";

     $hard_data = $this->db->query($hard_SQL)->result_array();
     $data = array();
        foreach ($hard_data as $row) {
        	$data[] = $row;
        }
    print json_encode($hard_data);
  }
  public function viewuser(){
    //   echo $euid;
      $where=array(
          'id' => $this->input->post("vuid")
          );
          $work_where=array(
          'user_id' => $this->input->post("vuid")
          );
          
          $uid=$this->input->post("vuid");
      $SQL="SELECT
            date(work_time) AS date,
            time(work_time) AS time,
            hardest_strike as hard,
            total_sets as ts,
            avg_no_strike as avgst,
            rounds as rounds,
            round_length as rl
        FROM
            work_history 
        WHERE
            user_id=".$uid.";";
        // GROUP BY
        //     date(work_time);";         
      $user1=$this->Usermodel->getdata('tbl_register',$where);
    //   $work_data=$this->Usermodel->getdata('work_history',$work_where);
    //   echo "<pre>";var_dump($user);die;
    
    $query = $this->db->query($SQL);

    $work_data = $query->result_array();
    
    $hard_SQL="SELECT
            month(work_time) AS month,
            MAX(hardest_strike) as hard
        FROM
            work_history 
        WHERE
            user_id=".$uid."
        GROUP BY
            MONTH(work_time);";
    
    $hard_data = $this->db->query($hard_SQL)->result_array();
    
    
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    

    // echo "<pre>";var_dump($data);die;
    
    $this->load->view('header');
    $this->load->view('view_user', ['user'=>$user1,'work'=>$work_data,'hard'=>$hard_data]);
    $this->load->view('footer');
      
  }
  public function deleteuser(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $set=array(
          'status'  => 4,
          );
          
       $this->Usermodel->update_query($set,$where,"tbl_register");
          
    //   $this -> db -> where($where);
    //   $this -> db -> delete('tbl_register');
      redirect("home/user");
  }
  public function deletework(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('work_history');
      redirect("home/work_history");
  }
  public function multiple_deletework(){
    //   var_dump($dellist);die;
      $arr=$this->input->post('dellist');
    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('work_history');
    }
  }
  public function multiple_deleteuser(){
    //   var_dump($dellist);die;
      $arr=$this->input->post('dellist');
    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('tbl_register');
    }
  }
  public function work_history(){
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    $data['work_historylist']=$this->Usermodel->get_user_work();
    // echo "<pre>";var_dump($data['work_historylist']);die;
    $this->load->view('header');
    $this->load->view('work_history',$data);
    $this->load->view('footer');
  }
   public function view_work(){
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    $data['unm']=$this->input->post('unm');
    // $data['work_historylist']=$this->Usermodel->getdata();
    // echo "<pre>";var_dump($data['work_historylist']);die;
    $this->load->view('header');
    $this->load->view('view_work',$data);
    $this->load->view('footer');
  }
  public function create_mirror_estimate()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    // echo "<pre>";print_r($this->input->post('first_location0'));die;
    $shower_color_frame=$this->input->post('shower_color_frame');
    $shower_glass=$this->input->post('shower_glass');
    // $mirror_location1=$this->input->post('mirror_location1');
    $mirror_color_frame=$this->input->post('mirror_color_frame');
    $mirror_glass=$this->input->post('mirror_glass');
    $mirror_desc1=$this->input->post('mirror_desc1');
    $img_count=$this->input->post('img_count');
    // print_r($img_count);die;

    $table='sh_mi_estimate';
    $cus_id['cus_id'] = $this->input->post('cus_id');
    $cus_id['description'] = $this->input->post('shower_desc');
    $cus_id['note1'] = $this->input->post('note_select');
    $cus_id['note2'] = $this->input->post('custom_note');
    $cus_id['removal_takeaway'] = $this->input->post('shower_rem_tak');
    $cus_id['total_amount'] = $this->input->post('total');
    $cus_id['deposite_amount'] = $this->input->post('deposite');
    $cus_id['balance_amount'] = $this->input->post('balance');
    $cus_id['order_date'] = $this->input->post('ordered');
    $cus_id['installed_date'] = $this->input->post('install');

    // echo "<pre>";print_r($cus_id);die;
    $result_estimate=$this->Usermodel->create_new_estimate($table,$cus_id);
    // print_r($result_estimate);die;
    $est_id="";
    if ($img_count !="") {
      // code...

    if (count($result_estimate) > 0) {

      for ($i=0; $i < $img_count ; $i++)
      {
        $str="imgdata".$i;
        $imgdata=$this->input->post($str);

        $s_width_c="s_width".$i;
        // echo $s_width_c;echo "<br>";die;
        $s_width=$this->input->post($s_width_c);
        // echo $s_width;echo "<br>";
        $s_height_c="s_height".$i;
        $s_height=$this->input->post($s_height_c);
        // echo $s_height;echo "<br>";
        $d_width_c="d_width".$i;
        $d_width=$this->input->post($d_width_c);
        // echo $d_width;echo "<br>";

        $m_width="m_width".$i;
        $m_width=$this->input->post($m_width);

        $m_height="m_height".$i;
        $m_height=$this->input->post($m_height);

        $d_height="d_height".$i;
        $return_r=$this->input->post($d_height);

        $angle_val="angle_val".$i;
        $angle_val_imp=$this->input->post($angle_val);
        $angle_val=implode(",",$angle_val_imp);
         // print_r($angle_val);echo "<br>";die;

        $type="type".$i;
        $type=$this->input->post($type);

        $first_location="first_location".$i;
        $first_location=$this->input->post($first_location);
        if ($first_location=="Custom Text") {
          $str="custom_location".$i;
          $first_location=$this->input->post($str);
        }
        // print_r($first_location);echo "<br>";
        $second_location="second_location".$i;
        $second_location=$this->input->post($second_location);
        if ($second_location=="Custom Text") {
          $str="custom_second_location".$i;
          $second_location=$this->input->post($str);
        }

        $type="type".$i;
        $type=$this->input->post($type);
        if ($type=="Shower") {
          $shower_glass="shower_glass".$i;
          $shower_glass=$this->input->post($shower_glass);
          if ($shower_glass=="Custom Text") {
            $str="custom_glass".$i;
            $shower_glass=$this->input->post($str);
          }
          // echo $shower_glass; "<br>";die;

          $shower_color_frame="shower_color_frame".$i;
          $shower_color_frame=$this->input->post($shower_color_frame);

          if ($shower_color_frame=="Custom Text") {
            $str="custom_shower_color_frame".$i;
            $shower_color_frame=$this->input->post($str);
          }
        }
        else {
          $shower_glass="mirror_glass".$i;
          $shower_glass=$this->input->post($shower_glass);
          if ($shower_glass=="Custom Text") {
            $str="custom_mirror_glass".$i;
            $shower_glass=$this->input->post($str);
          }

          $shower_color_frame="mirror_color_frame".$i;
          $shower_color_frame=$this->input->post($shower_color_frame);

          if ($shower_color_frame=="Custom Text") {
            $str="custom_mirror_color_frame".$i;
            $shower_color_frame=$this->input->post($str);
          }
        }

        $point_name="points".$i;
        $point_name=$this->input->post($point_name);
        // print_r($point_name);echo "<br>";die;

        $shower_screen="shower_screen".$i;
        $shower_screen=$this->input->post($shower_screen);

        if ($shower_screen=="Custom Text") {
          $str="custom_shower_screen".$i;
          $shower_screen=$this->input->post($str);
        }
        // print_r($point_name);echo "<br>";die;
        $mirror_screen_first="mirror_first_screen".$i;
        $mirror_screen_first=$this->input->post($mirror_screen_first);

        if ($mirror_screen_first=="Custom Text") {
          $str="custom_mirror_first_screen".$i;
          $mirror_screen_first=$this->input->post($str);
        }

        $mirror_second_screen="mirror_second_screen".$i;
        $mirror_screen_second=$this->input->post($mirror_second_screen);

        if ($mirror_screen_second=="Custom Text") {
          $str="custom_mirror_second_screen".$i;
          $mirror_screen_second=$this->input->post($str);
        }

        if ($imgdata !="") {
          $est_id               = $result_estimate;
           $insertimage_data=$this->Usermodel->insertmirrorimage_data($imgdata,$s_width,$s_height,$d_width,$angle_val,$est_id,$type,$first_location,$second_location,$shower_color_frame,$shower_glass,$shower_screen,$mirror_screen_first,$mirror_screen_second,$m_width,$m_height,$return_r);

           $img_id=$insertimage_data;
           $point_name="points".$i;
           $point_name=$this->input->post($point_name);
           $point_value="points_val".$i;
           $point_value=$this->input->post($point_value);

           for ($j=0; $j < count($point_value); $j++){
             // echo "<pre>";print_r($point_value[$j]);
             if ($point_value[$j] !=0) {
            $insertimage_data=$this->Usermodel->insertponts_data($img_id,$point_name[$j],$point_value[$j],$est_id);
             }

           }
        }

        else {
          // echo "2";
        }

      }

      for ($i=0; $i < count($mirror_desc1) ; $i++) {
        $data5 = array();
        $data5['est_id']                = $result_estimate;
        $data5['mirror_desc_type1']     = $this->input->post('mirror_desc1')[$i];
        $data5['mirror_desc_type2']     = $this->input->post('mirror_desc2')[$i];
        $table='mirror_desc';
         $result_uprights=$this->Usermodel->insertuprights($table,$data5);
      }

      $data7['est_id']         = $result_estimate;
      $data7['rem_tak']        = $this->input->post('mirror_re_ta');
      $table='mirror_rem_tak';
      $result_uprights=$this->Usermodel->insertuprights($table,$data7);


      $this->session->set_flashdata('success', 'Estimate Created Successfully ..!');
      $this->db->empty_table('temp_images_mirror');

      $est_data['est_details']=$this->Usermodel->get_mirror_customer_data($est_id);

      foreach($est_data['est_details'] as $key=>$images)
      {
        $path=$images['sh_images'];
        $path1=dirname($path);
        $path2=$path1.'/notext/';
        $imgnm=basename($path);
        $allpath=$path2.$imgnm;
        $est_data['est_details'][$key]['sh_images'] = $allpath;
      }
      // echo "<pre>";print_r($est_data['est_details']);die;
      if (count($est_data['est_details']) =="") {
        $est_data['est_details'][0]['email']="";
      }
      $est_data['est_extra_measurment']=$this->Usermodel->get_extra_measurment_data($est_id);
      $est_data['get_data']=$this->Usermodel->get_data_est($est_id);

      $page_data= $this->load->view('mirror_shower_pdf',$est_data,true);

      // $page_data=$this->pdf->view('mirror_shower_pdf',$est_data);
      // $html = $this->output->get_output();
      $this->load->library('pdf');
      // print_r($html);die;
       // Load HTML content
       $this->pdf->load_html($page_data);
       // (Optional) Setup the paper size and orientation
       $this->pdf->setPaper('A4');
       // $customPaper = array(0,0,800,1200);
       // $this->pdf->set_paper($customPaper);
       // Render the HTML as PDF
       $this->pdf->render();

       $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
       $file_name = $est_id."bild2".'.pdf';
       $full_path_new  = $path.$file_name;
       $output = $this->pdf->output();
       file_put_contents($full_path_new, $output);

        $mail_title=$this->input->post('mail_title');
        $est_data['get_mail_desc']=$this->Usermodel->get_mail_desc($mail_title);


        $this->email->set_mailtype("html");
        $this->email->from('info@tech599.com', 'CRM PROJECT');
        $this->email->to($est_data['est_details'][0]['email']);
        $this->email->subject('Estimate Copy');
        $this->email->message($est_data['get_mail_desc']['description']);
        $this->email->attach($full_path_new);

        if($this->email->send())
        {
          $this->load->view('mirror_bill',$est_data);
        }
        else
        {
          $this->load->view('mirror_bill',$est_data);
        }

      }
      else
      {
        $this->session->set_flashdata('error', 'Something Went Wrong..!');
        redirect('home/mirror_estimate','refresh');
      }
    }
    else
    {
      $this->session->set_flashdata('error', 'Please Select at least one image..!');
      redirect('home/mirror_estimate','refresh');
    }


  }

  public function teacher()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['customer'] = $this->db->get('customer')->result_array();

    $this->load->view('header');

    $this->load->view('teacher_view',$data);

    $this->load->view('footer');

  }


  public function addcustomers(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');

    $this->load->view('addcustomers',$data);

    $this->load->view('footer',$data);

  }

  public function add_customer()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $data1['customer_name']        = $this->input->post('name');
    $data1['phone']                = $this->input->post('phone');
    $data1['email']                = $this->input->post('email');
    $data1['address']              = $this->input->post('address');
    $data1['comment']              = $this->input->post('comment');
    $data1['customer_type']        = $this->input->post('cus_type');
    $data1['date']                 = $this->input->post('date');
    $data1['site_address']         = $this->input->post('site_address');
    $data1['send_representative']  = $this->input->post('send_representative');
    $data1['x_st']                 = $this->input->post('xst');
    $data1['rep_name']             = $this->input->post('rep');

    // print_r($data);die;
    $result=$this->Usermodel->insertcustomer($data1);
    if($result > 0)
    {
      // $this->session->set_flashdata('success', 'Customer Created Successfully ..!');
      $this->db->empty_table('temp_images');
      redirect('home/est_id/'.$result);
      // redirect('home/est_id/'.$result);
    }
    else
    {
      $this->session->set_flashdata('error', 'Something Went Wrong..!');
      redirect('home/customers');
    }
  }

  public function create_bill()
  {

    // if(!isset($this->session->balnxr_admin)){
    //
    //   redirect('/','refresh');
    //
    // }
    $this->load->view('bill');

  }

  public function call_pdf($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $est_id=$id;

    $pages = $this->Usermodel->getWardrobesPages($est_id);
    $total_pages = $pages['pg_id'];

    $list = array();
    for($i = 0; $i <= $total_pages ; $i++)
    {
       $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
       $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
       $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
       // print_r($est_data['uprights_std']);die;
       $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
       $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
       $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
       $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
       $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
       $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
       $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
       $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

    }

    $est_data['est_details']           =  $list['est_details'];
    $est_data['estimate_images']       =  $list['estimate_images'];
    $est_data['uprights_std']          =  $list['uprights_std'];
    $est_data['top_shelf']             =  $list['top_shelf'];
    $est_data['cleats']                =  $list['cleats'];
    $est_data['uprights_adj']          =  $list['uprights_adj'];
    $est_data['shelves']               =  $list['shelves'];
    $est_data['hanging_rail']          =  $list['hanging_rail'];
    $est_data['est_drawers']           =  $list['est_drawers'];
    $est_data['est_details_data']      =  $list['est_details_data'];
    $est_data['wardrobe_description']  =  $list['wardrobe_description'];
    $flag = 1;
    // echo "<pre>"; print_r($list['estimate_images']);die;

    $this->load->view('wardrop_two_estimate_pdf',$est_data);

    $html = $this->output->get_output();
    $this->load->library('pdf');
    // print_r($html);die;
     // Load HTML content
     $this->pdf->loadHtml($html);

     // (Optional) Setup the paper size and orientation
     $this->pdf->setPaper('A4');
     // $customPaper = array(0,0,800,1500);
     // $this->pdf->set_paper($customPaper);

     // Render the HTML as PDF
     $this->pdf->render();

     // Output the generated PDF (1 = download and 0 = preview)
     $this->pdf->stream($est_id."estimate.pdf", array("Attachment"=>0));

  }

  public function download_mirror_pdf($id){

    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
      $est_id=$id;

      $est_data['est_details']=$this->Usermodel->get_mirror_customer_data($est_id);

      $html = $this->load->view('mirror_shower_pdf',$est_data,true);
      // echo "<pre>";print_r($html);die;
      $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
      $file_name = $est_id.'_'.date("Ymdhis").'.pdf';
      $full_path  = $path.$file_name;
      $real_path = base_url()."uploads/pdf/".$file_name;
      $this->load->library('m_pdf');
      $pdf = $this->m_pdf->load();
      $pdf->WriteHTML($html);
      ob_clean();
      $pdf->Output($full_path, "D");
      $this->db->empty_table('temp_images');
      redirect('home/estimate');

  }
  public function get_customer_data($id){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $this->session->set_userdata('cus_select_id',$id);
    redirect('home/cus_data_id_view');

  }
  public function cus_data_id_view(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $id=$this->session->userdata('cus_select_id');
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    $data['cus_data']=$this->Usermodel->get_cus_data_id($id);

    // echo "<pre>";print_r($data);die;

    $this->load->view('header');
    $this->load->view('view_customer_data',$data);
    $this->load->view('footer');
  }


  public function get_estimate_data($id){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $this->session->set_userdata('user',$id);
    redirect('home/cus_estimate_id_view');

  }
  public function get_splashback_data($id){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $this->session->set_userdata('user',$id);
    redirect('home/cus_splashback_estimate_id_view');

  }
  public function cus_splashback_estimate_id_view(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $id=$this->session->userdata('user');
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $data['all_mirror']     = $this->Usermodel->get_cus_splashback_estimate($id);
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('all_splashback_estimate',$data);
    $this->load->view('footer');
  }

  public function get_balustrade_data($id){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $this->session->set_userdata('user',$id);
    redirect('home/cus_balustrade_estimate_id_view');

  }
  public function cus_balustrade_estimate_id_view(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $id=$this->session->userdata('user');
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $data['all_mirror']     = $this->Usermodel->get_cus_balustrade_estimate($id);
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('all_balustrade_estimate',$data);
    $this->load->view('footer');
  }


  public function get_mirror_shower_data($id){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $this->session->set_userdata('get_mirror_shower_id',$id);
    redirect('home/cus_mirror_showerid_view');

  }

  public function get_estimate_details_view($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id =$id;
    $pages = $this->Usermodel->getWardrobesPages($est_id);
    $total_pages = $pages['pg_id'];

    $list = array();
    for($i = 0; $i <= $total_pages ; $i++)
    {
       $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
       $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
       $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
       // print_r($est_data['uprights_std']);die;
       $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
       $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
       $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
       $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
       $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
       $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
       $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
       $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

    }

    $est_data['est_details']           =  $list['est_details'];
    $est_data['estimate_images']       =  $list['estimate_images'];
    $est_data['uprights_std']          =  $list['uprights_std'];
    $est_data['top_shelf']             =  $list['top_shelf'];
    $est_data['cleats']                =  $list['cleats'];
    $est_data['uprights_adj']          =  $list['uprights_adj'];
    $est_data['shelves']               =  $list['shelves'];
    $est_data['hanging_rail']          =  $list['hanging_rail'];
    $est_data['est_drawers']           =  $list['est_drawers'];
    $est_data['est_details_data']      =  $list['est_details_data'];
    $est_data['wardrobe_description']  =  $list['wardrobe_description'];

    // echo "<pre>";print_r($est_data);die;
    $this->load->view('bill',$est_data);

  }

  public function get_second_estimate_details($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id =$id;
    // echo $est_id;die;
    $pages = $this->Usermodel->getWardrobesPages($est_id);
    $total_pages = $pages['pg_id'];

    $list = array();
    for($i = 0; $i <= $total_pages ; $i++)
    {
       $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
       $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
       $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
       // print_r($est_data['uprights_std']);die;
       $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
       $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
       $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
       $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
       $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
       $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
       $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
       $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

    }

    $est_data['est_details']           =  $list['est_details'];
    $est_data['estimate_images']       =  $list['estimate_images'];
    $est_data['uprights_std']          =  $list['uprights_std'];
    $est_data['top_shelf']             =  $list['top_shelf'];
    $est_data['cleats']                =  $list['cleats'];
    $est_data['uprights_adj']          =  $list['uprights_adj'];
    $est_data['shelves']               =  $list['shelves'];
    $est_data['hanging_rail']          =  $list['hanging_rail'];
    $est_data['est_drawers']           =  $list['est_drawers'];
    $est_data['est_details_data']      =  $list['est_details_data'];
    $est_data['wardrobe_description']  =  $list['wardrobe_description'];

    $this->load->view('bill2',$est_data);

  }

  public function email_to_vendor()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $est_id = trim($this->input->post('est_id'));
    $cust_email = trim($this->input->post('cust_email_id'));
    $desc = $this->input->post('cutting_description');
    if(!empty($est_id) && !empty($cust_email))
    {

      // echo $est_id;die;
      $pages = $this->Usermodel->getWardrobesPages($est_id);
      $total_pages = $pages['pg_id'];

      $list = array();
      for($i = 0; $i <= $total_pages ; $i++)
      {
         $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
         $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
         $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
         // print_r($est_data['uprights_std']);die;
         $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
         $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
         $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
         $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
         $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
         $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
         $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
         $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

      }

      $est_details           =  $list['est_details'];
      // $est_data['estimate_images']       =  $list['estimate_images'];
      $uprights_std          =  $list['uprights_std'];
      $top_shelf             =  $list['top_shelf'];
      $cleats                =  $list['cleats'];
      $uprights_adj          =  $list['uprights_adj'];
      $shelves               =  $list['shelves'];
      $hanging_rail          =  $list['hanging_rail'];
      $est_drawers           =  $list['est_drawers'];
      $est_details_data      =  $list['est_details_data'];
      $wardrobe_description  =  $list['wardrobe_description'];

      //echo "<pre>";print_r($top_shelf);die;


      $message = "";
      $message .= $desc;
      $message .= "<br>";
      $message .='<!DOCTYPE html>
      <html lang="en">
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          <title>PRO Shower Screens and Wardrobes</title>

          <style>
            table.productsTable {
              border-width: 1px;
              border-spacing: 2px;
              border-style: outset;
              border-color: gray;
              border-collapse: separate;
              background-color: white;
            }

            table.productsTable td {
              border-width: 1px;
              padding: 1px;
              border-style: inset;
              border-color: gray;
              background-color: white;
              -moz-border-radius: ;
            }
          </style>




        </head>
        <body>';
           for($kd = 0; $kd < count($est_details); $kd++) {
          $message .='<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <section class="content">

                <div class="row ">
                  <div class="col-sm-8">
                    <div class="row nospace_row">

                      <div class="col-sm-4" style="display:inline-block; vertical-align:top; width:30%;">

                        <table border="1">
                          <tr>
                            <th width="18%">Uprights STD</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                          </tr>';
                          foreach ($uprights_std[$kd] as $uprights_std1) {
                            $message .='
                            <tr>
                            <td>';
                            if(isset($uprights_std1['sts_width']) && $uprights_std1['sts_width'] != 0)
                            {
                              $message .= $uprights_std1['sts_width'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($uprights_std1['sts_height']) && $uprights_std1['sts_height'] != 0)
                            {
                              $message .= $uprights_std1['sts_height'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($uprights_std1['sts_qty']) && $uprights_std1['sts_qty'] != 0)
                            {
                              $message .= $uprights_std1['sts_qty'];
                            }
                            $message .='</td>

                            </tr>';
                          }

                          $message .='</table>
                          </div>

                          <div class="col-sm-4" style="display:inline-block; vertical-align:top; width:30%;">
                          <table border="1" style="width:100%">
                          <tr>
                          <th width="18%">Top Shelf</th>
                          <th width="5%"></th>
                          <th width="5%"></th>
                          </tr>';

                          foreach ($top_shelf[$kd] as $top_shelf1) {

                            $message .='<tr>
                            <td>';
                            if(isset($top_shelf1['shelf_width']) && $top_shelf1['shelf_width'] != 0)
                            {
                              $message .= $top_shelf1['shelf_width'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($top_shelf1['shelf_height']) && $top_shelf1['shelf_height'] != 0)
                            {
                              $message .= $top_shelf1['shelf_height'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($top_shelf1['shelf_qty']) && $top_shelf1['shelf_qty'] != 0)
                            {
                              $message .= $top_shelf1['shelf_qty'];
                            }
                            $message .='</td>
                            </tr>';
                          }

                          $message .='</table>
                          </div>
                          <div class="col-sm-4" style="display:inline-block; vertical-align:top; width:30%">

                          <table border="1" style="width:100%">
                          <tr>
                          <th width="18%">Cleats</th>
                          <th width="5%"></th>
                          <th width="5%"></th>
                          </tr>';

                          foreach ($cleats[$kd] as $cleats1) {
                            $message .='<tr>
                            <td>';
                            if(isset($uprights_adj1['adj_width']) && $uprights_adj1['adj_width'] != 0)
                            {
                              $message .= $uprights_adj1['adj_width'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($uprights_adj1['adj_height']) && $uprights_adj1['adj_height'] != 0)
                            {
                              $message .= $uprights_adj1['adj_height'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($uprights_adj1['adj_qty']) && $uprights_adj1['adj_qty'] != 0)
                            {
                              $message .= $uprights_adj1['adj_qty'];
                            }
                            $message .='</td>
                            </tr>';
                          }



                          $message .= '</table>

                          </div>
                          <div style="display:block; height:15px;"> </div>


                          <div class="" style="display:inline-block; vertical-align:top; width:30%">
                          <table border="1">
                          <tr>

                            <th width="18%">Uprights ADJ</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                          </tr>';

                          foreach ($uprights_adj[$kd] as $uprights_adj1) {
                            $message .='<tr>
                            <td>';
                            if(isset($cleats1['cleats_width']) && $cleats1['cleats_width'] != 0)
                            {
                              $message .= $cleats1['cleats_width'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($cleats1['cleats_height']) && $cleats1['cleats_height'] != 0)
                            {
                              $message .= $cleats1['cleats_height'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($cleats1['cleats_qty']) && $cleats1['cleats_qty'] != 0)
                            {
                              $message .= $cleats1['cleats_qty'];
                            }
                            $message .='</td>
                            </tr>';
                          }

                          $message .='</div>
                          <div class="col-sm-4" style="display:inline-block; vertical-align:top; width:30%">
                          <table border="1">
                          <tr>
                          <th width="18%">Shelves</th>
                          <th width="5%"></th>
                          <th width="5%"></th>
                          </tr>';
                          foreach ($shelves[$kd] as $shelves_r) {
                            $message .='<tr>
                            <td>';
                            if(isset($shelves_r['shelves_width']) && $shelves_r['shelves_width'] != 0)
                            {
                              $message .= $shelves_r['shelves_width'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($shelves_r['shelves_height']) && $shelves_r['shelves_height'] != 0)
                            {
                              $message .= $shelves_r['shelves_height'];
                            }
                            $message .='</td>
                            <td>';
                            if(isset($shelves_r['shelves_qty']) && $shelves_r['shelves_qty'] != 0)
                            {
                              $message .= $shelves_r['shelves_qty'];
                            }
                            $message .='</td>
                            </tr>';
                          }
                          $message .='
                          </table>

                          </div>
                          <div style="display:block; height:15px;"> </div>

                          <div>
                            <table border="1">
                              <tbody>
                                <tr>
                                  <td colspan="2">
                                    <p><b>DESCRIPTION WARDROBE DOORS:</b>  </p> </p>';
                                    if(isset($est_details_data[$kd][0]['first_desc']))
                                    {
                                      $message .= $est_details_data[$kd][0]['first_desc'];
                                    }
                                    if(isset($est_details_data[$kd][0]['second_desc']))
                                    {
                                      $message .= isset($est_details_data[$kd][0]['second_desc']);
                                    }
                                    if(isset($est_details_data[$kd][0]['third_desc']))
                                    {
                                      $message .= $est_details_data[$kd][0]['third_desc'];
                                    }
                                    $message .='</p>
                                    <p>Frame Colour: ';
                                    if(isset($est_details_data[$kd][0]['frame_color']))
                                    {
                                      $message .= $est_details_data[$kd][0]['frame_color'];
                                    }
                                    if(isset($est_details_data[$kd][0]['frame_color_sec']))
                                    {
                                      $message .= $est_details_data[$kd][0]['frame_color_sec'];
                                    }

                                  $message .='</p> <p>Infill Type:';
                                  if(isset($est_details_data[$kd][0]['infill_type']))
                                  {
                                    $message .= $est_details_data[$kd][0]['infill_type'];
                                  }
                                  $message .='</p> <p>Hanging Rail Type:';
                                  foreach ($hanging_rail[$kd] as $hanging_rail1) {
                                    if(isset($hanging_rail1['hanging_rail_type']))
                                    {
                                      $message .= $hanging_rail1['hanging_rail_type'];
                                    }
                                  }
                                  $message .= '</p> <br><br>';


                                  $message .='</td>
                                </tr>
                                <tr>
                                  <td colspan="2">
                                    <p><b>DRAWERS:</b></p> ';
                                     foreach ($est_drawers[$kd] as $details_drawer) {

                                      $message .='<p>';
                                        if(isset($details_drawer['drawers_size']))
                                        {
                                          $message .= $details_drawer['drawers_size'];
                                        }
                                        $message .=' – Quantity – ';
                                        if(isset($details_drawer['drawers_qty']) && $details_drawer['drawers_qty'] != 0)
                                        {
                                          $message .= $details_drawer['drawers_qty'];
                                        }
                                        else{
                                          $message .= ' ';
                                        }

                                      $message .='</p>';

                                     }
                                  $message .= '</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div style="display:block; height:30px;"> </div>
                          </section>
                          </div>
                          </div>
                          </div>';
                        }
                        $message .='
                        </body>
                        </html>';




                  $this->email->set_mailtype("html");
                  $this->email->from('info@tech599.com', 'CRM PROJECT');
                  $this->email->to($cust_email);
                  $this->email->subject('Cutting List');
                  $this->email->message($message);

      if($this->email->send())
      {
        $this->session->set_flashdata('success', 'Mail sent to customer successfully.');
        redirect('home/wardrobe_estimate_data');
      }
      else
      {
        $this->session->set_flashdata('error', 'Problem while sending mail to customer.');
        redirect('home/wardrobe_estimate_data');
      }
    }
    else
    {
      $this->session->set_flashdata('error', 'Something went wrong!!');
      redirect('home/wardrobe_estimate_data');
    }
     // $this->load->view('email_vendor',$est_data);
   }

  public function email_to_customer($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id =$id;
    // echo $est_id;die;
    $pages = $this->Usermodel->getWardrobesPages($est_id);
    $total_pages = $pages['pg_id'];

    $list = array();
    for($i = 0; $i <= $total_pages ; $i++)
    {
       $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
       $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
       $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
       // print_r($est_data['uprights_std']);die;
       $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
       $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
       $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
       $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
       $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
       $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
       $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
       $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

    }

    $est_data['est_details']           =  $list['est_details'];
    $est_data['estimate_images']       =  $list['estimate_images'];
    $est_data['uprights_std']          =  $list['uprights_std'];
    $est_data['top_shelf']             =  $list['top_shelf'];
    $est_data['cleats']                =  $list['cleats'];
    $est_data['uprights_adj']          =  $list['uprights_adj'];
    $est_data['shelves']               =  $list['shelves'];
    $est_data['hanging_rail']          =  $list['hanging_rail'];
    $est_data['est_drawers']           =  $list['est_drawers'];
    $est_data['est_details_data']      =  $list['est_details_data'];
    $est_data['wardrobe_description']  =  $list['wardrobe_description'];

    // echo "<pre>";print_r($est_data);die;

     $this->load->view('email_customer',$est_data);
   }

  public function send_mail_customer()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id = trim($this->input->post('est_id'));
    $cust_email = trim($this->input->post('cust_emaill'));
    $desc = $this->input->post('description');
    if(!empty($est_id) && !empty($cust_email))
    {
      $pages = $this->Usermodel->getWardrobesPages($est_id);
      $total_pages = $pages['pg_id'];

      $list = array();
      for($i = 0; $i <= $total_pages ; $i++)
      {
        $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
        $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
        $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
        // print_r($est_data['uprights_std']);die;
        $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
        $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
        $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
        $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
        $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
        $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
        $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
        $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);
      }

      $est_data['est_details']           =  $list['est_details'];
      $est_data['estimate_images']       =  $list['estimate_images'];
      $est_data['uprights_std']          =  $list['uprights_std'];
      $est_data['top_shelf']             =  $list['top_shelf'];
      $est_data['cleats']                =  $list['cleats'];
      $est_data['uprights_adj']          =  $list['uprights_adj'];
      $est_data['shelves']               =  $list['shelves'];
      $est_data['hanging_rail']          =  $list['hanging_rail'];
      $est_data['est_drawers']           =  $list['est_drawers'];
      $est_data['est_details_data']      =  $list['est_details_data'];
      $est_data['wardrobe_description']  =  $list['wardrobe_description'];

      $first_estimate = $this->cust_attachment($est_data,$est_id);
      // $door_estimate = $this->cust_door_attach($est_data,$est_id);

      // $message = "Copy of wardrobe estimate.";
      $this->email->set_mailtype("html");
      $this->email->from('info@tech599.com', 'CRM PROJECT');
      $this->email->to($cust_email);
      $this->email->subject('Wardrobe Estimate');
      $this->email->message($desc);

      $this->email->attach($first_estimate);
      // $this->email->attach($door_estimate);

      if($this->email->send())
      {
        $this->session->set_flashdata('success', 'Mail sent to customer successfully.');
        redirect('home/wardrobe_estimate_data');
      }
      else
      {
        $this->session->set_flashdata('error', 'Problem while sending mail to customer.');
        redirect('home/wardrobe_estimate_data');
      }
    }
    else
    {
      $this->session->set_flashdata('error', 'Something went wrong!!');
      redirect('home/wardrobe_estimate_data');
    }

  }

  public function cust_attachment($est_data,$est_id)
  {
    // $page_data_demo= $this->load->view('demo1',$est_data,true);
    $page_data= $this->load->view('pdf_testnew',$est_data,true);

    $this->load->library('pdf');

    $this->pdf->load_html($page_data);

    // $customPaper = array(0,0,800,1500);
    // $this->pdf->set_paper($customPaper);
    $this->pdf->set_paper('A4');
    $this->pdf->render();

    $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name = $est_id."wardrop_first".'.pdf';
    $full_path_new  = $path.$file_name;

    $output = $this->pdf->output();
    unset($this->pdf);
    file_put_contents($full_path_new, $output);

    // $this->email->attach($full_path_new_sec);
    return $full_path_new;
  }

  public function cust_door_attach($est_data,$est_id)
  {
    // $page_data_demo= $this->load->view('demo1',$est_data,true);
    $page_data_demo= $this->load->view('wardrop_two_estimate_pdf',$est_data,true);

    $this->load->library('pdf');

    $this->pdf->load_html($page_data_demo);

     // $customPaper_two = array(0,0,800,1500);
     // $this->pdf->set_paper($customPaper_two);
    $this->pdf->set_paper('A4');
    $this->pdf->render();

    $path_sec = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name_second = $est_id."wardrop_second".'.pdf';
    $full_path_new_sec  = $path_sec.$file_name_second;
     //ob_start();
    $output_sec = $this->pdf->output();
     //ob_clean();
    file_put_contents($full_path_new_sec, $output_sec);
    // $this->email->attach($full_path_new_sec);
    return $full_path_new_sec;
  }

  public function send_To_supplier_Door_est()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id = trim($this->input->post('est_id'));
    $cust_email = trim($this->input->post('cust_email1'));
    $desc = $this->input->post('door_description');
    if(!empty($est_id) && !empty($cust_email))
    {
      $pages = $this->Usermodel->getWardrobesPages($est_id);
      $total_pages = $pages['pg_id'];

      $list = array();
      for($i = 0; $i <= $total_pages ; $i++)
      {
        $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
        $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
        $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
        // print_r($est_data['uprights_std']);die;
        $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
        $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
        $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
        $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
        $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
        $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
        $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
        $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);
      }

      $est_data['est_details']           =  $list['est_details'];
      $est_data['estimate_images']       =  $list['estimate_images'];
      $est_data['uprights_std']          =  $list['uprights_std'];
      $est_data['top_shelf']             =  $list['top_shelf'];
      $est_data['cleats']                =  $list['cleats'];
      $est_data['uprights_adj']          =  $list['uprights_adj'];
      $est_data['shelves']               =  $list['shelves'];
      $est_data['hanging_rail']          =  $list['hanging_rail'];
      $est_data['est_drawers']           =  $list['est_drawers'];
      $est_data['est_details_data']      =  $list['est_details_data'];
      $est_data['wardrobe_description']  =  $list['wardrobe_description'];


      $door_estimate = $this->supplier_door_attach($est_data,$est_id);

      // $message = "Copy of wardrobe estimate.";
      $this->email->set_mailtype("html");
      $this->email->from('info@tech599.com', 'CRM PROJECT');
      $this->email->to($cust_email);
      $this->email->subject('Wardrobe Door Estimate');
      $this->email->message($desc);

      $this->email->attach($door_estimate);

      if($this->email->send())
      {
        $this->session->set_flashdata('success', 'Mail sent to supplier successfully.');
        redirect('home/wardrobe_estimate_data');
      }
      else
      {
        $this->session->set_flashdata('error', 'Problem while sending mail to customer.');
        redirect('home/wardrobe_estimate_data');
      }
    }
    else
    {
      $this->session->set_flashdata('error', 'Something went wrong!!');
      redirect('home/wardrobe_estimate_data');
    }
  }

  public function supplier_door_attach($est_data,$est_id)
  {
    // $page_data_demo= $this->load->view('demo1',$est_data,true);
    $page_data_demo= $this->load->view('supplier_door_attachment',$est_data,true);

    $this->load->library('pdf');

    $this->pdf->load_html($page_data_demo);

     // $customPaper_two = array(0,0,800,1500);
     // $this->pdf->set_paper($customPaper_two);
    $this->pdf->set_paper('A4');
    $this->pdf->render();

    $path_sec = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name_second = $est_id."wardrop_second".'.pdf';
    $full_path_new_sec  = $path_sec.$file_name_second;
     //ob_start();
    $output_sec = $this->pdf->output();
     //ob_clean();
    file_put_contents($full_path_new_sec, $output_sec);
    // $this->email->attach($full_path_new_sec);
    return $full_path_new_sec;
  }


  public function send_vendor()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id = $this->input->post('est_id');

    $est_data['est_details'] = $this->Usermodel->get_all_est_data($est_id);
    $est_data['est_details_info'] = $this->Usermodel->get_all_est_deatils($est_id);

    $est_data['estimate_images'] = $this->Usermodel->estimate_images($est_id);

    $est_data['uprights_std'] = $this->Usermodel->uprights_std($est_id);
    // print_r($est_data['uprights_std']);die;
    $est_data['top_shelf'] = $this->Usermodel->get_top_shelf($est_id);
    $est_data['cleats'] = $this->Usermodel->get_cleats($est_id);

    $est_data['uprights_adj'] = $this->Usermodel->uprights_adj($est_id);
    $est_data['shelves'] = $this->Usermodel->get_shelves($est_id);
    $est_data['hanging_rail'] = $this->Usermodel->get_hanging_rail($est_id);

    $est_data['est_drawers'] = $this->Usermodel->get_all_est_drawer($est_id);

    $est_data['est_details_data'] = $this->Usermodel->get_details_data($est_id);

    $est_data['wardrobe_description'] = $this->Usermodel->getwardrobe_description($est_id);
    echo $this->input->post('vendor_emaill'); echo "<br>";
    echo "<pre>";print_r($est_data);die;
    // $this->load->view('pdf_testnew',$est_data);
    // $html = $this->output->get_output();
    //   $this->load->library('pdf');
    //   // print_r($html);die;
    //    // Load HTML content
    //    $this->pdf->loadHtml($html);
    //
    //    // (Optional) Setup the paper size and orientation
    //    $this->pdf->setPaper('A4');
    //    // $customPaper = array(0,0,800,1500);
    //    // $this->pdf->set_paper($customPaper);
    //
    //    // Render the HTML as PDF
    //    $this->pdf->render();
    //
    //    // Output the generated PDF (1 = download and 0 = preview)
    //    $this->pdf->stream($est_id."estimate.pdf", array("Attachment"=>1));
  }


  public function get_mirror_shower_details_view($id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id =$id;
    // echo $est_id;die;
    // $est_data['est_details']=$this->Usermodel->get_mirror_customer_data($est_id);

    // $est_data['est_details']=$this->Usermodel->get_mirror_customer_data($est_id);
    // $est_data['est_extra_measurment']=$this->Usermodel->get_extra_measurment_data($est_id);

    $est_data['est_details']=$this->Usermodel->get_mirror_customer_data($est_id);
    // echo "<pre>";print_r($est_data['est_details']);die;
    $est_data['est_extra_measurment']=$this->Usermodel->get_extra_measurment_data($est_id);
    $est_data['get_data']=$this->Usermodel->get_data_est($est_id);
    // echo "<pre>";print_r($est_data);die;
    $this->load->view('mirror_bill',$est_data);
  }

  public function get_splashback_details_view($id)
  {
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $est_id =$id;
    $est_data['est_details']=$this->Usermodel->get_all_splashback_data($est_id);
    $est_data['estimate_images']=$this->Usermodel->get_all_splashback_images($est_id);
    $est_data['est_extra_measurment']=$this->Usermodel->get_extra_spmeasurment_data($est_id);

    // echo "<pre>";print_r($est_data);die;
    $this->load->view('splashback_bill',$est_data);

  }
  public function get_balustrade_details_view($id)
  {
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $est_id =$id;
    $est_data['est_details']=$this->Usermodel->get_all_balustrade_data($est_id);
    $est_data['estimate_images']=$this->Usermodel->get_all_balustrade_images($est_id);
    $est_data['est_extra_measurment']=$this->Usermodel->get_extra_bmeasurment_data($est_id);
    $this->load->view('balustrade_bill',$est_data);

  }

  public function cus_estimate_id_view(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $id=$this->session->userdata('user');
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    $data['est_id_data']=$this->Usermodel->get_est_id($id);
    $data['mail_desc'] = $this->db->order_by("id", "asc")->get('mail_description')->result_array();

    $this->load->view('header');
    $this->load->view('get_estimate_id',$data);
    $this->load->view('footer');
  }

  public function cus_mirror_showerid_view(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $id=$this->session->userdata('get_mirror_shower_id');
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    $data['est_id_data']=$this->Usermodel->get_mirror_shower_data($id);

    $this->load->view('header');
    $this->load->view('get_shower_mirror',$data);
    $this->load->view('footer');
  }

  public function get_all_etimate_data(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $get_all_calendar_data=$this->Usermodel->get_all_calendar_data();
    // echo "<pre>";print_r($get_all_calendar_data);die;
    foreach ($get_all_calendar_data as $key) {

    $start_date = date('Y-m-d H:i:s', strtotime($key["created_at"] . ' +1 day'));
    $end_date=date('Y-m-d H:i:s',strtotime('+1 day +10 minutes',strtotime($key["created_at"])));
    // echo $start_date;echo "<br>";
    // echo $end_date;echo "<br>";
    $data1[] = array(
      'id'      =>   $key["est_id"],
      'title'   =>  $key["customer_name"],
      'start'   =>  date("Y-m-d", strtotime($start_date)).'T'.date("H:i:s", strtotime($start_date)),
      'end'     =>  date("Y-m-d", strtotime($end_date)).'T'.date("H:i:s", strtotime($end_date))
      // 'url'      =>  'http://tech599.com/~tech599/tech599.com/johnman/groutboss/admin/v1/customer_info.php?id='.$row1["id"]
    );
  }
  // echo "<pre>";print_r($data1);die;
  echo json_encode($data1);die;
  // echo "string";die;
  // echo $est_id;die;


  }


  public function estimate_shower_mirror(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $id=$this->session->userdata('user');
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    $data['est_id_data']=$this->Usermodel->get_est_id($id);

    $this->load->view('header');
    $this->load->view('create_estimate_shower',$data);
    $this->load->view('footer');
  }

  public function estimate_view(){
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $this->load->view('header');
    $this->load->view('view_estimate_details');
    $this->load->view('footer');
  }

  public function mirror_estimate_data()
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['all_mirror'] = $this->Usermodel->get_all_mirror_estimate();
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('all_mirror_estimate',$data);
    $this->load->view('footer');
  }

  public function wardrobe_estimate_data()
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $data['alert']      = $this->session->flashdata('alert');
    $data['error']      = $this->session->flashdata('error');
    $data['success']    = $this->session->flashdata('success');
    $data['all_mirror'] = $this->Usermodel->get_all_wardrobe_estimate();
    $data['mail_desc'] = $this->db->order_by("id", "asc")->get('mail_description')->result_array();
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('all_wardrobe_estimate',$data);
    $this->load->view('footer');
  }

  public function splashback_estimate_data()
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $data['all_mirror'] = $this->Usermodel->get_all_splashback_estimate();
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('all_splashback_estimate',$data);
    $this->load->view('footer');
  }

  public function balustrade_estimate_data()
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['all_mirror'] = $this->Usermodel->get_all_balustrade_estimate();
    // echo "<pre>";print_r($data);die;
    $this->load->view('header');
    $this->load->view('all_balustrade_estimate',$data);
    $this->load->view('footer');
  }

  public function test_pdf(){
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $est_data="speed";
    $html = $this->load->view('pdf_testnew',$est_data,true);
    // echo "<pre>";print_r($html);die;
    $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name = date("Ymdhis").'.pdf';
    $full_path  = $path.$file_name;
    $real_path = base_url()."uploads/pdf/".$file_name;
    $this->load->library('m_pdf');
    $pdf = $this->m_pdf->load();

    $pdf->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            30, // margin_left
            30, // margin right
            30, // margin top
            30, // margin bottom
            18, // margin header
            12); // margin footer
    // $siteaddressAPI= base_url("assets").'/css/test.css';
    // $stylesheet = file_get_contents($siteaddressAPI);

    $pdf->WriteHTML($stylesheet,1);

    $pdf->WriteHTML($html);


    $pdf->allow_charset_conversion=true;  // Set by default to TRUE
$pdf->charset_in='UTF-8';
$pdf->SetDirectionality('rtl');
$pdf->autoLangToFont = true;
    ob_clean();
    $pdf->Output($full_path, "D");
  }

  public function check_pdf_view(){
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    // $this->load->view('header');
    $this->load->view('pdf_testnew');
    // $this->load->view('footer');
  }

  public function test_pdf_new($id)
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $est_id=$id;

    // $est_data['est_details']=$this->Usermodel->get_all_est_data($est_id);
    // $est_data['est_details_info']=$this->Usermodel->get_all_est_deatils($est_id);
    //
    // $est_data['estimate_images']=$this->Usermodel->estimate_images($est_id);
    //
    // $est_data['uprights_std']=$this->Usermodel->uprights_std($est_id);
    // // print_r($est_data['uprights_std']);die;
    // $est_data['top_shelf']=$this->Usermodel->get_top_shelf($est_id);
    // $est_data['cleats']=$this->Usermodel->get_cleats($est_id);
    //
    // $est_data['uprights_adj']=$this->Usermodel->uprights_adj($est_id);
    // $est_data['shelves']=$this->Usermodel->get_shelves($est_id);
    // $est_data['hanging_rail']=$this->Usermodel->get_hanging_rail($est_id);
    //
    // $est_data['est_drawers']=$this->Usermodel->get_all_est_drawer($est_id);
    //
    // $est_data['est_details_data']=$this->Usermodel->get_details_data($est_id);
    //
    // $est_data['wardrobe_description']=$this->Usermodel->getwardrobe_description($est_id);

    $pages = $this->Usermodel->getWardrobesPages($est_id);
    $total_pages = $pages['pg_id'];

    $list = array();
    for($i = 0; $i <= $total_pages ; $i++)
    {
       $list['est_details'][] = $this->Usermodel->get_all_est_data_multiple($est_id,$i);
       $list['estimate_images'][] = $this->Usermodel->estimate_images_multiple($est_id,$i);
       $list['uprights_std'][] = $this->Usermodel->uprights_std_multiple($est_id,$i);
       // print_r($est_data['uprights_std']);die;
       $list['top_shelf'][] = $this->Usermodel->get_top_shelf_multiple($est_id,$i);
       $list['cleats'][] = $this->Usermodel->get_cleats_multiple($est_id,$i);
       $list['uprights_adj'][] = $this->Usermodel->uprights_adj_multiple($est_id,$i);
       $list['shelves'][] = $this->Usermodel->get_shelves_multiple($est_id,$i);
       $list['hanging_rail'][] = $this->Usermodel->get_hanging_rail_multiple($est_id,$i);
       $list['est_drawers'][] = $this->Usermodel->get_all_est_drawer_multiple($est_id,$i);
       $list['est_details_data'][] = $this->Usermodel->get_details_data_multiple($est_id,$i);
       $list['wardrobe_description'][] = $this->Usermodel->getwardrobe_description_multiple($est_id,$i);

    }

    $est_data['est_details']           =  $list['est_details'];
    $est_data['estimate_images']       =  $list['estimate_images'];
    $est_data['uprights_std']          =  $list['uprights_std'];
    // print_r($est_data['uprights_std']);die;
    $est_data['top_shelf']             =  $list['top_shelf'];
    $est_data['cleats']                =  $list['cleats'];
    $est_data['uprights_adj']          =  $list['uprights_adj'];
    $est_data['shelves']               =  $list['shelves'];
    $est_data['hanging_rail']          =  $list['hanging_rail'];
    $est_data['est_drawers']           =  $list['est_drawers'];
    $est_data['est_details_data']      =  $list['est_details_data'];
    $est_data['wardrobe_description']  =  $list['wardrobe_description'];
    
   

    // echo "<pre>";print_r($est_data);die;
    $this->load->view('pdf_testnew',$est_data);

    $html = $this->output->get_output();
    $this->load->library('pdf');
    // print_r($html);die;
    // Load HTML content
    $this->pdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $this->pdf->setPaper('A4');
    // $customPaper = array(0,0,800,1500);
    // $this->pdf->set_paper($customPaper);

    // Render the HTML as PDF
    $this->pdf->render();

    // Output the generated PDF (1 = download and 0 = preview)
    $this->pdf->stream($est_id."estimate.pdf", array("Attachment"=>0));
  }

  public function test_pdf_bill($id){
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }
    $est_id=$id;
    $est_data['est_details']=$this->Usermodel->get_all_est_data($est_id);
    $est_data['est_details_info']=$this->Usermodel->get_all_est_deatils($est_id);

    $est_data['estimate_images']=$this->Usermodel->estimate_images($est_id);

    $est_data['uprights_std']=$this->Usermodel->uprights_std($est_id);
    // print_r($est_data['uprights_std']);die;
    $est_data['top_shelf']=$this->Usermodel->get_top_shelf($est_id);
    $est_data['cleats']=$this->Usermodel->get_cleats($est_id);

    $est_data['uprights_adj']=$this->Usermodel->uprights_adj($est_id);
    $est_data['shelves']=$this->Usermodel->get_shelves($est_id);
    $est_data['hanging_rail']=$this->Usermodel->get_hanging_rail($est_id);

    $est_data['est_drawers']=$this->Usermodel->get_all_est_drawer($est_id);
    $est_data['est_details_data']=$this->Usermodel->get_details_data($est_id);

    $this->load->view('wardrop_two_estimate_pdf',$est_data);
    $html = $this->output->get_output();
      $this->load->library('pdf');
      // print_r($html);die;
       // Load HTML content
       $this->pdf->loadHtml($html);
       // (Optional) Setup the paper size and orientation
       // $this->pdf->setPaper('A4');
       $customPaper = array(0,0,800,1500);
       $this->pdf->set_paper($customPaper);
       // Render the HTML as PDF
       $this->pdf->render();

       $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
       $file_name = $est_id."bild2".'.pdf';
       $full_path_new  = $path.$file_name;
       $output = $this->pdf->output();
       // file_put_contents($full_path_new, $output);
       // Output the generated PDF (1 = download and 0 = preview)
       $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
  }

  public function mirror_test_pdf_new($id)
  {
    // print_r($id);die;
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_id = $id;

    $est_data['est_details'] = $this->Usermodel->get_mirror_customer_data($est_id);
    //echo "<pre>";print_r($est_data);die;

    //echo $est_data->sh_images;
    $data = $est_data['est_details'];

    foreach($data as $key=>$images)
    {
      $path = $images['sh_images'];
      $path1 = dirname($path);
      $path2 = $path1.'/notext/';
      $imgnm = basename($path);
      $allpath = $path2.$imgnm;
      $est_data['est_details'][$key]['sh_images'] = $allpath;
    }

    $data2 = $data[0];
    $path = $data2['sh_images'];
    //echo "<pre>";print_r($path);die;

    $est_data['est_extra_measurment'] = $this->Usermodel->get_extra_measurment_data($est_id);
     //echo "<pre>";print_r($est_data);die;

    $this->load->view('mirror_shower_pdf',$est_data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    // print_r($html);die;
    // Load HTML content
    $this->pdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $this->pdf->setPaper('A4');
    // $customPaper = array(0,0,800,1500);
    // $this->pdf->set_paper($customPaper);
    // Render the HTML as PDF
    $this->pdf->render();

    $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name = $est_id."bild2".'.pdf';
    $full_path_new  = $path.$file_name;
    $output = $this->pdf->output();
    // file_put_contents($full_path_new, $output);
    // Output the generated PDF (1 = download and 0 = preview)
    $this->pdf->stream("shower_estimate.pdf", array("Attachment"=>0));
  }

  public function test_tcpdf_new(){

    $this->load->library("Pdf");


    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Muhammad Saqlain Arif');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    // $pdf->SetFont('dejavusans', '', 14, '', true);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

    // Set some content to print

    $this->load->view('pdf_test');
    $html = $this->output->get_output();


    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // ---------------------------------------------------------

    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('example_001.pdf', 'I');

  }

  public function door_estimate_demo($est_id)
  {

    $est_data['est_details']=$this->Usermodel->get_all_est_data($est_id);
    $est_data['est_details_info']=$this->Usermodel->get_all_est_deatils($est_id);

    $est_data['estimate_images']=$this->Usermodel->estimate_images($est_id);

    $est_data['uprights_std']=$this->Usermodel->uprights_std($est_id);
    // print_r($est_data['uprights_std']);die;
    $est_data['top_shelf']=$this->Usermodel->get_top_shelf($est_id);
    $est_data['cleats']=$this->Usermodel->get_cleats($est_id);

    $est_data['uprights_adj']=$this->Usermodel->uprights_adj($est_id);
    $est_data['shelves']=$this->Usermodel->get_shelves($est_id);
    $est_data['hanging_rail']=$this->Usermodel->get_hanging_rail($est_id);

    $est_data['est_drawers']=$this->Usermodel->get_all_est_drawer($est_id);


    $est_data['est_details_data']=$this->Usermodel->get_details_data($est_id);

      $this->load->view('wardrop_two_estimate_pdf',$est_data);
      $html = $this->output->get_output();
        $this->load->library('pdf');
        // print_r($html);die;
         // Load HTML content
         $this->pdf->loadHtml($html);
         // (Optional) Setup the paper size and orientation
         $this->pdf->setPaper('A4');
         // $customPaper = array(0,0,800,1500);
         // $this->pdf->set_paper($customPaper);
         // Render the HTML as PDF
         $this->pdf->render();

         $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
         $file_name = $est_id."bild2".'.pdf';
         $full_path_new  = $path.$file_name;
         $output = $this->pdf->output();
         // file_put_contents($full_path_new, $output);
         // Output the generated PDF (1 = download and 0 = preview)
         $this->pdf->stream("welcome.pdf", array("Attachment"=>0));

  }

  public function splashback_pdf($est_id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }

    $est_data['estimate_images']=$this->Usermodel->get_all_splashback_images($est_id);
     //print_r($est_data['estimate_images']);die;
     $data=$est_data['estimate_images'];

    foreach($data as $key=>$images)
    {
      $path=$images['splashback_images'];
      $path1=dirname($path);
      $path2=$path1.'/notext/';
      $imgnm=basename($path);
      $allpath=$path2.$imgnm;
      $est_data['estimate_images'][$key]['splashback_images'] = $allpath;
    }

    $est_data['est_details']=$this->Usermodel->get_all_splashback_data($est_id);
    //$est_data['est_extra_measurment']=$this->Usermodel->get_extra_measurment_data($est_id);
    $est_data['est_extra_measurment']=$this->Usermodel->get_extra_spmeasurment_data($est_id);
    // echo "<pre>";print_r($est_data['est_extra_measurment']);die;
    $this->load->view('splashback_estimate_pdf',$est_data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    // print_r($html);die;
    // Load HTML content
    $this->pdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $this->pdf->setPaper('A4');
    // $customPaper = array(0,0,800,1500);
    // $this->pdf->set_paper($customPaper);
    // Render the HTML as PDF
    $this->pdf->render();

    $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name = $est_id."bild2".'.pdf';
    $full_path_new  = $path.$file_name;
    $output = $this->pdf->output();
    // file_put_contents($full_path_new, $output);
    // Output the generated PDF (1 = download and 0 = preview)
    $this->pdf->stream("splashback_estimate.pdf", array("Attachment"=>0));
  }


  public function balustrade_pdf($est_id)
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $est_data['est_details'] = $this->Usermodel->get_all_balustrade_data($est_id);

    $est_data['estimate_images'] = $this->Usermodel->get_all_balustrade_images($est_id);

    $est_data['est_extra_measurment'] = $this->Usermodel->get_extra_bmeasurment_data($est_id);

    $this->load->view('balustrade_estimate_pdf',$est_data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    // print_r($html);die;
    // Load HTML content
    $this->pdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $this->pdf->setPaper('A4');
    // $customPaper = array(0,0,800,1500);
    // $this->pdf->set_paper($customPaper);
    // Render the HTML as PDF
    $this->pdf->render();

    $path = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/pdf/";
    $file_name = $est_id."bild2".'.pdf';
    $full_path_new  = $path.$file_name;
    $output = $this->pdf->output();
    // file_put_contents($full_path_new, $output);
    // Output the generated PDF (1 = download and 0 = preview)
    $this->pdf->stream("balustrade_estimate.pdf", array("Attachment"=>0));
  }



}
