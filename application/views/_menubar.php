<?php
/*
 * Menu navbar, just an unordered list
 */
?>
<div class="container">
	<div class="nav-wrapper"><a id="logo-container" href="/" class="brand-logo grey-text text-lighten-3">Volunteer Website</a>
		<ul id="nav-mobile" class="right side-nav">
			{menudata}
			<li><a href="{link}">{name}</a></li>
			{/menudata}
		</ul><a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
	</div>
</div>
