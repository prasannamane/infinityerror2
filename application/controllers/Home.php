<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller 
    {
        function __construct() 
        {
            parent::__construct();
      		$this->load->helper('url');
          	$this->load->library('session');
            $this->load->model('HomeModel');          
            //$this->session->set_userdata('last_page', current_url());
      	}

          //Created Feb 28, 2021
        public function contact() {

            $data['msg'] = "";
            $data['page_name'] = "Contact";

            $table_name = "contact";
            if($this->input->post('name') != "")
            {
                $array_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),
                    'message' => $this->input->post('message')
                );

                $result = $this->HomeModel->insert_data($table_name, $array_data);

                if($result) 
                {
                $this->session->set_flashdata('success','You have successfully sent message '); 
                }
                else
                {
                    $this->session->set_flashdata('danger','Something went wrong');
                }
            }

            $this->load->view('my/template/head', $data);
            $this->load->view('my/template/startbody');
            $this->load->view('my/template/top');
            $this->load->view('my/template/header');
            $this->load->view('my/template/bread');
            $this->load->view('my/pages/contact');
            $this->load->view('my/template/footer');
            $this->load->view('my/template/foot');

        }
      	
        public function dislike()
      	{
      	    $id = $this->input->post('id');
      	    $userdata = $this->session->userdata('userdata')[0];
      	    
      	    $cond = array(
      	            'reply_id' => $id,
      	            'user_id' => $userdata['id']
            );
      	    $tbl = "like_deslike";      
      	    $checkbeforeinset = $this->HomeModel->select_cond_data($tbl, $cond);
      	    
      	    if(empty($checkbeforeinset))
      	    {
          	    $likeinsert = array(
                   'reply_id' => $id,
      	            'user_id' => $userdata['id']
                );
                $tbl = "like_deslike";      
      	        $result = $this->HomeModel->insert_data($tbl, $likeinsert);
          	}
          	
      	    $cond = array(
      	            'reply_id' => $id,
      	            'user_id' => $userdata['id'],
      	            'dislike' => 1
            );
      	        
      	    $tbl = "like_deslike";      
      	    $result = $this->HomeModel->select_cond_data($tbl, $cond);
            
            if(empty($result))
            {
                $cond = array(
      	            'reply_id' => $id,
      	            'user_id' => $userdata['id'],
      	            'like_' => 1
                );
      	        
      	        $tbl = "like_deslike";      
      	        $result_dis = $this->HomeModel->select_cond_data($tbl, $cond);
      	        
      	        if(!empty($result_dis))
                {
                    $like = array(
                       'reply_id' => $id,
      	                'user_id' => $userdata['id']
                    );
                    $tbl = "like_deslike";      
      	            $result = $this->HomeModel->like_d($tbl, $like);
      	            
      	            $like = array(
                       'id' => $id
      	            );
                    $tbl = "reply";      
      	            $result = $this->HomeModel->like_d($tbl, $like);
                }
                
                
                $like = array(
                       'reply_id' => $id,
      	                'user_id' => $userdata['id']
                    );
                    $tbl = "like_deslike";      
      	            $result = $this->HomeModel->dislike($tbl, $like);
      	            
      	            $like = array(
                       'id' => $id
      	            );
                    $tbl = "reply";      
      	            $result = $this->HomeModel->dislike($tbl, $like);
            }
            
            $cond = array(
      	        'id' => $id,
      	        
      	     );
      	        
      	    $tbl = "reply";      
      	    $result = $this->HomeModel->select_cond_data($tbl, $cond);
      	    
      	    //prin_r( $result);

      	     //   echo $result[0]['dislike'];
      	      echo json_encode(array("a" => $result[0]['like_'], "b" => $result[0]['dislike'])); 
      	    
      	}

      	
