<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content">
         <?php 
			$phase = get_query_var('phase');
			$posts = array();
			$query = new WP_Query( array('phase'=>$phase, 'nopaging'=>true));
			if($query->have_posts()){
				while($query->have_posts()){
					$query->the_post();
					$student = array_pop(get_the_terms($post->ID, 'student'));
					$school = get_term($student->parent, 'student');
					$posts[$school->name]['meta'] = $school;
					$posts[$school->name]['students'][$student->name]['meta'] = $student;
					$posts[$school->name]['students'][$student->name]['post'] = $post;
				}
			}
			$posts = ksortRecursive($posts);
			wp_reset_postdata();
			$phase_meta = get_term_by('slug', $phase, 'phase');
			?>
         <h3><?php echo $phase_meta->name; ?></h3>
         <div class="post">
         <?php
			echo "<div class='phase_description'>".$phase_meta->description."</div>";
			echo "<ul class='schools'>";
			foreach($posts as $school){
				echo "<li class='school'><a href='".home_url()."/school/".$school['meta']->slug."'><h4>".$school['meta']->name."</h4></a>";
				echo "<ul class='students'>";
				foreach($school['students'] as $student){
					$image = get_field('image', 'student_'.$student['meta']->term_id);
					$image_url = $image['url'];
					?>
					<li class="video">
               	<?php // Should be ofrenda image -- not student ?>
						<a href="<?php echo get_permalink($student['post']->ID); ?>"><img class="student_image" src="<?php echo $image_url; ?>" /></a>
						<a href="<?php echo get_permalink($student['post']->ID); ?>"><p class="student_name"><?php echo $student['meta']->name; ?></p></a>
					</li>
            	<?php
				}
				echo "</ul></li>";
			}
			echo "</ul>";
			?>
			</div>
      </div><!-- .large-11.columns.content -->
      <?php get_sidebar('phases'); ?><!-- .large-5.columns.sidebar -->
   </div><!-- .row -->
</div>

<?php get_footer(); ?>