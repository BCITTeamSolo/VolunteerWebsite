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
class Organizationprofile extends Application {

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
				$this->data["loginMessage"] = "";
				
				// calculate match percentage...
				$userid = $this->session->userdata("user_id");
				
				$userQuery = $this->db
					->select('c.name')
					->from('user_cause as uc')
					->join('cause as c', 'uc.causeid = c.causeid', 'left outer')
					->where('uc.userid = ' . $userid)
					->get();
					
				$percent = 0;	
				
				if( count( $userQuery->result() ) > 0 )
				{
					$count = 0;
					$matches = 0.0;
					$userCauses = array();
					
					$result = $userQuery->result();
					foreach( $result as $r )
					{
						$userCauses[] = $r->name;
						$count++;
					}
					
					$viewedUserCount = 0;
					
					//check causes with currently displayed user
					foreach($causes as $cause)
					{
						$viewedUserCount++;
						
						foreach($cause as $c)
						{
							foreach($userCauses as $uc)
							{								
								if($uc == $c)
								{
									$matches++;
								}
							}
						}
					}
					
					$percent = ($matches / $count) * 100;
					$percent = number_format($percent, 0);
					if($percent > 100)
						$percent = 100;
						
					$remainder = $viewedUserCount - $count;
					for( $i = 0; $i < $remainder; $i++ )
					{
						$percent -= 5;
					}
					
					if($percent < 0)
						$percent = 0;
				}
				
				$this->data["matchPercent"] = "$percent";
			}
			else
			{
				$this->data["matchPercent"] = "? ";
				$this->data["loginMessage"] = 
					"<div class='row center light-green lighten-2 valign-wrapper'>
						<p class='white-text col s8 flow-text'>
							<a href='/login'>Log in</a> or <a href='/register'>register</a> to see your match percentage!
						</p>
					</div>";
			}
			
			$this->data = array_merge($this->data, $organization);
			$this->data["causes"] = $causes;
		}

        $this->render();
	}

}

/* End of file OrganizationProfile.php */
/* Location: application/controllers/OrganizationProfile.php */