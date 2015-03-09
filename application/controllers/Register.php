<?php

/**
 * This controller handles user and organization registration.
 * 
 * controllers/Register.php
 *
 * ------------------------------------------------------------------------
 */
class Register extends Application {

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
        $this->data['pagebody'] = 'register';    // this is the view we want shown
		
        $this->render();
    }
	
	// this function will find an appropriate list of items from the search terms provided
	function registerOrganization()
	{
		$this->data['pagebody'] = 'registerOrganization';    // this is the view we want shown
		
        $this->render();
	}
	
	function registerIndividual()
	{
		// if the form is being submitted...
		if(isset($_REQUEST["email"]))
		{
			// validate the submitted data!
			$errors = array();
			$valid = $this->validateIndividual( $errors );
			
			if($valid)
			{
				// create new user and individual, assign numbers
				$user_id			= $this->user->highest() + 1;
				$newUser 			= $this->user->create();
				
				$ind_id				= $this->individual->highest() + 1;
				$newIndividual 		= $this->individual->create();
				
				// user info
				$newUser->userid		= $user_id;
				$newUser->email			= $this->input->post('email');
				$newUser->password 		= md5( $this->input->post('password') );
				$newUser->profilepic	= $this->input->post('profile_picture');
				$newUser->type			= 1; // user type 1 is an individual
				
				// individual info
				$newIndividual->indid		= $ind_id;
				$newIndividual->userid		= $user_id;
				$newIndividual->first_name 	= $this->input->post('first_name');
				$newIndividual->last_name 	= $this->input->post('last_name');
				$newIndividual->about_me 	= $this->input->post('about_me');
				
				// add new user to db
				$this->user->add( $newUser );
				$this->individual->add( $newIndividual);
				
				// add causes for this user
				if( $this->input->post('cause_animals') )
				{
					$this->addCause( $user_id, 1 );
				}
				
				if( $this->input->post('cause_environment') )
				{
					$this->addCause( $user_id, 2 );
				}
				
				if( $this->input->post('cause_welfare') )
				{
					$this->addCause( $user_id, 3 );
				}
				
				if( $this->input->post('cause_disabilities') )
				{
					$this->addCause( $user_id, 4 );
				}
			
				// prepare to render success pages
				$this->data['user_id']				= $user_id;
				$this->data['email']				= $this->input->post('email');
				$this->data['password']				= $this->input->post('password');
				$this->data['profile_pic']			= $this->input->post('profile_picture');
				$this->data['first_name'] 			= $this->input->post('first_name');
				$this->data['last_name'] 			= $this->input->post('last_name');
				$this->data['about_me']				= $this->input->post('about_me');
				$this->data['cause_animals'] 		= $this->input->post('cause_animals');
				$this->data['cause_environment'] 	= $this->input->post('cause_environment');
				$this->data['cause_welfare'] 		= $this->input->post('cause_welfare');
				$this->data['cause_disabilities'] 	= $this->input->post('cause_disabilities');
				$this->data['pagebody'] 			= 'registerIndividualSuccess';    // this is the view we want shown
			}
			else
			{
				$this->data['errors'] = $errors;
				$this->data['pagebody'] = 'registerIndividual';
			}
			
			$this->render();
		}
		else
		{
			$this->data['pagebody'] = 'registerIndividual';    // this is the view we want shown
			$this->render();
		}
	}
	
	// add new cause for registering user
	function addCause( $user_id, $cause_id )
	{
		$userCause 				= $this->usercause->create();
		$userCause->userid 		= $user_id;
		$userCause->causeid 	= $cause_id;
		
		$this->usercause->add( $userCause );
	}
	
	// validates incoming post data for a registering individual
	function validateIndividual( $errors )
	{	
		$this->validateUser( $errors );
		
		if( !$this->user )
		{
		
		}
		
		return true;
	}
	
	// validates incoming post data for general user registration data
	function validateUser( $errors )
	{
	
	}

}

/* End of file Search.php */
/* Location: application/controllers/Search.php */