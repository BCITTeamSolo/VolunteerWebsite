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
		//$this->load->library('upload');
		//$this->load->helper('string');
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
				$newUser->typeid			= 1; // user type 1 is an individual
				$newUser->email			= $this->input->post('email');
				$newUser->password 		= md5( $this->input->post('password') );
				
				// get profile image
				//if( !empty($_FILES['profile_picture']) )
				//{
					//$this->addProfileImage();
				//}
				
				// profile image things - currently non-functional
				/*
				$error = null;
				
				$pic_fileext = pathinfo($this->input->post('profile_picture'), PATHINFO_EXTENSION);
		
				$pic_filename = random_string('unique');
				$config['upload_path'] = './assets/images/profilepics/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '5000000';
				$config['max_width']  = '500';
				$config['max_height']  = '500';
				$config['file_name'] = $pic_filename . $pic_fileext;
				
				// initialize and try the upload!
				$this->upload->initialize($config);
				$upload_success = $this->upload->do_upload("profile_picture");
				
				if ( !$upload_success )
				{
					$error = array('error' => $this->upload->display_errors());
					var_dump($error);
					var_dump($this->upload->data());
					exit();
				}
				*/
				
				// individual info
				$newIndividual->indid		= $ind_id;
				$newIndividual->userid		= $user_id;
				$newIndividual->first_name 	= $this->input->post('first_name');
				$newIndividual->last_name 	= $this->input->post('last_name');
				$newIndividual->about_me 	= $this->input->post('about_me');
				$newIndividual->profile_pic = "";
				
				/*
				if( $upload_success )
				{
					$newIndividual->profile_pic	= $pic_filename . $pic_fileext;
				}
				else
				{
					$newIndividual->profile_pic = "default";
				}
				*/
				
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
				
				// show success page
				//$this->data['typeid']				= $ind_id;
				$this->data['pagebody'] 			= 'registerIndividualSuccess';
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
	
	// adds a profile image for the current user
	function addProfileImage()
	{
		

		return $error;
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
		
		// currently always returns true
		return true;
	}
	
	// validates incoming post data for general user registration data
	function validateUser( $errors )
	{
	
	}

}

/* End of file Search.php */
/* Location: application/controllers/Search.php */