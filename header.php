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
	<title><?php wp_title( '|', true, 'right' ); ?> Young People's Ofrendas Project | The Minneapolis Institute of Arts</title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <script type="text/javascript" src="//use.typekit.net/qqt0bwy.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?> Young People's Ofrendas Project | The Minneapolis Institute of Arts">
   	<meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:image" content="<?php if(has_post_thumbnail()){ echo wp_get_attachment_url(get_post_thumbnail_id()); } else { echo get_stylesheet_directory_uri()."/img/ofrenda_fb.gif"; } ?>"> 
	<meta name="twitter:site" content="@artsmia">
	<meta name="twitter:card" content="summary">
  
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="MIA_header">
	<a href="http://new.artsmia.org"><img width="373" height="15" src="<?php echo get_stylesheet_directory_uri(); ?>/img/trans.gif" alt=""></a>
</div>
   
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