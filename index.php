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
<?php get_header(); ?>

<div id="container">
     
                <div id="content">
                    
                    <?php /* Top post navigation */ ?>
                    <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                    <div id="nav-above" class="navigation">
                        <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'palladium' )) ?></div>
                        <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'palladium' )) ?></div>
                    </div><!-- #nav-above -->
                    <?php } ?>
                    
                    <ul id="posts-list">
                        <li class="placeholder"></li>
                        <?php /* The Loop — with comments! */ ?>
                        <?php while ( have_posts() ) : the_post() ?>
                        <li>
                        <?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>
                                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php /* an h2 title */ ?>
                        <?php $title = the_title("","",false); ?>
                        <?php if($title!=""){ ?>
                                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'palladium'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php echo $title ?></a></h2>
                                            <div class="entry-title-shadow"></div>
                                            <div class="ribbon-corner"></div>
                        <?php } ?>
                        <?php /* The entry content */ ?>
                                            <div class="entry-content <?php if($title==''){echo 'no-title';}?>">
                        <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'palladium' )  ); ?>
                        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'palladium' ) . '&after=</div>') ?>
                                            </div><!-- .entry-content -->
                         
                        <?php /* Microformatted category and tag links along with a comments link */ ?>
                                            <div class="entry-meta">
                                                <span class="meta-prep meta-prep-entry-date"><?php _e('Posted on ', 'palladium'); ?></span>
                                                <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'palladium'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
                                                <span class="meta-prep meta-prep-author"><?php _e('by ', 'palladium'); ?></span>
                                                <span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'palladium' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
                                                <span class="meta-sep"> | </span>
                                                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'palladium' ), __( '1 Comment', 'palladium' ), __( '% Comments', 'palladium' ) ) ?></span>
                                                <?php edit_post_link( __( 'Edit', 'palladium' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
                                            </div><!-- #entry-meta -->
                                        </div><!-- #post-<?php the_ID(); ?> -->
                         
                        <?php /* Close up the post div and then end the loop with endwhile */ ?>      
                                        <div class="post-shadow"></div>
                         </li>
                        <?php endwhile; ?>
                    </ul>
                    
                    <?php /* Bottom post navigation */ ?>
                    <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                                    <div id="nav-below" class="navigation">
                                        <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'palladium' )) ?></div>
                                        <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'palladium' )) ?></div>
                                    </div><!-- #nav-below -->
                    <?php } ?>
                    
                </div><!-- #content -->
     
            </div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
