<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="with-icon full-width">
		<input name="s" title="<?php echo esc_attr_x( 'Search for:', 'Title', 'lana' ) ?>" type="text" 
			class="input-text full-width" placeholder="<?php echo esc_attr( __( 'Search', 'lana' ) ); ?>" value="<?php echo get_search_query() ?>">
		<button type="submit" class="icon dark-blue-bg white-color">
			<i class="fa fa-search"></i>
		</button>
	</div>
</form>