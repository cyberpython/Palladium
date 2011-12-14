<?php
/*******************************************************************************

    This file is part of the Palladium WordPress theme.

    The Palladium WordPress theme is free software: you can redistribute it
    and/or modify it under the terms of the GNU General Public License as
    published by the Free Software Foundation, either version 3 of the License,
    or (at your option) any later version.

    The Palladium WordPress theme is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with the Palladium WordPress theme.
    If not, see <http://www.gnu.org/licenses/>.

 ******************************************************************************/
?>
<?php
        
        load_theme_textdomain( 'palladium', TEMPLATEPATH . '/languages' );

        if( !isset($content_width) ){
            $content_width = 960;
        }
        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);
         
        // Get the page number
        function get_page_number() {
            if ( get_query_var('paged') ) {
                print ' | ' . __( 'Page ' , 'palladium') . get_query_var('paged');
            }
        } // end get_page_number


/*------------------------------------------------------------------------------
    Sidebars:
------------------------------------------------------------------------------*/

    // Register widgetized areas
    function theme_widgets_init() {

        register_sidebar( array(
	    'name'          => 'Primary widget area',
	    'id'            => 'primary-widget-area',
	    'description'   => '',
	    'before_widget' => '<li id="%1$s" class="widget %2$s">',
	    'after_widget'  => '</li>',
	    'before_title'  => '<h2 class="widgettitle">',
	    'after_title'   => '</h2>' )
	    );
	    
	    register_sidebar( array(
	    'name'          => 'Secondary widget area',
	    'id'            => 'secondary-widget-area',
	    'description'   => '',
	    'before_widget' => '<li id="%1$s" class="widget %2$s">',
	    'after_widget'  => '</li>',
	    'before_title'  => '<h2 class="widgettitle">',
	    'after_title'   => '</h2>' )
	    );
	    
	    register_sidebar( array(
	    'name'          => 'Footer widget area',
	    'id'            => 'footer-widget-area',
	    'description'   => '',
	    'before_widget' => '<li id="%1$s" class="widget %2$s">',
	    'after_widget'  => '</li>',
	    'before_title'  => '<h2 class="widgettitle">',
	    'after_title'   => '</h2>' )
	    );

        
    } // end theme_widgets_init

add_action( 'init', 'theme_widgets_init' );

// Check for static widgets in widget-ready areas
function is_sidebar_active( $index ){
  global $wp_registered_sidebars;

  $widgetcolumns = wp_get_sidebars_widgets();
                 
  if ($widgetcolumns[$index]) return true;
  
        return false;
} // end is_sidebar_active

/*------------------------------------------------------------------------------
    Navigation menus code:    
------------------------------------------------------------------------------*/
        function palladium_addmenus() {
	        register_nav_menus(
		        array(
			        'main_nav' => 'The Main Menu',
		        )
	        );
        }

        add_action( 'init', 'palladium_addmenus' );

        function palladium_nav() {
            if ( function_exists( 'wp_nav_menu' ) )
                wp_nav_menu( 'menu=main_nav&container_class=pagemenu&fallback_cb=palladium_nav_fallback' );
            else
                palladium_nav_fallback();
        }

        function palladium_nav_fallback() {
            wp_page_menu( 'show_home=Home&menu_class=pagemenu' );
        }

/*------------------------------------------------------------------------------
    XHTML 1.0 Related fixes:
------------------------------------------------------------------------------*/

    function valid_search_form ($form) {
        return str_replace('role="search" ', '', $form);
    }
    add_filter('get_search_form', 'valid_search_form');
	
	
	remove_shortcode('gallery', 'gallery_shortcode');
    add_shortcode('gallery', 'gallery_shortcode_palladium');
	/**
     * The Gallery shortcode.
     *
     * This implements the functionality of the Gallery Shortcode for displaying
     * WordPress images on a post.
     *
     * @since 2.5.0
     *
     * @param array $attr Attributes attributed to the shortcode.
     * @return string HTML content to display gallery.
     */
    function gallery_shortcode_palladium($attr) {
	    global $post, $wp_locale;

	    static $instance = 0;
	    $instance++;

	    // Allow plugins/themes to override the default gallery template.
	    $output = apply_filters('post_gallery', '', $attr);
	    if ( $output != '' )
		    return $output;

	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
		    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		    if ( !$attr['orderby'] )
			    unset( $attr['orderby'] );
	    }

	    extract(shortcode_atts(array(
		    'order'      => 'ASC',
		    'orderby'    => 'menu_order ID',
		    'id'         => $post->ID,
		    'itemtag'    => 'li',
		    'icontag'    => 'div',
		    'captiontag' => 'div',
		    'columns'    => 3,
		    'size'       => 'thumbnail',
		    'include'    => '',
		    'exclude'    => ''
	    ), $attr));

	    $id = intval($id);
	    if ( 'RAND' == $order )
		    $orderby = 'none';

	    if ( !empty($include) ) {
		    $include = preg_replace( '/[^0-9,]+/', '', $include );
		    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		    $attachments = array();
		    foreach ( $_attachments as $key => $val ) {
			    $attachments[$val->ID] = $_attachments[$key];
		    }
	    } elseif ( !empty($exclude) ) {
		    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
		    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }

	    if ( empty($attachments) )
		    return '';

	    if ( is_feed() ) {
		    $output = "\n";
		    foreach ( $attachments as $att_id => $attachment )
			    $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		    return $output;
	    }

	    $itemtag = tag_escape($itemtag);
	    $captiontag = tag_escape($captiontag);
	    $columns = intval($columns);
	    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	    $float = is_rtl() ? 'right' : 'left';

	    $selector = "gallery-{$instance}";

	    $gallery_style = $gallery_div = '';
	    $size_class = sanitize_html_class( $size );
	    $gallery_div = "<ul id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	    $i = 0;
	    foreach ( $attachments as $id => $attachment ) {
		    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		    $output .= "<{$itemtag} class='gallery-item'>";
		    $output .= "
			    <{$icontag} class='gallery-icon'>
				    $link
			    </{$icontag}>";
		    if ( $captiontag && trim($attachment->post_excerpt) ) {
			    $output .= "
				    <{$captiontag} class='wp-caption-text gallery-caption'>
				    " . wptexturize($attachment->post_excerpt) . "
				    </{$captiontag}>";
		    }
		    $output .= "</{$itemtag}>";
		    if ( $columns > 0 && ++$i % $columns == 0 )
			    $output .= '<li style="clear: both" />';
	    }

	    $output .= "
			    <li style='clear: both;' />
		    </ul>\n";

	    return $output;
    }


?>
