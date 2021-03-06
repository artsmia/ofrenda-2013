<?php get_header(); ?>

<div id="main" class="site-main">
   <div class="row">
      <div class="large-11 columns content ofrenda-archive">
         <h2>Ofrendas</h2>
         <?php 
			$posts = array();
			$query = new WP_Query( array('post_type'=>'ofrenda','nopaging'=>true));
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
			?>
         <div class="post">
         <?php
			echo "<ul class='schools'>";
			foreach($posts as $school){
				echo "<li class='school'><a href='".home_url()."/school/".$school['meta']->slug."'><h3>".$school['meta']->name."</h3></a>";
				echo "<ul class='students'>";
				foreach($school['students'] as $student){
					$student_image = get_field('image', 'student_'.$student['meta']->term_id);
					$student_image_url = $student_image['url'];
          $ofrenda_image = get_field('image', $student['post']->ID);
          $ofrenda_image_url = $ofrenda_image['sizes']['thumbnail'];
					?>
					<li class="ofrenda">
            <a href="<?php echo get_permalink($student['post']->ID); ?>"><img class="ofrenda_thumb" src="<?php echo $ofrenda_image_url; ?>" /></a>
						<a href="<?php echo get_permalink($student['post']->ID); ?>"><img class="student_image" src="<?php echo $student_image_url; ?>" /></a>
						<a href="<?php echo get_permalink($student['post']->ID); ?>"><p class="ofrenda_name"><?php echo get_the_title($student['post']->ID); ?></p></a>
					</li>
            	<?php
				}
				echo "</ul></li>";
			}
			echo "</ul>";
			?>
			</div>
      </div><!-- .large-11.columns.blog -->
      <div class="large-5 columns">
      	<div id="sidebar" class="sidebar-container" role="complementary">
				<?php get_sidebar('translation'); ?>
		      <?php get_sidebar('general'); ?><!-- .large-5.columns.sidebar -->
         </div>
      </div>
   </div><!-- .row -->
</div>

<?php get_footer(); ?>