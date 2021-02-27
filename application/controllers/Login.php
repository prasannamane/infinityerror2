<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}

	public function loginme()
	{
		$this->load->model('Loginmodel');

		$email = $this->input->post("email");
		$password = base64_encode($this->input->post("password"));

		$result = $this->Loginmodel->check_login_details($email, $password );
		if(count($result) > 0)
		{
			$this->session->set_userdata('balnxr_admin', $result);
			redirect("Home");
		}
		else
		{	
			$this->session->set_flashdata('message', 'Sorry, Email ID or Password may be wrong .');
			$this->session->set_flashdata('erclass', "alert-danger");
			redirect("Login");
		}
	}

	public function forgot_password()
	{
		$this->load->view('forgot_password');
	}

	public function forgot_password_action()
	{
		$this->load->model('Loginmodel');

		$email = $this->input->post("email");

		$result = $this->Loginmodel->check_login($email );
		if(count($result) > 0)
		{

			// Send mail to registered email id -------------------------

		    $message = "<html>
            <head>
            <title>Forgot Password</title>
            </head>
            <body>
            <div  style='width:auto; height:405px; padding-left:25px'>
             <div>
                 <p>Hello ". $result->admin_name .",</p>
                 <p>We got pour request for forgot password of admin panel.</p>
                 <p>Please use below login credentials.</p>
                 <p><strong>Email</strong> : " . $result->admin_email . "</p>
                 <p><strong>Password</strong> : " . base64_decode($result->admin_pwd) . "</p>
                 <br>
                 <br>
                 <p> Thank You!</p>
             </div>
            </div>
            </body>
            </html>";

            $this->email->set_mailtype("html");
            $this->email->from('info@tech599.com', 'BalanXR');
            $this->email->to($result->admin_email);
            $this->email->subject('Forgot Password - BalanXR');
            $this->email->message($message);

            $this->email->send();

		    // ----------------------------------------------------------

			$this->session->set_flashdata('message', 'Mail containing password is sent on your registered mail id.');
			$this->session->set_flashdata('erclass', "alert-success");
			redirect("Login");
		}
		else
		{	
			$this->session->set_flashdata('message', 'Sorry, Email ID not found.');
			$this->session->set_flashdata('erclass', "alert-danger");
			redirect("Login/forgot_password");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('balnxr_admin');
		redirect("Login");
	}
}
