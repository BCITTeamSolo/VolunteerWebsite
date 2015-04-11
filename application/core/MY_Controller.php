<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		Matthew Banman
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = 'Volunteer Website';    // our default title
        $this->errors = array();
        $this->data['pageTitle'] = 'welcome';   // our default page
    }

    /**
     * Render this page
     */
    function render() {
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->makemenu(), true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
		$this->data['footer'] = $this->parser->parse('_footer', $this->config->item('menu_choices'), true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
	
	function makemenu()
	{
		$logged_in = $this->session->userdata('logged_in');
		
		$menuitems = array(
			'menudata' => array(
				array('name' => 'Search', 'link' => '/search')
			)
		);
			
		if(!$logged_in)
		{
			$menuitems['menudata'][] = array('name' => 'Register', 'link' => '/register');
			$menuitems['menudata'][] = array('name' => 'Log In', 'link' => '/login');
		}
		else
		{
			$name 		= $this->session->userdata("user_name");
			$typename 	= $this->session->userdata("user_typename");
			$typeid		= $this->session->userdata("user_typeid");
			
			$menuitems['menudata'][] = array('name' => "My Profile - $name", 'link' => "/$typename/$typeid");
			$menuitems['menudata'][] = array('name' => 'Log Out', 'link' => '/logout');
		}
		
		return $menuitems;
	}

}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */