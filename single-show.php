<?php get_header(); ?>

<div class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="single-show">
				<?php
				$show_id = intval(get_the_ID());
				$show = new Event($show_id);
				?>

				<img class="single-show-image" src="<?php echo $show->get_image_url(); ?>" />
				<div class="single-show-info padded-content">
					<h1 class="page-title" style="margin: 0;"><?php echo $show->get_title(); ?></h1>
					<div><?php echo $show->get_artists_string(); ?></div>
					<span class="single-show-date"><?php echo $show->get_date_string(); ?></span>
					<div class="live-now-icons">
						<a href="<?php echo $show->get_stream_url() ?>">
							<img title="play" src="<?php echo get_bloginfo('template_directory'); ?>/images/play.png">
						</a>

						<!-- TODO Where are you headed? -->
						<img title="audio" src="<?php echo get_bloginfo('template_directory'); ?>/images/audio.png">
					</div>
					<?php the_content() ?>
					<span class="show-item-info-tags" style="padding-top: 1rem;">
						<?php echo $show->get_genres_string(); ?>
					</span>
				</div>
			</div>

			<div class="related-shows padded-content">
				<h1>Related Shows</h1>
				<ul class="show-list-image">

					<?php
					$loop = new WP_Query(
						array(
							'post_type' => 'show',
							'posts_per_page' => -1,
							'post_status' => 'publish',
							'meta_key' => 'begin_date',
							'orderby' => 'meta_value_num',
							'meta_type' => 'DATE',
							'order' => 'ASC'
						)
					);

					?>

					<?php while ($loop->have_posts()) : $loop->the_post(); ?>
						<?php
						$s_show_id = intval(get_the_ID());
						$s_show = new Event($s_show_id);

						if ($s_show->get_format()->get_id() == $show->get_format()->get_id() && $show_id != $s_show_id) {
						?>
							<li class="show-item-image">
								<a href="<?php the_permalink(); ?>">
									<div class="show-item-image-image"><img src="<?php echo $s_show->get_image_url('medium'); ?>" />
									</div>
									<div class="show-item-image-info">
										<div class="show-item-image-info-title"><?php echo $s_show->get_title(); ?></div>
										<div class="show-item-image-info-date"><?php echo $s_show->get_date_string(); ?></div>
									</div>
								</a>
								<span class="show-item-info-tags">
									<?php echo $s_show->get_artists_string(true); ?>
									<?php echo $s_show->get_genres_string(true); ?>
								</span>
							</li>
					<?php
						}
					endwhile;
					wp_reset_query();
					?>

				</ul>
			</div>
	<?php endwhile;
	endif; ?>

</div>

<?php get_footer(); ?>