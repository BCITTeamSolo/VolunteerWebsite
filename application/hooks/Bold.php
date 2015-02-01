<?php

/**
 * Bold Controller! Bolds all capitalized words in qotes.
 * 
 * hooks/Bold.php
 *
 * ------------------------------------------------------------------------
 */
class Bold {

    function __construct() {
        
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

	// This function bolds all capitalized words!
    function index() {
		// intercept output
		$CI =& get_instance();
        $content = $CI->output->get_output(); 
		
		// find the quote and make it an array of words!
		$quote = substr($content, strpos($content, '<p class="lead">') + 16,
				strpos($content, '</p>') - (strpos($content, '<p class="lead">') + 16));
		$quotearray = explode(" ", $quote);
		
		// create new array for updated quote
		$newquotearray = array();
		
		// cycle through the words, adding strong tags if they have capital letters
		foreach($quotearray as $word)
		{
			if( preg_match("/[A-Z]+/", $word) )
			{
				$word = "<strong>" . $word . "</strong>";
			}
			
			$newquotearray[] = $word;
		}
		
		// put quote back together
		$newquote = implode(" ", $newquotearray);
		$newquote = '<p class="lead">' . $newquote . '</p>';
		$content = preg_replace('#<p class="lead">.+</p>#', $newquote, $content);
		
		// output the page!
		$CI->output->set_output($content);
		$CI->output->_display();
		
    }
}

/* End of file Bold.php */
/* Location: application/hooks/Bold.php */