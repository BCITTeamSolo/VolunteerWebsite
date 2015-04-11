<?php

/**
 * This is a Model for a user in the Volunteer Website
 *
 * @author Matthew Banman
 */
class User extends MY_Model {

    // Constructor
    public function __construct() 
	{
        parent::__construct('user', 'userid');
    }

    // retrieve a single user
    public function getSingle($userId) 
	{
        // iterate over the data until we find the one we want
		$singleUser = $this->db
			->select('i.first_name, i.last_name, i.about_me, i.profile_pic')
			->from('individual as i')
			->where('i.indid = ' . $userId)
			->get();
			
		if( count( $singleUser->result() ) > 0)
		{
			$result = $singleUser->result();
			$user = array(
				"firstName" 	=> $result[0]->first_name,
				"lastName"		=> $result[0]->last_name,
				"about"			=> $result[0]->about_me,
				"pic"			=> $result[0]->profile_pic
			);
			
			return $user;
		}
		
        return null;
    }

    // retrieve all users including individuals and organizations
    public function getAll() 
	{
		$allUsers = $this->all();
		$users = Array();
		
		foreach( $allUsers as $user )
		{
			$userid = $user->userid;
			$typeid = $user->typeid;
			$causes = null;
			
			$u['userid'] = $userid;
			$u['type'] = $typeid;
			
			// if user is an individual, put together name
			if($typeid == 1)
			{
				$individual = $this->db
					->select('i.indid, i.first_name, i.last_name')
					->from('individual as i')
					->where('i.userid = ' . $userid)
					->get();
					
				if( count( $individual->result() ) > 0)
				{
					$result = $individual->result();
					$u['typeid'] = $result[0]->indid;
					$u['name'] = $result[0]->first_name . " " . $result[0]->last_name;
				}
			}
			// else if user is an org, grab name from db
			else if($typeid = 2)
			{
				$organization = $this->db
					->select('o.orgid, o.name')
					->from('organization as o')
					->where('o.userid = ' . $userid)
					->get();
					
				if( count( $organization->result() ) > 0)
				{
					$causes = Array();
					
					$result = $organization->result();
					$u['typeid'] = $result[0]->orgid;
					$u['name'] = $result[0]->name;
				}
			}
			
			// add causes to the user
			$causes = $this->db
				->select('uc.causeid, c.name')
				->from('user_cause as uc')
				->join('cause as c', 'c.causeid = uc.causeid')
				->where('uc.userid = ' . $userid)
				->get();
				
			if( count( $causes->result() ) > 0)
			{
				$c = Array();
				
				$result = $causes->result();
				foreach($result as $r)
				{
					$causeid = $r->causeid;
					$c["$causeid"] = $r->name;
				}
			}
			
			$u['causes'] = $c;
			
			$users[] = $u;
		}
		
		return $users;
    }
	
	public function getUserId( $indId )
	{
		$singleUser = $this->db
			->select('i.userid')
			->from('individual as i')
			->where('i.indid = ' . $indId)
			->get();
			
		if( count( $singleUser->result() ) > 0 )
		{
			$result = $singleUser->result();
			$userId = $result[0]->userid;
			
			return $userId;
		}
		
		return null;
	}
	
	public function validate( $user )
	{
		
	}
}
