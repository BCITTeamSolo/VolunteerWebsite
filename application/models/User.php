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
        parent::__construct(null, 'userid');
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

    // retrieve all users
    public function all() 
	{
        /*
		$allUsers = $this->db
			->select('u.code, u.name, u.price, oi.quantity')
			->from('orderitems as oi')
			->join('menu as m', 'oi.item = m.code', 'left outer')
			->where('oi.order = ' . $num)
			->get();
			
		$items = array();
			
		if( $orderItems->result() > 0 )
		{
			foreach( $orderItems->result() as $item )
			{
				$items[] = array(
					"code" => $item->code,
					"name" => $item->name,
					"quantity" => $item->quantity,
					"price" => sprintf("$%0.2f", $item->price),
					"subtotal" => sprintf("$%0.2f", $item->quantity * $item->price)
				);
			}
		}
		
		return $items;
		*/
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
