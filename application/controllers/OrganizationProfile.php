<?php

/**
 * This is the OrganizationProfile controller - it contains all funtions required
 * gather data for and display an organizations's profile. 
 * 
 * controllers/OrganizationProfile.php
 *
 * @author Matthew Banman
 *
 * ------------------------------------------------------------------------
 */
class OrganizationProfile extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

	// non-functioning index function
    function index() 
	{
        
    }
	
	// This function displays the organization profile!
	function showProfile( $orgNumber )
	{
		$this->data['pagebody'] = 'organizationProfile'; // show the organizationProfile page
        
		// find organization with supplied organization number
		$userId 		= $this->organization->getUserId( $orgNumber );
        
		
		if( is_null( $userId ) )
		{
			$this->data['pagebody'] = 'organizationNotFound'; // swap to not found page
		}
		else
		{
			$organization 	= $this->organization->getSingle( $orgNumber );
			$causes 		= $this->usercause->getAllForUser( $userId );
			
			if( is_null( $causes ) || empty($causes) )
			{
				$causes[] = array(
					"cause" => "This organization has not selected any causes!"
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
			
			$this->data = array_merge($this->data, $organization);
			$this->data["causes"] = $causes;
		}

        $this->render();
	}

}

/* End of file OrganizationProfile.php */
/* Location: application/controllers/OrganizationProfile.php */