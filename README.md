WP GeoJSON Loader
=================

Like the name says, this plugin loads GeoJSON files. 

It creates a post for each feature. Postmeta is created for each 
property in the feature, and the entire feature itself is stored in
a postmeta field called _geom_


Usage
-----

No UI yet, call it like this: 

wp_geojson_loader::load( $geojson_string, 'which_post_type' );



Advanced Usage
--------------

Optionally, use filters to chagne what happens


### Set the post title (will be blank otherwise)

	add_filter( 'wp_geojson_loader_title', function( $title, $post_type, $feature ) {
		if ( $post_type == 'clubs' ) {
			return $feature[ 'properties' ][ 'title' ];
		}
		return $title;
	}, 10, 3);

### Set the post content (will be blank otherwise)

	add_filter( 'wp_geojson_loader_content', function( $content, $post_type, $feature ) {
		if ( $post_type == 'clubs' ) {
			return "The club, " . $feature[ 'properties' ][ 'name' ] . ", is really cool";
		}		
		return $content;
	}, 10, 3);


### Set the post status (defaults to draft)


	add_filter( 'wp_geojson_loader_status', function( $post_status, $post_type, $feature ) {
		if ( $post_type == 'clubs' ) {
			return 'publish'
		}

		return $post_status;
	}, 10, 3);

### Modify the whole postarr used in wp_insert_post

	add_filter( 'wp_geojson_loader_postarr', function( $postarr, $post_type, $feature ) {
		if ( $post_type == 'clubs' ) {
			$postarr[ 'post_author' ] = 231;
		}

		return $postarr;
	}, 10, 3 );

### Change the name of the geometry field (defaults to 'geom')

	add_filter( 'wp_geojson_loader_geom', function( $geom_field, $post_type ){
		if ( $post_type == 'clubs' ) {
			return 'meeting_place';
		}

		return $geom_field;
	}, 10, 2);


TODO 
----

 * Make a sweet UI
 * Set up a filter to get a property field which has a unique id so that posts can be updated
