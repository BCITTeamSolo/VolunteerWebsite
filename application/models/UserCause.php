<?php

/**
 * This is a Model for an organization in the Volunteer Website
 *
 * @author Matthew Banman
 */
class UserCause extends MY_Model2 {

    var $data = array();

    // Constructor
    public function __construct() {
        parent::__construct('user_cause', 'userid', 'causeid');
    }
	
	// get all causes connected to a single user
	function getAllForUser( $userId )
	{
		$userCauses = $this->db
			->select('c.name')
			->from('user_cause as uc')
			->join('cause as c', 'uc.causeid = c.causeid', 'left outer')
			->where('uc.userid = ' . $userId)
			->get();
			
		$causes = array();
		
		if( $userCauses->result() > 0 )
		{
			foreach( $userCauses->result() as $result )
			{
				$causes[] = array(
					"cause"	=> $result->name
				);
			}
			
			return $causes;
		}
		
		return null;
	}
}
