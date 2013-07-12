<?php
/*
Template Name: Contact
*/
?>

<?php

	$response = "";
	
	//Generate Response
	function generate_response($type, $message) {
	
		global $response;
		
		if($type == "success") {
			$response = '<div class="alert alert-success">'.$message.'</div>';
		} else {
			$response = '<div class="alert alert-error">'.$message.'</div>';
		}
	}

	//Response Messages
	$missing_content = "Please supply all information.";
	$email_invalid   = "Email Address Invalid.";
	$message_unsent  = "Message was not sent. Try Again.";
	$message_sent    = "Thanks! Your message has been sent.";
	
	//Form Variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	//Mailer Variables
	$to = get_option('admin_email');
	//$subject = "Someone sent a message from ".get_bloginfo('name');
	$headers = 'From: '.$email."\r\n". 'Reply-To: '.$email."\r\n";

	//Validate email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		generate_response("error", $email_invalid);
	} else {
		if(empty($name) || empty($subject) || empty($message)) {
			generate_response("error", $missing_content);
		} else {
			$sent = wp_mail($to, $subject, strip_tags($message), $headers);
		}
		if($sent) {
			generate_response("success", $message_sent); //message sent!
		} else {
			generate_response("error", $message_unsent); //message wasn't sent
		} 
	} if ($_POST['submitted']) {
		generate_response("error", $missing_content);
	}

?>

<?php get_header(); ?>

	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="row">
		<h1 class="span12 page-title"><?php the_title(); ?></h1>
	</div>
	<div class="row">
		<article class="post span8" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				<div id="respond">
					<?php echo $response; ?>
					<form class="span8" action="<?php the_permalink(); ?>" method="post">
						<div class="row">
							<label for="name">Name <span class="required">*</span></label>
							<input type="text" id="name" name="name" value="<?php echo esc_attr($_POST['name']); ?>" class="span5" placeholder="Your Name" />
							<label for="email">Email Address <span class="required">*</span></label>
							<input type="text" id="email" name="email" value="<?php echo esc_attr($_POST['email']); ?>" class="span5" placeholder="Your email address" />
							<label for="subject">Subject <span class="required">*</span></label>
							<input type="text" id="subject" name="subject" value="<?php echo esc_attr($_POST['subject']); ?>" class="span5" placeholder="Subject" />
							<label for="message">Message <span class="required">*</span></label>
							<textarea id="message" name="message" class="input-xlarge span8" rows="10">
								<?php echo esc_textarea($_POST['message']); ?>
							</textarea>
							<input type="hidden" name="submitted" value="1">
							<input type="submit" value="Send" class="btn btn-primary" />
						</div>
					</form>
				</div>
			</div>
		</article>
		
		<aside class="span4">
			<div class="entry">
				<?php $options = get_option('dism_theme_options'); ?>
				<?php if ($options['contact_name']) { ?>
					<h3 class="widget-title"><?php echo $options['contact_name'] ?></h3>
				<?php } else { ?>
					<h3 class="widget-title">Contact Information</h3>
				<?php } ?>
				<ul class="contact-information">
					<?php if ($options['address']) { ?><li><i class="icon-map-marker"></i> <?php echo $options['address'] ?></li><?php } ?>
					<?php if ($options['mailing_address']) { ?><li><i class="icon-envelope"></i> <?php echo $options['mailing_address'] ?></li><?php } ?>
					<?php if ($options['phone_number']) { ?><li><i class="icon-phone"></i> <?php echo $options['phone_number'] ?></li><?php } ?>
					<?php if ($options['mobile_number']) { ?><li><i class="icon-mobile-phone"></i> <?php echo $options['mobile_number'] ?></li><?php } ?>
					<?php if ($options['fax_number']) { ?><li><i class="icon-print"></i> <?php echo $options['fax_number'] ?></li><?php } ?>
					<?php if ($options['email_address']) { ?><li><i class="icon-envelope-alt"></i> <a href="mailto:<?php echo $options['email_address'] ?>"><?php echo $options['email_address'] ?></a></li><?php } ?>
					<?php if ($options['website_address']) { ?><li><i class="icon-globe"></i> <a href="<?php echo $options['website_address'] ?>"><?php echo $options['website_address'] ?></a></li><?php } ?>
				</ul>
			</div>
		</aside>
	</div>				
	<?php endwhile; else: ?>
		<div class="row">
			<article class="post span12">
				<div class="entry">
					<h1 class="post-title"><?php _e('Page Not Found',''); ?></h1>
					<p>The page you are looking for cannot be found.</p>
					<p>Head back to the <a href="<?php bloginfo('url'); ?>">Homepage</a></p>
					<?php get_search_form(); ?>
				</div>
			</article>
		</div>
	<?php endif; ?>

<?php get_footer(); ?>