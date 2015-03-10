<?php

/**
 * This controller handles user and organization registration.
 * 
 * controllers/Register.php
 *
 * ------------------------------------------------------------------------
 */
class Login extends Application {

    function __construct() 
	{
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

	// This function displays the search page
    function index() 
	{
        if(isset($_REQUEST["email"]))
		{
			$email 			= $this->input->post('email');
			$hashedPass		= md5( $this->input->post('password') );
			$loginSuccess 	= $this->checkPassword( $email, $hashedPass );
			
			if( $loginSuccess )
			{
				$this->session->set_userdata("logged_in", true);
				$this->session->set_userdata("user_email", $email);
				$this->data['pagebody'] = 'loginSuccess';    // this is the view we want shown
			}
			else
			{
				$this->data['pagebody'] = 'login';    // this is the view we want shown
			}
		}
		else
		{
			$this->data['pagebody'] = 'login';    // this is the view we want shown
		}
		
        $this->render();
    }
	
	function processLogin()
	{
		$email 			= $this->input->post('email');
		$hashedPass		= md5( $this->input->post('password') );
		$loginSuccess 	= $this->checkPassword( $email, $hashedPass );
		
		if( $loginSuccess )
		{
			$this->session->set_userdata("logged_in", true);
			$this->session->set_userdata("user_email", $email);
			$this->data['pagebody'] = 'loginSuccess';    // this is the view we want shown
		}
		else
		{
			$this->data['pagebody'] = 'login';    // this is the view we want shown
		}
		
		$this->render();
	}

	function checkPassword( $email, $hashedPass )
	{
		$passwordQuery = $this->db
			->select('userid, password')
			->from('user')
			->where("email = '$email'")
			->get();
			
		if( count( $passwordQuery->result() ) > 0 )
		{
			$result 	= $passwordQuery->result();
			$password 	= $result[0]->password;
			
			if( $hashedPass == $password )
			{
				// set userid in session data
				$this->session->set_userdata("user_id", $result[0]->userid);
				
				return true;
			}
			
		}
		
		return false;
	}
	
	function logout()
	{
		$this->session->unset_userdata("logged_in");
		$this->session->unset_userdata("user_email");
		$this->session->unset_userdata("user_id");
		
		//$this->data['pagebody'] = 'homepage';    // this is the view we want shown
		
		redirect("/", "refresh");
	}
}

/* End of file Search.php */
/* Location: application/controllers/Search.php */