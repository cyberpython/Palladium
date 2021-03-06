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
    $comment_count = get_comments_number();
    if($comment_count > 0){
        echo "<div class='navigation'>".paginate_comments_links( array('prev_text' => __('&laquo; Previous comments'), 'next_text' => __('Next comments &raquo;')))."</div>";
        echo '<ul class="commentlist"><li class="placeholder"></li>';
        wp_list_comments();
        echo '</ul>';
        echo "<div class='navigation'>".paginate_comments_links( array('prev_text' => __('&laquo; Previous comments'), 'next_text' => __('Next comments &raquo;')))."</div>";
    }
?>

<?php comment_form(array('comment_field'=>'<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>',
                          'comment_notes_after'=>'',
                          'fields' => array(
                                'author' => '<p class="comment-form-author"> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />'
                                            . '<label for="author">'. __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .'</p>',
	                            'email'  => '<p class="comment-form-email"> <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />'
	                                        . '<label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .'</p>',
	                            'url'    => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'
	                                        .'<label for="url">' . __( 'Website' ) . '</label>' .'</p>'
                                    )
                          )
                   ); ?>
