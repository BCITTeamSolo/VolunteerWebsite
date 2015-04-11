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
				$this->data['typeid'] = $this->session->userdata("user_typeid");
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
		// query to get user info using email and hashedPass
		$passwordQuery = $this->db
			->select('userid, password, typeid')
			->from('user')
			->where("email = '$email'")
			->get();
			
		// if there are results
		if( count( $passwordQuery->result() ) > 0 )
		{
			$result 	= $passwordQuery->result();
			$password 	= $result[0]->password;
			$userid		= $result[0]->userid;
			$typeid		= $result[0]->typeid;
			
			// if there is a match, check for user type and get ids
			if( $hashedPass == $password )
			{
				if( $typeid == 1 )
				{
					$type 		= "individual";
					$typename 	= "user"; 
					$id			= "indid";
					$name		= "first_name";
				}
				else
				{
					$type 		= "organization";
					$typename 	= $type;
					$id			= "orgid";
					$name		= "name";
				}
				
				// query dynamically for type and id
				$typeQuery = $this->db
					->select("$id, $name")
					->from("$type")
					->where("userid = '$userid'")
					->get();
					
				if( count( $typeQuery->result() ) > 0 )
				{
					$typeResult = $typeQuery->result();
					
					// set userid in session data
					$this->session->set_userdata("user_id", $userid );
					$this->session->set_userdata("user_name", $typeResult[0]->$name );
					$this->session->set_userdata("user_type", $result[0]->typeid );
					$this->session->set_userdata("user_typename", $typename );
					$this->session->set_userdata("user_typeid", $typeResult[0]->$id );
					
					return true;
				}
			}
			
		}
		
		return false;
	}
	
	function loginAfterRegistration( $user, $id, $name )
	{		
		$email 			= $user->email;
		$hashedPass		= $user->password;
		$loginSuccess 	= $this->checkPassword( $email, $hashedPass );
		
		if( $loginSuccess )
		{
			if($user->typeid == 1)
			{
				$typename = "user";
			}
			else
			{
				$typename = "organization";
			}
			
			$this->session->set_userdata("logged_in", true);
			$this->session->set_userdata("user_email", $email);
			$this->session->set_userdata("user_type", $user->typeid );
			$this->session->set_userdata("user_typename", $typename );
			$this->session->set_userdata("user_name", $name );
			$this->session->set_userdata("user_typeid", $id );
		}
		
		return $loginSuccess;
	}
	
	function logout()
	{
		$this->session->unset_userdata("logged_in");
		$this->session->unset_userdata("user_email");
		$this->session->unset_userdata("user_id");
		$this->session->unset_userdata("user_name");
		$this->session->unset_userdata("user_type");
		$this->session->unset_userdata("user_typename");
		$this->session->unset_userdata("user_typeid");
		
		redirect("/", "refresh");
	}
}

/* End of file Search.php */
/* Location: application/controllers/Search.php */