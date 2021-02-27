<?php

    error_reporting(0);

/*    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    */

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Panel extends CI_Controller {

        function __construct() {

            parent::__construct();
            $this->load->model('MainModel');
      		  $this->load->model('Usermodel');
      		  $this->load->helper('url');
          	$this->load->library('session');
            $this->load->model('googlecalendar');          
      	}

         public function index() {

            $response["message"] = "Please login.";

            $this->load->view('panel/template/head');
            $this->load->view('panel/pages/login', $response);
            $this->load->view('panel/template/foot');
        }

        public function dashbard() {

        $response["quetions"] = "";

          if($this->input->post('email') != "") {

              if($this->input->post('password') != "") {

                  $arr = array(
                      "email"     => $this->input->post('email'),
                      "password"  => $this->input->post('password')
                  );

                  $res = $this->MainModel->admin_login($arr);
                                    
                    if($res){ 


                        $response['manegetabs'] = '';
                        $response["payment"]    = "";
                        $response["report"]     = "";
                        $response["quiz"]       = "";
                        $response["leason"]     = "";
                        $response["course"]     = "";
                        $response["role"]       = "";
                        $response["dashboard"]  = "";
                        $response["user"]       = "";
                        $response["services"]   = "";
                        $response["booking"]    = "";
                        $response["message_code"]  = 1;
                        $response["message"] = "Login successfully.";
                        $response["dashboard"] = "active";
                        $response["category"] = "";
                        $response["sub_category"] = "";
                        $response["featured"] = "";
                        $response["sub_feature"] = "";
                        $response["news"] = "";
                        $response["services"] = "";
                        $response["booking"] = "";

                        $rest = $res[0];

                       /* $this->session->set_userdata('id', $rest['id']);
                        $this->session->set_userdata('name', $rest['name']);
                        $this->session->set_userdata('email', $rest['email']);
                        $this->session->set_userdata('role', $rest['role']);
                        $this->session->set_userdata('image', $rest['image']);
            */
                         $this->session->set_userdata('id', '1');
                        $this->session->set_userdata('name', 'Admin');
                        $this->session->set_userdata('email', 'admin@gmail.com');
                        $this->session->set_userdata('role', 'Admin');
                        $this->session->set_userdata('image', 'admin.png');

                        $this->load->view('panel/template/head');
                        $this->load->view('panel/template/header', $response);
                        $this->load->view('panel/pages/dashboard', $response);
                        $this->load->view('panel/template/footer');
                        $this->load->view('panel/template/foot');
                        
                    }
                    else
                    {
                        $response["message_code"]  = 0;
                        $response["message"] = "Sorry, incorrect credential .";
                        $this->load->view('panel/template/head');
                  $this->load->view('panel/pages/login', $response);
                  $this->load->view('panel/template/foot');
                    }
              }
              else {

                  $response["message_code"]  = 0;
                  $response["message"] = "Please enter password.";
                  $this->load->view('panel/template/head');
                $this->load->view('panel/pages/login', $response);
                $this->load->view('panel/template/foot');
              }
          }
          else {
              $response["message_code"]  = 0;
              $response["message"] = "Please enter email.";
              $this->load->view('panel/template/head');
              $this->load->view('panel/pages/login', $response);
              $this->load->view('panel/template/foot');
          }
      }


        

        public function manegetabs() {

            $res = $this->MainModel->manegetabs();

            $response['title_'] = 'Manage Tabs';
            $response['title_dynamic'] = 'manegetabs';
            $response['dashboard'] = '';
            $response['manegetabs'] = 'active';
            $response['details'] = $res;

            $this->load->view('panel/template/head');
            $this->load->view('panel/template/header', $response);
            $this->load->view('panel/pages/manegetabs/display');
            $this->load->view('panel/template/footer');
            $this->load->view('panel/template/foot');
        }

        public function managesubtabs($id = 0) {
            if($id > 0) {
                $tbl = "subtabs";
                $result = $this->MainModel->delete($tbl, $id);
                  if($result) {
                    $this->session->set_flashdata('success','New row added successfully'); 
                }else{
                    $this->session->set_flashdata('danger','Something went wrong');
                }
                redirect('/Panel/manegetabs', 'refresh');
            }

            if($this->input->post('name')){
                $name = $this->input->post('name');
                $category = $this->input->post('category');
              
                
                //SELECT `id`, `name`, `parent_id`, `created_at`, `image`, `description` FROM `category_` WHERE 1
                
                $array_data = array(
                   'name' => $name,
                   'category' => $category
               
                    
                    ); 

                $tbl = "subtabs";
                $result = $this->MainModel->add($tbl, $array_data);

                if($result) {
                    $this->session->set_flashdata('success','New row added successfully'); 
                }else{
                    $this->session->set_flashdata('danger','Something went wrong');
                }

                redirect('/Panel/manegetabs', 'refresh');
            }
        }

        public function edit_sub($id = 0) {

          //print_r($_POST);

          $tbl = "subtabs";

          $cond = array(
                  'id' => $id

                );

            if($this->input->post('question')){
                $name = $this->input->post('question');
            

                $array_data = array(
                    'name' => $name          
                ); 

                

                

                $result = $this->MainModel->edit_save($tbl, $array_data, $cond);

                if($result) {
                    $this->session->set_flashdata('success','Existing row updatedd successfully'); 
                }else{
                    $this->session->set_flashdata('danger','Something went wrong');
                }
            }

            $res = $this->MainModel->edit_($tbl, $cond);


           $response['title_'] = 'Manege Tabs';
            $response['title_dynamic'] = 'manegetabs';
            $response['dashboard'] = '';
            $response['manegetabs'] = 'active';
            $response["details"]    = $res;
    
            $this->load->view('panel/template/head');
            $this->load->view('panel/template/header', $response);
            $this->load->view('panel/pages/manegetabs/edit', $response);
            $this->load->view('panel/template/footer');
            $this->load->view('panel/template/foot');
        }

        public function source() {

           // $this->load->view('my/header', $data);
           $this->load->view('template/header', $data);
            $this->load->view('my/source', $data);
            //$this->load->view('my/footer');

        }

        public function contact() {

           // $this->load->view('my/header', $data);
           $this->load->view('template/header', $data);
            $this->load->view('my/contact', $data);
            //$this->load->view('my/footer');

        }

        public function register_new() {

          $data['msg'] = '';

        if($this->input->post('firstname') != ''){

          $firstname = $this->input->post('firstname');
          $lastname = $this->input->post('lastname');
          $Mobile = $this->input->post('Mobile');
          $pass = $this->input->post('pass');
          $email = $this->input->post('email');

          $arrayName = array('name' => $firstname." ".$lastname,
            'email' => $email,
            'phone' => $Mobile,
            'password' => $pass
          );

          $result = $this->db->insert('student',$arrayName);
          if($result){
            $data['msg'] = "Register successfully";
          }else{
            $data['msg'] = "Somethng went wrong";
          }
        }
        $this->load->view('template/header', $data);

           $this->load->view('my/register_new', $data);

        }

        public function forget_pass() {

            $this->load->view('my/header', $data);
            $this->load->view('my/forget_pass', $data);
            $this->load->view('my/footer');

        }

        public function send_mail() {

        $this->load->config('email');
        $this->load->library('email');

        $email = $this->input->post('email');

        $arrayName = array(
              'email' => $email 
            );
            
            $this->db->from('student');
           
            $this->db->where($arrayName);
            $query = $this->db->get(); 
            $report = $query->result_array();



        
        $from = "driving@viyra.com";
        $to = $email;
        $subject ="Forgot password";
        $message = "Your forgot password is : ".$report[0]->password;

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
       //     echo 'Your Email has successfully been sent.';
        } else {
         //   show_error($this->email->print_debugger());
        }

        redirect('/home/login', 'refresh');
        }


        public function certificate($id = 0) {

            $array_report['lesson_id'] = $id;
            $data['header_hide'] = "1";
            if($this->session->userdata('id') == '') {
                header('Location:'.base_url('home/login'));           
            }
            //SELECT `id`, `student_id`, `lesson_id`, `score`, `created_at`, `updated_at`, `score_out_of`, `persentage`, `timing` FROM `report` WHERE 1

            $arrayName = array(
              'student_id' => $this->session->userdata('id'),
              'lesson_id' => $id);
            
            $this->db->from('report');
            $this->db->order_by("id", "asc");
            $this->db->where($arrayName);
            $query = $this->db->get(); 
            $report = $query->result_array();

            //print_r($this->db->last_query());

            $data['persentage'] = $report[0]['persentage'];
            $data['certi'] = $report[0]['issue_ceri'];
            $data['created_at'] =  date("d-m-Y", strtotime($report[0]['created_at']));



            $this->db->from('lesson');
            $this->db->order_by("id", "asc");
            $this->db->where('id', $id);
            $query = $this->db->get(); 
            $video_ = $query->result_array();
            $data['video_'] = $video_[0]['video_'];

            $this->load->view('my/header', $data);
            $this->load->view('my/certificate', $data);
            $this->load->view('my/footer');

        }

        public function watch($id = 0) {
          
            $array_report['lesson_id'] = $id;
            $data['header_hide'] = "1";
            if($this->session->userdata('id') == '') {
                header('Location:'.base_url('home/login'));           
            }

            $this->db->from('lesson');
            $this->db->order_by("id", "asc");
            $this->db->where('id', $id);
            $query = $this->db->get(); 
            $video_ = $query->result_array();
            $data['video_'] = $video_[0]['video_'];

            $this->load->view('my/header', $data);
            $this->load->view('my/watch', $data);
            $this->load->view('my/footer');
        }

        public function quiz($id = 0) {



            $array_report['lesson_id'] = $id;
            $array_report['student_id'] = $this->session->userdata('id');

            $this->db->from('report');
            $this->db->where($array_report);
            $query = $this->db->get(); 
            $report_sub = $query->result_array();

            $data['report_sub'] = $report_sub[0]->id;

            $data['lesson_id'] = $id;
            $data['header_hide'] = "1";

            if($this->session->userdata('id') == '') {
              header('Location:'.base_url('home/login'));           
            }

            $this->db->from('quetions_');
            $this->db->order_by("id", "asc");
            $query = $this->db->get(); 
            $data['quetions_'] = $query->result_array();

        $this->db->from('quiz');
          $this->db->where('lesson_id', $id);
        $this->db->order_by("id", "asc");
        $query = $this->db->get(); 
        $data['quiz'] = $query->result_array();

        //print_r($data['quiz']);

        $this->db->select('lesson_id');
        $this->db->from('answers_');
        $this->db->where('student_id',$this->session->userdata('id'));
        $query = $this->db->get(); 
        $data['answers_'] = $query->result_array();
        
        foreach ($data['answers_'] as $row) {
          $dt[] = $row['lesson_id'];
        }

        $this->db->from('lesson');
        $this->db->order_by("id", "asc");
        
      $this->db->where_not_in('id', $dt);
        $query = $this->db->get(); 
        $data['lesson_q'] = $query->result_array();
        
        $this->db->select('lesson_id');
        $this->db->from('answers_quiz');
        $this->db->where('student_id',$this->session->userdata('id'));
        $query = $this->db->get(); 
        $data['answers_'] = $query->result_array();

        foreach ($data['answers_quiz'] as $row) {
          $dt2[] = $row['lesson_id'];
        }  


        $this->db->from('lesson');
        $this->db->order_by("id", "asc");
        
      $this->db->where_not_in('id', $dt2);
        $query = $this->db->get(); 
        $data['lesson_qz'] = $query->result_array();  

         //print_r($data['lesson_q']);        

        $this->db->from('lesson');
        $this->db->order_by("id", "asc");
        $query = $this->db->get(); 
        $lesson_here = $data['lesson'] = $query->result_array();

        $ewDate = 
        $ewDate = strtotime("+{$min} minutes");


        $data['timing'] = $lesson_here[0]->timing;


        $this->load->view('my/header', $data);
        $this->load->view('my/quiz', $data);
        $this->load->view('my/footer');
      }

        public function myquiz() {



         $this->db->select('s.name as sname, l.name as rname, r. *');
          $this->db->from('report as r');
          $this->db->join('student as s','s.id=r.student_id','left');
          $this->db->join('lesson as l','l.id=r.lesson_id','left');
                    $this->db->where('student_id',$this->session->userdata('id'));
          $query = $this->db->get();
          $data['report'] = $query->result_array(); 

//print_r($data['report']);

          $data['header_hide'] = "1";

          $this->load->view('my/header', $data);
          $this->load->view('my/myquiz');
          $this->load->view('my/footer');


/*
          $data['header_hide'] = "1";

          $this->load->view('my/header', $data);
        $this->load->view('my/myquiz', $data);
        $this->load->view('my/footer');
*/
        }

      	public function Courses_save() {

      		$ans = $this->input->post('ans');
	        $que = $this->input->post('que');
	    	  $les = $this->input->post('les');

	    	  $array_data = array(
	        	'quetions_id' => $que[$i],
	            'answer' => $ans,
	            'lesson_id' => $les,
	            'student_id' => $this->session->userdata('id')              
	            ); 

	            $result = $this->Usermodel->add('answers_', $array_data);

	            echo "1";

      	}

      	public function Courses_saveq() {

      		$ans = $this->input->post('ans');
	        $que = $this->input->post('que');
	    	  $les = $this->input->post('les');

	    	  $array_data = array(
	        	'quetions_id' => $que[$i],
	            'answer' => $ans,
	            'lesson_id' => $les,
	            'student_id' => $this->session->userdata('id')              
	            ); 

	            $result = $this->Usermodel->add('answers_quiz', $array_data);

	            echo "1";

      	}


      	public function leasons($id = 0) {

      		if($this->session->userdata('id') == '') {
				  header('Location:'.base_url('home/login'));      			
      		} 

      		//SELECT `id`, `quetions_id`, `student_id`, `answer`, `created_at` FROM `answers_` WHERE 1

      		$count_ = count($this->input->post('quetions_id'));

      		if($count_ > 0) {

	      		for($i = 0; $i < $count_; $i++) {

	 				$quetions_id = $this->input->post('quetions_id');
	                $answer = $this->input->post('answer');
	                
	                $array_data = array(
	                   'quetions_id' => $quetions_id[$i],
	                   'answer' => $answer[$i],
	                   'student_id' => $this->session->userdata('id')              
	                ); 

	                $result = $this->Usermodel->add('answers_', $array_data);
	               

	      		}

	      		if($result) {
	                    $this->session->set_flashdata('success','Existing row updatedd successfully'); 
	                }else{
	                    $this->session->set_flashdata('danger','Something went wrong');
	            }

	        }

          /*	        SELECT `id`, `quetions_id`, `student_id`, `answer`, `created_at` FROM `answers_` WHERE 1*/

      		$this->db->from('answers_');
  		    $this->db->where('student_id',$this->session->userdata('id'));
  		    $query = $this->db->get(); 
  		    $answers_ = $query->result_array();
  		    $data['answers_'] = $answers_[0]['id'];

  		    print_r($data);

        		$this->db->from('lesson');
  		    $this->db->order_by("id", "asc");
  		    $query = $this->db->get(); 
  		    $data['lesson'] = $query->result_array();


		    

		   	$this->db->from('quiz');
		   	$this->db->where('lesson_id', $id);
		    $this->db->order_by("id", "asc");
		    $query = $this->db->get(); 
		    $data['quiz'] = $query->result_array();

		    print_r($data['quiz']);

		    $this->db->from('quetions_');
		   	$this->db->where('lesson_id', $id);
		    $this->db->order_by("id", "asc");
		    $query = $this->db->get(); 
		    $data['quetions_'] = $query->result_array();

		    //print_r($data['quetions_'] );

		    $this->db->from('lesson');
		    $this->db->where('id', $id);
		    $this->db->order_by("id", "asc");
		    $query = $this->db->get(); 
		    $data['lesson_num'] = $query->result_array();

		    $data['page_id'] = $id;

		    $this->load->view('my/header');
		    $this->load->view('my/course', $data);
		    $this->load->view('my/footer');
      	}

        public function quiz_ans() {

        	$cont = 0;
        	$ans = $this->input->post('answer');
          $timing = - $this->input->post('timing') + 10;
          	$que = $this->input->post('quetions_id');
          	$les = $this->input->post('lesson_id');

          	$count_ = count($this->input->post('quetions_id'));

          	if($count_ > 0) {

            	for($i = 0; $i < $count_; $i++) {

            		$ans1 = $this->input->post('answer'.$que[$i]);

            		$this->db->from('quiz');
        			$this->db->where('id', $que[$i]);
		   			$query = $this->db->get(); 
		    		$quiz_ = $query->result_array();
		    		$answers = $quiz_[0]['answers'];

		    		if($answers == $ans1[0]) {
		    			$cont++;

		    		}
/*            else{
              print_r($quiz_[0]['answers']);

              print_r($answers);
              print_r(1);
              print_r($ans1[0]);
              die;

            }*/

		    		$array_data = array(
                  'timing' => $timing,
            			'quetions_id' => $que[$i],
              			'answer' => $ans1[0],
              			'lesson_id' => $les,
              			'student_id' => $this->session->userdata('id')              
              		); 

              		$result = $this->Usermodel->add('answers_quiz', $array_data);
              	}
        			$array_report = array(
                'timing' => $timing,
		    			'student_id' => $this->session->userdata('id'),
		    			'lesson_id' => $les,
		    			'score' => $cont,
		    			'score_out_of' => $count_,
		    			'persentage' => ($cont / $count_ * 100)
		    		);



		    		$result_report = $this->Usermodel->add('report', $array_report);
      }

      if(($cont / $count_ * 100) < 80) {
                $less = "but, Your score is less than 80% please take a retest.";

                 $this->session->set_flashdata('danger','Quiz successful completed, Time Taken:'.$timing.', Correct Answer:'.$cont.' '.$less); 
        redirect('/home/Courses');
      }
      else{

         $this->session->set_flashdata('success','Quiz successful completed, Time Taken:'.$timing.', Correct Answer:'.$cont); 
        redirect('/home/Courses');

      }

      
    }



      	public function courses() {

      		$data['header_hide'] = "1";

      		if($this->session->userdata('id') == '') {
				header('Location:'.base_url('home/login'));      			
      		}

      		$this->db->from('quetions_');
		   	$this->db->order_by("id", "asc");
		    $query = $this->db->get(); 
		    $data['quetions_'] = $query->result_array();

		    $this->db->from('quiz');
		   	$this->db->order_by("id", "asc");
		    $query = $this->db->get(); 
		    $data['quiz'] = $query->result_array();

		    $this->db->select('lesson_id');
		    $this->db->from('answers_');
		    $this->db->where('student_id',$this->session->userdata('id'));
		    $query = $this->db->get(); 
		    $data['answers_'] = $query->result_array();
		    
		    foreach ($data['answers_'] as $row) {
		    	$dt[] = $row['lesson_id'];
		    }

		    $this->db->from('lesson');
		    $this->db->order_by("id", "asc");
		    
			$this->db->where_not_in('id', $dt);
		    $query = $this->db->get(); 
		    $data['lesson_q'] = $query->result_array();

		    $this->db->select('lesson_id');
		    $this->db->from('answers_quiz');
		    $this->db->where('student_id',$this->session->userdata('id'));
		    $query = $this->db->get(); 
		    $data['answers_'] = $query->result_array();

		    foreach ($data['answers_quiz'] as $row) {
		    	$dt2[] = $row['lesson_id'];
		    }  


		    $this->db->from('lesson');
		    $this->db->order_by("id", "asc");
		    
			$this->db->where_not_in('id', $dt2);
		    $query = $this->db->get(); 
		    $data['lesson_qz'] = $query->result_array();  

		     //print_r($data['lesson_q']);    		

		    $this->db->from('lesson');
		    $this->db->order_by("id", "asc");
		    $query = $this->db->get(); 
		    $data['lesson'] = $query->result_array();


		    $this->load->view('my/header', $data);
		    $this->load->view('my/courses', $data);
		    $this->load->view('my/footer');
			}

	  	public function register(){

		    $data['msg'] = '';

		    if($this->input->post('firstname') != ''){

		      $firstname = $this->input->post('firstname');
		      $lastname = $this->input->post('lastname');
		      $Mobile = $this->input->post('Mobile');
		      $pass = $this->input->post('pass');
		      $email = $this->input->post('email');

		      $arrayName = array('name' => $firstname." ".$lastname,
		        'email' => $email,
		        'phone' => $Mobile,
		        'password' => $pass
		      );

		      $result = $this->db->insert('student',$arrayName);
		      if($result){
		        $data['msg'] = "Register successfully";
		      }else{
		        $data['msg'] = "Somethng went wrong";
		      }
		    }

		    $this->load->view('my/header');
		    $this->load->view('my/register', $data);
		    $this->load->view('my/footer');
	  		}

  		public function login() {

  			if($this->input->post('email') != '') {

  				$pass = $this->input->post('pass');
      			$email = $this->input->post('email');

      			$arrayName = array(
        			'email' => $email,
        			'password' => $pass
      			);

      			$que = $this->db->query("select * from student where email='".$email."' and password='".$pass."'");
      			$row = $que->num_rows();
    			
    			if($row > 0) {

    				$result = $que->result_array();
      				$this->session->set_userdata('id', $result[0]['id']);
      				$this->session->set_userdata('name', $result[0]['name']);

        			$data['msg'] = "login successfully";
        			redirect('/home/Courses');
      			}
      			else {
        			$data['msg'] = "Somethng went wrong";
      			}
    		}

    		$this->load->view('my/header');
    		$this->load->view('my/login');
    		$this->load->view('my/footer');
  			}

  			public function logout() {
        $this->session->unset_userdata('id');
       // $this->session->unset_userdata('logged_in');
        redirect(base_url('Panel'));
    }

  public function home(){

    $this->load->view('my/header');
    $this->load->view('my/index');
    $this->load->view('my/footer');
  }



  

 public function multiple_deleteteacher(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('teacher');
    }
  }
  
   public function multiple_deleteschedule(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('schedule');
    }
  }
   public function multiple_deleteappointment(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('appointment');
    }
  }
  
   public function multiple_deleteenrolled(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('enrolled');
    }
  }
  
       public function multiple_deletenote(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('note');
    }
  }
  
      public function multiple_deletestudent(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('student');
    }
  }
    
      public function multiple_deletelesson(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('lesson');
    }
  }
       public function multiple_deletelevel(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('level');
    }
  }
    public function multiple_deletesubject(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('subject');
    }
  }
  
   public function multiple_deleteappoint(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('appoint');
    }
  }
  
       public function multiple_deleteaccomodation(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('accomodation');
    }
  }
      public function multiple_deletecourse(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('course');
    }
  }
      public function multiple_deleteassigncourse(){
      // var_dump($dellist);die;
      $arr=$this->input->post('dellist');
// echo $arr;
// die;


    // echo "1";
    foreach($arr as $a){
         $where=array(
          'id'  => $a,
          );
        $this -> db -> where($where);
        $this -> db -> delete('courseassign');
    }
  }
       public function deletappointment(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('appointment');
      redirect("home/assignappointment");
  }
  
    public function deletteachercourse(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('assigncourse');
      redirect("home/course");
  }
  
     public function deletstudentcourse(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('enrolled');
      redirect("home/course");
  }
  public function deletappoint(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('appoint');
      redirect("home/appointmentlist");
  }
  
    public function deletnote(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('note');
      redirect("home/note");
  }
  
      public function deletaccomodation(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('teac_accomodation');
      redirect("home/accomodation");
  }
  
        public function deletsaccomodation(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('accomodation');
      redirect("home/accomodation");
  }
  
     public function deletcourseassign(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('assigncourse');
      redirect("home/course");
  }
  
       public function deletteachernote(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('note');
      redirect("home/note");
  }
        public function deletstudnote(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('stud_note');
      redirect("home/note");
  }
         public function deletsstudnote(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('stud_note');
      redirect("home/student");
  }
      public function deletschedule(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('schedule');
      redirect("home/schedule");
  }
      public function deletteacher(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('teacher');
      redirect("home/teacher");
  }
    public function deletstudent(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('student');
      redirect("home/student");
  }
    public function deletlesson(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('lesson');
      redirect("home/lesson");
  }
      public function deletsubject(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('subject');
      redirect("home/subject");
  }
      public function deletcourse(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('course');
      redirect("home/lesson");
  }
      public function deletenrolled(){
      $id = $this->input->post("duid");
      $where=array(
          'id'  => $id,
          );
      $this -> db -> where($where);
      $this -> db -> delete('enrolled');
      redirect("home/enrolled");
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

//     public function viewteacher(){
        
//         // echo $id;
//         // die;
        
//     //   echo $euid;
//       $where=array(
//           'id' => $this->input->post("vuid")
//           );
//         //   $work_where=array(
//         //   'user_id' => $this->input->post("vuid")
//         //   );
          
//           $uid=$this->input->post("vuid");
//       $SQL="SELECT
          
//             name as hard,
//             phone as ts,
//             email as avgst,
//             address as rounds,
//             state as rl
          
//         FROM
//             teacher 
//         WHERE
//             id=".$uid.";";
//         // GROUP BY
//         //     date(work_time);";         
//       $user1=$this->Usermodel->getdata('teacher',$where);
//       // $work_data=$this->Usermodel->getdata('work_history',$work_where);
//     //   echo "<pre>";var_dump($user);die;
    
//     // $query = $this->db->query($SQL);

//     // $work_data = $query->result_array();
    
//     // $hard_SQL="SELECT
//     //       *
//     //     FROM
//     //         teacher 
//     //     WHERE
//     //         id=".$uid."
//     //   ";
     
//      //  $data1=$this->Usermodel->getdata('teacher',$where);
//     //$hard_data = $this->db->query($hard_SQL)->result_array();
//     // $data2     = $this->Usermodel->get_appointmnet();
//       $data4 = $this->db->get('course')->result_array();
//          $data2 = $this->db->get('appointment')->result_array();
     
//           $data1 =$this->Usermodel->get_course();
//         //   print_r($data1);
//         //   die;
           
      
//              // $data1 =$this->db->get('assigncourse')->result_array();
//             //   print_r($data1);
//             //   die;
              
              
//   //   $data1 = $this->db->get('assigncourse')->result_array();
//       $data3 = $this->db->get('level')->result_array();
//     $data['alert']    = $this->session->flashdata('alert');
//     $data['error']    = $this->session->flashdata('error');
//     $data['success']  = $this->session->flashdata('success');
    

// //     echo "<pre>";var_dump($data1);die;
    
//     $this->load->view('header');
//     $this->load->view('teacherview', ['user'=>$user1,'appointment'=>$data2,'appoint'=>$data1,'course'=>$data4]);
//     $this->load->view('footer');
      
//   }

     public function viewteacher($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `teacher` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    $query2 = $this->db->query("SELECT * FROM `note` WHERE company_id='$id'");
    $res2  = $query2->result();
    $course2=$res2;

    $query3 = $this->db->query("SELECT * FROM `appointment` WHERE company_id='$id'");
    $res3  = $query3->result();
    $appointment=$res3;
    
     $query3 = $this->db->query("SELECT * FROM `teac_accomodation` WHERE t_id='$id'");
    $res3  = $query3->result();
    $t_accomodationt=$res3;
      $data4 = $this->db->get('course')->result_array();
     
           $data = $this->db->get('level')->result_array();


 $course = $this->Usermodel->coursehistoryteacher($id);
 
//  print_r($course);
//  die;

    $this->load->view('teacherview', ['user'=>$user1,'level'=>$data,'appoint'=>$appointment,'course'=>$course,'course2'=>$course2,'course1'=>$data4,'t_accomodation'=>$t_accomodationt]);

    $this->load->view('footer');

  }
  
//      public function viewteacher($id) {
//   $data['alert']    = $this->session->flashdata('alert');
//     $data['error']    = $this->session->flashdata('error');
//     $data['success']  = $this->session->flashdata('success');
    
//         // if (!in_array('viewAsset', $this->permission)) {
//         //     redirect('dashboard', 'refresh');
//         // }

//         if (!$id) {
//             redirect('dashboard', 'refresh');
//         }
        
//         $id= $this->uri->segment(3);
//     $query1 = $this->db->query("SELECT * FROM `teacher` WHERE id='$id'");
//     $res  = $query1->row_array();
//     $user1=$res;

//     $query2 = $this->db->query("SELECT * FROM `assigncourse` WHERE company_id='$id'");
//     $res2  = $query2->result();
//     $course=$res2;

//     $query3 = $this->db->query("SELECT * FROM `teacher` WHERE cus_type='$id'");
//     $res3  = $query3->result();
//     $appointment=$res3;
//       $data4 = $this->db->get('course')->result_array();
     
//           $data = $this->db->get('level')->result_array();
  

// //     echo "<pre>";var_dump($data1);die;
    
//     $this->load->view('header');
//     $this->load->view('teacherview', ['user'=>$user1,'level'=>$data,'appoint'=>$appointment,'course'=>$course,'course1'=>$data4]);
//     $this->load->view('footer');
//     }
  
    public function viewteachercourse()
  {
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');

    $data =$this->Usermodel->get_assigncourse();

    $this->load->view('header');
    $this->load->view('teacherview',$data);
    $this->load->view('footer');
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

 
  
   public function accomodation()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['t_accomodation'] = $this->db->get('teac_accomodation')->result_array();
    
       $data['accomodation'] = $this->db->get('accomodation')->result_array();

   // $data['student'] = $this->Usermodel->get_teachers();


    

    $this->load->view('header');
 $data['schedule']     = $this->db->get('schedule')->result_array();
    $this->load->view('accomodationlist',$data);

    $this->load->view('footer');

  }

  
   public function note()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['stud_note'] = $this->db->get('stud_note')->result_array();
    
       $data['note'] = $this->db->get('note')->result_array();

   // $data['student'] = $this->Usermodel->get_teachers();


    

    $this->load->view('header');
 $data['schedule']     = $this->db->get('schedule')->result_array();
    $this->load->view('communiationlist',$data);

    $this->load->view('footer');

  }

   public function report()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['level'] = $this->db->get('level')->result_array();
    
     //  $student = $this->db->get('student')->result_array();

    $appointment = $this->Usermodel->viewteacherappointment();

 $student = $this->Usermodel->viewstudentappointment();



    

    $this->load->view('header');
