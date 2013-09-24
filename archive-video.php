<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content video-archive">
         <h3>Videos</h3>
         <?php 
			$posts = array();
			$query = new WP_Query( array('post_type'=>'video','nopaging'=>true));
			if($query->have_posts()){
				while($query->have_posts()){
					$query->the_post();
					$student = array_pop(get_the_terms($post->ID, 'student'));
					$school = get_term($student->parent, 'student');
					$phase = array_pop(get_the_terms($post->ID, 'phase'));
					$posts[$phase->name]['meta'] = $phase;
					$posts[$phase->name]['schools'][$school->name]['meta'] = $school;
					$posts[$phase->name]['schools'][$school->name]['students'][$student->name]['meta'] = $student;
					$posts[$phase->name]['schools'][$school->name]['students'][$student->name]['post'] = $post;
				}
			}
			$posts = ksortRecursive($posts);
			wp_reset_postdata();
			?>
         <div class="post">
         <?php
			echo "<ul class='phases'>";
			foreach($posts as $phase){
				echo "<li class='phase'><a name='phase_".$phase['meta']->slug."'></a><h3>".$phase['meta']->name."</h3>";
				echo "<div class='phase_description'>".$phase['meta']->description."</div>";
				echo "<h4 class='video_label'>Phase ".$phase['meta']->slug." Videos:</h4>";
				echo "<ul class='schools'>";
				foreach($phase['schools'] as $school){
					echo "<li class='school'><a href='".home_url()."/school/".$school['meta']->slug."'><h5>".$school['meta']->name."</h5></a>";
					echo "<ul class='videos'>";
					foreach($school['students'] as $student){
						$image = get_field('image', 'student_'.$student['meta']->term_id);
						$image_url = $image['url'];
						?>
						<li class="video">
		                  	<a href="<?php echo get_permalink($student['post']->ID); ?>"><img class="student_image" src="<?php echo $image_url; ?>" /></a>
			               	<a href="<?php echo get_permalink($student['post']->ID); ?>"><p class="student_name"><?php echo $student['meta']->name; ?></p></a>
                  		</li>
						<?php
               		}
					echo "</ul></li>";
				}
				echo "</ul></li>";
			}
			echo "</ul>";
			?>
			</div>
      </div><!-- .large-11.columns.content -->
      <div class="large-5 columns">
      	<div id="sidebar" class="sidebar-container" role="complementary">
				<?php get_sidebar('translation'); ?>
		      <?php get_sidebar('general'); ?><!-- .large-5.columns.sidebar -->
         </div>
      </div>
   </div><!-- .row -->
</div>

<?php get_footer(); ?>