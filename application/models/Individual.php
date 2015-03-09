<?php

/**
 * This is a Model for an organization in the Volunteer Website
 *
 * @author Matthew Banman
 */
class Individual extends MY_Model {

    var $data = array();

    // Constructor
    public function __construct() {
        parent::__construct(null, 'indid');
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
