	<div id="primary" class="sidebar">
		<ul class="xoxo">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : // begin primary sidebar widgets ?>

			<li id="categories">
				<div class="hiliteimp feed_title"><?php _e( 'Categories', 'sandbox' ) ?></div>
				<ul class="items bghilite">
<?php wp_list_categories('title_li=&show_count=0&hierarchical=1') ?> 

				</ul>
			</li>

			<li id="archives">
				<div class="hiliteimp feed_title"><?php _e( 'Archives', 'sandbox' ) ?></div>
				<ul class="items bghilite">
<?php wp_get_archives('type=monthly') ?>

				</ul>
			</li>
<?php endif; // end primary sidebar widgets  ?>
		</ul>
	</div><!-- #primary .sidebar -->

	<div id="secondary" class="sidebar">
		<ul class="xoxo">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : // begin secondary sidebar widgets ?>
			<li id="search">
				<div class="hiliteimp feed_title"><label for="s"><?php _e( 'Search', 'sandbox' ) ?></label></div>
				<form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="s" name="s" type="text" class="text" value="<?php the_search_query() ?>" tabindex="1" />
						<input type="submit" class="button" value="<?php _e( 'Find', 'sandbox' ) ?>" tabindex="2" />
					</div>
				</form>
			</li>

			<li id="rss-links">
				<div class="hiliteimp feed_title"><?php _e( 'RSS Feeds', 'sandbox' ) ?></div>
				<ul class="items bghilite">
					<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All posts', 'sandbox' ) ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" rel="alternate" type="application/rss+xml"><?php _e( 'All comments', 'sandbox' ) ?></a></li>
				</ul>
			</li>

			<li id="meta">
				<div class="hiliteimp feed_title"><?php _e( 'Meta', 'sandbox' ) ?></div>
				<ul class="items bghilite">
					<?php wp_register() ?>

					<li><?php wp_loginout() ?></li>
					<?php wp_meta() ?>

				</ul>
			</li>
<?php endif; // end secondary sidebar widgets  ?>
		</ul>
	</div><!-- #secondary .sidebar -->
