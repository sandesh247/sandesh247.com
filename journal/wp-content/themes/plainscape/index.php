<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="postmetadata">Posted 
				<!-- the date and time -->
				on <?php the_time(get_option('date_format')) ?>, <?php the_time(get_option('time_format')) ?>, 
				<!-- post author -->
				by <?php the_author() ?>, 
				<!-- post category -->
				under <?php the_category(', ') ?>.
				</div>


				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<div class="postmetadata">
				<?php if( function_exists('the_tags') ) 
						the_tags(__('Tags: '), ', ', '<br />'); 
				?>
				<?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div style="text-align:left"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div style="text-align:right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
		
		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