//$data['teacher']     = $this->db->get('teacher')->result_array();
    $this->load->view('report', ['appointment'=>$appointment,'student'=>$student]);

    $this->load->view('footer');

  }
 
  public function schedule()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['level'] = $this->db->get('level')->result_array();
    
       $data['student'] = $this->db->get('student')->result_array();
     $data['teacher'] = $this->db->get('teacher')->result_array();
   // $data['student'] = $this->Usermodel->get_teachers();


    

    $this->load->view('header');
 $data['schedule']     = $this->db->get('schedule')->result_array();
    $this->load->view('schedulelist',$data);

    $this->load->view('footer');

  }


 
 


 
  public function teacher()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

   // $data['customer'] = $this->db->get('customer')->result_array();

  //  $data['teacher'] = $this->Usermodel->get_teachers();


    

    $this->load->view('header');
 $data['teacher']     = $this->db->get('teacher')->result_array();
    $this->load->view('teacher_view',$data);

    $this->load->view('footer');

  }


    public function level()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['level'] = $this->db->get('level')->result_array();

    $this->load->view('header');
 $data['consolidate']     = $this->db->get('student')->result_array();


    $this->load->view('levellist',$data);

    $this->load->view('footer');

  }
  
    public function student()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['student'] = $this->db->get('student')->result_array();

    $this->load->view('header');
 $data['consolidate']     = $this->db->get('student')->result_array();


    $this->load->view('studentlist',$data);

    $this->load->view('footer');

  }
  
      public function lesson()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

 

    $this->load->view('header');
 $data['lesson']     = $this->db->get('lesson')->result_array();



    $this->load->view('lessonlist',$data);

    $this->load->view('footer');

  }
  
        public function subject()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

 

    $this->load->view('header');
 $data['subject']     = $this->db->get('subject')->result_array();



    $this->load->view('subjectlist',$data);

    $this->load->view('footer');

  }
  
          public function course()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

 

    $this->load->view('header');
 $data['course']     = $this->db->get('course')->result_array();
 
  $data['teacher']     = $this->db->get('teacher')->result_array();



    $this->load->view('courselist',$data);

    $this->load->view('footer');

  }
  
         public function appointment()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

 

    $this->load->view('header');
 $data['appoint']     = $this->db->get('appoint')->result_array();



    $this->load->view('appointmentlist',$data);

    $this->load->view('footer');

  }
  
