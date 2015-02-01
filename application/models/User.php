<?php

/**
 * This is a Model for a user in the Volunteer Website
 *
 * @author Matthew Banman
 */
class User extends CI_Model {

    var $data = array(
        array('id' => '1', 'firstName' => 'Jim', 'lastName' => 'Kirk', 'matchPercent'=>'80',
            'about' => 'I am an explorer - I love meeting new people and cataloguing creatures of all kinds. I\'m excited to help in any way I can!'),
		array('id' => '2', 'firstName' => 'Han', 'lastName' => 'Solo', 'matchPercent'=>'15',
            'about' => 'I\'m passionate about helping the every-man, especially those in the transportation and cargo business.'),
		array('id' => '3', 'firstName' => 'Captain', 'lastName' => 'Planet', 'matchPercent'=>'100',
            'about' => 'Environmental issues are my bag - sign me up!'),
		array('id' => '4', 'firstName' => 'Selena', 'lastName' => 'Kyle', 'matchPercent'=>'55',
            'about' => 'I am an animal lover (especially cats)! I\'m looking for a position at an animal shelter or something similar.')
    );

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // retrieve a single user
    public function getSingle($which) {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['id'] == $which)
                return $record;
        return null;
    }

    // retrieve all users
    public function all() {
        return $this->data;
    }
}
