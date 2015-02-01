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
	function showProfile( $userNumber )
	{
		$this->data['pagebody'] = 'userProfile'; // show the userProfile page
        
		// find user with supplied user number
        $user = $this->user->getSingle( $userNumber );
		
		if( $user == null )
		{
			$this->data['pagebody'] = 'userNotFound'; // swap to not found page
		}
		else
		{
			$this->data = array_merge($this->data, $user);
		}

        $this->render();
	}
}

/* End of file UserProfile.php */
/* Location: application/controllers/UserProfile.php */