//   public function viewstudent(){
//     //   echo $euid;
//       $where=array(
//           'id' => $this->input->post("vuid")
//           );
//           $work_where=array(
//           'id' => $this->input->post("vuid")
//           );
          
//           $uid=$this->input->post("vuid");
//       $SQL="SELECT
          
//             stud_id as hard,
//             name as ts,
//             email as avgst,
//             phone as rounds,
//             gender as rl,
//               age as rl
//         FROM
//             student 
//         WHERE
//             id=".$uid.";";
//         // GROUP BY
//         //     date(work_time);";         
//       $user1=$this->Usermodel->getdata('student',$where);
//      //  $work_data1=$this->Usermodel->getdata('enrolled');
//     //   echo "<pre>";var_dump($user);die;
    
//     $query = $this->db->query($SQL);
//      $work_data = $query->result_array();
    
//     $hard_SQL="SELECT
//           *
//         FROM
//             student 
//         WHERE
//             id=".$uid."
//       ";
    
//     $hard_data = $this->db->query($hard_SQL)->result_array();
//      $course     = $this->db->get('course')->result_array();
//          $data2     = $this->db->get('enrolled')->result_array();
//     $data['alert']    = $this->session->flashdata('alert');
//     $data['error']    = $this->session->flashdata('error');
//     $data['success']  = $this->session->flashdata('success');
    

