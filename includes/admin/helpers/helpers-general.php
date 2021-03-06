<?php

/**
 * Tailor general admin helper functions.
 *
 * @package Tailor
 * @subpackage Helpers
 * @since 1.0.0
 */

if ( ! function_exists( 'tailor_custom_contact_info') ) {

	/**
	 * Adds Facebook, Twitter and Google Plus contact fields to the user profile page.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields
	 * @return array $fields
	 */
	function tailor_custom_contact_info( $fields ) {
		$fields['facebook'] = __( 'Facebook', 'tailor' );
		$fields['twitter'] = __( 'Twitter', 'tailor' );
		$fields['googleplus'] = __( 'Google Plus', 'tailor' );

		return $fields;
	}

	add_filter( 'user_contactmethods', 'tailor_custom_contact_info' );
}

if ( ! function_exists( 'tailor_get_post_types' ) ) {

	/**
	 * Returns an array containing the names of registered post types.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function tailor_get_post_types( ) {

		$types = array_merge(
			array(
                'page'                  =>  'page',
                'post'                  =>  'post',
            ),
			get_post_types( array(
                '_builtin'              =>  false,
                'public'                =>  true,
                'show_ui'               =>  true,
                'exclude_from_search'   =>  false,
            ) )
		);

		foreach ( $types as $type_id => $type ) {
			$type_object = get_post_type_object( $type_id );
			$types[ $type_id ] = $type_object->label;
		}

		return $types;
	}
}

if ( ! function_exists( 'tailor_get_roles' ) ) {

	/**
	 * Returns an array containing the names of editable roles.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function tailor_get_roles( ) {

		$roles = array();
		$editable_roles = get_editable_roles();

		foreach ( $editable_roles as $name => $editable_role ) {
			if ( ! empty( $editable_role['capabilities']['edit_posts'] ) && 1 === (int) $editable_role['capabilities']['edit_posts'] ) {
				$roles[ $name ] = $editable_role['name'];
			}
		}

		return $roles;
	}
}