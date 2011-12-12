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
        include_once TEMPLATEPATH . "/geshi.php";
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
    Shortcodes:
------------------------------------------------------------------------------*/
        // [source_code language="language-name"]
        function sourcecode_handler( $atts, $source="", $code="") {
	        $attributes = shortcode_atts( array(
		        'language' => '',
		        'linenumbers' => 'on',
		        'importantlines' => ''
	        ), $atts ) ;
            $language = strtolower(trim($attributes['language']));
            if($language!=''){
                $geshi = new GeSHi($source, $language);
                $geshi->set_overall_class('sourcecode');
                $geshi->enable_classes();
                if(strcmp(strtolower($attributes['linenumbers']),'off')!=0){
                    $geshi->set_header_type(GESHI_HEADER_PRE_TABLE);
                    $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
                }
                $implines = explode(",", $attributes['importantlines']);
                if($implines!=FALSE){
                    $geshi->highlight_lines_extra($implines);
                }

                // and simply dump the code!
                return $geshi->parse_code();
            }else{
                return "<pre>$source</pre>";
            }
        }
        add_shortcode( 'source_code', 'sourcecode_handler' );
        
        
        function source_code_formatter($content) {
	        $new_content = '';
	        $pattern_full = '{(\[source_code\].*?\[/source_code\])}is';
	        $pattern_contents = '{\[source_code\](.*?)\[/source_code\]}is';
	        $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	        foreach ($pieces as $piece) {
		        if (preg_match($pattern_contents, $piece, $matches)) {
			        $new_content .= $matches[1];
		        } else {
			        $new_content .= wptexturize(wpautop($piece));
		        }
	        }

	        return $new_content;
        }

        remove_filter('the_content', 'wpautop');
        remove_filter('the_content', 'wptexturize');

        add_filter('the_content', 'source_code_formatter', 99);

?>
