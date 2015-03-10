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
			
			$this->data = array_merge($this->data, $user);
			$this->data["causes"] = $causes;
		}

        $this->render();
	}
}

/* End of file UserProfile.php */
/* Location: application/controllers/UserProfile.php */