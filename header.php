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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head profile="http://gmpg.org/xfn/11">
        <title>
        <?php
            if ( is_single() ) { single_post_title(); }
            elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
            elseif ( is_page() ) { single_post_title(''); }
            elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
            elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
            else { bloginfo('name'); wp_title('|'); get_page_number(); }
        ?>
        </title>
     
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
     
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() .'/geshi.css'; ?>" />
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ."/ie7.css"; ?>" />
        <![endif]-->
        <!--[if IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ."/ie8.css"; ?>" />
        <![endif]-->
     
        <?php wp_enqueue_script("jquery"); ?>
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
     
        <?php wp_head(); ?>
     
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'palladium' ), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'palladium' ), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
        <script type="text/javascript">
            //<![CDATA[ 
            jQuery.fn.makeAllSameSize = function() {
                jQuery(this).each(function(){
                    var maxHeight = 0;
                    jQuery(this).children().each(function(i){
                            if (maxHeight < jQuery(this).height()) { maxHeight = jQuery(this).height(); }
                        });
                        jQuery(this).children().css({'height': maxHeight});
                    });
                return this;
            };
            
            jQuery(document).ready(function(){
                 /* Make boxes same height */
                 jQuery('#footer-widgets>ul').makeAllSameSize();

            });
            // ]]>
        </script>
        
    </head>
     
    <body>
    <div id="wrapper" class="hfeed">
        <div id="header">
            <div id="masthead">
                <div id="branding">
                    <h1 id="site-title"><span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></span></h1>
                    <h2 id="site-description"><?php bloginfo( 'description' ) ?></h2>
                </div><!-- #branding -->
                <div id="search-box"><?php the_widget('WP_Widget_Search', "title="); ?></div>
            </div><!-- #masthead -->
        </div><!-- #header -->
     
        <div id="main">
