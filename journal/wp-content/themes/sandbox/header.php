<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<link rel="stylesheet" type="text/css" href=
  "http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= get_bloginfo('url') ?>/../styles/prettify.css" />
	<link rel="stylesheet" type="text/css" href="<?= get_bloginfo('url') ?>/../styles/layout.css" />
	<link rel="stylesheet" type="text/css" href="<?= get_bloginfo('url') ?>/../styles/fonts.css" />
<?php wp_head() // For plugins ?>
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
</head>

<body class="<?php sandbox_body_class() ?>" id="doc2">

<div id="wrapper" class="hfeed">

	<div id="header" class="hiliteimp">
		<h1 id="blog-title"><span><a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
	</div><!--  #header -->

	<div id="access">
		<div class="skip-link">
		  <a href="../" title="<?php _e( 'Home', 'sandbox' ) ?>"><?php _e( 'Home', 'sandbox' ) ?></a> <br />
		  <a href="#content" title="<?php _e( 'Skip to content', 'sandbox' ) ?>"><?php _e( 'Skip to content', 'sandbox' ) ?></a>
		</div>
	</div><!-- #access -->