//     // echo "<pre>";var_dump($data);die;
    
//     $this->load->view('header');
//     $this->load->view('view_student', ['user'=>$user1,'work'=>$data2,'hard'=>$hard_data,'course'=>$course]);
//     $this->load->view('footer');
      
//   }

     public function viewaccomodation($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `accomodation` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    $query2 = $this->db->query("SELECT * FROM `enrolled` WHERE studc_id='$id'");
    $res2  = $query2->result();
    $student=$res2;

    $query3 = $this->db->query("SELECT * FROM `stud_appointment` WHERE studa_id='$id'");
    $res3  = $query3->result();
    $appointment=$res3;
      $data4 = $this->db->get('course')->result_array();
     
           $data = $this->db->get('level')->result_array();


    $this->load->view('view_accomodation', ['user'=>$user1]);

    $this->load->view('footer');

  }
  
     public function viewnote($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `note` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    // $query2 = $this->db->query("SELECT * FROM `enrolled` WHERE studc_id='$id'");
    // $res2  = $query2->result();
    // $student=$res2;

    // $query3 = $this->db->query("SELECT * FROM `stud_appointment` WHERE studa_id='$id'");
    // $res3  = $query3->result();
    // $appointment=$res3;
    //   $data4 = $this->db->get('course')->result_array();
     
        //   $data = $this->db->get('level')->result_array();


    $this->load->view('view_note', ['user'=>$user1]);

    $this->load->view('footer');

  }
  
       public function viewnotestudent($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `stud_note` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    // $query2 = $this->db->query("SELECT * FROM `enrolled` WHERE studc_id='$id'");
    // $res2  = $query2->result();
    // $student=$res2;

    // $query3 = $this->db->query("SELECT * FROM `stud_appointment` WHERE studa_id='$id'");
    // $res3  = $query3->result();
    // $appointment=$res3;
    //   $data4 = $this->db->get('course')->result_array();
     
        //   $data = $this->db->get('level')->result_array();


    $this->load->view('viewnotestudent', ['user'=>$user1]);

    $this->load->view('footer');

  }
     public function viewschedule($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `schedule` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    $query2 = $this->db->query("SELECT * FROM `enrolled` WHERE studc_id='$id'");
    $res2  = $query2->result();
    $student=$res2;

    $query3 = $this->db->query("SELECT * FROM `stud_appointment` WHERE studa_id='$id'");
    $res3  = $query3->result();
    $appointment=$res3;
      $data4 = $this->db->get('course')->result_array();
     
           $data = $this->db->get('level')->result_array();


    $this->load->view('view_schedule', ['user'=>$user1]);

    $this->load->view('footer');

  }
  
     public function viewstudent($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `student` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    $query2 = $this->db->query("SELECT * FROM `enrolled` WHERE studc_id='$id'");
    $res2  = $query2->result();
    $student=$res2;

    $query3 = $this->db->query("SELECT * FROM `stud_appointment` WHERE studa_id='$id'");
    $res3  = $query3->result();
    $appointment=$res3;
    
      $query3 = $this->db->query("SELECT * FROM `stud_note` WHERE studc_id='$id'");
    $res3  = $query3->result();
    $note=$res3;
    
      $query3 = $this->db->query("SELECT * FROM `accomodation` WHERE s_id='$id'");
    $res3  = $query3->result();
    $accomodation=$res3;
      $data4 = $this->db->get('course')->result_array();
     
           $data = $this->db->get('level')->result_array();


    $this->load->view('view_student', ['user'=>$user1,'level'=>$data,'student'=>$student,'course1'=>$data4,'appointment'=>$appointment,'note'=>$note,'accom'=>$accomodation]);

    $this->load->view('footer');

  }
  
   public function viewlesson(){
    //   echo $euid;
      $where=array(
          'id' => $this->input->post("vuid")
          );
          $work_where=array(
          'id' => $this->input->post("vuid")
          );
          
          $uid=$this->input->post("vuid");
      $SQL="SELECT
          
            *
        FROM
            lesson 
        WHERE
            id=".$uid.";";
        // GROUP BY
        //     date(work_time);";         
      $user1=$this->Usermodel->getdata('lesson',$where);
      
    //   $work_data=$this->Usermodel->getdata('work_history',$work_where);
    //   echo "<pre>";var_dump($user);die;
    
    $query = $this->db->query($SQL);
     $work_data = $query->result_array();
    
    $hard_SQL="SELECT
          *
        FROM
            lesson 
        WHERE
            id=".$uid."
      ";
    
    $hard_data = $this->db->query($hard_SQL)->result_array();
    
    
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    

    // echo "<pre>";var_dump($data);die;
    
    $this->load->view('header');
    $this->load->view('viewlesson', ['user'=>$user1,'work'=>$work_data,'hard'=>$hard_data]);
    $this->load->view('footer');
      
  }
  
     public function viewteacher_course(){
    //   echo $euid;


    
    
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    

   
    
  $data['course'] = $this->Usermodel->coursehistory();
  
   // echo "<pre>";var_dump($data);die;
  
    $this->load->view('header');
    $this->load->view('viewteacher_course', $data);
    $this->load->view('footer');
      
  }

     public function viewcourse($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `course` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    $query2 = $this->db->query("SELECT * FROM `enrolled` WHERE studc_id='$id'");
    $res2  = $query2->result();
    $student=$res2;

    // $query3 = $this->db->query("SELECT * FROM `assigncourse` WHERE names='$id'");
    // $res3  = $query3->result();
    // $data5=$res3;
    
    
      $data4 = $this->db->get('course')->row_array();
     
           $data = $this->db->get('level')->result_array();
 $data5 = $this->Usermodel->coursehistory($id);
 
//  print_r($data5);
//  die;

    $this->load->view('viewcourse', ['user'=>$user1,'level'=>$data,'student'=>$student,'course1'=>$data4,'course5'=>$data5]);

    $this->load->view('footer');

  }

