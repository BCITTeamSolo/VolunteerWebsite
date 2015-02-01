<?php
if (!defined('APPPATH'))
    exit('No direct script access allowed');
/**
 * view/template.php
 *
 * Pass in $pagetitle (which will in turn be passed along)
 * and $pagebody, the name of the content view.
 *
 * ------------------------------------------------------------------------
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{title}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<!-- import materialize.css-->
        <link href="/assets/materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="/assets/materialize/css/style.css"/>
    </head>
    <body>
        <nav class="light-green darken-2" role="navigation">
			{menubar}
		</nav>
		{content}
		<footer class="page-footer light-green darken-4">
			{footer}
		</footer>

		<!-- scripts -->
        <script src="/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/assets/materialize/js/materialize.min.js"></script>
    </body>
</html>
