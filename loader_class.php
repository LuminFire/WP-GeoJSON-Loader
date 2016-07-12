<?php

class wp_geojson_loader {
	public static function load( $json, $post_type = 'post' ) {
		if ( is_string( $json ) ) {
			$json = json_decode( $json, true );
		} else if ( is_object( $json ) ) {
			$json = (array)$json;
		}

		$geom_field = apply_filters( 'wp_geojson_loader_geom', 'geom', $post_type );

		foreach ( $json[ 'features' ] as $feature ) {
			$postarr = array(
				'post_type' => $post_type,
				'post_title' => apply_filters( 'wp_geojson_loader_title', NULL, $post_type, $feature ),
				'post_content' => apply_filters( 'wp_geojson_loader_content', NULL, $post_type, $feature ),
				'post_status' => apply_filters( 'wp_geojson_loader_status', NULL, $post_type, $feature ),
			);

			$postarr = apply_filters( 'wp_geojson_loader_postarr', $postarr, $post_type, $feature );

			$post_id = wp_insert_post( $postarr ); 

			$properties_to_keep = array_keys( $feature[ 'properties' ] );
			$properties_to_keep = apply_filters( 'wp_geojson_loader_properties', $properties_to_keep, $post_type, $feature );

			if ( $post_id ) {
				foreach ( $properties_to_keep as $property ) {
					$val = $feature[ 'properties' ][ $property ];
					update_post_meta( $post_id, $property, $val );
				}

				update_post_meta( $post_id, $geom_field, json_encode( $feature ) );
			}
		}
	}
}
