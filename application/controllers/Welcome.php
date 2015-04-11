<?php

/**
 * Our homepage. Show a table of all the author pictures. Clicking on one should show their quote.
 * Our quotes model has been autoloaded, because we use it everywhere.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

	// This function displays the homepage!
    function index() {
		$this->data['logged_in'] = "display: none;";
		$this->data['register'] = "";
		
		if($this->session->userdata("logged_in"))
		{
			$this->data['logged_in'] = "";
			$this->data['register'] = "display: none;";
			$this->data['type'] = $this->session->userdata('user_typename');
			$this->data['typeid'] = $this->session->userdata('user_typeid');
		}
		
        $this->data['pagebody'] = 'homepage';    // this is the view we want shown
        // build the list of authors, to pass on to our view
        $this->render();
    }
	
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */