<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="user-scalable=0, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	
	<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/ico/favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url');?>/ico/apple-touch-icon-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo('template_url');?>/ico/apple-touch-icon-57-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url');?>/ico/apple-touch-icon-72-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url');?>/ico/apple-touch-icon-114-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_url');?>/ico/apple-touch-icon-144-precomposed.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-320-460.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-640-920.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-640-1096.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-768-1004.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-1024-748.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-1536-2008.png" />
	<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" href="<?php bloginfo('template_url');?>/images/apple-touch-startup-image-2048-1496.png" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<!--[if lt IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/font-awesome-ie7.min.css" />
	<![endif]-->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body>	

<!--[if lt IE 7]>
	<div class="alert alert-browser container">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<span class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</span>
	</div>
<![endif]-->


<nav class="navbar navbar-static-top">
	<div class="navbar-inverse">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php bloginfo('url'); ?>" title="<?php echo get_bloginfo('name'); ?>" alt="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a>
			<div class="nav-collapse collapse">
				<?php wp_nav_menu(array('main-menu' => 'Main Menu', 'depth' => 0,'container_class' => '', 'menu_class' => 'nav', 'menu_id' => 'menu', 'walker' => new Bootstrap_Walker_Nav_Menu())); ?>
				<?php social_links(); ?>
			</div>
		</div>
	</div>
</nav>

<div id="content" class="container">