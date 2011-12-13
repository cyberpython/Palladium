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
                        
<?php the_post(); ?>

                                <div id="nav-above" class="navigation">
                                        <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
                                        <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
                                </div><!-- #nav-above -->
                                
                                <ul id="posts-list">
                                    <li class="placeholder"></li>
                                    <li>
                                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <?php $title = the_title("","",false); ?>
                                        <?php if($title!=""){ ?>
                                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                                <div class="entry-title-shadow"></div>
                                                <div class="ribbon-corner"></div>
                                        <?php } ?>
                                                
                                                <div class="entry-content <?php if($title==''){echo 'no-title';}?>">
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'palladium' ) . '&after=</div>') ?>
                                                </div><!-- .entry-content -->
                                                
                                                <div class="entry-meta">
                                                        <span class="meta-prep meta-prep-entry-date"><?php _e('Posted on ', 'palladium'); ?></span>
                                                        <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
                                                        <span class="meta-prep meta-prep-author"><?php _e('by ', 'palladium'); ?></span>
                                                        <span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'palladium' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
                                                        <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( ' in ', 'palladium' ); ?></span><?php echo get_the_category_list(', '); ?>.</span>
                                                        <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', 'your-theme' ) . '</span></span>', ", ", "" ) ?>
                                                        <?php edit_post_link( __( 'Edit', 'palladium' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
                                                </div><!-- #entry-meta -->                                               
                                                
                                                <div class="entry-utility">
        <?php if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Comments and trackbacks open ?>
                                                        <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'palladium' ), get_trackback_url() ) ?>
        <?php elseif ( !('open' == $post->comment_status) && ('open' == $post->ping_status) ) : // Only trackbacks open ?>
                                                        <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'palladium' ), get_trackback_url() ) ?>
        <?php elseif ( ('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Only comments open ?>
                                                        <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'palladium' ) ?>
        <?php elseif ( !('open' == $post->comment_status) && !('open' == $post->ping_status) ) : // Comments and trackbacks closed ?>
                                                        <?php _e( 'Both comments and trackbacks are currently closed.', 'palladium' ) ?>
        <?php endif; ?>
                                                </div><!-- .entry-utility -->                                                                                                   
                                        </div><!-- #post-<?php the_ID(); ?> -->   
                                        <div class="post-shadow"></div>              
                                    </li>
                                </ul>
                                
                                <div id="nav-below" class="navigation">
                                        <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
                                        <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
                                </div><!-- #nav-below -->                                       

<?php comments_template('', true); ?>
                        
                        </div><!-- #content -->         
                </div><!-- #container -->
                
<?php get_sidebar(); ?> 
<?php get_footer(); ?>
