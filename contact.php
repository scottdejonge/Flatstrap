<?php
/*
Template Name: Contact
*/
?>
<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		
		$options = get_option('dism_theme_options');
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = $options['email_address'];
			$subject = 'Contact Form Submission from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = 'You emailed Your Name';
				$headers = 'From: Your Name <noreply@somedomain.com>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>


<?php get_header(); ?>

<?php if(isset($emailSent) && $emailSent == true) { ?>

	<div class="thanks">
		<h1>Thanks, <?=$name;?></h1>
		<p>Your email was successfully sent. I will be in touch soon.</p>
	</div>

<?php } else { ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="row">
		<h1 class="span12 page-title"><?php the_title(); ?></h1>
	</div>
	<div class="row">
		<article class="post span8" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				
				<?php if(isset($hasError) || isset($captchaError)) { ?>
					<p class="error">There was an error submitting the form.<p>
				<?php } ?>
				
				<form class="span8" action="<?php the_permalink(); ?>" method="post">
					<div class="row">
						<label for="contactName">Name <span class="required">*</span></label>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="span5 requiredField" placeholder="Your Name" />
						<?php if($nameError != '') { ?>
							<span class="error"><?=$nameError;?></span> 
						<?php } ?>
						<label for="email">Email Address <span class="required">*</span></label>
						<input type="text" id="email" name="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="span5 requiredField email" placeholder="Your email address" />
						<?php if($emailError != '') { ?>
							<span class="error"><?=$emailError;?></span>
						<?php } ?>
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
				
				<!--
<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
	
					<ol class="forms">
						<li><label for="contactName">Name</label>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
							<?php if($nameError != '') { ?>
								<span class="error"><?=$nameError;?></span> 
							<?php } ?>
						</li>
						
						<li><label for="email">Email</label>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
							<?php if($emailError != '') { ?>
								<span class="error"><?=$emailError;?></span>
							<?php } ?>
						</li>
						
						<li class="textarea"><label for="commentsText">Comments</label>
							<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<span class="error"><?=$commentError;?></span> 
							<?php } ?>
						</li>
						<li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> /><label for="sendCopy">Send a copy of this email to yourself</label></li>
						<li class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
						<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Email me &raquo;</button></li>
					</ol>
				</form>
-->
				
				<!--
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
-->
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
	<?php endwhile; endif; ?>

<?php } ?>

<?php get_footer(); ?>