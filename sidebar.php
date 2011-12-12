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
    <div id="sidebar">
    
<?php if(is_sidebar_active( 'primary-widget-area' )){ ?>
        <div id="primary" class="widget-area">
                <ul class="widget-list">
                        <?php dynamic_sidebar('primary-widget-area'); ?>
                </ul>
        </div><!-- #primary .widget-area -->
<?php }?>

        <div id="access" class="widget-area">
                <h2>Pages</h2>
                <?php palladium_nav('show_home=1'); ?>
            
        </div><!-- #access .widget-area -->
        
<?php if(is_sidebar_active( 'secondary-widget-area' )){ ?>
        <div id="secondary" class="widget-area">
                <ul class="widget-list">
                        <?php dynamic_sidebar('secondary-widget-area'); ?>
                </ul>
        </div><!-- #secondary .widget-area -->
<?php }else{ ?>
        <div id="secondary" class="widget-area">
                <ul class="widget-list">
                        <li><?php the_widget('WP_Widget_Archives',array('title'=>__('Archives'),'count'=>0,'dropdown'=>0)); ?></li>
                        <li><?php  the_widget('WP_Widget_Meta'); ?></li>
                </ul>
        </div><!-- #secondary .widget-area -->
<?php } ?>

    </div>
