<?php

function render_character() {
	// verifing if the plugin is enabled
	if ( function_exists( "amp_is_canonical" ) && amp_is_canonical() ) {
		return sprintf('<p><amp-social-share type="twitter"></amp-social-share></p>');
	} else {
		// displaying the fallback
		global $wp;
		$text = wp_title( '|', false );
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		return sprintf('<a href="http://twitter.com/share?url=%1$s&text=%2$s&via=fellyph">Tweet a link to this page</a',
			$current_url,
			$text
		);
	}

}

// registering as a dynamic block
register_block_type( 'create-block/amp-share', array(
    'render_callback' => 'render_character',
) );
