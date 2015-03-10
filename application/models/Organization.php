<?php

/**
 * This is a Model for an organization in the Volunteer Website
 *
 * @author Matthew Banman
 */
class Organization extends CI_Model {

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // retrieve a single organization
    public function getSingle($orgId) {
        // iterate over the data until we find the one we want
        $singleOrg = $this->db
			->select('o.name, o.mission_statement, o.about_us, o.contact_email, o.contact_phone, o.logo_pic')
			->from('organization as o')
			->where('o.orgid = ' . $orgId)
			->get();
			
		if( count( $singleOrg->result() ) > 0)
		{
			$result = $singleOrg->result();
			$org = array(
				"orgName" 		=> $result[0]->name,
				"mission"		=> $result[0]->mission_statement,
				"about"			=> $result[0]->about_us,
				"contact_email"	=> $result[0]->contact_email,
				"contact_phone" => $result[0]->contact_phone,
				"pic"			=> $result[0]->logo_pic
			);
			
			return $org;
		}
		
        return null;
    }
	
	public function getUserId( $orgId )
	{
		$singleUser = $this->db
			->select('o.userid')
			->from('organization as o')
			->where('o.orgid = ' . $orgId)
			->get();
			
		if( count( $singleUser->result() ) > 0 )
		{
			$result = $singleUser->result();
			$userId = $result[0]->userid;
			
			return $userId;
		}
		
		return null;
	}

    // retrieve all organizations
    public function all() {
        //return $this->data;
    }
}
