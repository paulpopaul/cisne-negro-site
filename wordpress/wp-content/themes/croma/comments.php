<?php

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

<?php	if ( have_comments() ) : ?>
		<h2 class="comments-title"><?php echo wp_kses_post( sprintf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'croma' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ) )?></h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				) );
			?>
		</ol><!-- .comment-list -->

<?php		if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'croma' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'croma' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'croma' ) ); ?></div>
		</nav><!-- .comment-navigation -->
<?php		endif; // Check for comment navigation ?>

<?php		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'croma' ); ?></p>
<?php		endif; ?>

<?php	endif; // have_comments() ?>
<?php
	$iron_croma_commenter = wp_get_current_commenter();
	$iron_croma_req = get_option( 'require_name_email' );
	$iron_croma_aria_req = ( $iron_croma_req ? " aria-required='true'" : '' );

	$iron_croma_args = array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => esc_html__( 'Leave a Reply', 'croma'),
		'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'croma'),
		'cancel_reply_link' => esc_html__( 'Cancel Reply', 'croma'),
		'label_submit'      => esc_html__( 'Post Comment', 'croma'),

		'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' . esc_html__('Comment', 'croma') . '</textarea></p>',

		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<p class="comment-form-author">' .
			  '<input id="author" name="author" type="text" value="' . esc_attr( $iron_croma_commenter['comment_author'] ) .
			  '" size="30"' . $iron_croma_aria_req . ' placeholder="'. esc_html__( 'Name', 'croma' ) . ( $iron_croma_req ? ' *' : '' ) .'"/></p>',

			'email' =>
			  '<p class="comment-form-email">' .
			  '<input id="email" name="email" type="text" value="' . esc_attr(  $iron_croma_commenter['comment_author_email'] ) .
			  '" size="30"' . $iron_croma_aria_req . ' placeholder="' . esc_html__( 'Email', 'croma' ) . ( $iron_croma_req ? ' *' : '' ) . '" /></p>'
			)
		  ),
		);
?>
	<?php comment_form($iron_croma_args); ?>

</div>