//     public function viewcourse($name){
//     //   echo $euid;
//       $where=array(
//           'id' => $this->input->post("vuid")
//           );
        
          
//           $uid=$this->input->post("vuid");
//       $SQL="SELECT
          
//             *
//         FROM
//             course 
//         WHERE
//             id=".$uid.";";
//         // GROUP BY
//         //     date(work_time);";         
//       $user1=$this->Usermodel->getdata('course',$where);
//     //   $work_data=$this->Usermodel->getdata('work_history',$work_where);
//     //   echo "<pre>";var_dump($user);die;
    
//   // $query = $this->db->query($SQL);
//     // $work_data = $query->result_array();
    

    
    
//     $data['alert']    = $this->session->flashdata('alert');
//     $data['error']    = $this->session->flashdata('error');
//     $data['success']  = $this->session->flashdata('success');
//       $course = $this->Usermodel->coursehistory();
      
//             $student = $this->Usermodel->coursestudenthistory();

//     // echo "<pre>";var_dump($data);die;
    
//     $this->load->view('header');
//     $this->load->view('viewcourse', ['user'=>$user1,'course'=>$course,'student'=>$student]);
//     $this->load->view('footer');
      
//   }

     public function viewappointment($id)
  {

    
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 
        
        $id= $this->uri->segment(3);
    $query1 = $this->db->query("SELECT * FROM `appoint` WHERE id='$id'");
    $res  = $query1->row_array();
    $user1=$res;

    $query2 = $this->db->query("SELECT * FROM `appointment` WHERE company_id='$id'");
    $res2  = $query2->result();
    $student=$res2;

    $query3 = $this->db->query("SELECT * FROM `stud_appointment` WHERE studa_id='$id'");
    $res3  = $query3->result();
    $data5=$res3;
    
    
      $data4 = $this->db->get('course')->row_array();
     
           $data = $this->db->get('level')->result_array();
 $data5 = $this->Usermodel->coursehistory($id);
 
//  print_r($data5);
//  die;

    $this->load->view('viewappointment', ['user'=>$user1,'level'=>$data,'appointment'=>$student,'course1'=>$data4,'stud_app'=>$data5]);

    $this->load->view('footer');

  }
 public function viewlevel(){
    //   echo $euid;
      $where=array(
          'id' => $this->input->post("vuid")
          );
          $work_where=array(
          'id' => $this->input->post("vuid")
          );
          
          $uid=$this->input->post("vuid");
      $SQL="SELECT
          
            level as hard
            
        FROM
            level 
        WHERE
            id=".$uid.";";
        // GROUP BY
        //     date(work_time);";         
      $user1=$this->Usermodel->getdata('level',$where);
    //   $work_data=$this->Usermodel->getdata('work_history',$work_where);
    //   echo "<pre>";var_dump($user);die;
    
    $query = $this->db->query($SQL);
     $work_data = $query->result_array();
    
    $hard_SQL="SELECT
          *
        FROM
            level 
        WHERE
            id=".$uid."
      ";
    
    $hard_data = $this->db->query($hard_SQL)->result_array();
    
    
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    

    // echo "<pre>";var_dump($data);die;
    
    $this->load->view('header');
    $this->load->view('levelview', ['user'=>$user1,'work'=>$work_data,'hard'=>$hard_data]);
    $this->load->view('footer');
      
  }
  
 public function viewsubject(){
    //   echo $euid;
      $where=array(
          'id' => $this->input->post("vuid")
          );
          $work_where=array(
          'id' => $this->input->post("vuid")
          );
          
          $uid=$this->input->post("vuid");
      $SQL="SELECT
          
         *
            
        FROM
            subject 
        WHERE
            id=".$uid.";";
        // GROUP BY
        //     date(work_time);";         
      $user1=$this->Usermodel->getdata('subject',$where);
    //   $work_data=$this->Usermodel->getdata('work_history',$work_where);
    //   echo "<pre>";var_dump($user);die;
    
    $query = $this->db->query($SQL);
     $work_data = $query->result_array();
    
    $hard_SQL="SELECT
          *
        FROM
            subject 
        WHERE
            id=".$uid."
      ";
    
    $hard_data = $this->db->query($hard_SQL)->result_array();
    
    
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    

    // echo "<pre>";var_dump($data);die;
    
    $this->load->view('header');
    $this->load->view('viewsubject', ['user'=>$user1,'work'=>$work_data,'hard'=>$hard_data]);
    $this->load->view('footer');
      
  }
  
      public function unpaidshipments()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['customer'] = $this->db->get('customer')->result_array();

    $this->load->view('header');


  $data['consolidate'] = $this->Usermodel->get_all_unpaid_data1();

//   print_r($data['consolidate']);
//   die;


    $this->load->view('unpaidlist',$data);

    $this->load->view('footer');

  }

     public function coursesenrolled()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['enrolled'] = $this->db->get('enrolled')->result_array();

    $this->load->view('header');


 // $data['consolidate'] = $this->Usermodel->get_all_unpaid_data1();

  // print_r($data['consolidate']);
  // die;


    $this->load->view('coursesenrolledlist',$data);

    $this->load->view('footer');

  }

     public function courseassign()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['assigncourse'] = $this->db->get('assigncourse')->result_array();
      $data['level'] = $this->db->get('level')->result_array();

    $this->load->view('header');


 // $data['consolidate'] = $this->Usermodel->get_all_unpaid_data1();

  // print_r($data['consolidate']);
  // die;


    $this->load->view('assigncourselist',$data);

    $this->load->view('footer');

  }
  
      public function assignappointment()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['appointment'] = $this->db->get('appointment')->result_array();
    //  $data['level'] = $this->db->get('level')->result_array();

    $this->load->view('header');


 // $data['consolidate'] = $this->Usermodel->get_all_unpaid_data1();

  // print_r($data['consolidate']);
  // die;


    $this->load->view('assignappointment',$data);

    $this->load->view('footer');

  }
  
        public function addappoint()
  {

    if(!isset($this->session->balnxr_admin)){

      redirect('/','refresh');

    }
    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    $data['appointment'] = $this->db->get('appointment')->result_array();
      $data['student'] = $this->db->get('student')->result_array();
       $data['teacher'] = $this->db->get('teacher')->result_array();
        $data['course'] = $this->db->get('course')->result_array();
          $data['subject'] = $this->db->get('subject')->result_array();

    $this->load->view('header');


 // $data['consolidate'] = $this->Usermodel->get_all_unpaid_data1();

  // print_r($data['consolidate']);
  // die;


    $this->load->view('add_appoint',$data);

    $this->load->view('footer');

  }
  
