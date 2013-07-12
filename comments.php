<div class="post">			
	<div class="entry">
	<?php
	
		if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die ('Please do not load this page directly. Thanks!');
	
		if ( post_password_required() ) { ?>
			This post is password protected. Enter the password to view comments.
		<?php
			return;
		}
	?>

	<?php if ( have_comments() ) : ?>
			<h3 class="comments-title"><?php comments_number('No Responses', 'One Response', '% Responses' );?></h3>
		
			<div class="navigation">
				<div class="next-posts"><?php previous_comments_link() ?></div>
				<div class="prev-posts"><?php next_comments_link() ?></div>
			</div>
			<ol class="commentlist">
				<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
			</ol>
		
			<div class="navigation">
				<div class="next-posts"><?php previous_comments_link() ?></div>
				<div class="prev-posts"><?php next_comments_link() ?></div>
			</div>
			
		 <?php else:?>
			<?php if ( comments_open() ) : ?>
				<p>Be the First to Comment.</p>
			 <?php else: ?>
				<p>Comments are closed.</p>
			<?php endif; ?>
	<?php endif; ?>


	<?php if ( comments_open() ) : ?>
		<div id="respond">
			<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
			<div class="cancel-comment-reply">
				<?php cancel_comment_reply_link('Cancel Reply'); ?>
			</div>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
				<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
			<?php else : ?>
		
		
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form-horizontal">

				<?php if ( $user_ID ) : ?>
				
				<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
				
				<?php else : ?>
				
				  <div class="control-group">
				     <label class="control-label" for="author">Name</label>
				     <div class="controls">
				        <input type="text" class="input-large" name="author" id="author" value="<?php echo $comment_author; ?>" <?php if ($req) echo "required"; ?>>
				     </div>
				  </div>  
				
				  <div class="control-group">
				     <label class="control-label" for="email">Email</label>
				     <div class="controls">
				        <input type="text" class="input-large" name="email" id="email" value="<?php echo $comment_author_email; ?>" <?php if ($req) echo "required"; ?>>
				     </div>
				  </div>
				
				  <div class="control-group">
				     <label class="control-label" for="url">Website</label>
				     <div class="controls">
				        <input type="text" class="input-large" name="url" id="url" value="<?php echo $comment_author_url; ?>" >
				     </div>
				  </div> 
				
				<?php endif; ?>
				
				  <div class="control-group">
				     <label class="control-label" for="comment">Comment</label>
				     <div class="controls">
				        <textarea class="input-xlarge" name="comment" id="comment" rows="3"></textarea>
				     </div>
				  </div> 
				
				  <div class="form-actions">
				     <input name="submit" type="submit" id="comment-submit" tabindex="5" value="Comment" class="btn" />
				     <button type="reset" class="btn">Reset</button>
				  </div>
				
					<p>
					<?php comment_id_fields(); ?>
					</p>
					<?php do_action('comment_form', $post->ID); ?>
					
					<div class="clear"></div>
				</form>
		
			<?php endif; ?>
		</div>
	
	<?php endif; ?>
	</div>
</div>