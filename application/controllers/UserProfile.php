<?php

/**
 * This is the UserProfile controller - it contains all funtions required
 * gather data for and display a user's profile. 
 *
 * controllers/UserProfile.php
 *
 * @author Matthew Banman
 *
 * ------------------------------------------------------------------------
 */
class UserProfile extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

	// Non-functioning index method
    function index() {
        
    }
	
	// This function displays the user profile!
	function showProfile( $indId )
	{
		$this->data['pagebody'] = 'userProfile'; // show the userProfile page
        
		// find user with supplied user number
		$userId	= $this->user->getUserId( $indId );
		
		// check if user exists and display it!
		if( is_null( $userId ) )
		{
			$this->data['pagebody'] = 'userNotFound'; // swap to not found page
		}
		else
		{
			$user 	= $this->user->getSingle( $indId );
			$causes = $this->usercause->getAllForUser( $userId );
			
			if( is_null( $causes ) )
			{
				$causes[0] = array(
					"cause" => "This user has not selected any causes!"
				);
			}
			
			// check if current viewer is logged in or not
			if($this->session->has_userdata("logged_in"))
			{
				// if the viewer is logged in...
				
				// do some work to calculate match percentage
			}
			else
			{
				$this->data["matchPercent"] = "? ";
			}
			
			$this->data = array_merge($this->data, $user);
			$this->data["causes"] = $causes;
		}

        $this->render();
	}
}

/* End of file UserProfile.php */
/* Location: application/controllers/UserProfile.php */