<?php

class CustomPostTypes {
    /**
     * The single instance of the class.
     *
     * @var themeplate
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * custom post type constructor.
     */
    public function __construct() {
        add_action('init', array( $this,'themeplate_tesimonial_post') );

    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function themeplate_tesimonial_post() {
        /**
         *  Register Testimonial Post Type
         */
        register_post_type('testimonial',
            array(
             'labels'              => $this->get_posts_labels( 'Testimonial', __( 'Testimonial', 'themeplate' ), __( 'Testimonials', 'themeplate' ) ),
             'hierarchical'        => false,
             'supports'            => array( 'title', 'editor', 'thumbnail' ),
             'public'              => false,
             'show_ui'             => true,
             'show_in_menu'        => true,
             'show_in_nav_menus'   => true,
             'menu_position'       => 5,
             'menu_icon'           => 'dashicons-testimonial',
             'publicly_queryable'  => true,
             'exclude_from_search' => true,
             'has_archive'         => false,
             'query_var'           => true,
             'can_export'          => true,
             'rewrite'             => true,
             'capability_type'     => 'post',
         )
        );
    }

    protected static function get_posts_labels( $menu_name, $singular, $plural ) {
        $labels = array(
            'name'               => $singular,
            'all_items'          => sprintf( __( "All %s", 'themeplate' ), $plural ),
            'singular_name'      => $singular,
            'add_new'            => sprintf( __( 'New %s', 'themeplate' ), $singular ),
            'add_new_item'       => sprintf( __( 'Add New %s', 'themeplate' ), $singular ),
            'edit_item'          => sprintf( __( 'Edit %s', 'themeplate' ), $singular ),
            'new_item'           => sprintf( __( 'New %s', 'themeplate' ), $singular ),
            'view_item'          => sprintf( __( 'View %s', 'themeplate' ), $singular ),
            'search_items'       => sprintf( __( 'Search %s', 'themeplate' ), $plural ),
            'not_found'          => sprintf( __( 'No %s found', 'themeplate' ), $plural ),
            'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'themeplate' ), $plural ),
            'parent_item_colon'  => sprintf( __( 'Parent %s:', 'themeplate' ), $singular ),
            'menu_name'          => $menu_name,
        );

        return $labels;
    }

}

function cd_custom_post_types(){
    return CustomPostTypes::instance();
}

//fire off the theme
cd_custom_post_types();

