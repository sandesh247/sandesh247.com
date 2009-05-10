	<div id="primary" class="sidebar">
		<ul class="xoxo">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : // begin primary sidebar widgets ?>

			<li id="rss-links">
				<div class="hiliteimp feed_title"><?php _e( 'RSS Feeds', 'sandbox' ) ?></div>
				<ul class="items bghilite">
                                <li><a href="http://feeds2.feedburner.com/OneMeOneKeyboard" rel="alternate" type="application/rss+xml"><img src="http://www.feedburner.com/fb/images/pub/feed-icon16x16.png" alt="" style="vertical-align:middle;border:0; margin:0px"/></a>&nbsp;<a href="http://feeds2.feedburner.com/OneMeOneKeyboard" rel="alternate" type="application/rss+xml">Subscribe in a reader</a></li>
				</ul>
			</li>

      <li id="ublog" class="rss_reader" uri=
          "http://identi.ca/api/statuses/user_timeline/sandesh247.rss">
        <div class="hiliteimp feed_title">
          <a rel="me" href="http://identi.ca/sandesh247">&micro;Blog</a>
        </div>

        <div class="items bghilite"></div>
      </li>
      
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
