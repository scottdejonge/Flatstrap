<?php
/*
Template Name: Contact
*/
?>
<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	/*
if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
*/
	
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
		
		$options = get_option('flatstrap_theme_options');
		
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = $options['email_address'];
			$subject = 'Contact Form Submission from '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	/* } */
} 
?>

<?php get_header(); ?>

<?php if(isset($emailSent) && $emailSent == true) { ?>
	<div class="row">
		<article class="post span8" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<p>Your email was successfully sent. Thanks for contacting us! We will get in touch with you shortly.</p>
			</div>
		</article>
	</div>
<?php } else { ?>
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php if(has_post_thumbnail()) { ?>
		<section class="page-header" class="row">
			<?php the_post_thumbnail('header', array('class' => 'header-image')); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</section>
		<?php get_breadcrumbs(); ?>
	<?php } else { ?>
		<?php get_breadcrumbs(); ?>
		<div class="row">
			<h1 class="span12 page-title"><?php the_title(); ?></h1>
		</div>
	<?php } ?>
	
	<div class="row">
		<article class="post span8" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				
				<?php if(isset($hasError) || isset($captchaError)) { ?>
					<p class="error">There was an error submitting the form.<p>
				<?php } ?>
				
				<form class="span8" action="<?php the_permalink(); ?>" method="post">
					<div class="row">
						<div class="control-group <?php if($nameError != '') { ?>error<?php } ?>">
							<label for="contactName" class="control-label">Name <span class="required">*</span></label>
							<div class="controls">
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="span5 requiredField" placeholder="Your Name" />
								<?php if($nameError != '') { ?>
									<span class="help-inline"><?=$nameError;?></span>
								<?php } ?>
							</div>
						</div>
						<div class="control-group <?php if($emailError != '') { ?>error<?php } ?>">
							<label for="email">Email Address <span class="required">*</span></label>
							<div class="controls">
								<input type="text" id="email" name="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="span5 requiredField email" placeholder="Your email address" />
								<?php if($emailError != '') { ?>
									<div class="help-inline"><?=$emailError;?></div>
								<?php } ?>
							</div>
						</div>
						<div class="control-group <?php if($commentError != '') { ?>error<?php } ?>">
							<label for="message">Message <span class="required">*</span></label>
							<div class="controls">
								<textarea name="comments" id="commentsText" rows="10" cols="30" class="requiredField input-xlarge span8"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<div class="help-inline"><?=$commentError;?></div> 
								<?php } ?>
							</div>
						</div>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<input type="submit" value="Send" class="btn btn-large btn-primary" />
					</div>
				</form>
			</div>
		</article>
		
		<aside class="span4">
			<div class="entry">
				<?php $options = get_option('flatstrap_theme_options'); ?>
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