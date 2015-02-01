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
        $organization = $this->organization->getSingle( $orgNumber );
		
		if( $organization == null )
		{
			$this->data['pagebody'] = 'organizationNotFound'; // swap to not found page
		}
		else
		{
			$this->data = array_merge($this->data, $organization);
		}

        $this->render();
	}

}

/* End of file OrganizationProfile.php */
/* Location: application/controllers/OrganizationProfile.php */