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
		// load the page populated by user data
		$this->load->helper('form');
		
		$user 	= $this->user->getSingle( $indId );
		$userId	= $this->user->getUserId( $indId );
		$causes = $this->usercause->getAllForUser( $userId );
		
		if(isset($_REQUEST["first_name"]))
		{
			// user has edited the profile - make necessary changes
			// validate the submitted data!
			$errors = array();
			$valid = true;
			
			if($valid)
			{
				$individualUpdates = Array();
				$fnameChanged = false;
				
				// set new values if they exist
				if( $user['firstName'] != $this->input->post('first_name'))
				{
					$fnameChanged = true;
					$individualUpdates['first_name'] = $this->input->post('first_name');
				}
				
				if( $user['lastName'] != $this->input->post('last_name'))
				{
					$individualUpdates['last_name'] = $this->input->post('last_name');
				}
				
				if( $user['about'] != $this->input->post('about_me'))
				{
					$individualUpdates['about_me'] = $this->input->post('about_me');
				}
				
				// update individual database
				/*
				$this->db->where('indid', $indId);
				$this->db->set($individualUpdates);
				$this->db->insert('individual');
				*/
				
				$this->db->update('individual', $individualUpdates, "indid = $indId");
					
				/*
					
				// check causes for this user
				if( $this->input->post('cause_animals') )
				{
					$query = $this->db->get_where();
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
				*/
				
				// check if session user name data must be refreshed
				if($fnameChanged)
				{
					$this->session->unset_userdata("user_name");
					$this->session->set_userdata('user_name', $this->input->post('first_name'));
				}
				
				// return to profile
				redirect("/user/$indId");
			}
			else
			{
				var_dump($errors);
				exit();
				
				$this->data['errors'] = $errors;
				$this->data['pagebody'] = 'registerIndividual';
				$this->render();
			}
		}
		else
		{
			
			$this->data['pagebody'] = 'userProfileEdit'; // show the userProfile page
			
			// set text editable data
			$this->data['first_name'] = set_value('first_name', $user['firstName']);
			$this->data['last_name'] = set_value('last_name', $user['lastName']);
			$this->data['about_me'] = set_value('last_name', $user['about']);
			
			// set checkbox data
			$this->data['animals'] = "";
			$this->data['disabilities'] = "";
			$this->data['environment'] = "";
			$this->data['welfare'] = "";
			
			// set checked if the user has selected it
			foreach( $causes as $cause )
			{
				
				if($cause['cause'] == 'animals')
				{
					$this->data['animals'] = "checked";
				}
				else if($cause['cause'] == 'disabilities')
				{
					$this->data['disabilities'] = "checked";
				}
				else if($cause['cause'] == 'environment')
				{
					$this->data['environment'] = "checked";
				}
				else if($cause['cause'] == 'welfare')
				{
					$this->data['welfare'] = "checked";
				}
			}
			
			$this->render();
		}
	}
}

/* End of file UserProfile.php */
/* Location: application/controllers/UserProfile.php */