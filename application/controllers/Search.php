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

}

/* End of file Search.php */
/* Location: application/controllers/Search.php */