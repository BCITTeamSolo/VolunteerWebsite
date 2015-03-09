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
        parent::__construct('user_causes', 'userid', 'causeid');
    }
}
