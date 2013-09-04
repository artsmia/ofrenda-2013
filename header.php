<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
   <script type="text/javascript" src="//use.typekit.net/qqt0bwy.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header" role="banner">
	<div class="site-titles-wrap">
      <a href="<?php echo home_url(); ?>"><img class="site-title" alt="Dia de los Muertos" src="<?php echo get_stylesheet_directory_uri().'/img/title.png'; ?>" /></a>
		<div class="bird"></div>
      <div class="site-subtitle">
         <h2>Young People's Ofrendas:<br />
         Expressions of Life and Remembrance</h2>
      </div>
      <div class="site-description">
      	<p>At the Minneapolis Institute of Arts<br />
         October 22 - November 24, 2013 &nbsp;&bull;&nbsp; Gallery 110 &nbsp;&bull;&nbsp; Free</p>
      </div>
  	</div>
   <div class="skeleton"></div>
</header>

<?php get_template_part('nav'); ?>