<?php

/**
 * This is a Model for an organization in the Volunteer Website
 *
 * @author Matthew Banman
 */
class Organization extends CI_Model {

    var $data = array(
        array('id' => '5', 'organizationName' => 'Rebel Alliance', 'cause' => 'Overthrowing the Empire - power to the people!', 'matchPercent'=>'10',
            'about' => 'We are a rag-tag group of individuals looking for revolution. Join us and stand up to the Man!'),
		array('id' => '6', 'organizationName' => 'Internetters Anonymous', 'cause' => 'Internet access for all.', 'matchPercent'=>'95',
            'about' => 'Without the Internet, you wouldn\'t be able to visit this website. How\'s THAT for a reason?'),
		array('id' => '7', 'organizationName' => 'ANIMALS', 'cause' => 'Animals are the best!', 'matchPercent'=>'39',
            'about' => 'ANIMALSSSSSSSSSS!!!!!'),
		array('id' => '8', 'organizationName' => '', 'cause' => 'bob-monkhouse-150x150.jpg', 'matchPercent'=>'70',
            'about' => ''),
    );

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // retrieve a single organization
    public function getSingle($which) {
        // iterate over the data until we find the one we want
        foreach ($this->data as $record)
            if ($record['id'] == $which)
                return $record;
        return null;
    }

    // retrieve all organizations
    public function all() {
        return $this->data;
    }
}
