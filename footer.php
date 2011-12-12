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
        </div><!-- #main -->
        <div id="footer">
            
            <div id="meta-widget">
                <?php  the_widget('WP_Widget_Meta'); ?>
            </div><!-- #meta-widget -->
            
            <div id="colophon">     
<?php if(is_sidebar_active( 'footer-widget-area' )){ ?>
                <div id="footer-widgets">
                        <ul class="widget-list">
                                <?php dynamic_sidebar('footer-widget-area'); ?>
                        </ul>
                </div><!-- #footer-widgets -->
<?php }else{ ?>
                <div id="footer-widgets">
                        <ul class="widget-list">
                                <li><?php the_widget('WP_Widget_Pages'); ?></li>
                                <li><?php the_widget('WP_Widget_Archives', array('title'=>__('Archives'),'count'=>0,'dropdown'=>0)); ?></li>
                                <li><?php the_widget('WP_Widget_Recent_Posts', array('title'=>__('Recent Posts'),'number'=>10), array('widget_id'=>'footer-recent-posts')); ?></li>
                        </ul>
                </div><!-- #footer-widgets -->
<?php } ?>
     
            </div><!-- #colophon -->
            
            <div id="credits">
                <p>
                    Proudly powered by <a href="http://www.wordpress.org/" target="_blank">WordPress</a>.
                    Theme <q>Palladium</q> by <a href="http://gmigdos.wordpress.com/" target="_blank">George Migdos</a>.
                </p>
            </div>
        </div><!-- #footer -->
    </div><!-- #wrapper -->
    
    <?php wp_footer(); ?>
    </body>
</html>
