<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Usermodel extends CI_model {

    public function add($table_name, $array_data) {
        return $this->db->insert($table_name, $array_data);
    }
    public function insertconslidate($data) {

      if ($data) {

            $tr_no = $data['tr_no'];
            $container = $data['cont_no'];
            $country = $data['cont_size'];
             $paid = $data['ship_mode'];
            $balence = $data['ship_line'];
            $address = $data['dep_office'];
          
            $arrival = $data['arr_office'];
            
            foreach ($shipment as $key => $value) {
                $data1 = array(
                    'tr_no' => $tr_no,
                    'cont_no' => $container,
                    'cont_size' => $country,
                    'ship_mode' => $paid,
                    'ship_line' => $balence,
                    'dep_office' => $address,
                    'arr_office' => $arrival,
                );
              //  $data1['created_id'] = $this->session->userdata('id');
              
                $insert = $this->db->replace('consolidate', $data1);
            }
            return ($insert == true) ? true : false;
        }
    }

	public function insertcustomer($data)
	{
		// return $this->db->insert('customer',$data);

		$query = $this->db->insert('customer',$data);

		return $this->db->insert_id();
	}

	public function update_query($arr,$con,$tbl)
	{
		$query = $this->db->set($arr)->where($con)->update($tbl);
		return $this->db->affected_rows();
	}

	public function insertdescription($data)
	{
		$query = $this->db->insert('mail_description',$data);
		return $this->db->insert_id();
	}
	   public function countTotalTeacher() {
        $sql = "SELECT * FROM teacher";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    	   public function countTotalStudent() {
        $sql = "SELECT * FROM student";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    	   public function countTotalLevel() {
        $sql = "SELECT * FROM level";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    	   public function countTotalLesson() {
        $sql = "SELECT * FROM lesson";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    	   public function countTotalSubject() {
        $sql = "SELECT * FROM subject";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    	   public function countTotalCourse() {
        $sql = "SELECT * FROM course";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

	public function create_new_estimate($table,$cus_id)
	{
		$query = $this->db->insert($table,$cus_id);
		return $this->db->insert_id();
	}
    public function check_email_exist($email)
	{
		$query = $this->db->select('*')
		         ->from('student')
		         ->where(array("email"=>$email))
		         ->get();

		return $query->num_rows();
	}
	public function insertuprights($table,$data)
	{
		$query = $this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	public function insert_table($tbl,$data){
        $this->db->insert($tbl,$data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
	
	public function getcount($table)
	{
		$query=$this->db->get($table);

        return $query->num_rows();
	}
    public function getAlldata($table)
	{
		$query=$this->db->get($table);

        return $query->result_array();
	}
	public function getdata($table,$where)
	{
		$query=$this->db->where($where)->get($table);

        return $query->row();
	}
	public function insertimage_data($imgdata,$s_width,$s_height,$d_width,$d_height,$est_id,$pg_no)
	{
    $arr=array(
      'est_id' => $est_id,
      'pg_id' => $pg_no,
      'est_image' => $imgdata,
      'est_shelf_width' => $s_width,
      'est_shelf_hight' => $s_height,
      'est_door_width' => $d_width,
      'est_door_hight' => $d_height,
    );
		$query = $this->db->insert('est_images',$arr);
		return $this->db->insert_id();
	}

	public function insertspimage_data($imgdata,$width,$height,$ab,$cd,$ef,$gh,$first_desc,$second_desc,$est_id,$cus_id)
	{
    $arr=array(
      'est_id' => $est_id,
      'cus_id' => $cus_id,
      'splashback_images' => $imgdata,
      'width' => $width,
      'hight' => $height,
      'ab' => $ab,
      'cd' => $cd,
      'ef' => $ef,
      'gh' => $gh,
      'splash_back_desc_type' => $first_desc,
      'splash_back_desc2' => $second_desc,
    );
		$query = $this->db->insert('splashback_estimate_images',$arr);
		return $this->db->insert_id();
	}

	public function insertbimage_data($imgdata,$width,$height,$first_desc,$second_desc,$est_id,$cus_id)
	{
    $arr=array(
      'est_id' => $est_id,
      'cus_id' => $cus_id,
      'balustrade_images' => $imgdata,
      'width' => $width,
      'hight' => $height,
      'balustrade_desc_type' => $first_desc,
      'balustrade_desc2' => $second_desc,
    );
		$query = $this->db->insert('balustrade_estimate_images',$arr);
		return $this->db->insert_id();
	}

	public function insertmirrorimage_data($imgdata,$s_width,$s_height,$d_width,$angle_val,$est_id,$type,$first_location,$second_location,$shower_color_frame,$shower_glass,$shower_screen,$mirror_screen_first,$mirror_screen_second,$m_width,$m_height,$return_r)
	{
    $arr=array(
      'est_id' => $est_id,
      'sh_images' => $imgdata,
      's_width' => $s_width,
      's_height' => $s_height,
      'd_width' => $d_width,
      'm_height' => $m_height,
      'm_width' => $m_width,
      'return_r' => $return_r,
      'angle' => $angle_val,
      'image_type' => $type,
      'location1' => $first_location,
      'location2' => $second_location,
      'glass_type' => $shower_glass,
      'color_frame' => $shower_color_frame,
      'shower_screen' => $shower_screen,
      'mirror_screen_first' => $mirror_screen_first,
      'mirror_screen_second' => $mirror_screen_second

    );
		// echo "<pre>";print_r($arr);die;
		$query = $this->db->insert('sh_images',$arr);
		return $this->db->insert_id();
	}

	public function insertponts_data($img_id,$point_name,$point_value,$est_id)
	{
    $arr=array(
      'est_id' => $est_id,
      'img_id' => $img_id,
      'point_name' => $point_name,
      'point_value' => $point_value,

    );
		$query = $this->db->insert('sh_images_points',$arr);
		return $this->db->insert_id();
	}

	public function insertsbponts_data($img_id,$point_name,$point_value,$est_id)
	{
    $arr=array(
      'est_id' => $est_id,
      'img_id' => $img_id,
      'point_name' => $point_name,
      'point_value' => $point_value,

    );
		$query = $this->db->insert('splashback_estimate_points',$arr);
		return $this->db->insert_id();
	}

	public function insertbponts_data($img_id,$point_name,$point_value,$est_id)
	{
    $arr=array(
      'est_id' => $est_id,
      'img_id' => $img_id,
      'point_name' => $point_name,
      'point_value' => $point_value,

    );
		$query = $this->db->insert('balustrade_estimate_points',$arr);
		return $this->db->insert_id();
	}

	public function insertdetails($table,$details)
	{
		$query = $this->db->insert($table,$details);
		return $this->db->insert_id();
	}

	public function get_extra_measurment_data($est_id)
	{
    $query = $this->db->select('*')
             ->from('sh_images_points')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_all_level_data()
	{
    $query = $this->db->select('*')
             ->from('level')
            // ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_extra_bmeasurment_data($est_id)
	{
    $query = $this->db->select('*')
             ->from('balustrade_estimate_points')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_data_est($est_id)
	{
    $query = $this->db->select('*')
             ->from('sh_mi_estimate')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function getWardrobesPages($est_id){
    $query = $this->db->select('*')
             ->from('new_estimate')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->row_array();
	}

	public function get_all_est_data($est_id)
	{
    $query = $this->db->select('*')
             ->from('new_estimate e')
             ->join("estimate_details ed", "e.est_id=ed.est_id",'left')
             ->join("customer c", "e.cus_id=c.id",'left')
             ->join("est_images et", "et.est_id=e.est_id",'left')
             ->join("uprights_adj ua", "ua.est_id=e.est_id",'left')
             ->join("uprights_sts us", "us.est_id=e.est_id",'left')
             ->join("top_shelf ts", "ts.est_id=e.est_id",'left')
             ->join("shelves sh", "sh.est_id=e.est_id",'left')
             ->join("drawers dr", "dr.est_id=e.est_id",'left')
             ->join("hanging_rail hr", "hr.est_id=e.est_id",'left')
             ->where(array("e.est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}
    public function get_user_work()
	{
        $query = $this->db->select('wh.id as whid,total_sets,wh.work_time,tr.*')
             ->from('work_history wh')
             ->join("tbl_register tr", "wh.user_id=tr.id",'left')
             ->get();
        return $query->result_array();
	}
	
	 public function viewteacherappointment() {
       
            $this->db->select('*');
            $this->db->from('appointment');
            $this->db->join('teacher', 'teacher.id=appointment.company_id', 'left');
           
            $query = $this->db->get();
            return $query->result();
        }
        
        	 public function viewstudentappointment() {
       
            $this->db->select('*');
            $this->db->from('stud_appointment');
            $this->db->join('student', 'student.id=stud_appointment.studa_id', 'left');
           
            $query = $this->db->get();
            return $query->result();
        }
    
	
 	 public function get_assigncourse()
 	{

 $query = $this->db->select('assigncourse.id,names,specialization,tr_id')
                      ->from('teacher')
                      ->join('assigncourse', 'teacher.cus_type = assigncourse.tr_id','inner')
                      //->join('tb_proc', 'tb_proc.id = tb_result.id_proc')
                      ->get();
    return $query->result_array(); 
 	}
 	
 	 	 public function get_appointmnet()
 	{

 $query = $this->db->select('appointment.id,name_a,date,tra_id')
                      ->from('teacher')
                      ->join('appointment', 'teacher.cus_type = appointment.tra_id','inner')
                      //->join('tb_proc', 'tb_proc.id = tb_result.id_proc')
                      ->get();
    return $query->result_array(); 
 	}


	
	public function get_all_est_data_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('new_estimate e')
             ->join("estimate_details ed", "e.est_id=ed.est_id",'left')
             ->join("customer c", "e.cus_id=c.id",'left')
             ->join("uprights_adj ua", "ua.est_id=e.est_id",'left')
             ->join("uprights_sts us", "us.est_id=e.est_id",'left')
             ->join("top_shelf ts", "ts.est_id=e.est_id",'left')
             ->join("shelves sh", "sh.est_id=e.est_id",'left')
             ->join("drawers dr", "dr.est_id=e.est_id",'left')
             ->join("hanging_rail hr", "hr.est_id=e.est_id",'left')
             ->where(array("e.est_id"=> $est_id, "ed.pg_id" => $i, "ua.pg_id" => $i, "us.pg_id" => $i, "ts.pg_id" => $i, "sh.pg_id" => $i, "dr.pg_id" => $i, "hr.pg_id" => $i))
						 ->group_by('e.pg_id')
             ->get();
    return $query->row_array();
	}

	public function get_all_splashback_data($est_id)
	{
    $query = $this->db->select('*')
             ->from('splashback_estimate_id e')
             ->join("splashback_estimate ed", "e.est_id=ed.est_id",'left')
						 ->join("customer c", "e.cus_id=c.id",'left')
             ->where(array("e.est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_all_balustrade_data($est_id)
	{
    $query = $this->db->select('*')
             ->from('balustrade_estimate_id e')
             ->join("balustrade_estimate ed", "e.est_id=ed.est_id",'left')
						 ->join("customer c", "e.cus_id=c.id",'left')
             ->where(array("e.est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_all_est_deatils($est_id)
	{
    $query = $this->db->select('*')
             ->from('new_estimate e')
             ->join("uprights_sts us", "us.est_id=e.est_id",'left')
             ->join("uprights_adj ua", "ua.est_id=e.est_id",'left')
             ->join("top_shelf ts", "ts.est_id=e.est_id",'left')
             ->join("shelves sh", "sh.est_id=e.est_id",'left')
             ->join("cleats cl", "cl.est_id=e.est_id",'left')
             ->join("drawers dr", "dr.est_id=e.est_id",'left')
             ->join("hanging_rail hr", "hr.est_id=e.est_id",'left')
             ->where(array("e.est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}
	public function get_all_splashback_images($est_id)
	{
    $query = $this->db->select('*')
             ->from('splashback_estimate_images')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_all_balustrade_images($est_id)
	{
    $query = $this->db->select('*')
             ->from('balustrade_estimate_images')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function uprights_adj($est_id)
	{
    $query = $this->db->select('*')
             ->from('uprights_adj')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function uprights_adj_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('uprights_adj')
             ->where(array("est_id"=> $est_id, "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function estimate_images($est_id)
	{
    $query = $this->db->select('*')
             ->from('est_images')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function estimate_images_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('est_images')
             ->where(array("est_id"=> $est_id, "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function get_all_student_data()
	{
    $query = $this->db->select('*')
             ->from('student')
           //  ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_cleats_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('cleats')
             ->where(array("est_id"=> $est_id, "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function get_top_shelf($est_id)
	{
    $query = $this->db->select('*')
             ->from('top_shelf')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_top_shelf_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('top_shelf')
             ->where(array("est_id"=> $est_id, "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function get_mail_desc($mail_title)
	{
    $query = $this->db->select('*')
             ->from('mail_description')
             ->where(array("id"=> $mail_title))
             ->get();
    return $query->result_array()[0];
	}

	public function get_shelves($est_id)
	{
    $query = $this->db->select('*')
             ->from('shelves')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_shelves_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('shelves')
             ->where(array("est_id"=> $est_id , "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function get_hanging_rail($est_id)
	{
    $query = $this->db->select('*')
             ->from('hanging_rail')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_hanging_rail_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('hanging_rail')
             ->where(array("est_id"=> $est_id , "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function uprights_std($est_id)
	{
    $query = $this->db->select('*')
             ->from('uprights_sts')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function uprights_std_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('uprights_sts')
             ->where(array("est_id"=> $est_id, "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function get_mirror_customer_data($est_id)
	{
		$query = $this->db->select('*')
						 ->from('sh_mi_estimate e')
						 ->join("customer c", "e.cus_id=c.id",'left')
						 ->join("sh_images s", "e.est_id=s.est_id",'left')
						 ->where(array("e.est_id"=> $est_id))
						 ->get();
		return $query->result_array();
	}

	public function get_all_calendar_data()
	{
    $query = $this->db->select('e.*,c.customer_name')
             ->from('new_estimate e')
             ->join("customer c", "e.cus_id=c.id",'left')
             // ->where(array("e.est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_details_data($est_id)
	{
    $query = $this->db->select('*')
             ->from('estimate_details')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_details_data_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('estimate_details')
             ->where(array("est_id"=> $est_id, "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function getwardrobe_description($est_id)
	{
    $query = $this->db->select('*')
             ->from('wardrobe_description')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function getwardrobe_description_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('wardrobe_description')
             ->where(array("est_id"=> $est_id , "pg_id" => $i))
             ->get();
    return $query->result_array();
	}

	public function get_est_id($id)
	{
    $query = $this->db->select('est_id,created_at')
             ->from('new_estimate')
             ->where(array("cus_id"=> $id))
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_all_est_images($id)
	{
    $query = $this->db->select('*')
             ->from('est_images')
             ->where(array("est_id"=> $id))
             ->get();
    return $query->result_array();
	}

	public function get_mirror_shower_data($id)
	{
    $query = $this->db->select('est_id,created_at')
             ->from('sh_mi_estimate')
             ->where(array("cus_id"=> $id))
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_cus_data_id($id)
	{
    $query = $this->db->select('*')
             ->from('customer')
             ->where(array("id"=> $id))
						 ->order_by('id DESC')
             ->get();
    return $query->result_array()[0];
	}

	public function get_all_est_drawer($est_id)
	{
    $query = $this->db->select('*')
             ->from('drawers')
             ->where(array("est_id"=> $est_id))
             ->get();
    return $query->result_array();
	}

	public function get_all_est_drawer_multiple($est_id,$i)
	{
    $query = $this->db->select('*')
             ->from('drawers')
             ->where(array("est_id"=> $est_id, "pg_id"=>$i))
             ->get();
    return $query->result_array();
	}

	public function img_upload_dtls()
	{

      if($_POST['imgId']=="")
      {

				$data['img_path']=$_POST['img_src'];
				$data['img_path'] = str_replace('data:image/png;base64,', '', $data['img_path']);

				$data['img_path'] = str_replace(' ', '+', $data['img_path']);

				$imageData = base64_decode($data['img_path']);

				$file = 'uploads/'. rand(). '.png';

				file_put_contents($file, $imageData);
				$image_path=PROJ_PATH.$file;
				$data['img_path']=$image_path;
        if($query = $this->db->insert('temp_images',$data))
        {
          echo "success";
        }
      }else{
				$data['img_path']=$_POST['img_src'];
				$data['img_path'] = str_replace('data:image/png;base64,', '', $data['img_path']);

				$data['img_path'] = str_replace(' ', '+', $data['img_path']);

				$imageData = base64_decode($data['img_path']);

				$file = 'uploads/'. rand(). '.png';

				file_put_contents($file, $imageData);
				$image_path=PROJ_PATH.$file;

        $data['img_path']=$image_path;
        $this->db->where('img_id',$_POST['imgId']);
        if($query = $this->db->update('temp_images',$data))
        {
          echo "success";
        }
      }
   //	return $this->db->insert_id();
	}

	public function img_upload_mirror()
	{

      if($_POST['imgId']=="")
      {

				$data['img_path']=$_POST['img_src'];
				$data['img_path'] = str_replace('data:image/png;base64,', '', $data['img_path']);

				$data['img_path'] = str_replace(' ', '+', $data['img_path']);

				$imageData = base64_decode($data['img_path']);

				$file = 'uploads/'. rand(). '.png';

				file_put_contents($file, $imageData);
				$image_path=PROJ_PATH.$file;
				$data['img_path']=$image_path;
        if($query = $this->db->insert('temp_images_mirror',$data))
        {
          echo "success";
        }
				else {
					echo "error";
				}
      }else{

				$data['img_path']=$_POST['img_src'];
				$data['img_path'] = str_replace('data:image/png;base64,', '', $data['img_path']);

				$data['img_path'] = str_replace(' ', '+', $data['img_path']);

				$imageData = base64_decode($data['img_path']);

				$file = 'uploads/'. rand(). '.png';

				file_put_contents($file, $imageData);
				$image_path=PROJ_PATH.$file;

        $data['img_path']=$image_path;
        $this->db->where('id',$_POST['imgId']);
        if($query = $this->db->update('temp_images_mirror',$data))
        {
          echo "success";
        }
				else {
					echo "error";
				}
      }
   //	return $this->db->insert_id();
	}

	public function img_upload_splashback()
	{

      if($_POST['img_id']=="")
      {

				$data['img_path']=$_POST['img_src'];
				$data['img_path'] = str_replace('data:image/png;base64,', '', $data['img_path']);

				$data['img_path'] = str_replace(' ', '+', $data['img_path']);

				$imageData = base64_decode($data['img_path']);

				$file = 'uploads/'. rand(). '.png';

				file_put_contents($file, $imageData);
				$image_path=PROJ_PATH.$file;
				$data['img_path']=$image_path;
        if($query = $this->db->insert('temp_images',$data))
        {
          echo "success";
        }
				else {
					echo "error";
				}
      }else{

				$data['img_path']=$_POST['img_src'];
				$data['img_path'] = str_replace('data:image/png;base64,', '', $data['img_path']);

				$data['img_path'] = str_replace(' ', '+', $data['img_path']);

				$imageData = base64_decode($data['img_path']);

				$file = 'uploads/'. rand(). '.png';

				file_put_contents($file, $imageData);
				$image_path=PROJ_PATH.$file;

        $data['img_path']=$image_path;
        $this->db->where('img_id',$_POST['img_id']);
        if($query = $this->db->update('temp_images',$data))
        {
          echo "success";
        }
				else {
					echo "error";
				}
      }
   //	return $this->db->insert_id();
	}

	public function img_sample()
	{
		$data['img_path']=$_POST['images'];
		// print_r($data['img_path']);
		$count=count($data['img_path']);
		// echo $count;die;
		if ($count > 0) {
			 // if($this->db->empty_table('temp_images'))
			 // {
			for ($i=0; $i < $count; $i++) {
			   $inrarr=array(
					 "img_path" =>$data['img_path'][$i]
				 );
				$this->db->insert('temp_images',$inrarr);
			}
			echo "success";
		 // }
		}
		else {
			echo "error";
		}
   //	return $this->db->insert_id();
	}

	public function img_sample_mirror()
	{

		$data['img_path']=$_POST['images'];
		$data['imgtype']=$_POST['imgtype'];
		// print_r($data['img_path']);
		$count=count($data['img_path']);
		// echo $count;die;
		if ($count > 0) {
			 // if($this->db->empty_table('temp_images'))
			 // {
			for ($i=0; $i < $count; $i++) {
			   $inrarr=array(
					 "img_path" =>$data['img_path'][$i],
					 "img_type" =>$data['imgtype']
				 );
				$this->db->insert('temp_images_mirror',$inrarr);
			}
			echo "success";
		 // }
		}
		else {
			echo "error";
		}
	}

	public function img_sample_splashback()
	{
		$data['img_path']=$_POST['images'];
		// $data['imgtype']=$_POST['imgtype'];
		// print_r($data['img_path']);
		$count=count($data['img_path']);
		// echo $count;die;
		if ($count > 0) {
			 // if($this->db->empty_table('temp_images'))
			 // {
			for ($i=0; $i < $count; $i++) {
			   $inrarr=array(
					 "img_path" =>$data['img_path'][$i],
					 // "img_type" =>$data['imgtype']
				 );
				$this->db->insert('temp_images',$inrarr);
			}
			echo "success";
		 // }
		}
		else {
			echo "error";
		}
	}

	public function img_delete()
	{

		$img_id=$_POST['idd'];
		// print_r($data['img_path']);
	   $result=$this->db->delete('temp_images', array('img_id' => $img_id));
     if ($result > 0) {
       echo "success";
     }
     else {
       echo "error";
     }
	}

	public function img_mirror_delete()
	{
		$img_id=$_POST['idd'];
		// print_r($data['img_path']);
	   $result=$this->db->delete('temp_images_mirror', array('id' => $img_id));
     if ($result > 0) {
       echo "success";
     }
     else {
       echo "error";
     }

   //	return $this->db->insert_id();
	}

	public function img_splashback_delete()
	{
		$img_id=$_POST['idd'];
		// print_r($data['img_path']);
	   $result=$this->db->delete('temp_images', array('img_id' => $img_id));
     if ($result > 0) {
       echo "success";
     }
     else {
       echo "error";
     }

   //	return $this->db->insert_id();
	}

	public function insertDropCategories($data)
	{
		$query = $this->db->insert('categories',$data);
		return $this->db->insert_id();
	}

	public function insertDropCategories_sm($data)
	{
		$query = $this->db->insert('shower_categories',$data);
		return $this->db->insert_id();
	}

	public function insertsubcatvalue($data)
	{
		$query = $this->db->insert('sub_categories',$data);
		return $this->db->insert_id();
	}

	public function insertsubcatvalue_sm($data)
	{
		$query = $this->db->insert('sub_categories_shower_mirror',$data);
		return $this->db->insert_id();
	}

	public function insert_back_sp_subcatvalue($data)
	{
		$query = $this->db->insert('backsplash_sub_category',$data);
		return $this->db->insert_id();
	}

	public function insert_balustrade_subcatvalue($data)
	{
		$query = $this->db->insert('balustrade_sub_category',$data);
		return $this->db->insert_id();
	}

	public function get_data($tbl, $feilds, $arr)
	{
	    $query = $this->db->select($feilds)
		         ->from($tbl)
		         ->where($arr)
		         ->get();

		return $query->result();
	}

	public function get_details($tbl, $feilds, $arr)
	{
	    $query = $this->db->select($feilds)
		         ->from($tbl)
		         ->where($arr)
		         ->get();

		return $query->row();
	}


	public function run_query($qry)
	{
		$query = $this->db->query($qry);
		return $query->result();
	}

	public function get_all_mirror_estimate()
	{
    $query = $this->db->select('*')
             ->from('sh_mi_estimate e')
             ->join("customer c", "e.cus_id=c.id")
						  ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_all_wardrobe_estimate()
	{
    $query = $this->db->select('*')
             ->from('new_estimate e')
             ->join("customer c", "e.cus_id=c.id")
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_all_splashback_estimate()
	{
    $query = $this->db->select('*')
             ->from('splashback_estimate_id e')
             ->join("customer c", "e.cus_id=c.id")
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_cus_splashback_estimate($id)
	{
    $query = $this->db->select('*')
             ->from('splashback_estimate_id e')
             ->join("customer c", "e.cus_id=c.id")
						 ->where(array("e.cus_id"=> $id))
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_all_balustrade_estimate()
	{
    $query = $this->db->select('*')
             ->from('balustrade_estimate_id e')
             ->join("customer c", "e.cus_id=c.id")
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}

	public function get_cus_balustrade_estimate($id)
	{
    $query = $this->db->select('*')
             ->from('balustrade_estimate_id e')
             ->join("customer c", "e.cus_id=c.id")
						  ->where(array("e.cus_id"=> $id))
						 ->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}
	
		public function get_course($id= null)
	{
    $query = $this->db->select('*')
             ->from('assigncourse e')
             //->join("customer c", "e.cus_id=c.id")
						  ->where(array("e.id"=> $id))
						 //->order_by('est_id DESC')
             ->get();
    return $query->result_array();
	}
	
			public function get_teacher($id= null)
	{
    $query = $this->db->select('*')
             ->from('teacher e')
             //->join("customer c", "e.cus_id=c.id")
						  ->where(array("e.id"=> $id))
						 //->order_by('est_id DESC')
             ->get();
 return $query->row_array();
	}
	
	     public function viewAssetData($id = null) {
        if ($id) {
            $this->db->select('asset.*, parent.asset_no as parent_asset_no,  parent.note as parent_note, site.site_name as site_name1, users.firstname as firstname1,users.lastname as lastname1, asset_type.type as type1,'
                    . 'vendors.vendor as vendor1,manufacturer.manufacturer as manufacturer1,dept.dept as dept1');
            $this->db->from('asset');
             $this->db->join('asset as parent', 'parent.id=asset.parent_id', 'left');
            $this->db->join('site', 'site.id=asset.site_id', 'left');
            $this->db->join('users', 'users.id=asset.owner_user_id', 'left');
            $this->db->join('vendors', 'vendors.id=asset.vendor_id', 'left');
            $this->db->join('manufacturer', 'manufacturer.id=asset.manufacturer_id', 'left');
            $this->db->join('dept', 'dept.id=asset.dept_id', 'left');
            $this->db->join('asset_type', 'asset_type.id=asset.type_id', 'left');
            $this->db->where('asset.id', $id);
            $this->db->order_by('asset.id', 'DESC');
            $query = $this->db->get();


            return $query->row_array();
        }
        }
	
  public function pie_chart_js() {
   
      $query =  $this->db->query("SELECT created_on as y_date, DAYNAME(created_on) as day_name, COUNT(id) as count  FROM teacher WHERE date(created_on) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(created_on) = '" . date('m') . "' AND YEAR(created_on) = '" . date('Y') . "' GROUP BY DAYNAME(created_on) ORDER BY (y_date) ASC"); 
 
      $record = $query->result();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);
     
    }
    
    public function coursehistory($id) {
        if ($id) {
            $this->db->select('*');
            $this->db->from('assigncourse');
            $this->db->join('course', 'assigncourse.names=course.id', 'left');
           // $this->db->join('asset', 'asset.id=workorder.asset_id', 'left');
           // $this->db->join('site', 'site.id=workorder.site_id', 'left');
           // $this->db->join('pm', 'pm.id=workorder.pm_id', 'left');
           // $this->db->where('assigncourse.names', $names);
            	  $this->db ->where(array("assigncourse.names"=> $id));
           // $this->db->order_by('workorder.id', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }
    }
  
      public function coursehistoryteacher($id) {
        if ($id) {
            $this->db->select('*');
            $this->db->from('assigncourse');
            $this->db->join('course', 'assigncourse.names=course.id', 'left');
           // $this->db->join('asset', 'asset.id=workorder.asset_id', 'left');
           // $this->db->join('site', 'site.id=workorder.site_id', 'left');
           // $this->db->join('pm', 'pm.id=workorder.pm_id', 'left');
           // $this->db->where('assigncourse.names', $names);
            	  $this->db ->where(array("assigncourse.company_id"=> $id));
           // $this->db->order_by('workorder.id', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }
    }
     public function coursestudenthistory() {
      //  if ($id) {
            $this->db->select('enrolled.*');
            $this->db->from('enrolled');
            $this->db->join('course', 'enrolled.name=course.name', 'left');
           // $this->db->join('asset', 'asset.id=workorder.asset_id', 'left');
           // $this->db->join('site', 'site.id=workorder.site_id', 'left');
           // $this->db->join('pm', 'pm.id=workorder.pm_id', 'left');
          //  $this->db->where('assigncourse.name', $names);
         //   	  $this->db ->where(array("assigncourse.id"=> $id));
           // $this->db->order_by('workorder.id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }
     

}
?>
