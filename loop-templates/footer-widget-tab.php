<div class="widget-post-tab-area">
	<!-- Nav tabs -->
	<ul class="tabs-indicator" id="tab-widget" role="tablist" data-tabs="tabs">
		<li class="active">
			<a id="popular-post-tab" data-toggle="tab" href="#popular_post" role="tab"
			   aria-controls="popular_post" aria-selected="true"><?php echo esc_html__( 'Popular', 'themeplate' ) ?></a>
		</li>
		<li class="">
			<a id="recent-post-tab" data-toggle="tab" href="#recent-post" role="tab"
			   aria-controls="recent-post" aria-selected="false"><?php echo esc_html__( 'Recent', 'themeplate' ) ?></a>
		</li>
		<li class="">
			<a id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments"
			   aria-selected="false"><?php echo esc_html__( 'Comments', 'themeplate' ) ?></a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="popular_post" role="tabpanel" aria-labelledby="popular-post-tab">
			<ul class="list-unstyled">
				<?php
				$cd_popularpost = new WP_Query( array(
					'posts_per_page' => $cd_atts['limit'],
					'post__not_in'   => get_option( 'sticky_posts' ),
					'meta_key'       => 'cd_post_views_count',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				) );

				if ( $cd_popularpost->have_posts() ) :
					while ( $cd_popularpost->have_posts() ) :
						$cd_popularpost->the_post();
						?>
						<li class="widget-tab-item clearfix">
							<div class="widget-tab-thumbnail">
								<?php if ( has_post_thumbnail() ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail( 'widget-post-thumb' ); ?>
									</a>
								<?php } ?>
							</div>
							<div class="widget-tab-content">
								<h4 class="widget-tab-title"><a
										href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
								<div class="widget-meta-date"><?php echo get_the_date( 'F jS, Y' ); ?></div>
							</div>
						</li>
					<?php
					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</ul>
		</div>

		<div class="tab-pane fade" id="recent-post" role="tabpanel" aria-labelledby="recent-post-tab">
			<div id="wpr-recent-posts">
				<ul class="list-unstyled">
					<?php
					$cd_recent_post = new WP_Query(
						array(
							'posts_per_page' => $cd_atts['limit'],
							'post__not_in'   => get_option( 'sticky_posts' ),
							'order'          => 'DESC'
						)
					);
					if ( $cd_recent_post->have_posts() ) :
						while ( $cd_recent_post->have_posts() ) :
							$cd_recent_post->the_post();
							?>
							<li class="widget-tab-item clearfix">
								<div class="widget-tab-thumbnail">
									<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail( 'widget-post-thumb' ); ?>
										</a>
									<?php } ?>
								</div>
								<div class="widget-tab-content">
									<h4 class="widget-tab-title"><a
											href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
									<div class="widget-meta-date"><?php echo get_the_date( 'F jS, Y' ); ?></div>
								</div>
							</li>
						<?php
						endwhile;
					endif;
					wp_reset_postdata();
					?>
				</ul>
			</div>
		</div>

		<div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
			<?php
			$comment_args = array(
				'status' => 'approve',
				'number' => $cd_atts['limit']
			);
			$comments     = get_comments( $comment_args );
			?>
			<ul class="list-unstyled">
				<?php foreach ( $comments as $comment ) { ?>
					<li class="widget-tab-item comment-block clearfix">
						<div class="widget-tab-thumbnail">
							<?php echo get_avatar( $comment, '53' ); ?>
						</div>
						<div class="widget-tab-content">
							<p class="widget-comment-author"><?php echo $comment->comment_author; ?></p>
							<div>
								<?php echo wp_html_excerpt( $comment->comment_content, 72 ) . ".."; ?>
							</div>
							<span>on</span>
							<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>">
								<?php echo get_the_title( $comment->comment_post_ID ); ?>
							</a>
						</div>
					</li>
				<?php } ?>
			</ul>
		</div>

	</div>
</div>

