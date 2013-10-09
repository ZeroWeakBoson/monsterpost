<div class="search-form clearfix">
	<form id="searchform" class="clearfix" method="get" action="<?php echo home_url(); ?>" accept-charset="utf-8">
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="search-form_it">
		<button type="submit" id="submit" class="search-form_is icon-search"></button>
	</form>
</div>