/*      	public function dislike()
      	{
            $id = $this->input->post('id');
      	    $userdata = $this->session->userdata('userdata')[0]; 
      	    $like = array(
                'id' =>  $id
                );
            $tbl = "reply";      
      	    $result = $this->HomeModel->dislike($tbl, $like);
      	    return $result;
      	}*/
      	
      	public function like()
      	{
      	    $id = $this->input->post('id');
      	    $userdata = $this->session->userdata('userdata')[0];
      	    
      	          	    $cond = array(
      	            'reply_id' => $id,
      	            'user_id' => $userdata['id']
            );
      	    $tbl = "like_deslike";      
      	    $checkbeforeinset = $this->HomeModel->select_cond_data($tbl, $cond);
      	    
      	    if(empty($checkbeforeinset))
      	    {
          	    $likeinsert = array(
                   'reply_id' => $id,
      	            'user_id' => $userdata['id']
                );
                $tbl = "like_deslike";      
      	        $result = $this->HomeModel->insert_data($tbl, $likeinsert);
      	    }
      	    $cond = array(
      	            'reply_id' => $id,
      	            'user_id' => $userdata['id'],
      	            'like_' => 1
            );
      	        
      	    $tbl = "like_deslike";      
      	    $result = $this->HomeModel->select_cond_data($tbl, $cond);
            
            //print_r($this->db->last_query());
            //print_r($result);
            
            if(empty($result))
            {
                $cond = array(
      	            'reply_id' => $id,
      	            'user_id' => $userdata['id'],
      	            'dislike' => 1
                );
      	        
      	        $tbl = "like_deslike";      
      	        $result_dis = $this->HomeModel->select_cond_data($tbl, $cond);
      	        
      	        if(!empty($result_dis))
                {
                    $like = array(
                       'reply_id' => $id,
      	                'user_id' => $userdata['id']
                    );
                    $tbl = "like_deslike";      
      	            $result = $this->HomeModel->disliked($tbl, $like);
      	            
      	            $like = array(
                       'id' => $id
      	            );
                    $tbl = "reply";      
      	            $result = $this->HomeModel->disliked($tbl, $like);
                }
                
                
                $like = array(
                       'reply_id' => $id,
      	                'user_id' => $userdata['id']
                    );
                    $tbl = "like_deslike";      
      	            $result = $this->HomeModel->like_($tbl, $like);
      	            
      	            $like = array(
                       'id' => $id
      	            );
                    $tbl = "reply";      
      	            $result = $this->HomeModel->like_($tbl, $like);
            }
            
            $cond = array(
      	        'id' => $id,
      	     );
      	        
      	    $tbl = "reply";      
      	    $result = $this->HomeModel->select_cond_data($tbl, $cond);
      	    
      	    //prin_r( $result);

      	        //print count($result);
      	    //echo $result[0]['like_'];
      	    echo json_encode(array("a" => $result[0]['like_'], "b" => $result[0]['dislike'])); 
      	}
      	
      	public function questions($id = 0)
      	{
            $img_path   = "";      	     
      	    $cond       = array(
      	                    'id' => $id
                            );
      	    $tbl        = "quetions";      
      	    $res = $this->HomeModel->view_($tbl, $cond);
      	    if($this->input->post('reply'))
      	    {
      	        $config=[
                    'upload_path'=>"myassets/video/",
                    'allowed_types'=>'*'
                ];
                $this->load->library('upload',$config);
                if($this->upload->do_upload("attachment"))
                {
                    $uploaddata = $this->upload->data();
                    $img_path = "myassets/video/".$uploaddata['raw_name'].$uploaddata['file_ext'];
                }
                
                $userdata = $this->session->userdata('userdata')[0];
                $askquestion = array(
                    'user_id' =>  $userdata['id'],
                    'video' => $img_path,
                    'description' => $this->input->post('description'),
                    'quetions_id' => $id 
                    );
                
                $tbl = "reply";      
      	        $result = $this->HomeModel->insert_data($tbl, $askquestion);
                
                if($result) 
      	        {
	                $this->session->set_flashdata('success','You have successfully uploaded answer '); 
	            }
	            else
	            {
	                $this->session->set_flashdata('danger','Something went wrong');
	            }
      	    }
      	    
      	    $data['page_name'] = 'Questions';
      	    $cond = array(
      	        'id' => $id
                );
      	        
      	    $tbl = "quetions";      
      	    $data['details'] = $this->HomeModel->select_cond_data($tbl, $cond);
      	    
      	    $cond = array(
      	        'quetions_id' => $id
                );
      	    $tbl = "reply";      
      	    $data['reply'] = $this->HomeModel->select_cond_data($tbl, $cond);
      	    $data['id'] = $id;
      	    
            $this->load->view('my/template/head', $data);
      	    $this->load->view('my/template/startbody');
      	    $this->load->view('my/template/top');
      	    $this->load->view('my/template/header');
      	    $this->load->view('my/template/bread');
            $this->load->view('my/pages/questions');
            $this->load->view('my/template/footer');
            $this->load->view('my/template/foot');
      	}
      	
      	public function askquestion()
      	{
      	    //echo $this->session->userdata('userdata');
      	    //die;
      	    //Array ( [title] => [category] => -1 [description] => [form_type] => add_question [post_type] => add_question [askquestion] => Publish Your Question )
      	    if($this->input->post('askquestion'))
      	    {
      	        $config=[
                    'upload_path'=>"myassets/video/",
                    'allowed_types'=>'*'
                ];
                $this->load->library('upload',$config);
                if($this->upload->do_upload("attachment"))
                {
                    $uploaddata = $this->upload->data();
                    $img_path = "myassets/video/".$uploaddata['raw_name'].$uploaddata['file_ext'];
                }
                
                
                $userdata = $this->session->userdata('userdata')[0];
                //print_r($userdata);
                $askquestion = array(
                    'title' => $this->input->post('title'),
                    'user_id' =>  $userdata['id'],
                    'video' => $img_path,
                    'description' => $this->input->post('description')
                    
                    );
                
                $tbl = "quetions";      
      	        $result = $this->HomeModel->insert_data($tbl, $askquestion);
                
                if($result) 
      	        {
	                $this->session->set_flashdata('success','You have successfully uploaded quetion '); 
	            }
	            else
	            {
	                $this->session->set_flashdata('danger','Something went wrong');
	            }
      	        
      	    }
      	    
      	    $data['page_name'] = 'Ask A Question';
            
            $this->load->view('my/template/head', $data);
      	    $this->load->view('my/template/startbody');
      	    $this->load->view('my/template/top');
      	    $this->load->view('my/template/header');
      	    $this->load->view('my/template/bread');
            $this->load->view('my/pages/askquestion');
            $this->load->view('my/template/footer');
            $this->load->view('my/template/foot');
      	}
      	
        public function signin()
      	{
      	    
      	    //print_r($this->session->userdata('last_page'));
      	    if($this->session->userdata('userdata') == '') 
      	    { 
      	        //take them back to signin 
      	    }
      	    else
      	    {
      	        redirect(base_url('home'));
      	    }
      	    
      	    if($this->input->post('register'))
      	    {
      	        $name = $this->input->post('name');
      	        $email = $this->input->post('email');
      	        $pwd = $this->input->post('pwd');
      	        $checkme = $this->input->post('checkme');
      	        
      	        $arraydata = array(
      	            'name' => $name,
      	            'email' => $email,
      	            'pwd' => $pwd,
      	            'checkme' => $checkme
      	            );
      	        
      	        //print_r( $arraydata);
      	        
      	        $tbl = "signup";      
      	        $result = $this->HomeModel->insert_data($tbl, $arraydata);
      	        
      	        if($result) 
      	        {
	                $this->session->set_flashdata('success','You have successfully registered '); 
	            }
	            else
	            {
	                $this->session->set_flashdata('danger','Something went wrong');
	            }
      	    }
      	        
      	    
      	    
      	    if($this->input->post('login'))
      	    {
      	        $email = $this->input->post('email');
      	        $pwd = $this->input->post('pwd');
      	        
      	        $cond = array(
      	            'email' => $email,
      	            'pwd' => $pwd
                );
      	        
      	        $tbl = "signup";      
      	        $result = $this->HomeModel->select_cond_data($tbl, $cond);
      	        
      	        if(!empty($result)) 
      	        {
      	             $this->session->set_userdata('userdata', $result);
	                $this->session->set_flashdata('success','You have successfully login ');
	                  redirect(base_url('home')); 
	            }
	            else
	            {
	                $this->session->set_flashdata('danger','Something went wrong');
	            }
            }
            
      	    $data['page_name'] = 'Signin';
      	    $this->load->view('my/template/head', $data);
      	    $this->load->view('my/template/startbody');
      	    $this->load->view('my/template/top');
      	    $this->load->view('my/template/header');
      	    $this->load->view('my/template/bread');
            $this->load->view('my/pages/sign-in');
            $this->load->view('my/template/footer');
            $this->load->view('my/template/foot');
      	}
      	
        //update Feb 28, 2021
      	public function index()
      	{
      	    $tbl = "quetions";

            $search = $this->input->post('s');
            
            if($search){
                $quetions = $this->HomeModel->quetions_search($tbl, $search);
            }
            else
            {
                $quetions = $this->HomeModel->quetions($tbl);
            }        
      	    
            $data['page_name'] = 'Home';
      	    $data['quetions'] = $quetions;
            
            //print_r($data['quetions']);
            
      	    $this->load->view('my/template/head', $data);
      	    $this->load->view('my/template/startbody');
      	    $this->load->view('my/template/top');
      	    $this->load->view('my/template/header');
      	    //$this->load->view('my/template/left');
            $this->load->view('my/pages/landing');
            $this->load->view('my/pages/home');
            //$this->load->view('my/template/right');
            $this->load->view('my/template/footer');
            $this->load->view('my/template/foot');
      	}
      	
      	public function forgotpassword()
      	{
      	    $data['page_name'] = 'Forgot Password';
            
            
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
      	    $this->load->view('pages/forgotpassword');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	
      	    
      	}
      	
      	public function tags()
      	{
      	    $data['page_name'] = 'Tags';
            
            
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
      	    $this->load->view('template/left');
            $this->load->view('pages/tags');
            $this->load->view('template/right');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	}
      	
      	public function askquestion1()
      	{
      	    $data['page_name'] = 'Ask A Question';
            
            
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
      	    $this->load->view('template/left');
            $this->load->view('pages/askquestion');
            $this->load->view('template/right');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	}
      	    
      	public function signout() 
      	{
      	    $this->session->unset_userdata('userdata');
            redirect(base_url('home'));
        }
      	
      	public function questions1()
      	{   
            $data['page_name'] = 'Questions';
            
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
            $this->load->view('template/left');
            $this->load->view('pages/questions');
            $this->load->view('template/right');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	}
      	
      	public function index2()
      	{
      	    $tbl = "quetions";
      	    $quetions = $this->HomeModel->quetions($tbl);
            $data['page_name'] = 'Home';
      	    $data['quetions'] = $quetions;
            
            //print_r($data['quetions']);
            
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
      	    $this->load->view('template/left');
            $this->load->view('pages/index');
            $this->load->view('template/right');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	}
      	
      	public function signup()
      	{
      	    if($this->session->userdata('userdata') == '') 
      	    { 
      	        //take them back to signin 
      	    }
      	    else
      	    {
      	        redirect(base_url('home'));
      	    }
      	    
      	    if($this->input->post('sumbit'))
      	    {
      	        $name = $this->input->post('name');
      	        $email = $this->input->post('email');
      	        $pwd = $this->input->post('pwd');
      	        $checkme = $this->input->post('checkme');
      	        
      	        $arraydata = array(
      	            'name' => $name,
      	            'email' => $email,
      	            'pwd' => $pwd,
      	            'checkme' => $checkme
      	            );
      	        
      	        $tbl = "signup";      
      	        $result = $this->HomeModel->insert_data($tbl, $arraydata);
      	        
      	        if($result) 
      	        {
	                $this->session->set_flashdata('success','You have successfully registered '); 
	            }
	            else
	            {
	                $this->session->set_flashdata('danger','Something went wrong');
	            }
            }
      	    
      	    $data['page_name'] = 'Signup';
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
            $this->load->view('pages/signup');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	
      	    
      	}
      	
      	public function signin1()
      	{
      	    if($this->session->userdata('userdata') == '') 
      	    { 
      	        //take them back to signin 
      	    }
      	    else
      	    {
      	        redirect(base_url('home'));
      	    }
      	    
      	    if($this->input->post('login'))
      	    {
      	        $email = $this->input->post('email');
      	        $pwd = $this->input->post('password');
      	        
      	        $cond = array(
      	            'email' => $email,
      	            'pwd' => $pwd
                );
      	        
      	        $tbl = "signup";      
      	        $result = $this->HomeModel->select_cond_data($tbl, $cond);
      	        
      	        $this->session->set_userdata('userdata', $result);
      	        
      	        
      	        
      	        if($result) 
      	        {
	                $this->session->set_flashdata('success','You have successfully login ');
	                  redirect(base_url('home')); 
	            }
	            else
	            {
	                $this->session->set_flashdata('danger','Something went wrong');
	            }
            }
            
      	    $data['page_name'] = 'Signin';
      	    $this->load->view('template/head', $data);
      	    $this->load->view('template/header');
            $this->load->view('pages/signin');
            $this->load->view('template/footer');
            $this->load->view('template/foot');
      	}

        public function correction()
        {
            if($this->input->post('Message') != '')
            {
                $Message = $this->input->post('Message');

                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';         // use this setting

                $this->email->initialize($config);
                $this->load->config('email');
                $this->load->library('email');
            
                $from = "paziuk@viyra.com";
                $to = "davidpaziuk@gmail.com, prasannam.bwd@gmail.com";
                $subject =" Customer Correction";
               
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($Message);
                $this->email->send();

                $data['msg'] = "Message sent successfully";
            }
            else
            {
                $data['msg'] = "Somethng went wrong";
            }
        
            $this->load->view('template/header', $data);
            $this->load->view('my/correction');
        }


        public function search()
        {
            $search = $this->input->post('search');

            if($search == 'paziuk' || $search == 'Paziuk')
            {
                redirect('/home/source', 'refresh');
            }

            $data['table'] = $search;
            $this->load->view('template/header', $data);
            $this->load->view('my/table');
        }




        

        public function parent2($table)
        {
            $this->db->select('category');
            $this->db->from('subtabs');
            $this->db->where('id', $table);
            
            $query = $this->db->get();
            $data =  $query->result_array(); 

            foreach ($data as $row) 
            {
                $table = $row['category']; 
            }           
            //print_r($table);
            //echo "4<hr>";
            return $table;
        }

        public function parent3($table)
        {
            $this->db->select('my_parent');
            $this->db->from('subtabs');
            $this->db->where('id', $table);
            $query = $this->db->get();
            $data =  $query->result_array(); 

            if($data)
            {
                foreach ($data as $row) 
                {
                    if($row['my_parent'] == '')
                    {
                        return $table;   
                    }
                    $table = $this->parent3($row['my_parent']);
                    //print_r($row['my_parent']);
                }
            }
            else
            {
                return $table;
            }
            //print_r($table);
            //echo "2<hr>";
            return $table;
        }

        public function parent($table)
        {
            $this->db->select('my_parent');
            $this->db->from('subtabs');
            $this->db->where('name', $table);
            
            $query = $this->db->get();
            $data =  $query->result_array(); 

            if($data)
            {
                foreach ($data as $row) 
                {
                    $table = $this->parent3($row['my_parent']);
                }
            }
            else
            {
                return $table;
            }
            //print_r($table);
            //echo "2<hr>";
            return $table;
        }

        public function aboveone($table)
        {
            $this->db->select('my_parent');
            $this->db->from('subtabs');
            $this->db->where('name', $table);
            
            $query = $this->db->get();
            $data =  $query->result_array(); 

            if($data)
            {
                foreach ($data as $row) 
                {
                    $table = ($row['my_parent']);
                }
            }
            else
            {
                return $table;
            }
//            print_r($table);
  //          echo "2<hr>";
            return $table;
        }




        public function table($name)
        {
            $name = str_replace("-a","(",$name);
            $name = str_replace("-b",")",$name);
            $data['table'] = str_replace("_"," ",$name);

            //print_r($data['table']);
            //echo "1<hr>";
            $data['parent2'] = $this->parent($data['table']);
                        
            //print_r($data['parent2']);
            //echo "3<hr>";
            $data['parent'] = $this->parent2($data['parent2']);

            $data['aboveone'] = $this->parent2($data['aboveone']);

            
            

            $this->load->view('template/header', $data);
            $this->load->view('my/table');
        }

        public function login_new() 
        {

        	if($this->input->post('email') != '') 
        	{
        		$pass = $this->input->post('pass');
            	$email = $this->input->post('email');

            $arrayName = array(
              'email' => $email,
              'password' => $pass
              
            );

            $que = $this->db->query("select * from student where email='".$email."' and password='".$pass."' and user_status = 'Permission Granted' ");
            $row = $que->num_rows();
          
          if($row > 0) {

            $result = $que->result_array();
              $this->session->set_userdata('id', $result[0]['id']);
              $this->session->set_userdata('name', $result[0]['name']);

              $data['msg'] = "login successfully";
              redirect('/home/source');
            }
            else {
              $data['msg'] = "Please take permision OR  Email or password wrong";
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('my/welcome');
        //$this->load->view('my/footer');
        }

        public function welcome() {

            $data['hide'] = "1";

            $this->load->view('template/header', $data);
            $this->load->view('my/welcome', $data);
            //$this->load->view('my/footer');

        }

        public function source() {

           // $this->load->view('my/header', $data);
           $this->load->view('template/header', $data);
            $this->load->view('my/source', $data);
            //$this->load->view('my/footer');

        }



        public function register_new() {

          $data['msg'] = '';

          if($this->input->post('firstname') != '')
          {

            $email = $this->input->post('email');

            $que = $this->db->query("select * from student where email='".$email."'");
            $row = $que->num_rows();

            if($row > 0)
            {
              $data['msg'] = "Email Exist";

            }
            else
            {
              $firstname = $this->input->post('firstname');
              $lastname = $this->input->post('lastname');
              $Mobile = '1';//$this->input->post('Mobile');
              $pass = $this->input->post('pass');
              $message1 = "Help me identify how you fit by naming your parents and grand parents, if possible and your location";
              $message = $this->input->post('message');

              $arrayName = array('name' => $firstname." ".$lastname,
                'email' => $email,
                'phone' => $Mobile,
                'password' => $pass
              );
              $this->db->insert('student',$arrayName);
              
              //print_r($this->db->last_query());
              $insert_id = $this->db->insert_id();

              if($insert_id)
              {

                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';         // use this setting

                $this->email->initialize($config);
                $this->load->config('email');
        	       $this->load->library('email');
        	
        	     $from = "paziuk@viyra.com";
        	     $to = "davidpaziuk@gmail.com, prasannam.bwd@gmail.com";
        	     $subject ="New Customer Registered";
               
               $granted = base_url('Panel/granted/').$insert_id;
               $information = base_url('Panel/information/').$insert_id;
               $denied = base_url('Panel/denied/').$insert_id;

        	     $message = "<a href='".$granted."'>Reply change to Permission Granted</a>
               <br><a href='".$information."'>Reply all change to Need more information</a>
               <br><a href='".$denied."'>Forward change to Permission denied contact administrator</a>
               <br>New Customer Registered, Customer information, 
               <br>Name: ".$firstname." ".$lastname.", 
               <br>Email Address: ".$email.", 
                
               <br>Message ".$message1." - ".$message;

        	     $this->email->set_newline("\r\n");
        	     $this->email->from($from);
        	     $this->email->to($to);
        	     $this->email->subject($subject);
        	     $this->email->message($message);

        	     $this->email->send();

               $data['msg'] = "Register successfully";
              }else{
                $data['msg'] = "Somethng went wrong";
            }
          }
          }
          $this->load->view('template/header', $data);
          $this->load->view('my/register_new', $data);
        }

        public function forget_pass() {

            $this->load->view('template/header', $data);
            $this->load->view('my/forget_pass', $data);
            //$this->load->view('my/footer');

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

/*            print_r($this->db->last_query());

print_r($report);
print_r($report[0]['password']);
die;*/
        
        $from = "driving@viyra.com";
        $to = $email;
        $subject ="Forgot password";
        $message = "Your forgot password is : ".$report[0]['password'];

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

        redirect('/home/login_new', 'refresh');
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

  			

  public function home(){

    $this->load->view('my/header');
    $this->load->view('my/index');
    $this->load->view('my/footer');
  }



  public function index1()
  {
    if(!isset($this->session->balnxr_admin))
    {
      redirect('/','refresh');
    }
    $data['total_teacher'] = $this->Usermodel->countTotalTeacher();
      $data['total_student'] = $this->Usermodel->countTotalStudent(); 
          $data['total_level'] = $this->Usermodel->countTotalLevel(); 
              $data['total_lesson'] = $this->Usermodel->countTotalLesson();
                  $data['total_subject'] = $this->Usermodel->countTotalSubject();
                      $data['total_course'] = $this->Usermodel->countTotalCourse();
    //                     $monthQuery =  $this->db->query("SELECT COUNT(id) as count,MONTHNAME(date) as month_name FROM teacher WHERE YEAR(date) = '" . date('Y') . "'
    //   GROUP BY YEAR(date),MONTH(date)"); 
      
    //   $yearQuery =  $this->db->query("SELECT COUNT(id) as count,YEAR(date) as year FROM teacher
    //   GROUP BY YEAR(date)"); 

    //   $data['month_wise'] = $monthQuery->result();
      
    // //   print_r( $data['month_wise']);
    // //   die;
      
      
    //   $data['year_wise'] = $yearQuery->result();
          $dayQuery =  $this->db->query("SELECT COUNT(id) as count,DAY(join_date) as day_date FROM student WHERE MONTH(join_date) = '" . date('m') . "'
        AND YEAR(join_date) = '" . date('Y') . "'
      GROUP BY DAY(join_date)"); 
      
              $dayQuery_teacher =  $this->db->query("SELECT COUNT(id) as count,DAY(created_on) as day_date FROM teacher WHERE MONTH(created_on) = '" . date('m') . "'
        AND YEAR(created_on) = '" . date('Y') . "'
      GROUP BY DAY(created_on)"); 
    //     $dayQuery =  $this->db->query("SELECT  DAY(join_date) as y, COUNT(id) as a FROM student WHERE MONTH(join_date) = '" . date('m') . "'
    //     AND YEAR(join_date) = '" . date('Y') . "'
    //   GROUP BY DAY(join_date)"); 
    
    // $query ="SELECT * FROM student";
    // $result =  $query->result();
    // $chart_data='';
    // while($row = mysqli_fetch_array($result))
    // {
        
    // $chart_data.="{year:'".$row[year]."},";   
    
   // }
    
   //  $data['chart_data'] = substr ($char_data,0,-2);


      $data['day_wise'] = $dayQuery->result();
      
        $data['day_wise_teacher'] = $dayQuery_teacher->result();
       //$record = $dayQuery->result();
 
     // $data['chart_data'] = json_encode( $record );
    
   // $this->load->view('add_package');
    $this->load->view('header');
    $this->load->view('home',$data);
    $this->load->view('footer');
    //	$this->load->view('login');
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
    
           
            // $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['date']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['address']);
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
  
  
  
  
  
  
              public function createXLSnote() {
        $fileName = 'schedule.xlsx';  
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
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Log');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Notes');

       
       ///  $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');       
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['log']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['note']);
    
           
            // $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['date']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['address']);
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
  
  
  
            public function createXLSschedule() {
        $fileName = 'schedule.xlsx';  
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Schedule Date/time');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Level');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Shedule With (Teacher or Staff)');
       
       ///  $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');       
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['stud_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['dapt_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['ts_member']);
           
            // $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['date']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['address']);
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
          public function createXLSappoint() {
        $fileName = 'appoint.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('appoint')->result_array();

  
// print_r($data);
// die;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Student Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Student Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Teacher');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Course');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Subject');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Date');
    //    $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'City/State');
       
       ///  $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');       
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['studd_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['teacher']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['course']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['subject']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['date']);
           // $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['x_st']);
           
            // $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['date']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['address']);
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
  
        public function createXLSteacher() {
        $fileName = 'teacher.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('teacher')->result_array();

  
// print_r($data);
// die;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Qualification');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Teacher Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'City/State');
       
         $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date');
         $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');       
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['qualification']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['gender']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['cus_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['x_st']);
           
             $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['date']);
             $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['address']);
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }

   public function createXLSstudent() {
        $fileName = 'student.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('student')->result_array();

  




        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Qualification');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Teacher Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'City/State');
       
         $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date');
         $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Address');       
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['pin_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['gender']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['course']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['hobies']);
           
             $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['city']);
             $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['dob']);
                  $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['state']);
             $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['address']);
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
 public function createXLSlesson() {
        $fileName = 'lesson.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('lesson')->result_array();

  



        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Author');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Subscriber');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Subject');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Level');
     
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['author']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['suscriber']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['subject']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['level']);
       
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }

 public function createXLSsubject() {
        $fileName = 'subject.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('subject')->result_array();

  


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Author');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Level');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Category');

     
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['author']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['level']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['category']);
 
       
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
    
     public function createXLScourse() {
        $fileName = 'subject.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('course')->result_array();




        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Level');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Subject');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Lesson');
         $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Subscriber');

     
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['level']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['subject']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['lesson']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['subscription']);
 
       
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }

     public function createXLSlevel() {
        $fileName = 'level.xlsx';  
 // create file name
        // $fileName = 'mobile-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
           $data = $this->db->get('level')->result_array();




        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Level');


     
        // set Row       
        // set Row
        $rowCount = 2;

        foreach ($data as $val) 

// print_r($data);
// exit;

        {
           $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['level']);
      
 
       
     
            $rowCount++;
        }
 
     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
    
    
       public function create_teacher_query($name, $gender, $phone, $x_st, $email, $cus_type) 
  {
      $options = array(
        'name' => $name,
        'gender' => $gender,
        'phone' => $phone,
        'x_st' => $x_st,
        'email' => $email,
        'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM teacher" : "SELECT * FROM teacher WHERE $cond;";
  }

 public function search_by_filter_teacher()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
        $gender = trim($this->input->post("gender"));
           $phone = trim($this->input->post("phone"));
        $x_st = trim($this->input->post("x_st"));
        $email = trim($this->input->post("email"));
        $cus_type = $this->input->post("cus_type");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where name like '%$name%' or gender like '%$gender%' or phone like '%$phone%' or x_st like '%$x_st%' or email = $email or cus_type = $cus_type ;";

        $qr = $this->create_teacher_query($name, $gender, $phone, $x_st, $email, $cus_type);
        
         //echo $qr;die;
        
        $q1 = "select * from teacher ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                  <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>         
    
  <th>Id Number</th>
            <th>Name</th>

            <th>Phone</th>

            <th>Email</th>

           
           
              <th>Gender</th>
               <th>DOB</th>
              <th>State/Country</th>



            <th>Action</th>
            <!-- <th>Delete</th> -->

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['cus_type']."</td>
                                
                              
                                <td>".$user['name']."</td>
                                <td>".$user['phone']."</td>
                                <td>".$user['email']."</td>
                         
                                  <td>".$user['gender']."</td>
                                   <td>".$user['date']."</td>
                                <td>".$user['x_st']."</td>
                            
                                         <td>
                                        
                                    <form method='POST' action='".base_url("home/viewteacher")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editteacher")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletteacher")."'>
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
  
        public function create_accomodation_query($accomodation, $teac_name, $teac_id, $date) 
  {
      $options = array(
        'accomodation' => $accomodation,
        'teac_name' => $teac_name,
        'teac_id' => $teac_id,
        'date' => $date,
    
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
        return $noopt ? "SELECT * FROM teac_accomodation" : "SELECT * FROM teac_accomodation WHERE $cond;";
  }

 public function search_by_filter_accomodation()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $accomodation = trim($this->input->post("accomodation"));
        $teac_name = trim($this->input->post("teac_name"));
           $teac_id = trim($this->input->post("teac_id"));
        $date = trim($this->input->post("date"));
      
        
        $q2 = "where accomodation like '%$accomodation%' or teac_name like '%$teac_name%' or teac_id like '%$teac_id%' or date like '%$date%'";

        $qr = $this->create_accomodation_query($accomodation, $teac_name, $teac_id, $date);
        
         //echo $qr;die;
        
        $q1 = "select * from teac_accomodation ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                  <th> <input type='checkbox' id='multiple_delete_note' name='' class=''></th>         
         <th>Teacher Id</th>
                                                                      <th>Teacher Name</th>
                                                                       <th>Accomodation</th>
                                                                      
                                                                               <th>Date</th>
                                                                       
                                                                              <th>Action</th>

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['teac_id']."</td>
                                
                              
                                <td>".$user['teac_name']."</td>
                                <td>".$user['accomodation']."</td>
                                <td>".$user['date']."</td>
                         
                            
                            
                                         <td>
                                        
                                 
                                    
                                    <form method='POST' action='".base_url("home/edittaccomodation")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletaccomodation")."'>
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
  
  
  
        public function create_saccomodation_query($accomodation, $stud_name, $stud_id, $j_date) 
  {
      $options = array(
        'accomodation' => $accomodation,
        'stud_name' => $stud_name,
        'stud_id' => $stud_id,
        'j_date' => $j_date,
    
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
        return $noopt ? "SELECT * FROM accomodation" : "SELECT * FROM accomodation WHERE $cond;";
  }

 public function search_by_filter_saccomodation()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $accomodation = trim($this->input->post("accomodation"));
        $stud_name = trim($this->input->post("stud_name"));
           $stud_id = trim($this->input->post("stud_id"));
        $j_date = trim($this->input->post("j_date"));
      
        
        $q2 = "where accomodation like '%$accomodation%' or stud_name like '%$stud_name%' or stud_id like '%$stud_id%' or j_date like '%$j_date%'";

        $qr = $this->create_saccomodation_query($accomodation, $stud_name, $stud_id, $j_date);
        
         //echo $qr;die;
        
        $q1 = "select * from accomodation ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                  <th> <input type='checkbox' id='multiple_delete_note' name='' class=''></th>         
   
                                                                        <th>Student Id</th>
                                                                      <th>Student Name</th>
                                                                       <th>Accomodation</th>
                                                                      
                                                                               <th>Date</th>
                                                                       
                                                                              <th>Action</th>

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['stud_id']."</td>
                                
                              
                                <td>".$user['stud_name']."</td>
                                <td>".$user['accomodation']."</td>
                                <td>".$user['j_date']."</td>
                         
                            
                            
                                         <td>
                                        
                                 
                                    
                                    <form method='POST' action='".base_url("home/editsaccomodation")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletsaccomodation")."'>
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
  
  
      public function create_note_query($name, $note, $type, $log) 
  {
      $options = array(
        'name' => $name,
        'note' => $note,
        'type' => $type,
        'log' => $log,
      
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM note" : "SELECT * FROM note WHERE $cond;";
  }

 public function search_by_filter_note()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
        $note = trim($this->input->post("note"));
           $type = trim($this->input->post("type"));
        $log = trim($this->input->post("log"));
      
        
        $q2 = "where name like '%$name%' or note like '%$note%' or type like '%$type%' or log like '%$log%'";

        $qr = $this->create_note_query($name, $note, $type, $log);
        
         //echo $qr;die;
        
        $q1 = "select * from note ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
             <th> <input type='checkbox' id='multiple_delete_note' ></th>
                                <th>Id</th>
                        
                                <th>Name</th>
                                <th>Notes</th>
                                <th>Type</th>
                         
                                 <th>Log</th>
                               
                                <th>Action</th>

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['id']."</td>
                                
                              
                                <td>".$user['name']."</td>
                                <td>".$user['note']."</td>
                                <td>".$user['type']."</td>
                         
                                  <td>".$user['log']."</td>
                            
                            
                                         <td>
                                        
                                 <form method='POST' action='".base_url("home/viewnote")."'value='".$user['id']."'><i class='fa fa-eye'></i>  </form>
                                    
                                    <form method='POST' action='".base_url("home/editnote")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletnote")."'>
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
  
  
      public function create_ateacher_query($tra_id, $name_a, $date_a) 
  {
      $options = array(
        'tra_id' => $tra_id,
        'name_a' => $name_a,
        'date_a' => $date_a,
        // 'log' => $log,
      
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM appointment" : "SELECT * FROM appointment WHERE $cond;";
  }

 public function search_by_filter_ateacher()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $tra_id = trim($this->input->post("tra_id"));
        $name_a = trim($this->input->post("name_a"));
           $date_a = trim($this->input->post("date_a"));
        // $log = trim($this->input->post("log"));
      
        
        $q2 = "where tra_id like '%$tra_id%' or name_a like '%$name_a%' or date_a like '%$date_a%'";

        $qr = $this->create_ateacher_query($tra_id, $name_a, $date_a);
        
         //echo $qr;die;
        
        $q1 = "select * from appointment ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
       // print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover dataTables-example'>
                      <thead>
                        <tr>
             <th> <input type='checkbox' id='multiple_delete_note' ></th>
                                   <th>Teacher Name</th>
                                      <th>Name</th>
                                            <th>Schedule Date/time</th>
                                            
                                            <!--<th>Email</th>-->
                                            <!--<th>Mobile</th>-->
                                            <!--    <th>Department</th>-->
                                            <!--<th>Shedule With (Teacher or Staff)</th>-->
                                           
                                          

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['tra_id']."</td>
                                
                              
                                <td>".$user['name_a']."</td>
                                <td>".$user['date_a']."</td>
                           
                            
                            
                                  
                         
                              
                                
                                
                              </tr>  
                
                            "; 
            }
            $html = $html." </table>";
        }else{
          $html = $html. "<h3>No Data Available</h3>";  
        }
        echo $html;
        
  }
  
  
      public function create_sappointment_query($sa_name, $s_name, $date) 
  {
      $options = array(
        'sa_name' => $sa_name,
        's_name' => $s_name,
        'date' => $date,
        // 'log' => $log,
      
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM stud_appointment" : "SELECT * FROM stud_appointment WHERE $cond;";
  }

 public function search_by_filter_sappointment()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $sa_name = trim($this->input->post("sa_name"));
        $s_name = trim($this->input->post("s_name"));
           $date = trim($this->input->post("date"));
        // $log = trim($this->input->post("log"));
      
        
        $q2 = "where sa_name like '%$sa_name%' or s_name like '%$s_name%' or date like '%$date%'";

        $qr = $this->create_sappointment_query($sa_name, $s_name, $date);
        
         //echo $qr;die;
        
        $q1 = "select * from stud_appointment ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
       // print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
             <th> <input type='checkbox' id='multiple_delete_note' ></th>
                                  <th>Student Name</th>
                                                                      <th>Name</th>
                                                                      <th>Date</th>
                                                                     
                                                                        

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['sa_name']."</td>
                                
                              
                                <td>".$user['s_name']."</td>
                                <td>".$user['date']."</td>
                           
                            
                            
                                
                         
                              
                                
                                
                              </tr>  
                
                            "; 
            }
            $html = $html." </table>";
        }else{
          $html = $html. "<h3>No Data Available</h3>";  
        }
        echo $html;
        
  }
  
     public function create_schedule_query($stud_id, $ts_member, $dapt_name, $level, $email, $mobile) 
  {
      $options = array(
        'stud_id' => $stud_id,
        'ts_member' => $ts_member,
        'dapt_name' => $dapt_name,
        'level' => $level,
        'email' => $email,
        'mobile' => $mobile,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM schedule" : "SELECT * FROM schedule WHERE $cond;";
  }

 public function search_by_filter_schedule()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $stud_id = trim($this->input->post("stud_id"));
        $ts_member = trim($this->input->post("ts_member"));
           $dapt_name = trim($this->input->post("dapt_name"));
        $level = trim($this->input->post("level"));
        $email = trim($this->input->post("email"));
        $mobile = $this->input->post("mobile");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where stud_id like '%$stud_id%' or ts_member like '%$ts_member%' or dapt_name like '%$dapt_name%' or level like '%$level%' or email = $email or mobile = $mobile ;";

        $qr = $this->create_schedule_query($stud_id, $ts_member, $dapt_name, $level, $email, $mobile);
        
         //echo $qr;die;
        
        $q1 = "select * from schedule ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                  <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>         
    
 <th>Student Id</th>
                                     
                                            <th>Schedule Date/time</th>
                                            <th>Level</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                                <th>Department</th>
                                            <th>Shedule With (Teacher or Staff)</th>
                                           
                                            <th>Action</th>
            <!-- <th>Delete</th> -->

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['stud_id']."</td>
                                
                              
                                <td>".$user['date']."</td>
                                <td>".$user['level']."</td>
                                <td>".$user['email']."</td>
                         
                                  <td>".$user['mobile']."</td>
                                   <td>".$user['dapt_name']."</td>
                                <td>".$user['ts_member']."</td>
                            
                                         <td>
                                        
                                    
                                    
                                    <form method='POST' action='".base_url("home/editschedule")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletschedule")."'>
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
  
       public function create_appoint_query($name, $stud_id, $teacher,$course,$subject) 
  {
      $options = array(
        'name' => $name,
        'stud_id' => $stud_id,
        'teacher' => $teacher,
        'course' => $course,
       // 'x_st' => $x_st,
        'subject' => $subject,
       // 'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM appoint" : "SELECT * FROM appoint WHERE $cond;";
  }

 public function search_by_filter_appoint()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
        $stud_id = trim($this->input->post("stud_id"));
           $teacher = trim($this->input->post("teacher"));
      //  $x_st = trim($this->input->post("x_st"));
        $course = trim($this->input->post("course"));
        $subject = $this->input->post("subject");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where name like '%$name%' or stud_id like '%$stud_id%' or teacher like '%$teacher%' or  course = %$course%  or  subject = %$subject%";

        $qr = $this->create_appoint_query($name, $stud_id, $teacher,$course,$subject);
        
         //echo $qr;die;
        
        $q1 = "select * from appoint ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                  <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>         
    
 <th>Student Id</th>
                                <th>Student Name</th>
                              
                                <th>Teacher</th>
                                <th>Course</th>
                                <th>Subject</th>
                                 <th>Date</th>
                                 <!--<th>City</th>-->
                                 <!--<th>Address</th>-->
                                <!--<th>Qualifiaction</th>-->
                                <!--<th>Public Identity Number</th>-->
                                <th>Action</th>
                                <!-- <th>Delete</th> -->

          </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['stud_id']."</td>
                                  <td>".$user['teacher']."</td>
                              
                                <td>".$user['name']."</td>
                                <td>".$user['course']."</td>
                                <td>".$user['subject']."</td>
                         
                              
                                   <td>".$user['date']."</td>
                              
                            
                                         <td>
                                        
                                    <form method='POST' action='".base_url("home/viewappoint")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editappoint")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletappont")."'>
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
  
   public function create_student_query($stud_id, $gender, $address, $name, $age, $qualification, $email, $mobile,$identity) 
  {
      $options = array(
        'stud_id' => $stud_id,
        'gender' => $gender,
        'address' => $address,
        'name' => $name,
        'age' => $age,
        'qualification' => $qualification,
        'email' => $email,
      'identity' => $identity,
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
        return $noopt ? "SELECT * FROM student" : "SELECT * FROM student WHERE $cond;";
  }

 public function search_by_filter_student()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $stud_id = trim($this->input->post("stud_id"));
        $gender = trim($this->input->post("gender"));
           $address = trim($this->input->post("address"));
        $name = trim($this->input->post("name"));
        $age = trim($this->input->post("age"));
        $qualification = $this->input->post("qualification");
        $email = $this->input->post("email");
        $mobile = trim($this->input->post("mobile"));
      $identity = $this->input->post("identity");
       // $balance = $this->input->post("email");
     //   $pincode = trim($this->input->post("mobile"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where stud_id like '%$stud_id%' or gender like '%$gender%' or address like '%$address%' or name like '%$name%' or age ='%$age%' or qualification =' %$qualification%' or email like '%$email%' or mobile like '%$mobile%' or identity = $identity";

        $qr = $this->create_student_query($stud_id, $gender, $address, $name, $age, $qualification,$email,$mobile,$identity);
        
         //echo $qr;die;
        
        $q1 = "select * from student ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                           <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>
     
                                <th>Student. Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Gender</th>
                                   <th>City</th>
                                      <th>Action</th>
                        </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['stud_id']."</td>
                                
                              
                                <td>".$user['name']."</td>
                                <td>".$user['email']."</td>
                                <td>".$user['phone']."</td>
                                <td>".$user['gender']."</td>
                                  <td>".$user['city']."</td>
                                 
                                  
                                         <td>
                                        
                                    <form method='POST' action='".base_url("home/viewstudent")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editstudent")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletstudent")."'>
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
  
       public function create_lesson_query($name, $author, $suscriber, $subject, $level) 
  {
      $options = array(
        'name' => $name,
        'author' => $author,
        'suscriber' => $suscriber,
        'subject' => $subject,
        'level' => $level,
        //'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM lesson" : "SELECT * FROM lesson WHERE $cond;";
  }

 public function search_by_filter_lesson()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
        $author = trim($this->input->post("author"));
           $suscriber = trim($this->input->post("suscriber"));
        $subject = trim($this->input->post("subject"));
        $level = trim($this->input->post("level"));
     //   $cus_type = $this->input->post("cus_type");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where name like '%$name%' or author like '%$author%' or suscriber like '%$suscriber%' or $subject like '%$subject%' or $level = %$level%;";

        $qr = $this->create_lesson_query($name, $author, $suscriber, $subject, $level);
        
         //echo $qr;die;
        
        $q1 = "select * from lesson ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                           <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>

                
                                <th>Name</th>
                                <th>Author</th>
                                <th>Subscribers</th>
                                <th>Subject</th>
                                 <th>Level </th>
                                 <!--<th>Type</th>-->
                                 <!--<th>Address</th>-->
                                <!--<th>Qualifiaction</th>-->
                                <!--<th>Public Identity Number</th>-->
                                <th>Action</th>
                                <!-- <th>Delete</th> -->
                              
                        </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['name']."</td>
                                
                              
                                <td>".$user['author']."</td>
                                <td>".$user['suscriber']."</td>
                                <td>".$user['subject']."</td>
                                <td>".$user['level']."</td>
                               
                                             <td>
                                        
                                    <form method='POST' action='".base_url("home/viewlesson")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editlesson")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletlesson")."'>
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
  
       public function create_subject_query($name, $author, $level,$category) 
  {
      $options = array(
        'name' => $name,
        'author' => $author,
       
      
        'level' => $level,
          'category' => $category,
        //'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM subject" : "SELECT * FROM subject WHERE $cond;";
  }

 public function search_by_filter_subject()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
        $author = trim($this->input->post("author"));
      
    
        $level = trim($this->input->post("level"));
            $category = trim($this->input->post("category"));
     //   $cus_type = $this->input->post("cus_type");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where name like '%$name%' or author like '%$author%' or level like '%$level%' or category like '%$category%'";

        $qr = $this->create_subject_query($name, $author,  $level,$category);
        
         //echo $qr;die;
        
        $q1 = "select * from subject ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                        
                             <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>
    
                                <th>Name</th>
                                <th>Author</th>
                                <th>Level</th>
                                <th>Category</th>
                             
                                <th>Action</th>
                                <!-- <th>Delete</th> -->
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                  <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                                <td>".$user['name']."</td>
                                
                              
                                <td>".$user['author']."</td>
                                <td>".$user['level']."</td>
                                <td>".$user['category']."</td>
                            
                                 
                                  
                                 <td>
                                        
                                    <form method='POST' action='".base_url("home/viewsubject")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editsubject")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletsubject")."'>
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
    public function create_course_query($name, $subject, $lesson,$level) 
  {
      $options = array(
        'name' => $name,
        'subject' => $subject,
       
       'lesson' => $lesson,
        'level' => $level,
         
        //'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM course" : "SELECT * FROM course WHERE $cond;";
  }

 public function search_by_filter_course()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
        $subject = trim($this->input->post("subject"));
        $lesson = trim($this->input->post("lesson"));
    
        $level = trim($this->input->post("level"));
          
     //   $cus_type = $this->input->post("cus_type");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where name like '%$name%' or subject like '%$subject%' or lesson like '%$lesson%' or level like '%$level%'";

        $qr = $this->create_course_query($name, $subject,  $lesson,$level);
        
         //echo $qr;die;
        
        $q1 = "select * from course ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                        
                           <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>

       
                                <th>Name</th>
                                <th>Subscription</th>
                                <th>Lesson</th>
                                <th>Level</th>
                                <th>subject</th>
                                
                                
                                
                                <th>Action</th>
                              
                        </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                                 <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                               
                                <td>".$user['name']."</td>
                                
                              
                                <td>".$user['subscription']."</td>
                                <td>".$user['lesson']."</td>
                                <td>".$user['level']."</td>
                                <td>".$user['subject']."</td>
                            
                                   <td>
                                        
                                    <form method='POST' action='".base_url("home/viewcourse")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editcourse")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletcourse")."'>
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

    public function create_level_query($level) 
  {
      $options = array(
       
        'level' => $level,
         
        //'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM level" : "SELECT * FROM level WHERE $cond;";
  }

 public function search_by_filter_level()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $level = trim($this->input->post("level"));
    
          
     //   $cus_type = $this->input->post("cus_type");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where level like '%$level%'";

        $qr = $this->create_level_query($level);
        
         //echo $qr;die;
        
        $q1 = "select * from level ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                          <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>
                          

           <th>Level</th>
                    
                             <th>Action</th>
                              
                        </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                               <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                               
                                <td>".$user['level']."</td>
                                
                                      <td>
                                        
                                    <form method='POST' action='".base_url("home/viewlevel")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editlevel")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletlevel")."'>
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
  
  
    public function create_enrolled_query($level) 
  {
      $options = array(
       
        'name' => $name,
         
        //'cus_type' => $cus_type,
      //  'balance' => $balance,
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
        return $noopt ? "SELECT * FROM enrolled" : "SELECT * FROM enrolled WHERE $cond;";
  }


 public function search_by_filter_enrolled()
  {
    //   print_r($this->input->post());
    //   fnm:fnm,lnm:lnm,email:email,telephone:telephone,status:status,approved:approved,pincode:pincode
        $name = trim($this->input->post("name"));
    
          
     //   $cus_type = $this->input->post("cus_type");
       // $balance = $this->input->post("balance");
     //   $pincode = trim($this->input->post("status"));
        
        // $c_id=strlen($c_id);
        // $created_at=strlen($created_at);
        // $rname=strlen($rname);
        // $cost=strlen($cost);
        // $paid_amount=strlen($paid_amount);
        //  $balance=strlen($balance);
        
        $q2 = "where name like '%$name%'";

        $qr = $this->create_enrolled_query($name);
        
         //echo $qr;die;
        
        $q1 = "select * from enrolled ";
        $q = $q1." ".$q2;
        // echo $q;
        $query = $this->db->query($qr);

        $res = $query->result_array();
        //print_r($res);die;
        // $html = "<script>
        //             $('.view_event').click(function(){  
        //             var idx = $('.view_event').index(this);
        //             var uid = $('.view_uid').eq(idx).val();
        //             var url = $('#getdataurl').val();
        //             // alert( ' uid '+uid);
        //             $.ajax({
        //                type: 'POST',
        //                url: url,
        //                data:{uid:uid},
        //                success:function(data){
        //                 //   alert(data);
        //                 $('#table-popup').html(data);
        //                 $('#myModal_view').modal('show');
        //                     // window.location.reload();
        //                }
        //             });
        //         });
        //             $('#multiple_delete_user').change(function() {
        //               if(this.checked) {
        //                 $('.del_user').prop('checked', true); 
        //               }else{
        //                 $('.del_user').prop('checked', false);
        //               }
        //             });
        //             $('.del_user').change(function() {
        //                if(false == $(this).prop('checked')){
        //                  $('#multiple_delete_user').prop('checked', false);
        //                }
        //                if($('.del_user:checked').length == $('.del_user').length){
        //                  $('#multiple_delete_user').prop('checked', true);
        //                }
        //             }); 
        //             </script>";
         $html ="";
        if($res){
            $html = $html. "<table class='table table-bordered table-hover'>
                      <thead>
                        <tr>
                          <th> <input type='checkbox' id='multiple_delete_user' name='' class=''></th>
                          

           <th>Level</th>
                    
                             <th>Action</th>
                              
                        </tr>
                      </thead>";
            foreach($res as $user){
                $html = $html. "
                              <tr>
                               <td><input type='checkbox' name='' class='del_user' value='".$user['id']."'></td>
                               
                                <td>".$user['level']."</td>
                                
                                      <td>
                                        
                                    <form method='POST' action='".base_url("home/viewenrolled")."'>
                                        <input type='hidden' value='".$user['id']."' name='vuid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-eye'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/editenrolled")."'>
                                        <input type='hidden' value='".$user['id']."' name='euid'>
                                        <div class='icon_input'>
                                            <i class='fa fa-pen'></i>
                                            <input type='submit' value='' class='btn btn-info btn-sm btn_edit'>
                                        </div>
                                    </form>
                                    
                                    <form method='POST' action='".base_url("home/deletenrolled")."'>
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
  
  public function pie_chart_js() {
   
      $query =  $this->db->query("SELECT created_at as y_date, DAYNAME(created_at) as day_name, COUNT(id) as count  FROM teacher WHERE date(created_at) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "' GROUP BY DAYNAME(created_at) ORDER BY (y_date) ASC"); 
 
      $record = $query->result();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);
      $this->load->view('pie_chart',$data);
    }
     

    


  
}