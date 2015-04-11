<?php

/**
 * This controller handles all search-related functionality.
 * 
 * controllers/Search.php
 *
 * ------------------------------------------------------------------------
 */
class Search extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

	// This function displays the search page
    function index() {
	
		$users = $this->user->getAll();
		
		// if user is logged in, remove them from the list
		if($this->session->has_userdata("user_id"))
		{
			$i = 0;
			$row = null;
			foreach($users as $u)
			{
				if($u['userid'] == $this->session->userdata("user_id"))
				{
					$row = $i;
				}
				
				$i++;
			}
			
			unset($users[$row]);
		}
		
		// set data for display and linking to profiles
		$i = 0;
		foreach($users as $u)
		{			
			if($u['type'] == 1)
			{
				$users[$i]['typename'] = 'user';
			}
			else
			{
				$users[$i]['typename'] = 'organization';
			}
			
			$users[$i]['matchPercent'] = $this->matchPercentage( $u['userid'], $u['type'], $u['typeid'] );
			
			$i++;
		}
		
		usort($users, function($a, $b) {
			return $b['matchPercent'] - $a['matchPercent'];
		});
		
		$this->data['users'] = $users;
        $this->data['pagebody'] = 'search';    // this is the view we want shown
		
        $this->render();
    }
	
	// this function will find an appropriate list of items from the search terms provided
	function find( $searchString )
	{
		$this->data['pagebody'] = 'searchResult';    // this is the view we want shown
		$this->data['searchString'] = $searchString;
		
        $this->render();
	}
	
	function matchPercentage( $userId, $type, $typeId )
	{
		$percentage = "? ";
		
		// if a user is logged in, calculate percentage
		if($this->session->has_userdata("user_id"))
		{
			//if()
			//$user 	= $this->user->getSingle( $indId );
			$causes = $this->usercause->getAllForUser( $userId );
			
			if( is_null( $causes ) )
			{
				$causes[0] = array(
					"cause" => "This user has not selected any causes!"
				);
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
				
				//check causes with current user
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
			
			$percentage = $percent;
		}
			
		return $percentage;
	}

}

/* End of file Search.php */
/* Location: application/controllers/Search.php */