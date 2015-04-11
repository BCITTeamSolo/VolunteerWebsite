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
class Userprofile extends Application {

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
		$this->data['match_display'] = "";
		$this->data['edit_display'] = "display: none;";
        
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
				$this->data["loginMessage"] = "";
				
				if( $indId == $this->session->userdata("user_typeid") )
				{
					$this->data['match_display'] = "display: none;";
					$this->data['edit_display'] = "";
					$this->data['type'] = $this->session->userdata("user_typename");
					$this->data['id'] = $this->session->userdata("user_typeid");
				}
				
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
			
			$this->data = array_merge($this->data, $user);
			$this->data["causes"] = $causes;
		}

        $this->render();
	}
	
	function editProfile( $indId )
	{
		$this->data['pagebody'] = 'userProfileEdit'; // show the userProfile page
        
		// find user with supplied user number
		$userId	= $this->user->getUserId( $indId );
	}
}

/* End of file UserProfile.php */
/* Location: application/controllers/UserProfile.php */