public function adduser(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');

    $this->load->view('user_add',$data);

    $this->load->view('footer',$data);

  }
  public function addrecepient(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');

    $this->load->view('recepient_add',$data);

    $this->load->view('footer',$data);

  }
  
    public function editappoint(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('appoint',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    $student = $this->db->get('student')->result_array();
       $teacher = $this->db->get('teacher')->result_array();
        $course = $this->db->get('course')->result_array();
          $subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_appoint', ['user'=>$user1,'teacher'=>$teacher,'student'=>$student,'course'=>$course,'subject'=>$subject]);
    $this->load->view('footer');
      
  } 
  
      public function editaccomodation(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('accomodation',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    $student = $this->db->get('student')->result_array();
    //   $teacher = $this->db->get('teacher')->result_array();
    //     $course = $this->db->get('course')->result_array();
          $subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_accomodation', ['user'=>$user1,'student'=>$student]);
    $this->load->view('footer');
      
  } 
  
  
  public function editstudent(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('student',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
      $subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('student_edit', ['user'=>$user1,'subject'=>$subject]);
    $this->load->view('footer');
      
  } 
  
   public function editstudentnote(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('stud_note',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
      //$subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_student_note', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
     public function editsaccomodation(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('accomodation',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
      //$subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_student_accomodation', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
     public function edittaccomodation(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('teac_accomodation',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
      //$subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_teacher_accomodation', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
  
    public function editlevel(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('level',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
     // $subject = $this->db->get('subject')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_level', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
  
  
   public function editnote(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('note',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    //  $subject = $this->db->get('schedule')->result_array();
     //  $level = $this->db->get('level')->result_array();
     //   $student = $this->db->get('student')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_note', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
  
    public function editschedule(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('schedule',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
    //  $subject = $this->db->get('schedule')->result_array();
       $level = $this->db->get('level')->result_array();
        $student = $this->db->get('student')->result_array();
        $teacher = $this->db->get('teacher')->result_array();
    
    $this->load->view('header');
    $this->load->view('edit_schedule', ['user'=>$user1,'level'=>$level,'student'=>$student,'teacher'=>$teacher]);
    $this->load->view('footer');
      
  } 
  
    public function editteacher(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('teacher',$where);
      
   
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
   
    
    $this->load->view('header');
    $this->load->view('teacher_edit', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
    public function editenrolled(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('enrolled',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
   
         $course     = $this->db->get('course')->result_array();
    $this->load->view('header');
    $this->load->view('edit_course_enrolled', ['user'=>$user1,'course'=>$course]);
    $this->load->view('footer');
      
  } 
  
    public function editlesson(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('lesson',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
      $subject = $this->db->get('subject')->result_array();
      $level = $this->db->get('level')->result_array();
   
    
    $this->load->view('header');
    $this->load->view('editlesson', ['user'=>$user1,'subject'=>$subject,'level'=>$level]);
    $this->load->view('footer');
      
  } 
  
      public function editappointment(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('appointment',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
   
    
    $this->load->view('header');
    $this->load->view('editassignappointment', ['user'=>$user1]);
    $this->load->view('footer');
      
  } 
  
      public function editsubject(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('subject',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
       $level = $this->db->get('level')->result_array();
    
    $this->load->view('header');
    $this->load->view('editsubject', ['user'=>$user1,'level'=>$level]);
    $this->load->view('footer');
      
  } 
       public function editcourse(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
      $user1=$this->Usermodel->getdata('course',$where);
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
     $level = $this->db->get('level')->result_array();
      $subject = $this->db->get('subject')->result_array();
       $lesson = $this->db->get('lesson')->result_array();
   
    
    $this->load->view('header');
    $this->load->view('editcourse', ['user'=>$user1,'level'=>$level,'subject'=>$subject,'lesson'=>$lesson]);
    $this->load->view('footer');
      
  } 
        public function editcourseassign(){
      //   echo $euid;
      $where=array(
          'id' => $this->input->post("euid")
          );
    
    //   echo "<pre>";var_dump($user);die;
    $data['alert']    = $this->session->flashdata('alert');
    $data['error']    = $this->session->flashdata('error');
    $data['success']  = $this->session->flashdata('success');
    
      $user1 = $this->db->get('level')->result_array();
  $user1=$this->Usermodel->getdata('assigncourse',$where);
     $course = $this->db->get('course')->result_array();
    
    $this->load->view('header');
    $this->load->view('editcourselistassign', ['user'=>$user1,'course'=>$course,], $data);
    $this->load->view('footer');
      
  }  
  
  
 
  
  public function addteacher(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');

    $this->load->view('addteacher',$data);

    $this->load->view('footer',$data);

  }
    public function addlevel(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');

    $this->load->view('addlevel',$data);

    $this->load->view('footer',$data);

  }
    public function addstudent(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();
    
       $data['subject'] = $this->db->get('subject')->result_array();

    $this->load->view('header');

    $this->load->view('student_add',$data);

    $this->load->view('footer',$data);

  }
      public function addcourseenrolled(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');

    $this->load->view('add_course_enrolled',$data);

    $this->load->view('footer',$data);

  }
      public function addcourse(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');
  $data['level'] = $this->db->get('level')->result_array();
  
   $data['subject'] = $this->db->get('subject')->result_array();
    $data['lesson'] = $this->db->get('lesson')->result_array();
    $this->load->view('addcourse',$data);

    $this->load->view('footer',$data);

  }
      public function addsubject(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');
  $data['subject'] = $this->db->get('level')->result_array();
    $this->load->view('addsubject',$data);

    $this->load->view('footer',$data);

  }
  
//       public function addsubject(){
//     if(!isset($this->session->balnxr_admin)){
//       redirect('/','refresh');
//     }

//     $data['alert']    = $this->session->flashdata('alert');

//     $data['error']    = $this->session->flashdata('error');

//     $data['success']  = $this->session->flashdata('success');

//     // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

//     $this->load->view('header');

//     $this->load->view('addsubject',$data);

//     $this->load->view('footer',$data);

//   }
    public function addlesson(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();

    $this->load->view('header');
  $data['level'] = $this->db->get('level')->result_array();
  
   $data['subject'] = $this->db->get('subject')->result_array();
    $this->load->view('addlesson',$data);

    $this->load->view('footer',$data);

  }
  public function addpackage(){
    if(!isset($this->session->balnxr_admin)){
      redirect('/','refresh');
    }

    $data['alert']    = $this->session->flashdata('alert');

    $data['error']    = $this->session->flashdata('error');

    $data['success']  = $this->session->flashdata('success');

    // $data['all_driver'] = $this->db->where('driver_active',1)->get('driver_registration')->result_array();
$data['mail_desc']    = $this->db->get('mail_description')->result_array();
    $this->load->view('header');

    $this->load->view('add_package',$data);

    $this->load->view('footer',$data);

  }
  
    public function savelesson(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("author");
    $mob=$this->input->post("subscriber");
    //$password=$this->input->post("subject");
    $pincode=$this->input->post("level");
    $course=$this->input->post("course");

   // $date = date("Y-m-d");
 
        $config=[
                'upload_path'=>"./uploads",
                'allowed_types'=>'*'
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
            "name"        => $fnm,
            "subject"        => $course,
            "author"       => $email,
            "suscriber"   => $mob,
           // "subject"    => $password,
              "level"        => $pincode,
            "type" => $img_path,
          
    
            );
        $user_id = $this->Usermodel->insert_table("lesson",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'lesson Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/lesson");
  }
    public function updatelesson(){
           $id=$this->input->post("uid");
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("author");
    $mob=$this->input->post("subscriber");
    $password=$this->input->post("course");
    $pincode=$this->input->post("level");
   // $course=$this->input->post("course");

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
    "name"        => $fnm,
          //  "subject"        => $course,
            "author"       => $email,
            "suscriber"   => $mob,
            "subject"    => $password,
              "level"        => $pincode,
            "type" => $img_path,
        );
        
    
        
        
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"lesson");
    if($user_updated){
        $data1['success']  = 'student Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/lesson");
  }
  
     public function savesubject(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("level");
    $mob=$this->input->post("author");
    $password=$this->input->post("category");
   // $pincode=$this->input->post("level");
   // $gender=$this->input->post("type");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "name"        => $fnm,
          //  "date"        => $date,
            "level"       => $email,
            "author"   => $mob,
            "category"    => $password,
           //   "level"        => $pincode,
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("subject",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Subject Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/subject");
  }
    public function updatesubject(){
           $id=$this->input->post("uid");
     $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("level");
    $mob=$this->input->post("author");
    $password=$this->input->post("category");
   // $pincode=$this->input->post("level");
   // $gender=$this->input->post("type");

     
        $data=array(
            "name"        => $fnm,
          //  "date"        => $date,
            "level"       => $email,
            "author"   => $mob,
            "category"    => $password,
           //   "level"        => $pincode,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"subject");
    if($user_updated){
        $data1['success']  = 'Subject Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/subject");
  }
  
      public function savesaccomodation(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    $lnm=$this->input->post("s_id");
    $email=$this->input->post("id");
    $mob=$this->input->post("accomodation");
    $password=$this->input->post("date");
   // $pincode=$this->input->post("level");
   // $gender=$this->input->post("type");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "stud_name"        => $fnm,
            "s_id"        => $lnm,
            "stud_id"       => $email,
            "accomodation"   => $mob,
            "j_date"    => $password,
           //   "level"        => $pincode,
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("accomodation",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Accomodation Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/student");
  }
    public function updatesaccomodation(){
           $id=$this->input->post("uid");
   $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("id");
    $mob=$this->input->post("accomodation");
    $password=$this->input->post("date");
   // $pincode=$this->input->post("level");
   // $gender=$this->input->post("type");

     
        $data=array(
   
            "stud_name"        => $fnm,
          //  "date"        => $date,
            "stud_id"       => $email,
            "accomodation"   => $mob,
            "j_date"    => $password,
           //   "level"        => $pincode,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"accomodation");
    if($user_updated){
        $data1['success']  = 'Accomdoation Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/student");
  }

      public function savetaccomodation(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
     $lnm=$this->input->post("t_id");
    $email=$this->input->post("id");
    $mob=$this->input->post("accomodation");
    $password=$this->input->post("date");
   // $pincode=$this->input->post("level");
   // $gender=$this->input->post("type");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "teac_name"        => $fnm,
           "t_id"        => $lnm,
            "teac_id"       => $email,
            "accomodation"   => $mob,
            "date"    => $password,
           //   "level"        => $pincode,
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("teac_accomodation",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Accomodation Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/teacher");
  }
    public function updatetaccomodation(){
           $id=$this->input->post("uid");
   $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("id");
    $mob=$this->input->post("accomodation");
    $password=$this->input->post("date");
   // $pincode=$this->input->post("level");
   // $gender=$this->input->post("type");

     
        $data=array(
   
            "teac_name"        => $fnm,
          //  "date"        => $date,
             "teac_id"       => $email,
            "accomodation"   => $mob,
            "date"    => $password,
           //   "level"        => $pincode,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"teac_accomodation");
    if($user_updated){
        $data1['success']  = 'Accomdoation Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/teacher");
  }

  public function saveappoint(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    $lnm=$this->input->post("stud_id");
    $email=$this->input->post("teacher");
    $mob=$this->input->post("course");
    $password=$this->input->post("subject");
    $pincode=$this->input->post("date");
   // $gender=$this->input->post("type");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "name"        => $fnm,
            "stud_id"        => $lnm,
            "teacher"       => $email,
            "course"   => $mob,
            "subject"    => $password,
              "date"        => $pincode,
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("appoint",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Appointment Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/appointment");
  }
    public function updateappoint(){
           $id=$this->input->post("uid");
    $fnm=$this->input->post("name");
    $lnm=$this->input->post("stud_id");
    $email=$this->input->post("teacher");
    $mob=$this->input->post("course");
    $password=$this->input->post("subject");
    $pincode=$this->input->post("date");
   // $gender=$this->input->post("type");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "name"        => $fnm,
            "stud_id"        => $lnm,
            "teacher"       => $email,
            "course"   => $mob,
            "subject"    => $password,
              "date"        => $pincode,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"appoint");
    if($user_updated){
        $data1['success']  = 'Apoointment Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/appointment");
  }
  
  
  
   public function saveaccomodeation(){
 
    // echo "<pre>";var_dump($this->input->post());die;
       $s_id=$this->input->post("s_id");
   
    $address=$this->input->post("address");
    $dept=$this->input->post("dept");
    $gender=$this->input->post("gender");
     $email=$this->input->post("email");
     $mobile=$this->input->post("mobile");
     $j_date=$this->input->post("j_date");
      $l_date=$this->input->post("l_date");

   // $date = date("Y-m-d");
 
       
        $data=array(
               "s_id"        => $s_id,
          
            "address"        => $address,
            "dept"       => $dept,
            "gender"   => $gender,
             "email"    => $email,
           "mobile"        => $mobile,
           "j_date"        => $j_date,
           "e_date"        => $l_date,
    
            );
        $user_id = $this->Usermodel->insert_table("accomodation",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Accomodation Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/accomodation");
  }
    public function updateaccomodation(){
           $id=$this->input->post("uid");
            $s_id=$this->input->post("s_id");
   
    $address=$this->input->post("address");
    $dept=$this->input->post("dept");
    $gender=$this->input->post("gender");
     $email=$this->input->post("email");
     $mobile=$this->input->post("mobile");
       $j_date=$this->input->post("j_date");
      $l_date=$this->input->post("l_date");

   // $date = date("Y-m-d");
 
       
        $data=array(
    "s_id"        => $s_id,
          
            "address"        => $address,
            "dept"       => $dept,
            "gender"   => $gender,
             "email"    => $email,
           "mobile"        => $mobile,
             "j_date"        => $j_date,
           "e_date"        => $l_date,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"accomodation");
    if($user_updated){
        $data1['success']  = 'Accomodation Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/accomodation");
  }



   public function savenote(){
 
    // echo "<pre>";var_dump($this->input->post());die;
       $name=$this->input->post("name");
     $description=$this->input->post("description");
    $note=$this->input->post("note");
    $type=$this->input->post("type");
    $log=$this->input->post("log");
     $email=$this->input->post("c_id");
     $mobile=$this->input->post("date");
    // $ts_member=$this->input->post("ts_member");

   // $date = date("Y-m-d");
 
       
        $data=array(
               "name"        => $name,
             "description"        => $description,
            "note"        => $note,
            "type"       => $type,
            "log"   => $log,
             "company_id"    => $email,
               "date"        => $mobile,
        //   "ts_member"        => $ts_member,
          
    
            );
        $user_id = $this->Usermodel->insert_table("note",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Notes Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/teacher");
  }
    public function updatenote(){
           $id=$this->input->post("uid");
                  $name=$this->input->post("name");
   $description=$this->input->post("description");
    $note=$this->input->post("note");
    $type=$this->input->post("type");
    $log=$this->input->post("log");
       $mobile=$this->input->post("date");

   // $date = date("Y-m-d");
 
       
        $data=array(
         "name"        => $name,
           "description"        => $description,
            "note"        => $note,
            "type"       => $type,
            "log"   => $log,
                "date"        => $mobile,
        //     "email"    => $email,
        //       "mobile"        => $mobile,
        //   "ts_member"        => $ts_member,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"note");
    if($user_updated){
        $data1['success']  = 'Notes Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/communication");
  }

   public function savestudnote(){
 
    // echo "<pre>";var_dump($this->input->post());die;
       $name=$this->input->post("name");
     $description=$this->input->post("description");
    $note=$this->input->post("note");
    $type=$this->input->post("type");
    $log=$this->input->post("log");
     $email=$this->input->post("c_id");
     $mobile=$this->input->post("date");
    // $ts_member=$this->input->post("ts_member");

   // $date = date("Y-m-d");
 
       
        $data=array(
               "name"        => $name,
             "description"        => $description,
            "note"        => $note,
            "type"       => $type,
            "log"   => $log,
             "studc_id"    => $email,
               "date"        => $mobile,
        //   "ts_member"        => $ts_member,
          
    
            );
        $user_id = $this->Usermodel->insert_table("stud_note",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Notes Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/student");
  }
    public function updatestudnote(){
           $id=$this->input->post("uid");
                  $name=$this->input->post("name");
 $description=$this->input->post("description");
    $note=$this->input->post("note");
    $type=$this->input->post("type");
    $log=$this->input->post("log");
       $mobile=$this->input->post("date");

   // $date = date("Y-m-d");
 
       
        $data=array(
         "name"        => $name,
            "description"        => $description,
            "note"        => $note,
            "type"       => $type,
            "log"   => $log,
                "date"        => $mobile,
        //     "email"    => $email,
        //       "mobile"        => $mobile,
        //   "ts_member"        => $ts_member,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"stud_note");
    if($user_updated){
        $data1['success']  = 'Notes Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/student");
  }


 public function saveschedule(){
 
    // echo "<pre>";var_dump($this->input->post());die;
       $stud_id=$this->input->post("stud_id");
         $t_id=$this->input->post("t_id");
   
    $date=$this->input->post("datetimes");
    $dapt_name=$this->input->post("dapt_name");
    $level=$this->input->post("level");
    $email=$this->input->post("email");
    $mobile=$this->input->post("mobile");
    $ts_member=$this->input->post("ts_member");

   // $date = date("Y-m-d");
 
       
        $data=array(
               "stud_id"        => $stud_id,
           "t_id"        => $t_id,
            "date"        => $date,
            "dapt_name"       => $dapt_name,
            "level"   => $level,
            "email"    => $email,
              "mobile"        => $mobile,
          "ts_member"        => $ts_member,
          
    
            );
        $user_id = $this->Usermodel->insert_table("schedule",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Schedule Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/schedule");
  }
    public function updateschedule(){
           $id=$this->input->post("uid");
                  $stud_id=$this->input->post("stud_id");
     $t_id=$this->input->post("t_id");
    $date=$this->input->post("datetimes");
    $dapt_name=$this->input->post("dapt_name");
    $level=$this->input->post("level");
    $email=$this->input->post("email");
    $mobile=$this->input->post("mobile");
    $ts_member=$this->input->post("ts_member");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "stud_id"        => $stud_id,
   "t_id"        => $t_id,
            "date"        => $date,
            "dapt_name"       => $dapt_name,
            "level"   => $level,
            "email"    => $email,
              "mobile"        => $mobile,
          "ts_member"        => $ts_member,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"schedule");
    if($user_updated){
        $data1['success']  = 'Schedule Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/schedule");
  }


     public function savecourse(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("level");
    $mob=$this->input->post("subject");
    $password=$this->input->post("lesson");
    $pincode=$this->input->post("subscription");
   // $gender=$this->input->post("type");

   // $date = date("Y-m-d");
 
       
        $data=array(
            "name"        => $fnm,
          //  "date"        => $date,
            "level"       => $email,
            "subject"   => $mob,
            "lesson"    => $password,
              "subscription"        => $pincode,
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("course",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Course Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/course");
  }
  
   public function saveassigncourse(){
  
    // echo "<pre>";var_dump($this->input->post());die;
    
    $lnm=$this->input->post("id");
       $company_id=$this->input->post('cid');
    $fnm=$this->input->post("name");
    //
    $specilization=$this->input->post("specialization");
   // $mob=$this->input->post("level");


   // $date = date("Y-m-d");
 
       
        $data=array(
          
               "tr_id"        => $lnm,
                'company_id' =>$company_id,
            "names"        => $fnm,
          //  "date"        => $date,
            "specialization"       => $specilization,
          //  "level"   => $mob,
        
          
    
            );
            
            
            // print_r($data);
            // die;
            
            
        $user_id = $this->Usermodel->insert_table("assigncourse",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Assign Course Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/teacher");
  }
  
     public function updateassigncourse(){
     $id=$this->input->post("uid");
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $specilization=$this->input->post("specialization");
    //$mob=$this->input->post("level");
     
        $data=array(
           "names"        => $fnm,
          //  "date"        => $date,
            "specialization"       => $specilization,
            //"level"   => $mob,
        );
        
 
        
        
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"assigncourse");
    if($user_updated){
        $data1['success']  = 'Assign Course Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/teacher");
  }

 public function saveappointment(){
   
    // echo "<pre>";var_dump($this->input->post());die;
    $lnm=$this->input->post("id");
    $fnm=$this->input->post("name");
      $company_id=$this->input->post('cid');
    $specilization=$this->input->post("date");



   // $date = date("Y-m-d");
 
       
        $data=array(
             "tra_id"        => $lnm,
            "name_a"        => $fnm,
             'company_id' =>$company_id,
          //  "date"        => $date,
            "date_a"       => $specilization,
         
        
          
    
            );
        $user_id = $this->Usermodel->insert_table("appointment",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Appointment Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/teacher");
  }
  
     public function updateappointment(){
     $id=$this->input->post("uid");
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $specilization=$this->input->post("date");
   // $mob=$this->input->post("level");
     
        $data=array(
           "name"        => $fnm,
          //  "date"        => $date,
            "date"       => $specilization,
           // "level"   => $mob,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"appointment");
    if($user_updated){
        $data1['success']  = 'Appointment Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/teacher");
  }

    public function updatecourse(){
     $id=$this->input->post("uid");
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("author");
    $email=$this->input->post("level");
    $mob=$this->input->post("subject");
    $password=$this->input->post("lesson");
    $pincode=$this->input->post("subscription");
   // $gender=$this->input->post("type");
     
        $data=array(
          "name"        => $fnm,
          //  "date"        => $date,
            "level"       => $email,
            "subject"   => $mob,
            "lesson"    => $password,
              "subscription"        => $pincode,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"course");
    if($user_updated){
        $data1['success']  = 'Course Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/course");
  }

  
  

   public function savestudent(){

    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("lnm");
    $email=$this->input->post("email");
    $mob=$this->input->post("phone");
    $password=base64_encode($this->input->post("pwd"));
    $pincode=$this->input->post("pincode");
    $gender=$this->input->post("gender");
    $stud_id=$this->input->post("stud_id");
   // $age=$this->input->post("age");
// $identity=$this->input->post("identity");
   // $qualification=$this->input->post("qualification");
    $course=$this->input->post("course");
    $hobies=$this->input->post("hobies");
    $city=$this->input->post("city");
    $date=$this->input->post("date");
    $state=$this->input->post("state");
    $country=$this->input->post("country");
    $address=$this->input->post("address");
     $enrolled=$this->input->post("enrolled");
      $subject=$this->input->post("subject");
        $join_date=$this->input->post("join_date");
    
    
        $config=[
                'upload_path'=>"./uploads",
                'allowed_types'=>'*'
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
            "name"        => $fnm,
            "join_date"        => $join_date,
            "email"       => $email,
            "phone"   => $mob,
            "password"    => $password,
              "pin_code"        => $pincode,
               "gender"        => $gender,
            "stud_id"        => $stud_id,
            "course"       => $course,
            "hobies"   => $hobies,
            "city"    => $city,
              "dob"        => $date,
               "state"        => $state,
            "country"        => $country,
            "address"       => $address,
             "enrolled"       => $enrolled,
              "subject"       => $subject,
               "profile_img" => $img_path,
           
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("student",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Student Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/student");
  
    
   }
   
   
     public function updatestudent(){
            $id=$this->input->post("uid");
     $fnm=$this->input->post("name");
    //$lnm=$this->input->post("lnm");
    $email=$this->input->post("email");
    $mob=$this->input->post("phone");
    $password=base64_encode($this->input->post("pwd"));
    $pincode=$this->input->post("pincode");
    $gender=$this->input->post("gender");
    $stud_id=$this->input->post("stud_id");
   // $age=$this->input->post("age");
// $identity=$this->input->post("identity");
   // $qualification=$this->input->post("qualification");
    $course=$this->input->post("course");
    $hobies=$this->input->post("hobies");
    $city=$this->input->post("city");
    $date=$this->input->post("date");
    $state=$this->input->post("state");
    $country=$this->input->post("country");
    $address=$this->input->post("address");
      $enrolled=$this->input->post("enrolled");
    $subject=$this->input->post("subject");
     $join_date=$this->input->post("join_date");
    
    
        $config=[
                'upload_path'=>"./uploads",
                'allowed_types'=>'*'
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
         "name"        => $fnm,
      "join_date"        => $join_date,
            "email"       => $email,
            "phone"   => $mob,
            "password"    => $password,
              "pin_code"        => $pincode,
               "gender"        => $gender,
            "stud_id"        => $stud_id,
            "course"       => $course,
            "hobies"   => $hobies,
            "city"    => $city,
              "dob"        => $date,
               "state"        => $state,
            "country"        => $country,
            "address"       => $address,
            
             "profile_img" => $img_path,
              "enrolled"       => $enrolled,
              "subject"       => $subject,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"student");
    if($user_updated){
        $data1['success']  = 'Student Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/student");
  }
  
     public function savestudentapp(){

    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
         $stud_id=$this->input->post("stud_id");
       $stud=$this->input->post("studa_id");
 

    $date=$this->input->post("date");
 
    
    
        $data=array(
            "s_name"        => $fnm,
              "studa_id"        => $stud,
              "sa_name"        => $stud_id,
              "date"        => $date,
  
           
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("stud_appointment",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Course Enrolled Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/student");
  
    
   }
   
        public function updatestudentapp(){
            $id=$this->input->post("uid");
    $fnm=$this->input->post("name");
    
       $stud=$this->input->post("studc_id");
 

    $date=$this->input->post("date");

    

     
    $data=array(
            "name"        => $fnm,
              "studa_id"        => $stud,
        
              "date"        => $date,

        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"stud_appointment");
    if($user_updated){
        $data1['success']  = 'Appointment Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/student");
  }
  
    

   public function saveenrolled(){

    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    
       $stud=$this->input->post("studc_id");
 

    $date=$this->input->post("date");
 
    
    
        $data=array(
            "name"        => $fnm,
              "studc_id"        => $stud,
        
              "date"        => $date,
  
           
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("enrolled",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Course Enrolled Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/student");
  
    
   }
   
   
     public function updateenrolled(){
            $id=$this->input->post("uid");
     $fnm=$this->input->post("name");
  $stud_id=$this->input->post("stud_id");
    $date=$this->input->post("date");

    

     
        $data=array(
         "name"        => $fnm,
 "studc_id"        => $stud_id,
              "date"        => $date,

        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"enrolled");
    if($user_updated){
        $data1['success']  = 'Course Enrolled Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/student");
  }
  
       public function savelevel(){
 
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("level");


   // $date = date("Y-m-d");
 
       
        $data=array(
            "level"        => $fnm,
      
         
          
    
            );
        $user_id = $this->Usermodel->insert_table("level",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'Level Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/level");
  }
    public function updatelevel(){
     $id=$this->input->post("uid");
    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("level");

     
        $data=array(
          "level"        => $fnm,
        
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"level");
    if($user_updated){
        $data1['success']  = 'Level Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/level");
  }
   public function add_customer(){

    // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
  
    $email=$this->input->post("qualification");
    $mob=$this->input->post("email");

    $gender=$this->input->post("gender");

    $course=$this->input->post("cus_type");
    $hobies=$this->input->post("phone");
    $city=$this->input->post("xst");
    $date=$this->input->post("date");

    $address=$this->input->post("address");
    
    
    
        $config=[
                'upload_path'=>"./uploads",
                'allowed_types'=>'*'
            ];
            
            
          
            
        $this->load->library('upload',$config);
       
        if($this->upload->do_upload("profile_img")){
            
            //   echo $address;
            // die;
            
            $uploaddata=$this->upload->data();
            // var_dump($uploaddata);die;
            $img_path="uploads/".$uploaddata['raw_name'].$uploaddata['file_ext'];
        }else{
            // $img_path="uploads/a4.jpg";
            $img_path="assets/img/blankdp.png";
        }
        
        
        
        // $config=[
        //         'upload_path'=>"./uploads",
        //         'allowed_types'=>'*'
        //     ];
        // $this->load->library('upload',$config);
        // if($this->upload->do_upload("profile_im")){
            
      
            
            
        //     $uploaddata=$this->upload->data();
        //     // var_dump($uploaddata);die;
        //     $img_path="uploads/".$uploaddata['raw_name'].$uploaddata['file_ext'];
        // }else{
        //     // $img_path="uploads/a4.jpg";
        //     $img_path="assets/img/blankdp.png";
        // }
     
    
    
        $data=array(
            "name"        => $fnm,
      
            "qualification"       => $email,
            "email"   => $mob,
     
               "gender"        => $gender,
    
            "cus_type"       => $course,
            "phone"   => $hobies,
            "x_st"    => $city,
              "date"        => $date,

            "address"       => $address,
              "profile" => $img_path,
           
         
          
    
            );
            
            // print_r($data);
            // die;
            
          //  $this->session->set_userdata('sid_no',$id);
        $user_id = $this->Usermodel->insert_table("teacher",$data);
        // $work_data = array(
        //     'user_id'    => $user_id,
        //     'total_sets' => 0
        //     );
        // $work_id = $this->Usermodel->insert_table("work_history",$work_data);
        if($user_id){
            $data1['success']  = 'teacher Added Successfully!';
        }else{
            $data1['error']  = 'Error in Adding User!';
        }
    
    redirect("home/teacher");
  
    
   }
   
   
     public function updateteacher(){
         $id=$this->input->post("uid");
      // echo "<pre>";var_dump($this->input->post());die;
    $fnm=$this->input->post("name");
    //$lnm=$this->input->post("lnm");
    $email=$this->input->post("qualification");
    $mob=$this->input->post("email");
   // $password=base64_encode($this->input->post("pwd"));
   // $pincode=$this->input->post("address");
    $gender=$this->input->post("gender");
   // $stud_id=$this->input->post("stud_id");
   // $age=$this->input->post("age");
// $identity=$this->input->post("identity");
   // $qualification=$this->input->post("qualification");
    $course=$this->input->post("cus_type");
    $hobies=$this->input->post("phone");
    $city=$this->input->post("xst");
    $date=$this->input->post("date");
   // $state=$this->input->post("state");
   // $country=$this->input->post("country");
    $address=$this->input->post("address");
    
        $config=[
                'upload_path'=>"./uploads",
                'allowed_types'=>'*'
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
     "name"        => $fnm,
          //  "date"        => $date,
            "qualification"       => $email,
            "email"   => $mob,
         //   "password"    => $password,
            //  "pin_code"        => $pincode,
               "gender"        => $gender,
          //  "date"        => $stud_id,
            "cus_type"       => $course,
            "phone"   => $hobies,
            "x_st"    => $city,
              "date"        => $date,
              // "state"        => $state,
          //  "date"        => $country,
            "address"       => $address,
                  "profile" => $img_path,
        );
    $where=array(
        'id' => $id
        );
    $user_updated=$this->Usermodel->update_query($data,$where,"teacher");
    if($user_updated){
        $data1['success']  = 'Teacher Updated Successfully!';
    }else{
        $data1['error']  = 'Error in Updating User!';
    }
    redirect("home/teacher");
  }
  
  
                public function createXLSaccomodation() {
        $fileName = 'accomodation.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('schedule')->result_array();

  
// print_r($data);
// die;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Student Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
         $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Join Date');
         $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'End Date');

       
       ///  $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');       
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['s_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['dept']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['email']);
              $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['gender']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['j_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['e_date']);
    
           
            // $objPHPExcel->getActiveSheet()->S