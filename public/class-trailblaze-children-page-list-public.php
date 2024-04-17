<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://trailblazecreative.com/
 * @since      1.0.0
 *
 * @package    Trailblaze_Children_Page_List
 * @subpackage Trailblaze_Children_Page_List/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Trailblaze_Children_Page_List
 * @subpackage Trailblaze_Children_Page_List/public
 * @author     TrailBlaze Creative <info@trailblazecreative.com>
 */
class Trailblaze_Children_Page_List_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


    /**
     * Display a list of child pages of the current page.
     *
     * @since    1.0.0
     * @param    array    $atts    Shortcode attributes.
     * @return   string   HTML list of child pages.
     */
    public function children_page_list_function($atts) {
        $atts = shortcode_atts( array(
            'parent' => null,
        ), $atts, 'children_page_list' );

        $parent = $atts['parent'];

        if ($parent === null) {
            global $post;
            $ancestors = get_post_ancestors($post->ID);
            $parent = ($ancestors) ? $ancestors[count($ancestors) - 1] : $post->ID;
        }

        $args = array(
            'post_parent' => $parent,
            'post_type' => 'page',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'menu_order'
        );

        $children = get_children($args);

        $output = '<div class="children-pages-menu">';

        foreach ($children as $child) {
            $output .= '<a class="child-page" href="' . get_permalink($child->ID) . '">' . $child->post_title . '</a><br />';
            $grandchildren = get_children(array(
                'post_parent' => $child->ID,
                'post_type' => 'page',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'menu_order'
            ));
            foreach ($grandchildren as $grandchild) {
                $output .= '<a class="grandchild-page" href="' . get_permalink($grandchild->ID) . '">' . $grandchild->post_title . '</a><br />';
            }
        }

        $output .= '</div>';

        return $output;
    }

}
